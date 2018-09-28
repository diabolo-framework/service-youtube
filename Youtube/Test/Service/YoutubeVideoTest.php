<?php
namespace X\Service\Youtube\Test\Service;
use PHPUnit\Framework\TestCase;
use X\Service\Youtube\YoutubeVideo;
class YoutubeVideoTest extends TestCase {
    public function test_playlistModel() {
        $videoMan = YoutubeVideo::withProject('test');
        
        $page = null;
        $videos = $videoMan->findByIds(array('mPJCZl6UVM8','LaFrEPC_9MA'), 10, $page);
        $this->assertEquals(2, count($videos));
    }
}