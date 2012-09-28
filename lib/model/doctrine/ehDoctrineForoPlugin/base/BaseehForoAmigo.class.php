<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('ehForoAmigo', 'doctrine');

/**
 * BaseehForoAmigo
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $invitante_id
 * @property integer $invitado_id
 * @property ehAuthUser $Invitante
 * @property ehAuthUser $Invitado
 * 
 * @method integer     getId()           Returns the current record's "id" value
 * @method integer     getInvitanteId()  Returns the current record's "invitante_id" value
 * @method integer     getInvitadoId()   Returns the current record's "invitado_id" value
 * @method ehAuthUser  getInvitante()    Returns the current record's "Invitante" value
 * @method ehAuthUser  getInvitado()     Returns the current record's "Invitado" value
 * @method ehForoAmigo setId()           Sets the current record's "id" value
 * @method ehForoAmigo setInvitanteId()  Sets the current record's "invitante_id" value
 * @method ehForoAmigo setInvitadoId()   Sets the current record's "invitado_id" value
 * @method ehForoAmigo setInvitante()    Sets the current record's "Invitante" value
 * @method ehForoAmigo setInvitado()     Sets the current record's "Invitado" value
 * 
 * @package    templodehecate
 * @subpackage model
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseehForoAmigo extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('eh_foro_amigo');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('invitante_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('invitado_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
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
        $this->hasOne('ehAuthUser as Invitante', array(
             'local' => 'invitante_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('ehAuthUser as Invitado', array(
             'local' => 'invitado_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}