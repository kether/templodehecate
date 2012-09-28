<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('tdhMenu', 'doctrine');

/**
 * BasetdhMenu
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property boolean $estado_portada
 * @property string $nombre
 * @property integer $ordinal
 * @property string $descripcion
 * @property string $enlace
 * 
 * @method integer getId()             Returns the current record's "id" value
 * @method boolean getEstadoPortada()  Returns the current record's "estado_portada" value
 * @method string  getNombre()         Returns the current record's "nombre" value
 * @method integer getOrdinal()        Returns the current record's "ordinal" value
 * @method string  getDescripcion()    Returns the current record's "descripcion" value
 * @method string  getEnlace()         Returns the current record's "enlace" value
 * @method tdhMenu setId()             Sets the current record's "id" value
 * @method tdhMenu setEstadoPortada()  Sets the current record's "estado_portada" value
 * @method tdhMenu setNombre()         Sets the current record's "nombre" value
 * @method tdhMenu setOrdinal()        Sets the current record's "ordinal" value
 * @method tdhMenu setDescripcion()    Sets the current record's "descripcion" value
 * @method tdhMenu setEnlace()         Sets the current record's "enlace" value
 * 
 * @package    templodehecate
 * @subpackage model
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasetdhMenu extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tdh_menu');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('estado_portada', 'boolean', null, array(
             'type' => 'boolean',
             'notnull' => true,
             'default' => false,
             ));
        $this->hasColumn('nombre', 'string', 50, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 50,
             ));
        $this->hasColumn('ordinal', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'default' => 0,
             'length' => 4,
             ));
        $this->hasColumn('descripcion', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'default' => '',
             'length' => 255,
             ));
        $this->hasColumn('enlace', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'default' => '',
             'length' => 255,
             ));

        $this->option('type', 'INNODB');
        $this->option('collate', 'utf8_unicode_ci');
        $this->option('charset', 'utf8');
    }

    public function setUp()
    {
        parent::setUp();
        $sluggable0 = new Doctrine_Template_Sluggable(array(
             'fields' => 
             array(
              0 => 'nombre',
             ),
             'canUpdate' => true,
             ));
        $ehforoforeignkeybackbehavior0 = new ehForoForeignKeyBackBehavior(array(
             'fields' => 
             array(
              0 => 'menu_id',
             ),
             ));
        $this->actAs($sluggable0);
        $this->actAs($ehforoforeignkeybackbehavior0);
    }
}