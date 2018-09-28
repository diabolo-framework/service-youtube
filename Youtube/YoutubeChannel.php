<?php
namespace X\Service\Youtube;
class YoutubeChannel extends YoutubeObjectBase {
    /** @var string */
    const KIND = 'channels';
    
    /** @var string */
    public $id = null;
    /** @var string */
    public $title;
    /** @var string */
    public $description;
    /** @var string */
    public $customUrl;
    /** @var string */
    public $publishedAt;
    /** @var array */
    public $thumbnails;
    /** @var array */
    public $localized;
}