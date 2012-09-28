<?php

class ehForoRouting
{
  static public function listenToRoutingLoadConfigurationEvent(sfEvent $event)
  {
    $r = $event->getSubject();

    // preprend our routes
    $r->prependRoute('eh_foro', new sfRoute('/ehForoPlugin', array('module' => 'ehForoTablon', 'action' => 'lista')));
    $r->prependRoute('eh_foro_tablon', new sfRoute('/ehForoPlugin/:id/temas/pagina.:pagina', array('module' => 'ehForoTema', 'action' => 'lista')));
    $r->prependRoute('eh_foro_tema', new sfRoute('/ehForoPlugin/:id/hilo/pagina.:pagina', array('module' => 'ehForoTema', 'action' => 'mostrar')));
  }
}