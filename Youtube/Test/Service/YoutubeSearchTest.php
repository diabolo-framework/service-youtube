<?php
namespace X\Service\Youtube\Test\Service;
use PHPUnit\Framework\TestCase;
use X\Service\Youtube\YoutubeSearch;
class YoutubeSearchTest extends TestCase {
    public function test_playlistModel() {
        $searchMan = YoutubeSearch::withProject('test');
        
        $searchMan->q = 'QQ';
        $result = $searchMan->search();
    }
}