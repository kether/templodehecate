/**
 * Hoja de estilo de <?php echo $estilo->getTitle()."\n" ?>
 *
 * @copyright <?php echo tdhConfig::get('nombre', 'Estudio Hécate s.l.')."\n" ?>
 * @file <?php echo $estilo->getFilename().".css\n" ?>
 * @updated <?php echo date('d-m-Y H:i', strtotime($estilo->getUpdatedAt())) ?>   
 */
@CHARSET "UTF-8";

<?php echo $estilo->getContent() ?>