/**
 * Funciones diversas para el control de Templo de Hécate 8.0
 * 
 * @copyright Pablo Floriano
 * @file tdh.generico.js 
 */

/**
 * @var Estilo de los tooltip qTip2
 */
var toolTipClasses = 'ui-tooltip-blue ui-tooltip-tipsy';

function tdhAddFavorito(path, caja) { 
  jQuery.ajax({
    type:'GET',
    dataType:'html',
    success:function(data, textStatus){
      $(caja).html(data);
    },
  url: path
  });
}

function tdhIngresarGrupo(path, caja) {
  jQuery.ajax({
    type:'GET',
    dataType:'html',
    success:function(data, textStatus){
      $(caja).html(data);
    },
  url: path
  });
}

function tdhAddRecursoSeccion(path, caja, cajaLoader) {
  jQuery.ajax({
    type:'GET',
    dataType:'html',
    success:function(data, textStatus){
      $(caja).html(data);
      $(caja).slideDown('fast', function(){ $(cajaLoader).hide($(caja + " input[type=submit]").button()); });
    },
    beforeSend:function(XMLHttpRequest){     
      $(cajaLoader).show(0, function(){ 
        if($(caja).css('display') == 'list-item')
        {
          $(caja).slideUp();
        }
      });
    },
    url: path
  });
}

function tdhPostRecursoSeccion(formulario, caja, cajaLoader, path) {
  jQuery.ajax({
    type:'POST',
    dataType:'html',
    data:jQuery(formulario).serialize(),
    success:function(data, textStatus){
      $(caja).html(data);
      $(caja).slideDown();
      $(cajaLoader).hide();
    },
    beforeSend:function(XMLHttpRequest){
      $(cajaLoader).show(0, $(caja).slideUp());
    },
    url: path
  });
}

/**
 * Saltamos automáticamente a la ruta URL indicada.
 * 
 * @param url Una ruta a la dirección a la que queremos saltar
 */
function tdhIrA(url) {
  $(location).attr('href', url);
}

/**
 * Crea un tooltip básico
 * 
 * @param elemento El identificador del elemento HTML
 * @param posmy
 * @param posat
 */
function tdhTooltip(elemento, posmy, posat) {
  posmy = posmy || 'bottom center';
  posat = posat || 'top center';
  
  $(elemento).qtip({ style: { classes: toolTipClasses }, position: { my: posmy, at: posat } });
}

/**
 * Añadimos un tooltipo a todas las estrellas para hacer favoritas las secciones y otros registros para los usuarios
 * 
 * @param elemento
 */
function tdhFavoritoTooltip(elemento) { 
  elemento = elemento || '.tdh_favorito a[title]';
  $(elemento).qtip({ style: { classes: toolTipClasses }, position: { my: 'bottom center', at: 'top center' } });
}

/**
 * Tooltip configurado para patrocinadores
 * 
 * @param elemento El identificador del elemento HTML
 */
function tdhToolTipPatrocinador(elemento) { 
  $(elemento).qtip({ overwrite: false, style: { classes: toolTipClasses }, position: { my: 'top center', at: 'bottom center' }, show: { solo: true, ready: true }  });
}