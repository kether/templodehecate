<?php

require_once dirname(__FILE__).'/../lib/vendor/symfony/lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {    
    $this->enablePlugins(array(
      'sfDoctrinePlugin', 
      'ehDoctrineAuthPlugin', 
      'ehDoctrineForoPlugin',
      'ehUtilesPlugin',
      'ehSitebarPlugin',
      'ehCalendarPlugin',
      'sfFormExtraPlugin',
      'ehPaypalPlugin'
    ));
    
    $this->dispatcher->connect(
      'mailer.configure',
      array($this, 'configureMailer')
    );
  }
  
  public function configureMailer(sfEvent $event)
  {
    $mailer = $event->getSubject();
     
    if($mailer->getDeliveryStrategy() == 'spool')
    {
      $spool = $mailer->getSpool();
  
      $spool->setMessageLimit(450);
      $spool->setTimeLimit(275);
  
      $transport = $mailer->getRealtimeTransport();
  
      $transport->registerPlugin(new Swift_Plugins_ThrottlerPlugin(100, Swift_Plugins_ThrottlerPlugin::MESSAGES_PER_MINUTE));  
      $transport->registerPlugin(new Swift_Plugins_AntiFloodPlugin(30));
    }
  }
  
  public function setupPlugins()
  {
    $this->pluginConfigurations['ehDoctrineForoPlugin']->connectTests();
  }
  
}
