<?php
namespace X\Service\Youtube;
class YoutubeVideoCategory extends YoutubeObjectBase {
    /** @var string */
    const KIND = 'videoCategories';
    /** @var string */
    public $id = null;
    /** @var string */
    public $channelId = null;
    /** @var string */
    public $title = null;
    /** @var string */
    public $assignable = null;
    
    /**
     * @param unknown $regionCode
     * @param unknown $limit
     * @param unknown $page
     * @return \X\Service\Youtube\ListResult
     */
    public function findByRegionCode( $regionCode, $limit, $page ) {
        return $this->findByAttributes('regionCode', $regionCode, $limit, $page);
    }
}