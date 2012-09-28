<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('tdhArticulo', 'doctrine');

/**
 * BasetdhArticulo
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property boolean $es_aprobado
 * @property enum $tipo
 * @property integer $hilo_id
 * @property ehForoHilo $Hilo
 * 
 * @method integer     getId()          Returns the current record's "id" value
 * @method boolean     getEsAprobado()  Returns the current record's "es_aprobado" value
 * @method enum        getTipo()        Returns the current record's "tipo" value
 * @method integer     getHiloId()      Returns the current record's "hilo_id" value
 * @method ehForoHilo  getHilo()        Returns the current record's "Hilo" value
 * @method tdhArticulo setId()          Sets the current record's "id" value
 * @method tdhArticulo setEsAprobado()  Sets the current record's "es_aprobado" value
 * @method tdhArticulo setTipo()        Sets the current record's "tipo" value
 * @method tdhArticulo setHiloId()      Sets the current record's "hilo_id" value
 * @method tdhArticulo setHilo()        Sets the current record's "Hilo" value
 * 
 * @package    templodehecate
 * @subpackage model
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasetdhArticulo extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tdh_articulo');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('es_aprobado', 'boolean', null, array(
             'type' => 'boolean',
             'notnull' => true,
             'default' => true,
             ));
        $this->hasColumn('tipo', 'enum', null, array(
             'type' => 'enum',
             'notnull' => true,
             'values' => 
             array(
              0 => 'miscelanea',
              1 => 'pie',
              2 => 'cabecera',
             ),
             'default' => 'miscelanea',
             ));
        $this->hasColumn('hilo_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => 4,
             ));

        $this->option('type', 'INNODB');
        $this->option('collate', 'utf8_unicode_ci');
        $this->option('charset', 'utf8');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('ehForoHilo as Hilo', array(
             'local' => 'hilo_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));
    }
}