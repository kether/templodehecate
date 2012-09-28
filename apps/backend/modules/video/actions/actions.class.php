<?php

require_once dirname(__FILE__).'/../lib/videoGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/videoGeneratorHelper.class.php';

/**
 * video actions.
 *
 * @package    templodehecate
 * @subpackage video
 * @author     Pablo Floriano <kether@templodehecate.com>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class videoActions extends autoVideoActions
{
  public function executeNew(sfWebRequest $request)
  {
    if($request->hasParameter('critica_id'))
    {
      $this->form = $this->configuration->getForm(null, array('critica_id' => $request->getParameter('critica_id')));
      $this->tdh_critica_video = $this->form->getObject();
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
        $tdh_critica_video = $form->save();
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
  
      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $tdh_critica_video)));
  
      if ($request->hasParameter('_save_and_add'))
      {
        $this->getUser()->setFlash('notice', $notice.' You can add another one below.');
  
        // Éste es el único cambio
        $this->redirect('@tdh_critica_video_new?critica_id='.$form->getObject()->getCriticaId());
      }
      else
      {
        $this->getUser()->setFlash('notice', $notice);
  
        $this->redirect(array('sf_route' => 'tdh_critica_video_edit', 'sf_subject' => $tdh_critica_video));
      }
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
}
