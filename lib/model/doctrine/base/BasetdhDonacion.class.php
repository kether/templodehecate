<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('tdhDonacion', 'doctrine');

/**
 * BasetdhDonacion
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property float $cantidad
 * @property integer $hilo_id
 * @property integer $usuario_id
 * @property ehForoHilo $Hilo
 * @property ehAuthUser $Donante
 * 
 * @method integer     getId()         Returns the current record's "id" value
 * @method float       getCantidad()   Returns the current record's "cantidad" value
 * @method integer     getHiloId()     Returns the current record's "hilo_id" value
 * @method integer     getUsuarioId()  Returns the current record's "usuario_id" value
 * @method ehForoHilo  getHilo()       Returns the current record's "Hilo" value
 * @method ehAuthUser  getDonante()    Returns the current record's "Donante" value
 * @method tdhDonacion setId()         Sets the current record's "id" value
 * @method tdhDonacion setCantidad()   Sets the current record's "cantidad" value
 * @method tdhDonacion setHiloId()     Sets the current record's "hilo_id" value
 * @method tdhDonacion setUsuarioId()  Sets the current record's "usuario_id" value
 * @method tdhDonacion setHilo()       Sets the current record's "Hilo" value
 * @method tdhDonacion setDonante()    Sets the current record's "Donante" value
 * 
 * @package    templodehecate
 * @subpackage model
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasetdhDonacion extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tdh_donacion');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('cantidad', 'float', null, array(
             'type' => 'float',
             'notnull' => true,
             'default' => 0,
             ));
        $this->hasColumn('hilo_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('usuario_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => 4,
             ));

        $this->option('symfony', array(
             'form' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('ehForoHilo as Hilo', array(
             'local' => 'hilo_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('ehAuthUser as Donante', array(
             'local' => 'usuario_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $timestampable0 = new Doctrine_Template_Timestampable(array(
             'updated' => 
             array(
              'disabled' => true,
             ),
             ));
        $this->actAs($timestampable0);
    }
}