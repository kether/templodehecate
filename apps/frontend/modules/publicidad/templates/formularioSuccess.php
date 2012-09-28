<?php use_helper('Date', 'Number') ?>

<?php use_stylesheet('tdh8_layout_b', 'last') ?>
<?php use_stylesheet('tdh8_formularios', 'last') ?>
<?php use_stylesheet('tdh8_publicidad', 'last') ?>

<?php use_javascript('jqueryui/jquery.ui.datepicker-es.js', 'last') ?>

<?php slot('navegacion') ?>
<?php include_component('publicidad', 'misAnuncios') ?>
<?php end_slot() ?>

<script type="text/javascript">
  $(function(){
    $(".tdh_submit input[type=submit]").button();
  });
</script>

<div id="tdh_anuncio_contratar" class="tdh_formulario">
  <h1><?php echo tdh_set_title('Contratar promoción') ?></h1>
  
  <p>
    Recuerda que el anuncio comenzará a aparecer aproximadamente a partir de las 12 de media noche del día seleccionado en <strong>Fecha inicio</strong>.
    Dependiendo del estado del sistema de caché para evitar el colapso de la web, podría tardar en aparecer o desparecer tu promoción más tarde de la media noche.
  </p>
  
  <p>
    <strong>Condiciones:</strong> No están permitido anuncios que violen la legalidad internacional, en tu país o en el país donde se aloja esta web. Adicionalmente quedan prohibidos los anuncios de carácter pornográficos o
    de juegos de apuestas, extendiéndose esta prohibición a la imagen del anuncio, el texto y/o la dirección URL a la que redireccione la promoción.
    Si se viola alguno de éstos términos, los responsables del sitio están autorizados a dar de baja tu promoción unilateralmente sin retribuir el pago por el servicio.
  </p>
  
  <form action="<?php echo url_for($form->isNew() ? '@tdh_publicidad_contratar?tipo='.$sf_request->getParameter('tipo') : '@tdh_publicidad_contratar?id='.$sf_request->getParameter('id').'&tipo='.$sf_request->getParameter('tipo')) ?>" method="post" enctype="multipart/form-data">
    <fieldset>
      <ul>
        <?php echo $form ?>
        <li class="tdh_submit">
          <input type="submit" value="Guardar" name="guardar" />
        </li>
      </ul>
    </fieldset>
  </form>
</div>

<?php if(isset($paypal)): ?>
<div id="tdh_anuncio_pagar" class="tdh_formulario">
  <h2>Pagar para contratar</h2>
  
  <p>Aun no has terminado. Debes ingresar <strong><?php echo format_currency($precio, 'EUR') ?></strong> para que automáticamente tu promoción sea dada de alta.</p>
  
  <form action="<?php echo $paypal->getPaypalUrl() ?>" method="post">
    <fieldset>
    <?php echo $paypal->getForm()->renderHiddenFields() ?>
      <ul>
        <li><input type="image" src="<?php echo image_path('btns/paypal_card.png') ?>" name="pagar" value="pagar"  /></li>
      </ul>
    </fieldset>
  </form>
</div>
<?php endif ?>