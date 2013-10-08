<?php

namespace ZendTutorialInCougar;

use Cougar\Model\iStoredModel;
use Cougar\Model\tPdoModel;

# Initialize the Cougar framework and add the application path
require_once("cougar.php");
\Cougar\Autoload\FlexAutoload::addPath(__DIR__, 2);

/**
 * Creates the Album PDO model from the base model
 *
 * @Table album
 * @Allow CREATE READ UPDATE DELETE QUERY
 * @PrimaryKey id
 */
class AlbumPdoModel extends AlbumBaseModel implements iStoredModel
{
    use tPdoModel;
}
