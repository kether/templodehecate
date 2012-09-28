<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version18 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->addColumn('tdh_sorteo', 'estado_visible', 'boolean', '25', array(
             'notnull' => '1',
             'default' => '1',
             ));
        $this->addColumn('tdh_sorteo', 'estado_abierto', 'boolean', '25', array(
             'notnull' => '1',
             'default' => '1',
             ));
        $this->addColumn('tdh_sorteo', 'mensaje', 'string', '255', array(
             'notnull' => '1',
             'default' => '',
             ));
        $this->addColumn('tdh_sorteo', 'semilla', 'integer', '4', array(
             'notnull' => '1',
             'default' => '0',
             ));
        $this->addColumn('tdh_sorteo', 'participantes_num', 'integer', '3', array(
             'notnull' => '1',
             'default' => '0',
             ));
        $this->addColumn('tdh_sorteo_condicion', 'url', 'string', '255', array(
             'notnull' => '1',
             'default' => '',
             ));
        $this->addColumn('tdh_sorteo_participante', 'ip', 'string', '255', array(
             'notnull' => '1',
             'default' => '0.0.0.0',
             ));
        $this->addColumn('tdh_sorteo_participante', 'tipo', 'enum', '', array(
             'notnull' => '1',
             'values' => 
             array(
              0 => 'facebook',
              1 => 'twitter',
             ),
             'default' => 'twitter',
             ));
    }

    public function down()
    {
        $this->removeColumn('tdh_sorteo', 'estado_visible');
        $this->removeColumn('tdh_sorteo', 'estado_abierto');
        $this->removeColumn('tdh_sorteo', 'mensaje');
        $this->removeColumn('tdh_sorteo', 'semilla');
        $this->removeColumn('tdh_sorteo', 'participantes_num');
        $this->removeColumn('tdh_sorteo_condicion', 'url');
        $this->removeColumn('tdh_sorteo_participante', 'ip');
        $this->removeColumn('tdh_sorteo_participante', 'tipo');
    }
}