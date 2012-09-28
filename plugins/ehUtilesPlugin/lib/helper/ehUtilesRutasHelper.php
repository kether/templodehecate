<?php

/**
 * Devuelve la ruta absoluta en la aplicación especificada.
 * 
 * @param $app Nombre de la aplicación (p.e.: frontend, backend, etc.)
 * @param $name Nombre de la ruta definido en routing.yml (p.e.: homepage).
 * @param $parameters $parameters Array de variables que se pasarán a la acción.
 * @return string
 */
function url_for_app($app, $name, $parameters = array())
{
  return sfProjectConfiguration::getActive()->generaUrlFromApp($app, $name, $parameters);
}

/**
 * Función hermana de link_to() pero para enlazar aplicaciones cruzadas.
 * 
 * @param string $title Texto del vínculo.
 * @param string $app Nombre de la aplicación (p.e.: frontend, backend, etc.)
 * @param string $name Nombre de la ruta definido en routing.yml (p.e.: homepage).
 * @param array $parameters Array de variables que se pasarán a la acción.
 * @param array $attributes Atributos HTML.
 * @return string Código HTML con el vínculo a la aplicación especificada.
 * @see link_to()
 */
function link_to_app($title, $app, $name, $parameters = array(), $attributes = array())
{
  return link_to($title, url_for_app($app, $name, $parameters), $attributes);
}