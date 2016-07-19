<?php namespace Teb\AfterStory\Controllers;

use Flash;
use BackendMenu;
use Backend\Classes\Controller;
use Teb\AfterStory\Models\Comment;

/**
 * Comments Back-end Controller
 */
class Comments extends Controller
{
    public $implement = [
      'Backend.Behaviors.FormController',
      'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public $requiredPermissions = ['teb.afterstory.access_afterstory'];

    /**
     * Ensure that by default our edit menu sidebar is active
     */
    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Teb.AfterStory', 'afterstory', 'comments');

        // Add my assets
        $this->addJs('/plugins/teb/afterstory/assets/js/afterstory.js');
    }
}