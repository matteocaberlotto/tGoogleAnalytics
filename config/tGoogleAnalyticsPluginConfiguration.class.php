<?php

/**
 * tGoogleAnalyticsPluginConfiguration configuration.
 *
 * @package    tGoogleAnalyticsPluginConfiguration
 * @author     Matteo Caberlotto mcaber@gmail.com
 */
class tGoogleAnalyticsPluginConfiguration extends sfPluginConfiguration
{
  /**
   * @see sfPluginConfiguration
   */
  public function initialize()
  {
    if(sfConfig::get('app_ga_auto_enable', false))
    {
      sfConfig::set('sf_enabled_modules', array_merge(sfConfig::get('sf_enabled_modules', array()), array('googleAnalytics')));
      $this->dispatcher->connect('response.filter_content', array($this, 'addAnalytics'));
    }
  }

  public function addAnalytics(sfEvent $event, $content)
  {
    if(stripos($content, "<body>") !== FALSE)
    {
      // this is quite ugly: need to find a better way to recognize a symfony error 'state'
      if(function_exists('get_partial'))
      {
        $enabled = sfConfig::get('app_ga_is_production_environment', false) &&
        !in_array(sfContext::getInstance()->getModuleName(), sfConfig::get('app_ga_exclude_modules',array()));
        $partial = get_partial('analytics/googleAnalytics', array('enabled' => $enabled));
        $content = str_replace("</body>", $partial . "</body>", $content);
      }

    }
    return $content;
  }
}
