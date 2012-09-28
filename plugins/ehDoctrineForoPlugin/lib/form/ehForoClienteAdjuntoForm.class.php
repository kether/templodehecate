<?php

/**
 * ehForoClienteAdjuntoForm form.
 *
 * @package    ehDoctrineForoPlugin
 * @subpackage form
 * @author     Pablo Floriano
 */
class ehForoClienteAdjuntoForm extends ehForoAdjuntoForm
{
  public function configure()
  {
    $this->useFields(array(
      'tipo_id',
      'nombre',
      'mensaje_id'
    ));
    
    $this->widgetSchema['mensaje_id']         = new sfWidgetFormInputHidden();
    $this->widgetSchema['fichero']            = new sfWidgetFormInputFile();
    $this->widgetSchema['cargar_ficheros']    = new sfWidgetFormInputCheckbox();
    
    $this->validatorSchema['nombre']          = new sfValidatorString(array('required' => false));
    $this->validatorSchema['fichero']         = new sfValidatorFile();
    $this->validatorSchema['cargar_ficheros'] = new sfValidatorBoolean();
    
    $this->getWidgetSchema()->setLabel('cargar_ficheros', 'Cargar otro fichero');
    $this->getWidgetSchema()->setHelps(array(
      'tipo_id'     => 'Clase del archivo a subir',
      'nombre'      => 'Unas palabras que lo definan'
    ));
    
    $this->getWidgetSchema()->setFormFormatterName('foro');
  }
  
  public function doSave($con = null)
  {
    $fichero = $this->getValue('fichero');
    unset($this['fichero']);
    
    parent::doSave($con);
    
    if($fichero)
    {
      $nombreFinal = $this->getNombreFicheroFinal($fichero);
      $fichero->save($this->getDirUpload().$nombreFinal);
      
      $this->getObject()->setNombreFichero($nombreFinal);
      $this->getObject()->save();
    }
  }
  
  protected function getNombreFicheroFinal($fichero)
  {    
    return $this->getObject()->getId().'-'.strtolower($fichero->getOriginalName());
  }
  
  protected function getDirUpload()
  {
    return $this->getObject()->getDirUpload();
  }
}
