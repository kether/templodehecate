<?php use_helper('Date') ?>

<?php echo $calendario->render() ?>

<div id="tdh_calendario_navegador">
  
  <span class="tdh_anterior">
    <a href="<?php echo url_for(sprintf('@tdh_evento_agenda?month=%d&year=%d', $calendario->getPreviousMonth()->format('m'), $calendario->getPreviousMonth()->format('Y'))) ?>" onclick="tdhLinkMes('<?php echo url_for(sprintf('@tdh_evento_agenda?month=%d&year=%d', $calendario->getPreviousMonth()->format('m'), $calendario->getPreviousMonth()->format('Y')), true) ?>', true); return false;">
      <?php echo format_date($calendario->getPreviousMonth()->format('U'), 'MMMM yyyy') ?>
    </a>
  </span>
  
  <span class="tdh_siguiente">
    <a href="<?php echo url_for(sprintf('@tdh_evento_agenda?month=%d&year=%d', $calendario->getNextMonth()->format('m'), $calendario->getNextMonth()->format('Y'))) ?>" onclick="tdhLinkMes('<?php echo url_for(sprintf('@tdh_evento_agenda?month=%d&year=%d', $calendario->getNextMonth()->format('m'), $calendario->getNextMonth()->format('Y')), true) ?>', false); return false;">
      <?php echo format_date($calendario->getNextMonth()->format('U'), 'MMMM yyyy') ?>
    </a>
  </span>
  
</div>