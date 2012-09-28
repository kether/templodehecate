<?php

/**
 * tdhCriticaCaptura form.
 *
 * @package    form
 * @subpackage tdhCriticaCaptura
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class tdhCriticaCapturaForm extends BasetdhCriticaCapturaForm
{
  public function configure()
  {    
    $this->useFields(array(
      'comentario', 
      'critica_id'
    ));
    
    $this->setWidget('critica_id', new sfWidgetFormInputHidden());
    $this->setDefault('critica_id', $this->getOption('critica_id'));
    
    // Imagen
    $this->widgetSchema['fichero_temp'] = new sfWidgetFormInputFileEditable(array(
      'label'        => 'Captura',
      'file_src'     => $this->getObject()->getPath(),
      'is_image'     => true,
      'edit_mode'    => !$this->isNew(),
      'with_delete'  => false,
      'template'     => $this->getObject()->existeFichero() ? '<div>%input%</div><div class="tdh_image_form">%file%</div>' : '%input%',
    ));
    
    $this->validatorSchema['fichero_temp'] = new sfValidatorFile(array(
      'required' => false,
      'mime_types' => 'web_images'
    ), array(
      'required' => 'Se require captura/imagen',
      'mime_types' => 'Formatos aceptados: *.jpg, *.jpeg, *.gif, *.png'
    ));
  }
}