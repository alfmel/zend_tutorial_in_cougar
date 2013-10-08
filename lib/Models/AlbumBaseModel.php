<?php

namespace ZendTutorialInCougar;

/**
 * Defines the properties in the Album database table
 *
 * @CaseInsensitive
 */
abstract class AlbumBaseModel
{
    /**
     * @var int Album ID
     */
    public $id;

    /**
     * @NotNull
     * @var string Album artist
     */
    public $artist;

    /**
     * @NotNull
     * @var string Album title
     */
    public $title;
}
