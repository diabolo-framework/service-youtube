<?php
namespace X\Service\Youtube\Test\Service;
use PHPUnit\Framework\TestCase;
use X\Service\Youtube\YoutubePlaylist;
class YoutubePlaylistTest extends TestCase {
    public function test_playlistModel() {
        $playlistMan = YoutubePlaylist::withProject('test');
        
        $page = null;
        $playlists = $playlistMan->findByIds(array('PLDxVetiIKvZ8Xy1pXsyphE8z9P2xTaUtd','PLDxVetiIKvZ-iUaLOzz6M-jA66A7ll7_P'), 10, $page);
        $this->assertEquals(2, count($playlists));
        
        $page = null;
        do {
            $playlists = $playlistMan->findByChannelId('UCtDdB-mu47GeMOroAQOb0Sg', 10, $page);
            foreach ( $playlists as $playlist ) {
                echo "{$playlist->title}\n";
            }
            if ( null === $playlists->nextPageToken ) {
                break;
            }
            $page = $playlists->nextPageToken;
        } while( true );
    }
}