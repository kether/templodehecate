<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version12 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->createTable('tdh_oauth', array(
             'id' => 
             array(
              'type' => 'integer',
              'primary' => '1',
              'autoincrement' => '1',
              'length' => '4',
             ),
             'uid' => 
             array(
              'type' => 'string',
              'notnull' => '1',
              'default' => '',
              'length' => '255',
             ),
             'servicio' => 
             array(
              'type' => 'enum',
              'notnull' => '1',
              'values' => 
              array(
              0 => 'facebook',
              1 => 'twitter',
              2 => 'google',
              ),
              'default' => 'google',
              'length' => '',
             ),
             'token' => 
             array(
              'type' => 'string',
              'notnull' => '1',
              'default' => '',
              'length' => '255',
             ),
             'token_secret' => 
             array(
              'type' => 'string',
              'notnull' => '1',
              'default' => '',
              'length' => '255',
             ),
             'usuario_id' => 
             array(
              'type' => 'integer',
              'notnull' => '1',
              'length' => '4',
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
             'type' => 'INNODB',
             'primary' => 
             array(
              0 => 'id',
             ),
             'collate' => 'utf8_unicode_ci',
             'charset' => 'utf8',
             ));
    }

    public function down()
    {
        $this->dropTable('tdh_oauth');
    }
}