<?php namespace Teb\AfterStory\Components;

use Illuminate\Support\Facades\Log;
use Lang;
use Auth;
use Mail;
use Event;
use Flash;
use Input;
use File;
use Request;
use Redirect;
use Validator;
use ValidationException;
use ApplicationException;
use Cms\Classes\Page;
use Cms\Classes\ComponentBase;
use Exception;
use Teb\AfterStory\Models\Category;
use Teb\AfterStory\Models\Post;
use Teb\AfterStory\Models\Photo;

class RecentAfterStory extends ComponentBase
{
  public function componentDetails()
  {
    return [
      'name'        => 'rainlab.user::lang.account.account',
      'description' => 'rainlab.user::lang.account.account_desc'
    ];
  }

  public function defineProperties()
  {
    return [

    ];
  }

  public function getPropertyOptions($property)
  {
    return Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
    $this->prepareVars();
  }

  public function onRun()
  {
    $this->addCss('/plugins/teb/afterstory/assets/css/afterstory.css');
    $this->addJs('/plugins/teb/afterstory/assets/js/afterstory.js');
    $this->prepareVars();
    $this->handleOptOutLinks();
  }

  protected function prepareVars()
  {

  }

  protected function handleOptOutLinks()
  {

  }

  public function getPosts()
  {
    return Post::orderBy('created_at', 'desc')->take(3)->get();
  }

}
