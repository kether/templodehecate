<?php

class tdhAdminUsuarioForm extends ehAuthUserAdminForm
{
  public function configure()
  {
    $this->embedRelation('Perfil', 'ehForoPerfilForm');
  }
}