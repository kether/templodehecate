<?php

/**
 * tdhPerfil form base class.
 *
 * @method tdhPerfil getObject() Returns the current form's model object
 *
 * @package    templodehecate
 * @subpackage form
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasetdhPerfilForm extends ehForoPerfilForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('tdh_perfil[%s]');
  }

  public function getModelName()
  {
    return 'tdhPerfil';
  }

}
