<?php

abstract class tdhContenidoTable extends Doctrine_Table
{
  protected $opciones = array(
    'filtro'            => null,
    'limite'            => null,
    'seccion_slug' 	    => null,
    'solo_noticias'     => false,
    'orden'             => 'fecha_desc',
    'favorito_ruser_id' => null,
    'perfil'            => null,
    'contenidos_por_pagina' => null
  );
  
  public function setQueryJoin(Doctrine_Query $q)
  {
    $q->innerJoin('c.Hilo h')
      ->innerJoin('h.PrimerMensaje m')
      ->innerJoin('m.Usuario u')
      ->innerJoin('u.Perfil p')
      ->innerJoin('c.Seccion s')
      ->innerJoin('s.Genero g')
      ->leftJoin('h.Noticia n');
  }
  
  /**
   * Prepara el query de la consulta para mostrar los contenidos autorizados
   * 
   * @return Doctrine_Query
   */
  public function autorizados()
  {
    $q = $this->createQuery('c')
      ->addWhere('c.estado_aprobado = ?', true)
      ->addWhere('m.visible_desde <= ?', date('Y-m-d H:i:s'))
      ->addWhere('m.estado_activo = ?', true)
      ->addWhere('h.estado_oculto = ?', false);

    $this->setQueryJoin($q);
    
    return $q;
  }
  
  /**
   * Prepara el query de la consulta para mostrar los contenidos NO autorizados
   *
   * @return Doctrine_Query
   */
  public function desautorizados()
  {
    $q = $this->createQuery('c')
      ->addWhere('c.estado_aprobado = ? OR m.visible_desde > ? OR m.estado_activo = ? OR h.estado_oculto = ?', array(false, date('Y-m-d H:i:s'), false, true));
  
    $this->setQueryJoin($q);
  
    return $q;
  }
  
  public function retrieveAutorizadoById($id)
  {
    return $this->autorizados()
      ->addWhere('c.id = ?', $id)->fetchOne();
  }
  
  public function retrieveById($id)
  {
    $q = $this->createQuery('c');
    $this->setQueryJoin($q);
    
    return $q->fetchOne();
  }
  
  /**
   * Busca todos los contenidos autorizados en función de unas opciones opcionales.
   *
   * @param integer $limite Número máximo de resultados. Con 0 o menos el límite es infinito
   * @param array $opciones Serie de opciones opcionales
   * @return Doctrine_Collection
   */
  public function getAutorizados($limite = 0, $opciones = array())
  {
    $q = $this->autorizados();
    
    $this->setQueryPorOpciones($q, $opciones);
    
    if((integer) $limite > 0)
    {
      $q->limit($limite);
    }
    
    return $q->execute();
  }
  
  /**
   * Busca todos los contenidos NO autorizados en función de unas opciones opcionales.
   * 
   * @param integer $limite Número máximo de resultados. Con 0 o menos el límite es infinito
   * @param array $opciones Serie de opciones opcionales
   * @return Doctrine_Collection
   */
  public function getDesautorizados($limite = 0, $opciones = array())
  {
    $q = $this->desautorizados();
    
    $this->setQueryPorOpciones($q, $opciones);
    
    if((integer) $limite > 0)
    {
      $q->limit($limite);
    }
    
    return $q->execute();
  }
  
  /**
   * Cuenta el número de contenidos desautorizados por tabla.
   * 
   * @param array $opciones
   */
  public function countDesautorizados($opciones = array())
  {
    $q = $this->desautorizados();
    
    $this->setQueryPorOpciones($q, $opciones);
    
    return $q->select($q->getRootAlias().'.id')->count();
  }
  
