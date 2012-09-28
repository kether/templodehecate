<?php

/**
 * ehAuthUser filter form.
 *
 * @package    filters
 * @subpackage ehAuthUser *
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class ehAuthUserFormFilter extends PluginehAuthUserFormFilter
{
  public function configure()
  {
    $this->setWidget('nick', new sfWidgetFormFilterInput(array('with_empty' => false)));
    $this->setWidget('email', new sfWidgetFormFilterInput(array('with_empty' => false)));
    
    $this->setValidator('nick', new sfValidatorPass(array('required' => false)));
    $this->setValidator('email', new sfValidatorPass(array('required' => false)));
    
    $this->getWidgetSchema()->setLabel('nick', 'Seudónimo');
    $this->getWidgetSchema()->setLabel('email', 'eMail');
  }
  
  public function addNickColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if ($values['text'] != '')
      $query->innerJoin($query->getRootAlias().'.Perfil tdnPerfilNick')->addWhere("tdnPerfilNick.nick LIKE ?", '%'.$values['text'].'%');
  }
  
  public function addEmailColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if ($values['text'] != '')
      $query->innerJoin($query->getRootAlias().'.Perfil tdnPerfilEmail')->addWhere("tdnPerfilEmail.email LIKE ?", '%'.$values['text'].'%');
  }
  
  public function getFields()
  {
    return parent::getFields() + array(
      'nick'            => 'Text',
      'email'           => 'Text',
    );
  }
}