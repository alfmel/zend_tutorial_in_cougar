<?php

namespace ZendTutorialInCougar;

use PDO;
use Cougar\Security\iSecurity;
use Cougar\Cache\iCache;

# Initialize the Cougar framework and add the application path
require_once("cougar.php");
\Cougar\Autoload\FlexAutoload::addPath(__DIR__, 1);

/**
 * Stores the dependencies for the AlbumModel classes and returns new instances
 * when needed.
 */
class AlbumModelFactory
{
    /**
     * Stores the references to the security context, cache object and database
     * connection (PDO).
     *
     * @param iSecurity $security
     *   Security context
     * @param iCache $cache
     *   Cache object
     * @param PDO $pdo
     *   Database connection
     */
    public function __construct(iSecurity $security, iCache $cache, PDO $pdo)
    {
        // Store the object references
        $this->security = $security;
        $this->cache = $cache;
        $this->pdo = $pdo;
    }

    /**
     * Returns a new instance of the AlbumModel object
     *
     * @var mixed $object
     *   Object or assoc. array to import from
     * @var string $view
     *   Set the initial view
     * @var bool strict
     *   Whether to perform strict property checks
     * @return AlbumModel
     */
    public function AlbumModel($object = null, $view = null, $strict = true)
    {
        return new AlbumModel($object, $view, $strict);
    }

    /**
     * Returns a new instance of the AlbumModel object
     *
     * @var mixed $object
     *   Object or assoc. array to import from
     * @var string $view
     *   Set the initial view
     * @var bool strict
     *   Whether to perform strict property checks
     * @return AlbumModel
     */
    public function AlbumPdoModel($object = null, $view = null, $strict = true)
    {
        return new AlbumPdoModel($this->security, $this->cache, $this->pdo,
            $object, $view, $strict);
    }

    /**
     * @var iSecurity Security context
     */
    protected $security;

    /**
     * @var iCache Cache object
     */
    protected $cache;

    /**
     * @var PDO Database connection
     */
    protected $pdo;
}
?>