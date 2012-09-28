<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('ehForoUsuarioActivo', 'doctrine');

/**
 * BaseehForoUsuarioActivo
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $ip
 * @property integer $usuario_id
 * @property string $modulo
 * @property string $accion
 * @property string $agent
 * @property ehAuthUser $Usuario
 * 
 * @method string              getIp()         Returns the current record's "ip" value
 * @method integer             getUsuarioId()  Returns the current record's "usuario_id" value
 * @method string              getModulo()     Returns the current record's "modulo" value
 * @method string              getAccion()     Returns the current record's "accion" value
 * @method string              getAgent()      Returns the current record's "agent" value
 * @method ehAuthUser          getUsuario()    Returns the current record's "Usuario" value
 * @method ehForoUsuarioActivo setIp()         Sets the current record's "ip" value
 * @method ehForoUsuarioActivo setUsuarioId()  Sets the current record's "usuario_id" value
 * @method ehForoUsuarioActivo setModulo()     Sets the current record's "modulo" value
 * @method ehForoUsuarioActivo setAccion()     Sets the current record's "accion" value
 * @method ehForoUsuarioActivo setAgent()      Sets the current record's "agent" value
 * @method ehForoUsuarioActivo setUsuario()    Sets the current record's "Usuario" value
 * 
 * @package    templodehecate
 * @subpackage model
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseehForoUsuarioActivo extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('eh_foro_usuario_activo');
        $this->hasColumn('ip', 'string', 128, array(
             'type' => 'string',
             'primary' => true,
             'length' => 128,
             ));
        $this->hasColumn('usuario_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('modulo', 'string', 128, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 128,
             ));
        $this->hasColumn('accion', 'string', 128, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 128,
             ));
        $this->hasColumn('agent', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));

        $this->option('type', 'INNODB');
        $this->option('collate', 'utf8_unicode_ci');
        $this->option('charset', 'utf8');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('ehAuthUser as Usuario', array(
             'local' => 'usuario_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $timestampable0 = new Doctrine_Template_Timestampable(array(
             'created' => 
             array(
              'disabled' => true,
             ),
             ));
        $this->actAs($timestampable0);
    }
}