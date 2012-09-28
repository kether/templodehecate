<?php

class tdhAdminArticuloForm extends tdhContenidoForm
{
	protected $methodResource = 'getArticulo';
		
  public function configure()
	{
		parent::configure();
		
		if($this->isNew())
		{
		  // $this->setWidget('tablon_id', new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tablon'), 'add_empty' => false)));
		  $this->setWidget('tablon_id', new sfWidgetFormChoice(array('choices' => Doctrine::getTable('ehForoTablon')->retrieveArrayFormList())));
		  $this->setValidator('tablon_id', new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Tablon'))));
		  $this->getWidgetSchema()->setLabel('tablon_id', 'Tablón');
		}
		
		$this->embedRelation('Articulo', 'tdhArticuloForm');
		
		$this->getWidgetSchema()->setLabel('Articulo', 'Artículo');
	}
} 