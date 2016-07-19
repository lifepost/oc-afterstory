<?php namespace Teb\AfterStory;

use System\Classes\PluginBase;
use BackendAuth;
use Backend;
use Config;
use Event;
use Cache;
use Request;
use App;
use Flash;

/**
 * AfterStory Plugin Information File
 * Plugin icon is used with Creative Commons (CC BY 4.0) Licence
 * Icon author: http://pixelkit.com/
 */
class Plugin extends PluginBase
{

  /**
   * Returns information about this plugin.
   *
   * @return array
   */
  public function pluginDetails()
  {
    return [
      'name' => '치료후기',
      'description' => '치료후기 플러그인',
      'author' => 'jsy',
      'icon' => 'icon-cubes'
    ];
  }

  public function registerNavigation()
  {
    return [
      'afterstory' => [
        'label'       => 'Afterstory',
        'url'         => Backend::url('teb/afterstory/posts'),
        'icon'        => 'icon-pencil',
        'permissions' => ['teb.afterstory.*'],
        'order'       => 500
      ]
    ];
  }

  public function registerPermissions()
  {
    return array('teb.afterstory.access_afterstory' => ['label' => 'Afterstory menu', 'tab' => 'MenuManager']);
  }

  public function registerComponents()
  {
    return [
      'Teb\AfterStory\Components\AfterStory'       => 'afterStory',
      'Teb\AfterStory\Components\AfterStoryPost'       => 'afterStoryPost',
      'Teb\AfterStory\Components\RecentAfterStory'       => 'recentAfterStory'
    ];
  }

  public function boot() {

  }
}
