<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version7 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->createTable('tdh_mail_mensaje', array(
             'id' => 
             array(
              'type' => 'integer',
              'length' => '8',
              'autoincrement' => '1',
              'primary' => '1',
             ),
             'mensaje' => 
             array(
              'type' => 'blob',
              'notnull' => '1',
              'length' => '',
             ),
             'created_at' => 
             array(
              'notnull' => '1',
              'type' => 'timestamp',
              'length' => '25',
             ),
             'updated_at' => 
             array(
              'notnull' => '1',
              'type' => 'timestamp',
              'length' => '25',
             ),
             ), array(
             'primary' => 
             array(
              0 => 'id',
             ),
             ));
        $this->addColumn('tdh_asociacion_invitacion', 'created_at', 'timestamp', '25', array(
             'notnull' => '1',
             ));
        $this->addColumn('tdh_asociacion_invitacion', 'updated_at', 'timestamp', '25', array(
             'notnull' => '1',
             ));
    }

    public function down()
    {
        $this->dropTable('tdh_mail_mensaje');
        $this->removeColumn('tdh_asociacion_invitacion', 'created_at');
        $this->removeColumn('tdh_asociacion_invitacion', 'updated_at');
    }
}