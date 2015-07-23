<?php
namespace Kemer\MediaLibrary\Container\Genre;

/**
 * A ‘musicGenre’ instance is a ‘genre’ which should be interpreted as a “style of music”.
 * A ‘musicGenre’ container can contain objects of class ‘musicArtist, ‘musicAlbum’,
 * ‘audioItem’ or “sub”-music genres of the same class (e.g. ‘Rock’ contains ‘Alternative Rock’).
 * Which classes of objects a ‘musicGenre’ contains in a ContentDirectory implementation
 * is device-dependent. The class is derived from ‘genre’ and currently
 * does not add any properties.
 */
class MusicGenre extends GenreContainer
{

}
