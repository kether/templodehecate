<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version8 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->addColumn('eh_foro_perfil', 'foro_a_templo', 'boolean', '25', array(
             'notnull' => '1',
             'default' => '1',
             ));
    }

    public function down()
    {
        $this->removeColumn('eh_foro_perfil', 'foro_a_templo');
    }
}