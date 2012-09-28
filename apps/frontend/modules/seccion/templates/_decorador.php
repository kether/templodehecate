<?php if($seccion->getLogo()) slot('logo', link_to(image_tag($seccion->getLogo(), array('alt' => $seccion->getNombre())), '@tdh_seccion?seccion_slug='.$seccion->getSlug())) ?>
<?php if($seccion->getFondo()) slot('fondo', $seccion->getFondo()) ?>

<?php foreach($seccion->getHojasDeEstilo() as $hoja) use_stylesheet(url_for('@tdh_css?fichero='.$hoja->getFilename(), 'last', array('title' => $hoja->getTitle(), 'media' => $hoja->getMedia()))) ?>