<?php
namespace X\Service\Youtube;
class YoutubeVideo extends YoutubeObjectBase {
    /** @var string */
    const KIND = 'videos';
    
    /** @var string */
    public $publishedAt = null;
    /** @var string */
    public $channelId = null;
    /** @var string */
    public $title = null;
    /** @var string */
    public $description = null;
    /** @var array */
    public $thumbnails = null;
    /** @var string */
    public $channelTitle = null;
    /** @var array */
    public $tags = array();
    /** @var string */
    public $categoryId = null;
    /** @var string */
    public $defaultLanguage = null;
    /** @var string */
    public $defaultAudioLanguage = null;
    /** @var string */
    public $id;
    
    /**
     * @param unknown $chart
     * @param unknown $limit
     * @param unknown $page
     * @return \X\Service\Youtube\ListResult
     */
    public function findByChart( $chart, $limit, $page ) {
        return $this->findByAttributes('chart', $chart, $limit, $page);
    }
    
    /**
     * @return \X\Service\Youtube\YoutubeVideoCategory
     */
    public function getCategory() {
        return YoutubeVideoCategory::withProject($this->getProject())->getById($this->categoryId);
    }
}