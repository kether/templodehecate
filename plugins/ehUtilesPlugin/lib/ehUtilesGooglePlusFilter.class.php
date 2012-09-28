<?php

class ehUtilesGooglePlusFilter extends sfFilter
{

  public function execute($filterChain)
  {
    // No se hace nada antes de la acción
    $filterChain->execute();
        
    if($this->getContext()->getRequest()->getParameter('sf_format', 'html') == 'html')
    {
    
	    // Decorar la respuesta con el código de Google Analytics
	    $lang = $this->getParameter('lang', 'es');
	    $codigoGoogle = <<< EOH
<script type="text/javascript" src="https://apis.google.com/js/plusone.js">{lang: '$lang'}</script>
EOH;
    
	    $respuesta = $this->getContext()->getResponse();
	    $respuesta->setContent(str_ireplace('</head>', $codigoGoogle.'</head>', $respuesta->getContent()));
    }
   }
}