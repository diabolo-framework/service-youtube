# service-youtube
youtube service for diabolo framework

## configuration
```
'Youtube' => array(
    'class' => \X\Service\Youtube\Service::class,
    'enable' => true,
    'delay' => true,
    'params' => array(
        'projects' => array(
            'test' => array(
                'key' => 'AIzaSyDTXTo-7ZjXn65b93PrLu2zuvylSSXg4d4',
                'proxy' => '127.0.0.1',
                'proxyPort' => 1080,
                'proxyType' => CURLPROXY_HTTP,
            ),
        ),
    ),
),
```

## Basic usage
```
use X\Service\Youtube\YoutubeVideo;
use X\Service\Youtube\YoutubePlaylist;
use X\Service\Youtube\YoutubeChannel;

# get video info by video id
$video = YoutubeVideo::withProject('test')->getById('video-id');
echo $video->title; 
echo $video->description;

# find video by video id list
$videos = YoutubeVideo::withProject('test')->findByIds(['video-id-1', 'video-id-2'], 10, null);
echo count($videos);

# get playlist information by playlist id
$playlist = YoutubePlaylist::withProject('test')->getById('playlist-id')
echo $playlist->title;
echo $playlist->description;

# list items in playlist
$items = $playlist->getItems(10, null);
foreach ( $items as $item ) {
   echo $item->getVideo()->title;
}
echo count($items);
if ( null !== $items->nextPageToken ) {
    $nextPageItems = $playlist->getItems(10, $items->nextPageToken);
}

# find playlist by id list
$playlists = YoutubePlaylist::withProject('test')->findByIds(['p-id-1', 'p-id-2'], 10, null);
echo count($playlists);

# find playlist by channel id 
$playlists = YoutubePlaylist::withProject('test')->findByChannelId('channels', 10, null);
echo count($playlists);

# get channel information by id
$channel = YoutubeChannel::withProject('test')->getById('channel-id');
echo $channel->title;

# find channel by id list
$channels = YoutubeChannel::withProject('test')->findByIds(['c-id-1', 'c-id-2'], 10, null);
echo count($channels);
```
