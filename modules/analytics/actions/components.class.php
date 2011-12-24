<?php

class analyticsComponents extends sfComponents
{
	public function executeGoogleAnalytics(sfWebRequest $request)
	{
    $this->enabled =
    sfConfig::get('app_ga_is_production_environment', false) &&
    !in_array(sfContext::getInstance()->getModuleName(), sfConfig::get('app_ga_exclude_modules',array()));
    $actions = array();
    $actions[] = array('_setAccount', sfConfig::get('app_ga_google_code'));
    $actions = array_merge($actions, sfConfig::get('app_ga_extra_actions', array()));
    $actions[] = array('_trackPageview'); // questa sempre ultima

    $this->actions = $actions;
	}
}
