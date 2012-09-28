<?php use_stylesheet('tdh8_listados', 'last') ?>

<?php if($sf_request->hasParameter('seccion_slug')): ?>
<?php slot('submenu_pre', '<li>'.link_to('Ayudas y módulos de '.$seccion->getNombre(), '@tdh_seccion_recurso_lista?pagina=1&seccion_slug='.$seccion->getSlug()).'</li>') ?>
<?php include_partial('seccion/decorador', array('seccion' => $seccion)) ?>
<?php endif ?>

<div id="tdh_recurso_lista" class="tdh_contenido_lista">
  <script type="text/javascript">$(function(){ tdhFavoritoTooltip(); });</script>
  
  <h1><?php echo tdh_set_title('Módulos y ayudas') ?></h1>
  
  <ul>
    <?php foreach($lista->getResults() as $key => $recurso): ?>
    <li id="<?php echo 'tdh_recurso_'.$recurso->getId() ?>" class="<?php echo $key % 2 == 0 ? 'tdh_par' : 'tdh_impar' ?>">
      <div class="tdh_captura">
        <?php echo link_to(image_tag($recurso->getImagePath('secmed', true, true), array('alt' => $recurso->getTitular())), $recurso->getRouting()) ?>
      </div>
      <div class="tdh_detalles">
        <?php if($sf_user->isAuthenticated()): ?><div id="<?php echo 'tdh_favorito_recurso_'.$recurso->getId() ?>" class="tdh_favorito_contenedor"><?php include_partial('favorito', array('recurso_id' => $recurso->getId(), 'es_favorito' => $recurso->getEsMiFavorito($sf_user->getUserId()))) ?></div><?php endif ?>
        <h2>
          <?php echo link_to(($recurso->getSeccion()->getTipo()->getEsJuego() ? $recurso->getSeccion().': '.$recurso->getTitular() : $recurso->getTitular()), $recurso->getRouting()) ?>
        </h2>
        <div class="tdh_ficha">
          <ul>
            <li><?php echo $recurso->getTipo() ?> (<?php echo $recurso->getLicencia() ?>)</li>
            <?php if($recurso->getAutor()): ?><li><?php echo $recurso->getContactoAutor() ? '<a href="'.$recurso->getContactoAutor().'">'.$recurso->getAutor().'</a>' : $recurso->getAutor() ?></li><?php endif ?>
            <?php if($recurso->getNumDonativos() > 0): ?><li><?php echo $recurso->getNumDonativos() > 1 ? $recurso->getNumDonativos().' donativos recibidos' : '1 donativo recibido' ?></li><?php endif ?>
            <li>
              <?php if($recurso->hasPdf()): ?><?php echo link_to(image_tag('btns/pdf_peq.png', array('alt '=> 'PDF')), $recurso->getPdfPath(), array('title' => 'Descargar PDF')) ?><?php endif ?>
              <?php if($recurso->hasEPub()): ?><?php echo link_to(image_tag('btns/epub_peq.png', array('alt '=> 'ePub')), $recurso->getEPubPath(), array('title' => 'Descargar ePub')) ?><?php endif ?>
            </li>
            <li><?php if($recurso->getAceptaDonativos()): ?><?php echo link_to(image_tag('btns/paypal_peq.png', array('alt '=> 'PayPal')), $recurso->getRouting(), array('title' => '¡Haz un donativo!')) ?><?php endif ?></li>
          </ul>
        </div>
        <div class="tdh_entradilla">
          <p><?php echo $recurso->getEntradilla() ?></p>
        </div>
      </div>
    </li>
    <?php endforeach ?>
  </ul>
</div>

<div class="tdh_paginacion"><?php include_partial('global/paginas', array('pager' => $lista, 'uri' => '@tdh_recurso_lista')) ?></div>