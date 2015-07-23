<?php
namespace Kemer\MediaLibrary\Container\Genre;

/**
 * A ‘movieGenre’ instance is a ‘genre’ which should be interpreted as a
 * “style of movies”. A ‘movieGenre’ container can contain objects of class
 * ‘people’, ‘videoItem’ or “sub”-movie genres of the same class (e.g. ‘Western’
 * contains ‘Spaghetti Western’). Which classes of objects a ‘movieGenre’ contains
 * in a ContentDirectory implementation is device-dependent. The class is derived
 * from ‘genre’ and currently does not add any properties.
 */
class VideoGenre extends GenreContainer
{

}
