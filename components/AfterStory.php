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

class AfterStory extends ComponentBase
{

  public $postPage;

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
    if (!Auth::getUser()) return redirect('/account');
    $this->addCss('/plugins/teb/afterstory/assets/css/afterstory.css');
    $this->addJs('/plugins/teb/afterstory/assets/js/afterstory.js');
    $this->prepareVars();
    $this->handleOptOutLinks();
  }

  protected function prepareVars()
  {
    $this->postPage = $this->page['postPage'] = $this->property('postPage');
  }

  protected function handleOptOutLinks()
  {

  }

  public function getCategories()
  {
    return Category::all();
  }

  public function getBestPosts()
  {
    return Post::where('is_best', 1)->orderBy('created_at', 'desc')->take(3)->get();
  }

  public function getPosts()
  {
    return Post::orderBy('created_at', 'desc')->paginate(5);
  }

  public function getPhotos($post_id)
  {
    return Photo::where('post_id', $post_id)->get();
  }

  public function getPhoto($post_id)
  {
    return Photo::where('post_id', $post_id)->first();
  }

  public function getPage()
  {
    $page = Request::get('page');
    if(!$page) $page = 1;

    return $page;
  }

//  public function onUpdate()
//  {
//    Log::info(post('post'));
//    $post = Post::find(post('post'));
//    Log::info($post);
//    $this->page['post'] = $post;
//  }

  public function onDelete()
  {
    $post_id = post('post_id');
    $post = Post::find($post_id);

    foreach ($post->photos as $photo) {
      $photo->delete();
      if (! File::delete('storage/app/media/'.$photo->path.$photo->filename)) {
        throw new Exception('File delete error ...');
      }
    }

    if (! $post->delete()) {
      throw new Exception('Post delete error ...');
    }

    return redirect('/afterstory');
  }

  public function onTest()
  {
    return 'hello';
  }
}
