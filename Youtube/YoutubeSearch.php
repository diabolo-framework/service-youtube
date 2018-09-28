<?php
namespace X\Service\Youtube;
/**
 * @link https://developers.google.com/apis-explorer/#p/youtube/v3/youtube.search.list
 */
class YoutubeSearch {
    const CHANNEL_TYPE_ANY = 'any';
    const CHANNEL_TYPE_SHOW = 'show';
    
    const EVENT_TYPE_COMPLETED = 'completed';
    const EVENT_TYPE_LIVE = 'live';
    const EVENT_TYPE_UPCOMING = 'upcoming';
    
    const ORDER_DATE = 'date';
    const ORDER_RATING = 'rating';
    const ORDER_RELEVANCE = 'relevance';
    const ORDER_TITLE = 'title';
    const ORDER_VIDEOCOUNT = 'videoCount';
    const ORDER_VIEWCOUNT = 'viewCount';
    
    const SAFE_SEARCH_MODERATE = 'moderate';
    const SAFE_SEARCH_NONE = 'none';
    const SAFE_SEARCH_STRICT = 'strict';
    
    const VIDEO_CAPTION_ANY = 'any';
    const VIDEO_CAPTION_CLOSEDCAPTION = 'closedCaption';
    const VIDEO_CAPTION_NONE = 'none';
    
    const VIDEO_DEFINITION_ANY = 'any';
    const VIDEO_DEFINITION_HIGH = 'high';
    const VIDEO_DEFINITION_STANDARD = 'standard';
    
    const VIDEO_DIMENSION_2D = '2d';
    const VIDEO_DIMENSION_3D = '3d';
    const VIDEO_DIMENSION_ANY = 'any';
    
    const VIDEO_DURATION_ANY = 'any';
    const VIDEO_DURATION_LONG = 'long';
    const VIDEO_DURATION_MEDIUM = 'medium';
    const VIDEO_DURATION_SHORT = 'short';
    
    const VIDEO_EMBEDDABLE_ANY = 'any';
    const VIDEO_EMBEDDABLE_TRUE = 'true';
    
    const VIDEO_LICENSE_ANY = 'any';
    const VIDEO_LICENSE_REATIVECOMMON = 'reativeCommon';
    const VIDEO_LICENSE_YOUTUBE = 'youtube';
    
    const VIDEO_SYNDICATED_ANY = 'any';
    const VIDEO_SYNDICATED_TRUE = 'true';
    
    const VIDEO_TYPE_ANY = 'any';
    const VIDEO_TYPE_EPISODE = 'episode';
    const VIDEO_TYPE_MOVIE = 'movie';
    
    /** @var YoutubeProject */
    private $project = null;
    
    public $channelId = null;
    public $channelType = null;
    public $eventType = null;
    public $maxResults = null;
    public $order = null;
    public $pageToken = null;
    public $publishedAfter = null;
    public $publishedBefore = null;
    public $q = null;
    public $regionCode = null;
    public $relatedToVideoId = null;
    public $safeSearch = null;
    public $topicId = null;
    public $type = null;
    public $videoCategoryId = null;
    public $videoCaption = null;
    public $videoDefinition = null;
    public $videoDimension = null;
    public $videoDuration = null;
    public $videoEmbeddable = null;
    public $videoLicense = null;
    public $videoSyndicated = null;
    public $videoType = null;
    
    /**
     * @param string|YoutubeProject $project
     * @return self
     */
    public static function withProject( $project ) {
        $model = new static();
        $model->project = Service::getService()->getProject($project);
        return $model;
    }
    
    /**
     * @return \X\Service\Youtube\ListResult
     */
    public function search() {
        $params = array(
            'part' => 'snippet',
            'channelId' => $this->channelId,
            'channelType' => $this->channelType,
            'eventType' => $this->eventType,
            'maxResults' => $this->maxResults,
            'order' => $this->order,
            'pageToken' => $this->pageToken,
            'publishedAfter' => $this->publishedAfter,
            'publishedBefore' => $this->publishedBefore,
            'q' => $this->q,
            'regionCode' => $this->regionCode,
            'relatedToVideoId' => $this->relatedToVideoId,
            'safeSearch' => $this->safeSearch,
            'topicId' => $this->topicId,
            'type' => $this->type,
            'videoCategoryId' => $this->videoCategoryId,
            'videoCaption' => $this->videoCaption,
            'videoDefinition' => $this->videoDefinition,
            'videoDimension' => $this->videoDimension,
            'videoDuration' => $this->videoDuration,
            'videoEmbeddable' => $this->videoEmbeddable,
            'videoLicense' => $this->videoLicense,
            'videoSyndicated' => $this->videoSyndicated,
            'videoType' => $this->videoType,
        );
        $response = $this->project->call('search', $params);
        
        $list = array();
        foreach ( $response['items'] as $item ) {
            $resultItem = new YoutubeSearchResult();
            $resultItem->project = $this->project;
            $resultItem->id = $item['id'];
            foreach ( $item['snippet'] as $key => $value ) {
                $resultItem->$key = $value;
            }
            $list[] = $resultItem;
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