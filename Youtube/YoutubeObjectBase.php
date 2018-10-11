<?php
namespace X\Service\Youtube;
use X\Service\Youtube\Service as YoutubeService;
abstract class YoutubeObjectBase {
    /** @var mixed */
    const KIND = null;
    
    /**
     * @param string|YoutubeProject $project
     * @return self
     */
    public static function withProject( $project ) {
        $model = new static();
        $model->setProject($project);
        return $model;
    }
    
    /** @var YoutubeProject */
    private $project = null;
    
    /**
     * @param string|YoutubeProject $project
     * @return self
     */
    public function setProject( $project ) {
        $this->project = YoutubeService::getService()->getProject($project);
        return $this;
    }
    
    /**
     * @return \X\Service\Youtube\YoutubeProject
     */
    public function getProject() {
        return $this->project;
    }
    
    /**
     * @param unknown $values
     * @return self
     */
    public function setValues( $values ) {
        foreach ( $values as $attr => $value ) {
            $this->$attr = $value;
        }
        return $this;
    }
    
    /**
     * list by id
     * @param array $idList
     * @return self[]
     */
    public function findByIds( $idList, $limit, $page ) {
        return $this->findByAttributes('id', implode(',', $idList), $limit, $page);
    }
    
    /**
     * @param string $id
     * @return self
     */
    public function getById( $id ) {
        $list = $this->findByIds(array($id), 1, null);
        if ( 0 === count($list) ) {
            return null;
        }
        return $list[0];
    }
    
    /**
     * find targets by attribute
     * @param array $idList
     */
    protected function findByAttributes( $attrName, $attrValue, $limit, $page ) {
        $params = array(
            $attrName => $attrValue,
            'part' => 'snippet',
            'maxResults' => $limit,
            'pageToken' => $page,
        );
        $response = $this->project->call(static::KIND, $params);
        return $this->setupListResultByListResponse($response);
    }
    
    /**
     * @param unknown $response
     * @return \X\Service\Youtube\ListResult
     */
    protected function setupListResultByListResponse( $response ) {
        $list = array();
        foreach ( $response['items'] as $item ) {
            $model = new static();
            $model->id = $item['id'];
            $model->project = $this->project;
            $model->setValues($item['snippet']);
            $list[] = $model;
        }
        
        $result = new ListResult($list);
        if ( isset($response['nextPageToken']) ) {
            $result->nextPageToken = $response['nextPageToken'];
        }
        if ( isset($response['prevPageToken']) ) {
            $result->prevPageToken = $response['prevPageToken'];
        }
        $result->totalCount = $response['pageInfo']['totalResults'];
        $result->pageSize = $response['pageInfo']['resultsPerPage'];
        return $result;
    }
}