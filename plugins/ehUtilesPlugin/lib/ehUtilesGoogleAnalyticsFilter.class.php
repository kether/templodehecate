<?php

class ehUtilesGoogleAnalyticsFilter extends sfFilter
{

  public function execute($filterChain)
  {
    // No se hace nada antes de la acción
    $filterChain->execute();
        
    if($this->getContext()->getRequest()->getParameter('sf_format', 'html') == 'html')
    {
	    // Decorar la respuesta con el código de Google Analytics
	    if($googleId = $this->getParameter('google_id'))
	    {
	      $codigoGoogle = <<< EOH
<script type="text/javascript">
	      
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', '$googleId']);
  _gaq.push(['_trackPageview']);
	      
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
	      
</script>
EOH;
	      
	      $respuesta = $this->getContext()->getResponse();
	      $respuesta->setContent(str_ireplace('</head>', $codigoGoogle.'</head>', $respuesta->getContent()));
	    }
    }
   }
}