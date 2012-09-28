<?php


class ehForoGrupoUsuarioTable extends PluginehForoGrupoUsuarioTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('ehForoGrupoUsuario');
    }
}