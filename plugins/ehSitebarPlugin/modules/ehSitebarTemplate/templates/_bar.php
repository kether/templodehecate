<?php if($tiptip): ?>
<script type="text/javascript">
  $(function(){
    $(".eh_sitebar_item_link").tipTip();
  });
</script>
<?php endif ?>
<div id="eh_sitebar">
  <div id="eh_sitebar_body" class="eh_sitebar_<?php echo $size ?>">
    <a href="<?php echo $sitebar->url ?>" title="<?php echo $sitebar->name ?>"><?php echo image_tag($sitebar->icon, array('alt' => $sitebar->name)) ?></a>
    <ul>
      <?php foreach($sitebar->items->site as $item): ?>
      <li class="eh_sitebar_item" id="<?php echo "eh_sitebar_site_".$item->tag ?>">
        <a href="<?php echo $item->url ?>" title="<?php echo $item->title ?>" class="eh_sitebar_item_link"><?php echo image_tag($item->icon, array('alt' => $item->title)) ?></a>
      </li>
      <?php endforeach ?>
    </ul>
  </div>
</div>