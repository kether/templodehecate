<?php use_stylesheet('tdh8_formularios', 'last') ?>

<script type="text/javascript">$(function(){ $(".tdh_submit input[type=submit]").button(); });</script>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1&appId=277860003995";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>


<div id="tdh_sorteo" class="tdh_formulario">
  <div class="tdh_banner_sorteo"><?php echo link_to(image_tag($sorteo->getImagePath('gra'), array('alt' => $sorteo->getNombre())), '@tdh_sorteo?slug='.$sorteo->getSlug()) ?></div>
  
  <h1><?php echo tdh_set_title('Formulario para sorteo de '.$sorteo->getNombre()) ?></h1>
  
  <form action="<?php echo url_for('@tdh_sorteo_mensaje?slug='.$sf_request->getParameter('slug')) ?>" method="post">
    <fieldset>
      <ul>
        <?php if($form->getServicio() == 'facebook'):  ?>
        <?php foreach($sorteo->getCondicionesByServicio('facebook') as $condicion): ?>
        <li class="tdh_campo">
          <div class="tdh_label">
            <label><?php echo $condicion->getNombre() ?></label>
            <div class="tdh_help">'Me gusta' obligatorio</div>
          </div>
          <div class="fb-like" data-href="<?php echo $condicion->getUrl() ?>" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div>
        </li>
        <?php endforeach ?>
        <?php endif ?>
        <?php echo $form['nombre']->renderRow() ?>
        <?php echo $form['email']->renderRow() ?>
        <?php echo $form['mensaje']->renderRow() ?>
        <li class="tdh_submit"><input type="submit" name="enviar" value="¡Envíalo y participa!" /></li>
      </ul>
      <?php echo $form->renderHiddenFields() ?>
    </fieldset>
  </form>
</div>