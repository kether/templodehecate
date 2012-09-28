<?php

class tdhClientePublicidadForm extends tdhAnuncioForm
{
  /**
	 * @var tdhAnuncioTipo
   */
  protected $anuncioTipo;
  
  public function configure()
  {
    parent::configure();
    
    $this->useFields(array(
    	'nombre',
    	'descripcion',
    	'url',
    	'desde',
    	'fichero'
    ));
    
    $years = array(date('Y', time()), date('Y', time())+1);
    $years = array_combine($years, $years);
    
    // Imágen o SWF
    $this->widgetSchema['fichero'] = new sfWidgetFormInputFileEditable(array(
      'label'        => 'Fichero de imagen',
      'file_src'     => $this->getObject()->getRecursoPath(),
      'is_image'     => true,
      'edit_mode'    => true,
      'template'     => $this->getObject()->hasRecurso() ? '<div>%input%</div><div class="tdh_image_form">%file%</div>' : '%input%',
    ));
    
    $this->validatorSchema['fichero'] = new sfValidatorFile(array('required' => false, 'mime_types' => array('image/png', 'image/jpeg', 'image/gif')), array('mime_types' => 'Sólo se aceptan GIF, PNG, JPEG y SWF'));
    
    $this->setWidget('descripcion', new sfWidgetFormTextarea(array('label' => 'Descripción')));
    $this->setWidget('desde', new ehWidgetFormJQueryDate(array('label' => 'Fecha inicio', 'culture' => sfConfig::get('sf_default_culture', 'es'), 'date_widget' => new sfWidgetFormI18nDate(array('culture' => sfConfig::get('sf_default_culture', 'es'), 'years' => $years)))));
    
    $this->setValidator('desde', new sfValidatorDateTime(array('required' => true)));
    $this->setValidator('descripcion', new sfValidatorString(array('required' => false)));
    
    $this->getWidgetSchema()->setFormFormatterName('templo');
    $this->getWidgetSchema()->setNameFormat('anuncio[%s]');
    
    if(!($tipo = $this->getOption('tipo')))
    {
      throw new Exception('Se debe especificar el tipo en los nuevos anuncios.');
    }
    else
    {
      $this->anuncioTipo = Doctrine::getTable('tdhAnuncioTipo')->findOneBy('slug', $tipo['slug']);
    }
    
    $this->getWidgetSchema()->setHelps(array(
      'nombre'  => 'De la web, promoción o servicio',
      'descripcion' => 'Es un campo opcional que puede contener una frase breve que describa su producto promocionado',
      'url'     => 'Dirección web a la que irá la promoción cuando hagan click',
      'desde'   => 'La promoción durará '.$tipo['duracion'].' días desde ésta fecha',
      'fichero' => 'Sólo puede subir una imágen JPG, GIF (no animado) o PNG y será redimensionada a una resolución de '.$this->anuncioTipo->getAnchura().'x'.$this->anuncioTipo->getAltura().' píxeles'
    ));
    
    // Quitamos los post validator
    $this->validatorSchema->setPostValidator(new sfValidatorPass());
  }
  
  public function doSave($con = null)
  {
    if($this->isNew())
    {
      $this->getObject()->setActivo(false);
      $this->getObject()->setTipoId($this->anuncioTipo->getId());
    }
    
    $tipo = $this->getOption('tipo');
    $this->getObject()->setHasta(date('Y-m-d H:i:s', strtotime($this->getValue('desde')) + ($tipo['duracion']*24*60*60)));
    
    parent::doSave($con);
  }
  
  /**
   * Comprueba si este anuncio puede ser pagado que es cuando ya no es nuevo, cuando tiene imagen y cuando no está pagado.
   * 
   * @return boolean
   */
  public function esPagable()
  {
    return !$this->isNew() && $this->getObject()->hasRecurso() && !$this->esPagado();
  }
  
  /**
   * Comprueba si ha sido pago el artículo.
   * 
   * @return boolean
   */
  public function esPagado()
  {
    return !is_null($this->getObject()->getPago()->getId());
  }
}