/**
 * Funciones Javascript para hacer para escribir y navegar por los comentarios de
 * Templo de Hécate 8.0. Requiere las librerías jQuery. 
 * 
 * @copyright Pablo Floriano
 * @file tdh.comentarios.js 
 */

// Variables globales

/**
 * @var string
 */
var elemComentarios       = '#tdh_comentarios';

/**
 * @var string
 */
var elemComentariosLoader = '#tdh_cargando_comentario';

// Funciones

/**
 * Hace una petición GET XMLHttpRequest al pathTo.
 * 
 * @param integer hiloId
 * @param integer pagina
 * @param string pathTo
 */
function tdhLinkComentarios(hiloId, pagina, pathTo)
{	
  jQuery.ajax({
    type:'GET',
    dataType:'html',
    success:function(data, textStatus){
      $(elemComentarios).html(data);
    },
    beforeSend:function(XMLHttpRequest){
	  $(elemComentariosLoader).show();
	},
	url: pathTo + '?hilo_id=' + hiloId + '&pagina=' + pagina
  });
}

function tdhRemoveComentario(mensajeId, pagina, pathTo)
{ 
  jQuery.ajax({
    type:'GET',
    dataType:'html',
    success:function(data, textStatus){
      $(elemComentarios).html(data);
    },
    beforeSend:function(XMLHttpRequest){
    $(elemComentariosLoader).show();
  },
  url: pathTo + '?remove_mensaje_id=' + mensajeId + '&pagina=' + pagina
  });
}

/**
 * Hace una petición POST XMLHttpRequest al pathTo con los datos del formulario.
 * 
 * @param string formulario
 * @param string pathTo
 */
function tdhPostComentario(formulario, pathTo)
{
  jQuery.ajax({
    type:'POST',
    dataType:'html',
    data:jQuery(formulario).serialize(),
    success:function(data, textStatus){
	  $(elemComentarios).html(data);
    },
    beforeSend:function(XMLHttpRequest){
      $(elemComentariosLoader).show();
    },
    url: pathTo
  });
}