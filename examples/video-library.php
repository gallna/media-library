<?php
require '../vendor/autoload.php';

use Kemer\MediaLibrary\Library;
use Kemer\MediaLibrary\Container;
use Kemer\MediaLibrary\Container\Genre\VideoGenre;
use Kemer\MediaLibrary\Container\Album\VideoAlbum;
use Kemer\MediaLibrary\Container\Actor\MovieActor;
use Kemer\MediaLibrary\Container\StorageFolder;
use Kemer\MediaLibrary\Container\PlaylistContainer;
use Kemer\MediaLibrary\Item\VideoItem;
use Kemer\MediaLibrary\Factory;
use Kemer\MediaLibrary\Factory\ItemFactory;
use Kemer\MediaLibrary\Factory\ContainerFactory;
use Kemer\MediaLibrary\Builder;
use Kemer\MediaLibrary\Filters;
ini_set('max_execution_time', 300);
// Connection creation
$memcache = new Memcache();
$cacheAvailable = $memcache->connect('127.0.0.1', '11211');
$key = 'storageFolder';

$library = new Library();

/* add some content */
// add content from example folder using StorageFolderFactory
$builder = new Builder\GetID3Builder(new getID3(), $memcache);
$itemFactory = new ItemFactory\StorageItemFactory();
$storageFactory = new Factory\StorageFolderFactory($itemFactory, $builder);
$storageFolder = $storageFactory->createStorageFolder(dirname(__DIR__)."/media");

$library->add($storageFolder);

$items = new ArrayIterator($library->getItems());

$videoFilter = new Filters\VideoFilter($items);
$videoLibrary = new Library();
$videoLibrary->set($videoFilter);

$musicFilter = new Filters\MusicFilter($items);
$musicLibrary = new Library();
$musicLibrary->set($musicFilter);

/* GenreFactory instance to create GenreContainerInterface containers from library */
$genreFactory = new ContainerFactory\GenreFactory();

/* Container for VideoGenre containers (optional) */
$videoGenreContainer  = new Container(9, "Video/Genre");
$genreFactory->createVideoGenre($videoLibrary, $videoGenreContainer);

/* Container for MusicGenre containers (optional) */
$musicGenreContainer  = new Container(5, "Music/Genre");
$genreFactory->createMusicGenre($musicLibrary, $musicGenreContainer);

/* GenreFactory instance to create MusicAlbum containers from library */
$albumFactory = new ContainerFactory\AlbumFactory();

/* Container for MusicAlbum containers (optional) */
$musicAlbumContainer  = new Container(6, "Music/Album");
$albumFactory->createMusicAlbum($musicLibrary, $musicAlbumContainer);

/* GenreFactory instance to create GenreContainerInterface containers from library */
$personFactory = new ContainerFactory\PersonFactory();

/* Container for MovieActor containers (optional) */
$videoActorContainer  = new Container("A", "Video/Actor");
$personFactory->createActor($videoLibrary, $videoActorContainer);

/* Container for MusicArtist containers (optional) */
$musicArtistContainer  = new Container(107, "Music/Artist");
$personFactory->createArtist($musicLibrary, $musicArtistContainer);

/* Container for video containers and items */
$videoContainer = new Container(2, "Videos");
$videoContainer->add($videoGenreContainer);
$videoContainer->add($videoActorContainer);

/* Container for music containers and items */
$musicContainer = new Container(1, "Music");
$musicContainer->add($musicGenreContainer);
$musicContainer->add($musicArtistContainer);
$musicContainer->add($musicAlbumContainer);

/* Root Container for root items */
$root = new Container(0, "Content");
$root->add($videoContainer);
$root->add($musicContainer);

$lib = new Library();
$lib->add($root);

$xml = new SimpleXMLIterator('<DIDL-Lite xmlns="urn:schemas-upnp-org:metadata-1-0/DIDL-Lite/" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:dlna="urn:schemas-dlna-org:metadata-1-0/" xmlns:upnp="urn:schemas-upnp-org:metadata-1-0/upnp/"></DIDL-Lite>');
$dom = new \DOMDocument("1.0");
$dom->formatOutput = true;
$dom->loadXML($videoGenreContainer->asXML()->asXML());
var_dump($dom->saveXML());
//var_dump($lib->get(5));


// new Container(8, "Video/All Video")
// new Container(9, "Video/Genre")
// new Container("A", "Video/Actor")
// new Container("E", "Video/Series")
// new Container(10, "Video/Playlists")
// new Container(15, "Video/Folders")
// new Container(200, "Video/Rating")
// new Container(201, "Video/Rating/1 or more stars")
// new Container(201, "Video/Rating/2 or more stars")
// new Container(201, "Video/Rating/3 or more stars")
// new Container(201, "Video/Rating/4 or more stars")
// new Container(201, "Video/Rating/5 or more stars")

