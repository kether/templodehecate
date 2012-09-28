<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('tdhSeccionEstilo', 'doctrine');

/**
 * BasetdhSeccionEstilo
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $seccion_id
 * @property integer $estilo_id
 * @property tdhSeccion $Seccion
 * @property tdhHojaDeEstilo $Estilo
 * 
 * @method integer          getSeccionId()  Returns the current record's "seccion_id" value
 * @method integer          getEstiloId()   Returns the current record's "estilo_id" value
 * @method tdhSeccion       getSeccion()    Returns the current record's "Seccion" value
 * @method tdhHojaDeEstilo  getEstilo()     Returns the current record's "Estilo" value
 * @method tdhSeccionEstilo setSeccionId()  Sets the current record's "seccion_id" value
 * @method tdhSeccionEstilo setEstiloId()   Sets the current record's "estilo_id" value
 * @method tdhSeccionEstilo setSeccion()    Sets the current record's "Seccion" value
 * @method tdhSeccionEstilo setEstilo()     Sets the current record's "Estilo" value
 * 
 * @package    templodehecate
 * @subpackage model
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasetdhSeccionEstilo extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tdh_seccion_estilo');
        $this->hasColumn('seccion_id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'length' => 4,
             ));
        $this->hasColumn('estilo_id', 'integer', 4, array(
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
        $this->hasOne('tdhSeccion as Seccion', array(
             'local' => 'seccion_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('tdhHojaDeEstilo as Estilo', array(
             'local' => 'estilo_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));
    }
}