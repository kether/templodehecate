<?php

/**
 * tdhSeccion filter form.
 *
 * @package    filters
 * @subpackage tdhSeccion *
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class tdhSeccionFormFilter extends BasetdhSeccionFormFilter
{
  public function configure()
  {
    $this->useFields(array(
      'estado_activa',
      'nombre',
      'nombre_original',
      'tipo_id',
      'editor_id',
      'genero_id',
      'tablon_id'
    ));
  }
}