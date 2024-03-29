<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('ehForoStaffTablon', 'doctrine');

/**
 * BaseehForoStaffTablon
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $grupo_id
 * @property integer $tablon_id
 * @property ehForoGrupo $Grupo
 * @property ehForoTablon $Tablon
 * 
 * @method integer           getGrupoId()   Returns the current record's "grupo_id" value
 * @method integer           getTablonId()  Returns the current record's "tablon_id" value
 * @method ehForoGrupo       getGrupo()     Returns the current record's "Grupo" value
 * @method ehForoTablon      getTablon()    Returns the current record's "Tablon" value
 * @method ehForoStaffTablon setGrupoId()   Sets the current record's "grupo_id" value
 * @method ehForoStaffTablon setTablonId()  Sets the current record's "tablon_id" value
 * @method ehForoStaffTablon setGrupo()     Sets the current record's "Grupo" value
 * @method ehForoStaffTablon setTablon()    Sets the current record's "Tablon" value
 * 
 * @package    templodehecate
 * @subpackage model
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseehForoStaffTablon extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('eh_foro_staff_tablon');
        $this->hasColumn('grupo_id', 'integer', 4, array(
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
        $this->hasOne('ehForoGrupo as Grupo', array(
             'local' => 'grupo_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('ehForoTablon as Tablon', array(
             'local' => 'tablon_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));
    }
}