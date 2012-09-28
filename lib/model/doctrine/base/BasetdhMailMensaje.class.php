<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('tdhMailMensaje', 'doctrine');

/**
 * BasetdhMailMensaje
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property blob $mensaje
 * 
 * @method blob           getMensaje() Returns the current record's "mensaje" value
 * @method tdhMailMensaje setMensaje() Sets the current record's "mensaje" value
 * 
 * @package    templodehecate
 * @subpackage model
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasetdhMailMensaje extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tdh_mail_mensaje');
        $this->hasColumn('mensaje', 'blob', null, array(
             'type' => 'blob',
             'notnull' => true,
             ));

        $this->option('symfony', array(
             'form' => false,
             'filter' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}