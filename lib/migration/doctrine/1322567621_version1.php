<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version1 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->changeColumn('tdh_critica', 'idioma', 'string', '255', array(
             'notnull' => '1',
             'default' => 'es',
             ));
    }

    public function down()
    {

    }
}