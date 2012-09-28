<?php use_helper('I18N') ?>

<div class="eh_auth_signin_form">
  <form action="<?php echo url_for(sfConfig::get('app_eh_auth_plugin_uri_signin', '@eh_auth_signin')) ?>" method="post">
    <fieldset><legend><?php echo __('Sign in', null, 'eh_auth_plugin') ?></legend>
    
      <ul>
        <?php echo $form ?>
        <li class="submit"><input type="submit" value="<?php echo __('log in', null, 'eh_auth_plugin') ?>" /></li>
      </ul>
    
    </fieldset>
  </form>
</div>