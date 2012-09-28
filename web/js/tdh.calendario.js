/**
 * Funciones Javascript para hacer slide-ajax en el calendario de Templo de Hécate 8.0. Requiere
 * las librerías jQuery y jQuery UI. 
 * 
 * @copyright Pablo Floriano
 * @file tdh.calendario.js 
 */

// Variables globales

/**
 * @var string
 */
var elemCalendario = '#tdh_calendario';

/**
 * @var string
 */
var elemCalendarioMarco = '#tdh_calendario_marco';

/**
 * @var string
 */
var optionsIn, optionsOut;

// Funciones

/**
 * Hace una llamada GET a la url pathTo (que debe dar una respuesta HTML para el calendario) en el elemento elemCalendario.
 * Al hacerlo llama a jQuery UI para hacer un efecto slide a la izquierda o la derecha según la variable inverse. 
 * 
 * @param string pathTo URL con la página AJAX
 * @param boolean inverse Si queremos que el calendario haga 'slide' a la izquierda esta variable debe estar marcada como 'true'
 */
function tdhLinkMes(pathTo, inverse)
{	
  jQuery.ajax({
    type:'GET',
    dataType:'html',
    success:function(data, textStatus){
      if(inverse == true) { optionsIn  = { mode: 'show', direction: 'left' }; } else { optionsIn  = { mode: 'show', direction: 'right' }; }
	    
  	  $(elemCalendario).html(data);
  	  
  	  $(elemCalendarioMarco).css('min-height', $(elemCalendario).height());
  	  $(elemCalendario).effect('slide', optionsIn, 'normal');
    },
    beforeSend:function(XMLHttpRequest){
      if(inverse == true) {	optionsOut  = { mode: 'hide', direction: 'right' }; } else { optionsOut  = { mode: 'hide', direction: 'left' }; }
      
      $(elemCalendarioMarco).css('min-height', $(elemCalendario).height());
      $(elemCalendario).effect('slide', optionsOut, 'normal');
    },
    url: pathTo
  });
}