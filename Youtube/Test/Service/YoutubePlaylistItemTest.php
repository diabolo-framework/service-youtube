<?php
namespace X\Service\Youtube\Test\Service;
use PHPUnit\Framework\TestCase;
use X\Service\Youtube\YoutubePlaylistItem;
class YoutubePlaylistItemTest extends TestCase {
    public function test_playlistModel() {
        $playlistItemMan = YoutubePlaylistItem::withProject('test');
        
        $page = null;
        do {
            $page = null;
            $playlistItems = $playlistItemMan->findByPlaylistId('PLDxVetiIKvZ8Xy1pXsyphE8z9P2xTaUtd', 50, $page);
            foreach ( $playlistItems as $playlistItem ) {
                echo "{$playlistItem->title}\n";
            }
            if ( null === $playlistItems->nextPageToken ) {
                break;
            }
            $page = $playlistItems->nextPageToken;
        } while( true );
    }
}