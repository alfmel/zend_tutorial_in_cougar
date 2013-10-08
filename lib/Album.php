<?php

namespace ZendTutorialInCougar;

use Cougar\Security\iSecurity;

# Initialize the Cougar framework and add the application path
require_once("cougar.php");
\Cougar\Autoload\FlexAutoload::addPath(__DIR__, 1);

/**
 * Provides the Album API, which allows for the querying, creating, reading,
 * updating and deleting of Albums.
 */
class Album
{
    /**
     * Stores the references to the security context and model factory.
     *
     * @param \Cougar\Security\iSecurity $security
     *   Security context
     * @param AlbumModelFactory $factory
     *   Album model factory
     */
    public function __construct(iSecurity $security, AlbumModelFactory $factory)
    {
        // Store the references
        $this->security = $security;
        $this->factory = $factory;
    }

    /**
     * Returns a list of albums. You may optionally pass a list of query
     * parameters to limit your search.
     *
     * @Path /album
     * @Methods GET
     * @GetQuery query
     * @XmlRootElement albums
     * @XmlObjectName album
     *
     * @var array $query
     *   Optional query parameters
     * @return array Album list
     */
    public function getAlbumList(array $query = array())
    {
        $pdo_model = $this->factory->AlbumPdoModel();
        return $pdo_model->query($query);
    }

    /**
     * Creates a new album with the given Artist and Title.
     *
     * @Path /album
     * @Methods POST
     * @Accepts json
     * @Body album object
     * @XmlRootElement album
     *
     * @var mixed $album
     *   Album model, object or assoc. array with album information
     * @return AlbumModel New album as a model
     */
    public function createAlbum($album)
    {
        $new_album = $this->factory->AlbumPdoModel();
        $new_album->__import($album);
        $new_album->save();

        # Detach from database
        return $this->factory->AlbumModel($new_album);
    }

    /**
     * Gets the album associated with the given Album ID
     *
     * @Path /album/:id
     * @Methods GET
     * @XmlRootElement album
     *
     * @var int $id
     *   Album ID
     * @return AlbumModel Album
     * @throws \Cougar\Exceptions\RecordNotFoundException
     */
    public function getAlbum($id)
    {
        $album = $this->factory->AlbumPdoModel(array("id" => $id));

        # Detach from the database
        return $this->factory->AlbumModel($album);
    }

    /**
     * Updates the given album with the new information (ID cannot be changed)
     *
     * @Path /album/:id
     * @Methods PUT
     * @Accepts json
     * @Body album object
     * @XmlRootElement album
     *
     * @var mixed $album
     *   Album model, object or assoc. array with ID and updated information
     * @return AlbumModel updated album
     */
    public function updateAlbum($album)
    {
        $album = $this->factory->AlbumPdoModel($album);
        $album->save();

        # Detach from database
        return $this->factory->AlbumModel($album);
    }

    /**
     * Deletes the album associated with the given Album ID
     *
     * @Path /album/:id
     * @Methods DELETE
     *
     * @var int $id
     *   Album ID
     */
    public function deleteAlbum($id)
    {
        $album = $this->factory->AlbumPdoModel(array("id" => $id));
        $album->delete();
    }

    /**
     * @var \Cougar\Security\iSecurity Security context
     */
    protected $security;

    /**
     * @var AlbumModelFactory
     */
    protected $factory;
}
?>
