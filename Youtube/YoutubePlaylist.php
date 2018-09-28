<?php
namespace X\Service\Youtube;
class YoutubePlaylist extends YoutubeObjectBase {
    /** @var string */
    const KIND = 'playlists';
    
    /** @var string */
    public $id = null;
    /** @var string */
    public $title = null;
    /** @var string */
    public $description = null;
    /** @var string */
    public $publishedAt = null;
    /** @var string */
    public $channelId = null;
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
     * @param unknown $limit
     * @param unknown $page
     * @return YoutubePlaylistItem[]
     */
    public function getItems($limit, $page) {
        return YoutubePlaylistItem::withProject($this->getProject())
        ->findByPlaylistId($this->id, $limit, $page);
    }
    
    /**
     * list playlist by channel id
     * @param string $channelId
     * @link https://developers.google.com/apis-explorer/#p/youtube/v3/youtube.playlists.list
     */
    public function findByChannelId( $channelId, $limit, $page ) {
        return $this->findByAttributes('channelId', $channelId, $limit, $page);
    }
}