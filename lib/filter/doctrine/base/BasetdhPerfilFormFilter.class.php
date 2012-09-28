<?php

/**
 * tdhPerfil filter form base class.
 *
 * @package    templodehecate
 * @subpackage filter
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedInheritanceTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasetdhPerfilFormFilter extends ehForoPerfilFormFilter
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('tdh_perfil_filters[%s]');
  }

  public function getModelName()
  {
    return 'tdhPerfil';
  }
}
