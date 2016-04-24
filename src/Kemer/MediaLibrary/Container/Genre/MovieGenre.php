<?php
namespace Kemer\MediaLibrary\Container\Genre;

use Kemer\MediaLibrary\Container\Genre as BaseGenre;
/**
 * A ‘movieGenre’ instance is a ‘genre’ which should be interpreted as a
 * “style of movies”. A ‘movieGenre’ container can contain objects of class
 * ‘people’, ‘videoItem’ or “sub”-movie genres of the same class (e.g. ‘Western’
 * contains ‘Spaghetti Western’). Which classes of objects a ‘movieGenre’ contains
 * in a ContentDirectory implementation is device-dependent. The class is derived
 * from ‘genre’ and currently does not add any properties.
 */
class MovieGenre extends BaseGenre
{
    /** @class upnp */
    public $class = "object.container.genre.movieGenre";
}
