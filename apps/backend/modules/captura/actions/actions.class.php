<?php

require_once dirname(__FILE__).'/../lib/capturaGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/capturaGeneratorHelper.class.php';

/**
 * captura actions.
 *
 * @package    templodehecate
 * @subpackage captura
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class capturaActions extends autoCapturaActions
{
  public function executeNew(sfWebRequest $request)
  {
    if($request->hasParameter('critica_id'))
    {
      $this->form = $this->configuration->getForm(null, array('critica_id' => $request->getParameter('critica_id')));
      $this->tdh_critica_captura = $this->form->getObject();
    }
    else
    {
      throw new Exception('No se pueden crear capturas sin el parámetro de la crítica');
    }
  }
  
  public function executeCritica(sfWebRequest $request)
  {
    $this->redirect('@tdh_critica_edit?id='.$this->getRoute()->getObject()->getCritica()->getHiloId());
  }
  
  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';
  
      try {
        $tdh_critica_captura = $form->save();
      } catch (Doctrine_Validator_Exception $e) {
  
        $errorStack = $form->getObject()->getErrorStack();
  
        $message = get_class($form->getObject()) . ' has ' . count($errorStack) . " field" . (count($errorStack) > 1 ?  's' : null) . " with validation errors: ";
        foreach ($errorStack as $field => $errors) {
          $message .= "$field (" . implode(", ", $errors) . "), ";
        }
        $message = trim($message, ', ');
  
        $this->getUser()->setFlash('error', $message);
        return sfView::SUCCESS;
      }
  
      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $tdh_critica_captura)));
  
      if ($request->hasParameter('_save_and_add'))
      {
        $this->getUser()->setFlash('notice', $notice.' You can add another one below.');
        
        // Ésta es la única modificación
        $this->redirect('@tdh_critica_captura_new?critica_id='.$form->getObject()->getCritica()->getId());
      }
      else
      {
        $this->getUser()->setFlash('notice', $notice);
  
        $this->redirect(array('sf_route' => 'tdh_critica_captura_edit', 'sf_subject' => $tdh_critica_captura));
      }
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
}
