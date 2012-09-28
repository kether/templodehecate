<?php if($sf_user->hasFlash('success')): ?>
<div id="eh_foro_suceso_exito">
  <?php echo $sf_user->getFlash('success') ?>
</div>
<?php endif ?>

<?php if($sf_user->hasFlash('error')): ?>
<div id="eh_foro_suceso_fallo">
  <?php echo $sf_user->getFlash('error') ?>
</div>
<?php endif ?>