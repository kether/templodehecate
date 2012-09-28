# LEÉME

[![Licencia GPLv3](http://i.imgur.com/Ma8i9.png)](http://www.gnu.org/licenses/gpl-3.0.html)

## ¿Qué es "GTdH"?

El **Generador de Templo de Hécate** (o "GTdH" por sus siglas) es el programa encargado de gestionar el sitio web [Templo de Hécate](http://www.templodehecate.com) dedicado al género de los juegos de rol de entretenimiento.

Ahora GTdH está liberado bajo licencia [GPLv3](http://www.gnu.org/licenses/gpl-3.0.html) para que cualquier persona pueda aportar sus conocimientos para mejorar el programa como para ser usado en sus propios proyectos. Algunas de las librerías usadas (symfony, zend framewor, etc.) pueden tener otras licencias. Leelas en cada caso.

## Requisitos

Para instalar **GTdH v8.0.0** se deben satisfacer una serie de requisitos previos:

* Un servidor de páginas webs *(p.e. "Apache")*
* Una base de datos MySQL 4.1 o superior
* Un cliente PHP con la versión 5.2 o superior vinculado al servidor de páginas webs

GTdH ha sido instalado en servidores compartidos de coste reducido previamente y en entornos de desarrollo en Windows y Linux con buenos resultados de rendimiento.

## Instalación

*ADVERTENCIA: En este momento no existe un sistema de instalación y configuración sencillos y/o automatizado por lo que requiere ciertos conocimientos de YAML y de configuración de servidores. A continuación se explican todos los pasos para instalarlo manualmente.*

Sigue estos pasos en orden para hacer una instalación limpia de **GTdH**.

1. Extrae los archivos en una carpeta en la máquina que vaya a ejecutar GTdH (o cárgalos mediante FTP, rsync, SVN/CVS, etc. en tu servidor remoto)
2. Apunta el directorio público del servidor al directorio `web`. Consulta la documentación de tu proveedor de alojamiento de páginas webs para hacerlo.
3. Si tu servidor es Apache renombra el fichero `sample.htaccess` a `.htaccess` y modifica cualquier línea que sea apropiada si tu panel de control está en otro dominio o subdominio.
4. Renombra el fichero `config/database.yml.sample` por `config/database.yml` y modifícalo por los datos de conexión de tu base de datos.
5. Renombra el fichero `config/settings.yml.sample` por `config/settings.yml` y modificalo por la zona horaria por defecto que prefieras para tu emplazamiento web.
6. Renombra el fichero `config/app.yml.sample` por `config/app.yml` y modifica los parámetros que necesitas/prefieras para tu emplazamiento web, la mayoría son autoexplicativos.
7. Ejecuta mediante SSH, en la carpeta donde se encuentre GTdH la siguientes instrucciones en este orden:
 * `php symfony doctrine:generate-model-tables --env=prod`
 * `php symfony doctrine:data-load --dir=data/fixtures_prod --env=prod`

Ahora ya debería funcionar todo, dirígete al inicio de tu página desde el navegador web *(p.e.: http://www.midominio.com)*.

## Soporte a terceros

No doy soporte gratuito por la utilización de este programa en emplazamiento de terceros. Podéis hacer peticiones en el *tracker* de GitHub o en los [Foros de Templo de Hécate](http://www.templodehecate.com/foro) para mejorar el generador en general y el Templo de Hécate en particular. Si queréis soporte dedicado para instalar y mejorar vuestro emplazamiento web contactar primero conmigo en mi [correo](mailto:kether@templodehecate.com) para poder llegar a un acuerdo.

## Aportaciones

Si deseas realizar aportaciones al código, hazlo através del proyecto en **GitHub**. Debes saber que GTdH v8.0 está construido sobre **symfony 1.4** (puedes encontrar documentación [aquí](http://www.symfony-project.org/doc/1_4/) en varios idiomas). No descarto introducir componentes y/o apartados completos próximamente construidos en **symfony2.x**.