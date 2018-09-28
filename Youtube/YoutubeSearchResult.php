<?php
namespace X\Service\Youtube;
class YoutubeSearchResult {
    public $project = null;
    public $id = null;
    public $publishedAt;
    public $channelId;
    public $title;
    public $description;
    public $thumbnails;
    public $channelTitle;
    public $liveBroadcastContent;
    
    /**
     * @return boolean
     */
    public function isVideo() {
        return 'youtube#video' === $this->id['kind'];
    }
    
    /**
     * @return boolean
     */
    public function isPlaylist() {
        return 'youtube#playlist' === $this->id['kind'];
    }
    
    /**
     * @throws YoutubeException
     * @return \X\Service\Youtube\YoutubeVideo
     */
    public function getVideo() {
        if ( !$this->isVideo() ) {
            throw new YoutubeException('this result is not a video');
        }
        return YoutubeVideo::withProject($this->project)->getById($this->id['videoId']);
    }
    
    /**
     * @throws YoutubeException
     * @return \X\Service\Youtube\YoutubePlaylist
     */
    public function getPlayList() {
        if ( !$this->isVideo() ) {
            throw new YoutubeException('this result is not a playlist');
        }
        return YoutubePlaylist::withProject($this->project)->getById($this->id['playlistId']);
    }
}