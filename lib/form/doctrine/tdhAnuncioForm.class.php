<?php

/**
 * tdhAnuncio form.
 *
 * @package    templodehecate
 * @subpackage form
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class tdhAnuncioForm extends BasetdhAnuncioForm
{
  public function configure()
  {
    $this->useFields(array(
    	'activo',
    	'nombre',
    	'descripcion',
    	'url',
    	'es_codigo',
    	'codigo',
    	'tipo_id',
    	'temporal',
    	'desde',
    	'hasta'
    ));
    
    $this->setWidget('desde', new sfWidgetFormI18nDateTime(array('culture' => sfConfig::get('sf_default_culture', 'es'))));
    $this->setWidget('hasta', new sfWidgetFormI18nDateTime(array('culture' => sfConfig::get('sf_default_culture', 'es'))));
    
    $this->setValidator('desde', new sfValidatorDateTime(array('required' => false)));
    $this->setValidator('hasta', new sfValidatorDateTime(array('required' => false)));
    $this->setValidator('url', new sfValidatorUrl(array('required' => true)));
    $this->setValidator('codigo', new sfValidatorString(array('required' => false)));
    
    // Imágen o SWF
    $this->widgetSchema['fichero'] = new sfWidgetFormInputFileEditable(array(
      'label'        => 'Imagen o flash',
      'file_src'     => $this->getObject()->getRecursoPath(),
      'is_image'     => false,
      'edit_mode'    => !$this->isNew(),
      'delete_label' => 'Suprimir este fichero',
      'with_delete'  => $this->getObject()->hasRecurso(),
      'template'     => $this->getObject()->hasRecurso() ? '<div>%input%</div><div class="tdh_image_form">%delete% %delete_label%</div>' : '%input%',
    ));
    
    $this->validatorSchema['fichero'] = new sfValidatorFile(array('required' => false, 'mime_types' => array('application/x-shockwave-flash', 'image/png', 'image/jpeg', 'image/gif')), array('mime_types' => 'Sólo se aceptan GIF, PNG, JPEG y SWF'));
    $this->validatorSchema['fichero_delete'] = new sfValidatorPass();
    
    // Post validators
    $this->validatorSchema->setPostValidator(new sfValidatorSchemaCompare('desde', sfValidatorSchemaCompare::LESS_THAN_EQUAL, 'hasta'));
    
    $this->getWidgetSchema()->setLabels(array(
      'activo' => '¿Activo?',
      'url' => 'URL',     
      'es_flash' => '¿Flash?',
    	'temporal' => '¿Temporal?',
      'es_codigo' => '¿Código HTML?',
      'codigo' => 'Código',
      'descripcion' => 'Descripción'
    ));
  }
  
  public function doSave($con = null)
  {
    $fichero = $this->getValue('fichero');
    unset($this['fichero']);
    
    if($this->getValue('fichero_delete') == true)
    {
      $this->deleteFichero();
    }
    
    parent::doSave($con);
    
    $this->saveFichero($fichero);
  }
  
  /**
   * Se guarda el fichero del recurso del anuncio.
   * 
   * @param sfValidatorFile $fichero
   */
  public function saveFichero($fichero)
  {    
    if(!$fichero) return;
    
    if($fichero->getType() == 'application/x-shockwave-flash')
    {
      $this->getObject()->setEsFlash(true)->save();
      $fichero->save(sfConfig::get('sf_web_dir').$this->getObject()->getRecursoPath());
    }
    else
    {
      $this->getObject()->setEsFlash(false)->save();
      
      $myImage = new ehUtilesImagen($fichero->getTempName());
      
      $myImage
        ->setFormatoSalida(ehUtilesImagen::FORMATO_PNG)
        ->setModoRedimension(ehUtilesImagen::AJUSTE_ADAPTATIVO)
        ->setFicheroDestino(sfConfig::get('sf_web_dir').$this->getObject()->getRecursoPath())
        ->setMaxAlto($this->getObject()->getTipo()->getAltura())
        ->setMaxAncho($this->getObject()->getTipo()->getAnchura())
        ->save();
    }
  }
  
  /**
   * Se borra el fichero recurso del anuncio.
   */
  protected function deleteFichero()
  {
    @unlink(sfConfig::get('sf_web_dir').$this->getObject()->getRecursoPath());
  }
}
