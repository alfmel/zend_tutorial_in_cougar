<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alberto
 * Date: 10/4/13
 * Time: 9:31 AM
 * To change this template use File | Settings | File Templates.
 */

namespace ZendTutorialInCougar\UnitTests;

use Cougar\Security\Security;
use Cougar\Cache\Cache;
use Cougar\PDO\PDO;
use ZendTutorialInCougar\AlbumPdoModel;

require_once(__DIR__ . "/../lib/Models/AlbumPdoModel.php");

class AlbumPdoModelTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Cougar\Security\Security Security context
     */
    protected $security;

    /**
     * @var \Cougar\Cache\Cache Cache mock
     */
    protected $cache;

    /**
     * @var \Cougar\PDO\PDO Database connection
     */
    protected $pdo;

    /**
     * Obtain security context, cache mock and connect to the database
     */
    protected function setUp()
    {
        $this->security = new Security();

        $this->cache = $this->getMockBuilder("\\Cougar\\Cache\\Cache")
            ->disableOriginalConstructor()
            ->getMock();
        $this->cache->expects($this->any())
            ->method("get")
            ->will($this->returnValue(false));
        $this->cache->expects($this->any())
            ->method("set")
            ->will($this->returnValue(false));

        $this->pdo = new PDO("sqlite::memory:");

        # Create the table
        $this->pdo->exec("CREATE TABLE album (
            id INTEGER,
            artist TEXT NOT NULL,
            title TEXT NOT NULL,
            PRIMARY KEY (id))");

        # Add the data
        $this->pdo->exec("INSERT INTO album (artist, title)
            VALUES  ('The  Military  Wives',  'In  My  Dreams')");
        $this->pdo->exec("INSERT INTO album (artist, title)
            VALUES  ('Adele',  '21')");
        $this->pdo->exec("INSERT INTO album (artist, title)
            VALUES  ('Bruce  Springsteen',  'Wrecking Ball (Deluxe)')");
        $this->pdo->exec("INSERT INTO album (artist, title)
            VALUES  ('Lana  Del  Rey',  'Born  To  Die');");
        $this->pdo->exec("INSERT INTO album (artist, title)
            VALUES  ('Gotye',  'Making  Mirrors')");
    }

    /**
     * @covers \ZendTutorialInCougar\AlbumPdoModel::__construct
     * @covers \ZendTutorialInCougar\AlbumPdoModel::__query
     */
    public function testQuery()
    {
        $pdo_model = new AlbumPdoModel($this->security, $this->cache,
            $this->pdo);
        $album_list = $pdo_model->query(array());
        $this->assertCount(5, $album_list);
    }

    /**
     * @covers \ZendTutorialInCougar\AlbumPdoModel::__construct
     */
    public function testRead()
    {
        $album1 = new AlbumPdoModel($this->security, $this->cache,
            $this->pdo, array("id" => 1));
        $this->assertEquals(1, $album1->id);
        $this->assertEquals("The  Military  Wives", $album1->artist);
        $this->assertEquals("In  My  Dreams", $album1->title);

        $album2 = new AlbumPdoModel($this->security, $this->cache,
            $this->pdo, array("id" => 2));
        $this->assertEquals(2, $album2->id);
        $this->assertEquals("Adele", $album2->artist);
        $this->assertEquals("21", $album2->title);

    }

    /**
     * @covers \ZendTutorialInCougar\AlbumPdoModel::__construct
     * @covers \ZendTutorialInCougar\AlbumPdoModel::__save
     */
    public function testCreate()
    {
        $album = new AlbumPdoModel($this->security, $this->cache,
            $this->pdo);
        $album->artist = "Cougar is Awesome";
        $album->title = "PHP Developer";
        $album->save();
        $this->assertNotNull($album->id);

        $new_album = new AlbumPdoModel($this->security, $this->cache,
            $this->pdo, array("id" => $album->id));
        $this->assertEquals($album->id, $new_album->id);
        $this->assertEquals("Cougar is Awesome", $new_album->artist);
        $this->assertEquals("PHP Developer", $new_album->title);
    }

    /**
     * @covers \ZendTutorialInCougar\AlbumPdoModel::__construct
     * @covers \ZendTutorialInCougar\AlbumPdoModel::__save
     */
    public function testUpdate()
    {
        $album = new AlbumPdoModel($this->security, $this->cache,
            $this->pdo, array("id" => 5));
        $album->artist = "Cougar is Awesome";
        $album->title = "PHP Developer";
        $album->save();

        $updated_album = new AlbumPdoModel($this->security, $this->cache,
            $this->pdo, array("id" => $album->id));
        $this->assertEquals($album->id, $updated_album->id);
        $this->assertEquals("Cougar is Awesome", $updated_album->artist);
        $this->assertEquals("PHP Developer", $updated_album->title);

        $album_list = $album->query();
        $this->assertCount(5, $album_list);
    }

    /**
     * @covers \ZendTutorialInCougar\AlbumPdoModel::__construct
     * @covers \ZendTutorialInCougar\AlbumPdoModel::__delete
     */
    public function testDelete()
    {
        $album = new AlbumPdoModel($this->security, $this->cache,
            $this->pdo, array("id" => 3));
        $album->delete();

        $album_list = $album->query();
        $this->assertCount(4, $album_list);
    }

    /**
     * @covers \ZendTutorialInCougar\AlbumPdoModel::__construct
     * @expectedException \Cougar\Exceptions\RecordNotFoundException
     */
    public function testReadNotFound()
    {
        $album = new AlbumPdoModel($this->security, $this->cache,
            $this->pdo, array("id" => 500));
        $this->fail("Expected exception was not thrown");
    }
}
?>
