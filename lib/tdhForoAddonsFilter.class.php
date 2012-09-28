<?php

class tdhForoAddonsFilter extends ehForoAddonsFilter
{
  protected 
    $addons = array('recurso', 'evento', 'critica', 'noticia'),
    $soloNoticia = true;
  
  public function recursoAddon()
  {
    if($this->checkModuleAction('ehForoTema', 'mostrar'))
    {
      if($this->getContext()->getUser()->getTemplateVar('tema')->getRecurso())
      {
        $tema = $this->getContext()->getUser()->getTemplateVar('tema');
        $tema->getRecurso()->setHilo($tema);
        
        if($this->getContext()->getUser()->tieneRedireccionCanonica())
          $this->getContext()->getController()->redirect($tema->getRecurso()->getRouting(false, 'html'), 301);
        
        $this->soloNoticia = false;
        
        $sus  = $tema->getRecurso()->hasPdf()  ? '<div class="tdh_addon_boton" id="tdh_descargar_pdf"><a title="Descargar en PDF" href="'.$tema->getRecurso()->getPdfPath().'"><span>Descargar en PDF</span></a></div>' : '';
        $sus .= $tema->getRecurso()->hasEPub() ? '<div class="tdh_addon_boton" id="tdh_descargar_epub"><a title="Descargar en ePub" href="'.$tema->getRecurso()->getEPubPath().'"><span>Descargar en ePub</span></a></div>' : '';
        $sus .= '<div class="tdh_addon_boton" id="tdh_addon_inicio"><a title="Ver página del recurso" href="'.$tema->getRecurso()->getRouting(false, 'html', true).'"><span>Recurso</span></a></div>';
        
        $this->sustituir('<!-- [EHF-THREAD-PRESUBJECT] -->', '<div class="tdh_addon_lista_botones" id="tdh_addon_recurso">'.$sus.'</div>');
        $this->sustituir('</title>', "\n".'<link rel="canonical" href="'.$tema->getRecurso()->getRouting(false, 'html', true).'" />', true);
      }
    }
  }
  
  public function eventoAddon()
  {
    if($this->checkModuleAction('ehForoTema', 'mostrar'))
    {
      if($this->getContext()->getUser()->getTemplateVar('tema')->getEvento())
      {
        $tema = $this->getContext()->getUser()->getTemplateVar('tema');
        $tema->getEvento()->setHilo($tema);
        
        if($this->getContext()->getUser()->tieneRedireccionCanonica())
          $this->getContext()->getController()->redirect($tema->getEvento()->getRouting(false, 'html'), 301);
        
        $this->soloNoticia = false;
        
        $sus = '<div class="tdh_addon_boton" id="tdh_addon_evento"><a title="Ver página del evento" href="'.$tema->getEvento()->getRouting(false, 'html', true).'"><span>Evento</span></a></div>';
        
        $this->sustituir('<!-- [EHF-THREAD-PRESUBJECT] -->', '<div class="tdh_addon_lista_botones" id="tdh_addon_evento">'.$sus.'</div>');
        $this->sustituir('</title>', "\n".'<link rel="canonical" href="'.$tema->getEvento()->getRouting(false, 'html', true).'" />', true);
      }
    }
  }
  
  public function criticaAddon()
  {
    if($this->checkModuleAction('ehForoTema', 'mostrar'))
    {
      if($this->getContext()->getUser()->getTemplateVar('tema')->getCritica())
      {
        $tema = $this->getContext()->getUser()->getTemplateVar('tema');
        $tema->getCritica()->setHilo($tema);
        
        if($this->getContext()->getUser()->tieneRedireccionCanonica())
          $this->getContext()->getController()->redirect($tema->getCritica()->getRouting(false, 'html'), 301);

        $this->soloNoticia = false;
        
        $sus = '<div class="tdh_addon_boton" id="tdh_addon_critica"><a title="Ver página de la reseña" href="'.$tema->getCritica()->getRouting(false, 'html', true).'"><span>Crítica</span></a></div>';
        
        $this->sustituir('<!-- [EHF-THREAD-PRESUBJECT] -->', '<div class="tdh_addon_lista_botones" id="tdh_addon_critica">'.$sus.'</div>');
        $this->sustituir('</title>', "\n".'<link rel="canonical" href="'.$tema->getCritica()->getRouting(false, 'html', true).'" />', true);

      }
    }
  }
  
  public function noticiaAddon()
  {
    if($this->checkModuleAction('ehForoTema', 'mostrar'))
    {
      if($this->getContext()->getUser()->getTemplateVar('tema')->getNoticia())
      {
        $tema = $this->getContext()->getUser()->getTemplateVar('tema');
        $tema->getNoticia()->setHilo($tema);
        
        if($this->soloNoticia)
        {
          if($this->getContext()->getUser()->tieneRedireccionCanonica())
            $this->getContext()->getController()->redirect($tema->getNoticia()->getRouting(false, 'html'), 301);

          $sus = '<div class="tdh_addon_boton" id="tdh_addon_noticia"><a title="Ver página de la noticia" href="'.$tema->getNoticia()->getRouting(false, 'html', true).'"><span>Noticia</span></a></div>';
          $this->sustituir('<!-- [EHF-THREAD-PRESUBJECT] -->', '<div class="tdh_addon_lista_botones" id="tdh_addon_noticia">'.$sus.'</div>');
          $this->sustituir('</title>', "\n".'<link rel="canonical" href="'.$tema->getNoticia()->getRouting(false, 'html', true).'" />', true);
        }
      }
    }
  }
}