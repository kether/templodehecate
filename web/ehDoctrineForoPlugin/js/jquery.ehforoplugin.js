/**
 * jquery.ehforoplugin.js
 * 
 * @author Pablo Floriano
 * @version 06.06.2012
 */

var capaFormResponder = '#eh_foro_form_responder';

var capaBotones = '.eh_foro_botones';

// Funciones genéricas
function efpAjaxClickAndRemove(url, caja)
{ 
  $.ajax({
    type:'GET',
    dataType:'html',
    success:function(data, textStatus){ $(caja).fadeOut(); },
    url: url
  });
}

// Funciones especificas
function efpResponder(url)
{ 
  $.ajax({
    type:'GET',
    dataType:'html',
    success:function(data, textStatus) {
      $(capaFormResponder).html(data);
      $(capaFormResponder).fadeIn('medium');
    },
    beforeSend:function(XMLHttpRequest) {
      $(capaBotones).hide();
    },
    url: url
  });
}

function efpCancelarRespuesta()
{ 
  $(capaFormResponder).hide(0, function() {
    $(capaBotones).fadeIn('slow');
  });
}

function efpAmigar(url, caja)
{ 
  $.ajax({
    type:'GET',
    dataType:'html',
    success:function(data, textStatus){
      $(caja).html(data);
    },
    url: url
  });
}

function efpBorrarPrivado(url, caja)
{ 
  efpAjaxClickAndRemove(url, caja);
}