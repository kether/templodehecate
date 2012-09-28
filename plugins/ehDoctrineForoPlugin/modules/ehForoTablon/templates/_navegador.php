<div id="eh_foro_navegador">
  <?php echo link_to(isset($nombre) ? $nombre : ehForoConfig::getStatic('nombre'), '@eh_foro') ?>
  <?php
    if(isset($nav) && is_array($nav))
    {
      foreach($nav as $opcion)
      {
        if($opcion[0])
        {
          echo ' &rarr; ';
          echo isset($opcion[2]) ? $opcion[2] : '';
          echo isset($opcion[1]) ? link_to($opcion[0], $opcion[1]) : $opcion[0];
        }
      }
    }
  ?>
</div>