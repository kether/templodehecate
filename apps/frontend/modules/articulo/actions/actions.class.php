<?php

/**
 * articulo actions.
 *
 * @package    templodehecate
 * @subpackage articulo
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class articuloActions extends sfActions
{
  /**
   * Muestra un artículo según el slug
   *
   * @param sfRequest $request A request object
   */
  public function executeMostrar(sfWebRequest $request)
  {
    $this->forward404Unless($this->articulo = Doctrine::getTable('tdhArticulo')->retrieveAutorizadoBySlug($request->getParameter('slug')));
  }
}
