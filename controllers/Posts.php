<?php namespace Teb\AfterStory\Controllers;

use Flash;
use BackendMenu;
use Backend\Classes\Controller;
use Teb\AfterStory\Models\Post;

/**
 * Posts Back-end Controller
 */
class Posts extends Controller
{
    public $implement = [
      'Backend.Behaviors.FormController',
      'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';
    public $categoryConfig = 'config_category.yaml';

    public $requiredPermissions = ['teb.afterstory.access_afterstory'];

    /**
     * Ensure that by default our edit menu sidebar is active
     */
    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Teb.AfterStory', 'afterstory', 'posts');

        // Add my assets
        $this->addJs('/plugins/teb/afterstory/assets/js/afterstory.js');
    }
}