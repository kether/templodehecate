<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('tdhAsociacionUsuario', 'doctrine');

/**
 * BasetdhAsociacionUsuario
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $usuario_id
 * @property integer $asociacion_id
 * @property enum $rol
 * 
 * @method integer              getUsuarioId()     Returns the current record's "usuario_id" value
 * @method integer              getAsociacionId()  Returns the current record's "asociacion_id" value
 * @method enum                 getRol()           Returns the current record's "rol" value
 * @method tdhAsociacionUsuario setUsuarioId()     Sets the current record's "usuario_id" value
 * @method tdhAsociacionUsuario setAsociacionId()  Sets the current record's "asociacion_id" value
 * @method tdhAsociacionUsuario setRol()           Sets the current record's "rol" value
 * 
 * @package    templodehecate
 * @subpackage model
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasetdhAsociacionUsuario extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tdh_asociacion_usuario');
        $this->hasColumn('usuario_id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'length' => 4,
             ));
        $this->hasColumn('asociacion_id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'length' => 4,
             ));
        $this->hasColumn('rol', 'enum', null, array(
             'type' => 'enum',
             'notnull' => true,
             'values' => 
             array(
              0 => 'administrador',
              1 => 'socio',
             ),
             'default' => 'socio',
             ));

        $this->option('symfony', array(
             'form' => false,
             'filter' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}