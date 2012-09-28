<?php

/**
 * tdhRecurso form.
 *
 * @package    form
 * @subpackage tdhRecurso
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class tdhRecursoForm extends BasetdhRecursoForm
{
  public function configure()
  {
    $user = sfContext::getInstance()->getUser();
    
    $this->setWidget('seccion_id', new sfWidgetFormChoice(array('choices' => Doctrine::getTable('tdhSeccion')->retrieveArrayFormList())));
    
    $this->getWidgetSchema()->setLabels(array(
      'seccion_id'	      => 'Sección',
      'contacto_autor'    => 'Contacto del autor',
      'tiene_html'        => '¿Recurso HTML?',
      'estado_aprobado'	  => '¿Aprobado?',
      'paypal'            => 'PayPal',
      'acepta_donativos'  => '¿Permite donativos?',
      'conver_pdf'        => 'Convertir a PDF',
      'conver_epub'       => 'Convertir a ePub',
      'separar_capitulos' => 'Separar capítulos'
    ));
    
    $this->getWidgetSchema()->setHelps(array(
      'paypal'            => 'Si permite recibir donativos, ¿a qué cuenta PayPal?',
      'estado_aprobado'   => 'Si está marcado se verá en la sección de recursos.',
      'tiene_html'        => 'El recurso está en el propio contenido del mensaje en HTML.',
      'separar_capitulos' => 'Si autoconvierte a PDF/ePub, separa los encabezados H1 como capítulos.' 
    ));
    
    $this->useFields(array(
      'tipo_id',
      'seccion_id',
      'estado_aprobado',
      'acepta_donativos',
    	'paypal',
      'entradilla',
      'autor',
      'contacto_autor',
      'tiene_html',
      'conver_pdf',
    	'conver_epub',
    	'separar_capitulos',
      'licencia_id',
    ));
    
    $this->setDefault('paypal', $user->getPerfil()->getPerfilPaypal());
    
    if(!$this->isNew())
    {
      unset($this['seccion_id']);
    }
  }
}