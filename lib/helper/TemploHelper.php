<?php

/**
 * Setea el título de la página añadiendo un separador y el nombre de la web.
 * 
 * @param string $title Título de la página
 * @param string $separator Separador entre el título y el nombre de la web, por defecto ' • '
 * @param sfContext $context Contexto
 * @return string El título de nuevo, sin el separador y el nombre de la página
 */
function tdh_set_title($title, $separator = ' • ', $context = null)
{
  $context = $context instanceOf sfContext ? $context : sfContext::getInstance();
  $context->getResponse()->setTitle($title.$separator.tdhConfig::get('nombre'));
  return $title;
}