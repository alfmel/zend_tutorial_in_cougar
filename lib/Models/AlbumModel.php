<?php

namespace ZendTutorialInCougar;

use Cougar\Model\iModel;
use Cougar\Model\tModel;

# Initialize the Cougar framework and add the application path
require_once("cougar.php");
\Cougar\Autoload\FlexAutoload::addPath(__DIR__, 2);

/**
 * Creates the Album model from the base model
 */
class AlbumModel extends AlbumBaseModel implements iModel
{
    use tModel;
}
