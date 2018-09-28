<?php
namespace X\Service\Youtube;
/**
 * @link https://developers.google.com/apis-explorer/#p/youtube/v3/youtube.playlistItems.list
 */
class YoutubePlaylistItem extends YoutubeObjectBase {
    /** @var string */
    const KIND = 'playlistItems';
    
    /** @var string */
    public $id = null;
    /** @var string */
    public $publishedAt = null;
    /** @var string */
    public $channelId = null;
    /** @var string */
    public $title = null;
    /** @var string */
    public $description = null;
    /** @var string */
    public $playlistId = null;
    /** @var array */
    public $resourceId = null;
    /** @var array */
    protected $thumbnails = array();
    
    /**
     * @param string $type
     * @return mixed
     */
    public function getThumbnails( $type='default' ) {
        return $this->thumbnails[$type]['url'];
    }
    
    /**
     * @return string
     */
    public function getVideoId() {
        return $this->resourceId['videoId'];
    }
    
    /**
     * @return \X\Service\Youtube\YoutubeVideo
     */
    public function getVideo() {
        return YoutubeVideo::withProject($this->getProject())->getById($this->getVideoId());
    }
}