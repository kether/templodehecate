<?php

/**
 * tdhCritica form.
 *
 * @package    form
 * @subpackage tdhCritica
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class tdhCriticaForm extends BasetdhCriticaForm
{
  protected static $currencies = array('EUR', 'USD', 'GBP');
  protected static $languages = array('es', 'en', 'fr', 'de', 'it', 'pt', 'fi', 'sv');
  
  public function configure()
  {
    $years = range(1960, date('Y', time()));
    $years = array_combine($years, $years);
    
    $this->setWidget('moneda', new sfWidgetFormI18nChoiceCurrency(array('culture' => sfConfig::get('sf_default_culture', 'es'), 'currencies' => self::$currencies)));
    $this->setWidget('idioma', new sfWidgetFormI18nChoiceLanguage(array('culture' => sfConfig::get('sf_default_culture', 'es'), 'languages' => self::$languages)));
    // $this->setWidget('fecha_publicacion', new sfWidgetFormI18nDate(array('label' => 'Publicación', 'culture' => sfConfig::get('sf_default_culture', 'es'), 'years' => $years)));
    $this->setWidget('fecha_publicacion', new ehWidgetFormJQueryDate(array('label' => 'Publicación', 'culture' => sfConfig::get('sf_default_culture'), 'date_widget' => new sfWidgetFormI18nDate(array('culture' => sfConfig::get('sf_default_culture', 'es'), 'years' => $years)))));
    
    $this->setWidget('seccion_id', new sfWidgetFormChoice(array('choices' => Doctrine::getTable('tdhSeccion')->retrieveArrayFormList())));
    
    $this->getWidgetSchema()->setLabels(array(
      'estado_sin_nota' => '¿No valorado?',
    	'estado_basico' => '¿Guía básica?',
      'paginas' => 'Páginas',
      'capturas_automaticas'  => 'Autocapturas',
      'estado_aprobado'  => '¿Aprobada?'
    ));
    
    $this->getWidgetSchema()->setHelps(array(
      'estado_aprobado'         => 'Si está marcada el artículo aparecerá en la sección de críticas y en la portada.',
      'capturas_automaticas'    => 'Si marcas esta opción las capturas se integrarán automáticamente en el cuerpo del mensaje entre los párrafos.'
    ));
    
    $this->useFields(array(
      'nota',
      'estado_sin_nota',
    	'estado_basico',
      'estado_aprobado',
      'capturas_automaticas',
      'fecha_publicacion',
      'autor',
      'paginas',
      'editor_id',
      'idioma',
      'precio',
      'moneda',
      'seccion_id',
    ));
    
    if(!$this->isNew())
    {
      unset($this['seccion_id']);
    }
  }
}