  public function getPagerAutorizadas($pagina = 1, $opciones = array())
  {
    $pager = new sfDoctrinePager($this->getClassnameToReturn(), tdhConfig::get('contenidos_por_pagina'));
    
    $pager->setPage($pagina);
    $pager->setTableMethod('autorizados');
    $pager->setParameter('links', tdhConfig::get('contenidos_links_por_pagina'));
    
    $this->setQueryPorOpciones($pager->getQuery(), $opciones);
    $pager->init();
    
    return $pager;
  }
  
  /**
   * Realiza una búsqueda en el asuntos 
   * 
   * @param string $cadena
   * @return mixed Devuelve un objeto Doctrine_Collection o null si no hay correspondencia
   */
  static public function getContenidoBusqueda($cadena)
  {
    return Doctrine_Query::create()->from('ehForoHilo h')
      ->innerJoin('h.PrimerMensaje pm')
      ->innerJoin('pm.Usuario u')
      ->innerJoin('u.Perfil p')
      ->leftJoin('h.Noticia n')
      ->leftJoin('h.Recurso r')
      ->leftJoin('h.Critica c')
      ->leftJoin('h.Evento e')
      ->where('pm.asunto LIKE ?', "%$cadena%")
      ->addWhere('pm.estado_activo = true')
      ->addWhere('h.estado_oculto = false')
      ->addWhere('pm.visible_desde <= ?', date('Y-m-d H:i:s'))
      ->execute();
  }
  
  /**
   * Muestra las últimas actualizaciones producidas en la web.
   * 
   * @return Doctrine_Collection Una colección de registros
   */
  static public function getContenidoUltimos()
  {
    return Doctrine_Query::create()->from('ehForoHilo h')
      ->innerJoin('h.PrimerMensaje pm')
      ->leftJoin('h.Noticia n')
      ->leftJoin('h.Recurso r')
      ->leftJoin('h.Critica c')
      ->leftJoin('h.Evento e')
      ->addWhere('n.id IS NOT NULL OR c.id IS NOT NULL OR e.id IS NOT NULL OR r.id IS NOT NULL')
      ->addWhere('pm.estado_activo = true')
      ->addWhere('h.estado_oculto = false')
      ->addWhere('pm.visible_desde <= ?', date('Y-m-d H:i:s'))
      ->limit(tdhConfig::get('contenidos_por_pagina', 10))
      ->orderBy('pm.visible_desde DESC, pm.created_at DESC, pm.id DESC')
      ->execute();
  }
  
  public function setQueryPorOpciones(Doctrine_Query $q, $opciones = array())
  {
    $opciones = sfToolkit::arrayDeepMerge($this->opciones, $opciones);
    
    // Filtro de los contenidos
    switch($opciones['filtro'])
    {
      case 'staff':
        $q->addWhere('h.estado_staff = true');
        break;
      case 'destacados':
      case 'destacadas':
        $q->addWhere(($this->getClassnameToReturn() == 'tdhNoticia' ? 'c' : 'n').'.es_destacada = true');
        break;
      case 'no-destacados':
      case 'no-destacadas':
        $q->addWhere(($this->getClassnameToReturn() == 'tdhNoticia' ? 'c' : 'n').'.es_destacada = false');
        break;
    }
    
    // Sólo admitimos noticias "puras"
    if($opciones['solo_noticias'] == true && $this->getClassnameToReturn() == 'tdhNoticia')
    {
      $q->addWhere('r.id IS NULL')
        ->addWhere('i.id IS NULL')
        ->addWhere('e.id IS NULL');
    }
    
    // Filtramos por la sección
    if($opciones['seccion_slug'])
    {
      $q->addWhere('s.slug = ?', $opciones['seccion_slug']);
    }
    
    // Ponemos un límite al número de resultados
    if($opciones['limite'])
    {
      $q->limit($opciones['limite']);
    }
    
    // Orden en el que son entregados los resultados
    switch($opciones['orden'])
    {
      case 'fecha_desc':
      default:
        $q->orderBy('m.visible_desde DESC, m.created_at DESC, c.id DESC');
        break;
    }
    
    return $opciones;
  }
}