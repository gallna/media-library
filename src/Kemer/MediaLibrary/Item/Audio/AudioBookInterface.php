<?php
namespace Kemer\MediaLibrary\Item\Audio;

/**
 * An ‘audioBook’ instance is a discrete piece of audio that should be interpreted
 * as a book (as opposed to, for example, a news broadcast or a song).
 * It typically has at least 1 <res> element.
 */
interface AudioBookInterface extends AudioItemInterface
{
    // upnp:storageMedium No
    // upnp:producer No
    // dc:contributor No
    // dc:date No
}
