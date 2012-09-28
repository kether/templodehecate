<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('ehForoTablonModerador', 'doctrine');

/**
 * BaseehForoTablonModerador
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $usuario_id
 * @property integer $tablon_id
 * @property ehAuthUser $Usuario
 * @property ehForoTablon $Tablon
 * 
 * @method integer               getUsuarioId()  Returns the current record's "usuario_id" value
 * @method integer               getTablonId()   Returns the current record's "tablon_id" value
 * @method ehAuthUser            getUsuario()    Returns the current record's "Usuario" value
 * @method ehForoTablon          getTablon()     Returns the current record's "Tablon" value
 * @method ehForoTablonModerador setUsuarioId()  Sets the current record's "usuario_id" value
 * @method ehForoTablonModerador setTablonId()   Sets the current record's "tablon_id" value
 * @method ehForoTablonModerador setUsuario()    Sets the current record's "Usuario" value
 * @method ehForoTablonModerador setTablon()     Sets the current record's "Tablon" value
 * 
 * @package    templodehecate
 * @subpackage model
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseehForoTablonModerador extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('eh_foro_tablon_moderador');
        $this->hasColumn('usuario_id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'length' => 4,
             ));
        $this->hasColumn('tablon_id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'length' => 4,
             ));

        $this->option('symfony', array(
             'form' => false,
             'filter' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('ehAuthUser as Usuario', array(
             'local' => 'usuario_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('ehForoTablon as Tablon', array(
             'local' => 'tablon_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));
    }
}