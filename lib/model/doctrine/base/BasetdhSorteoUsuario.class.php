<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('tdhSorteoUsuario', 'doctrine');

/**
 * BasetdhSorteoUsuario
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $usuario_id
 * @property integer $participante_id
 * 
 * @method integer          getUsuarioId()       Returns the current record's "usuario_id" value
 * @method integer          getParticipanteId()  Returns the current record's "participante_id" value
 * @method tdhSorteoUsuario setUsuarioId()       Sets the current record's "usuario_id" value
 * @method tdhSorteoUsuario setParticipanteId()  Sets the current record's "participante_id" value
 * 
 * @package    templodehecate
 * @subpackage model
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasetdhSorteoUsuario extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tdh_sorteo_usuario');
        $this->hasColumn('usuario_id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'length' => 4,
             ));
        $this->hasColumn('participante_id', 'integer', 4, array(
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
        
    }
}