<?php

/**
 * hojaDeEstilo actions.
 *
 * @package    templodehecate
 * @subpackage hojaDeEstilo
 * @author     Pablo Floriano
 */
class hojaDeEstiloActions extends sfActions
{
  /**
   * Ejecutar acción mostrar.
   *
   * @param sfWebRequest $request
   */
  public function executeMostrar(sfWebRequest $request)
  {
    $this->forward404Unless($this->estilo = Doctrine::getTable('tdhHojaDeEstilo')->findOneByFilename($request->getParameter('fichero')));
  }
}
