<?php namespace Teb\AfterStory\Components;

use Illuminate\Support\Facades\Log;
use Lang;
use Auth;
use Mail;
use Event;
use Flash;
use Input;
use Request;
use Redirect;
use File;
use Teb\AfterStory\Models\Photo;
use Validator;
use ValidationException;
use ApplicationException;
use Cms\Classes\Page;
use Cms\Classes\ComponentBase;
use Exception;
use Teb\AfterStory\Models\Category;
use Teb\AfterStory\Models\Post;


class AfterStoryPost extends ComponentBase
{

  public $postPage;
  public $postId;
  public $post;

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
    if($this->postId) {
      $this->post = $this->page['post'] = Post::find($this->postId);
    }
  }

  protected function prepareVars()
  {
    $this->postPage = $this->page['postPage'] = $this->property('postPage');
    $this->postId = $this->page['postId'] = $this->property('postId');
  }

  protected function handleOptOutLinks()
  {

  }

  public function getCategories()
  {
    return Category::all();
  }

  public function onCreate()
  {
    $data = post();
    $rules = [
      'title'         => 'required',
      'content'      => 'required',
      'category' => 'required',
      'take_period' => 'required',
      'daily_dose' => 'required'
    ];

    $validation = Validator::make($data, $rules);
    if ($validation->fails()) {
      Flash::error($validation->messages()->first());
      return;
    }

    try {
      if (!$user = Auth::getUser())
        throw new ApplicationException('You should be logged in.');

      $post = new Post();
      $post->user_id = $user->id;
      $post->title = post('title');
      $post->content = post('content');
      $post->category_id = post('category');
      $post->take_period = post('take_period');
      $post->daily_dose = post('daily_dose');

      $post->save();

//      Input::file('images')->move('storage/app/media/photos');
//      $fileName = Input::file('images')->getFileName();
      foreach(Input::file('images') as $image) {
        if($image) {
          $photo = new Photo();
          $photo->post_id = $post->id;
          $fileName = md5($image->getClientOriginalName() . microtime()) . '.' .$image->getClientOriginalExtension();
          $image->move('storage/app/media/photos', $fileName);
          $photo->path = 'photos/';
          $photo->filename = $fileName;
          $photo->save();
        }
      }


      return redirect('/afterstory');
    }
    catch (Exception $ex) {
      Flash::error($ex->getMessage());
    }
  }

  public function onUpdate()
  {
    $data = post();
    $rules = [
      'title'         => 'required',
      'content'      => 'required',
      'category' => 'required',
      'take_period' => 'required',
      'daily_dose' => 'required'
    ];

    $validation = Validator::make($data, $rules);
    if ($validation->fails()) {
      Flash::error($validation->messages()->first());
      return;
    }

    try {
      $post = Post::find(post('post_id'));

      if ($post->user_id != Auth::getUser()->id)
        throw new ApplicationException('권한이 없습니다.');

      $post->title = post('title');
      $post->content = post('content');
      $post->category_id = post('category');
      $post->take_period = post('take_period');
      $post->daily_dose = post('daily_dose');

      $post->save();

      $photos = Photo::where('post_id', $post->id)->get();

      $i = 0;
      foreach(Input::file('images') as $image) {
        if ($image) {
          if (isset($photos[$i]->id)) {
            $photo = Photo::find($photos[$i]->id);
            if (!File::delete('storage/app/media/' . $photo->path . $photo->filename)) {
              throw new Exception('File delete error ...');
            }
          } else {
            $photo = new Photo();
            $photo->post_id = $post->id;
          }
          $fileName = md5($image->getClientOriginalName() . microtime()) . '.' .$image->getClientOriginalExtension();
          $image->move('storage/app/media/photos', $fileName);
          $photo->path = 'photos/';
          $photo->filename = $fileName;
          $photo->save();
        }
        $i++;
      }

      $delete_photos = post('delete_photos');
      if (!empty($delete_photos)) {
        foreach ($delete_photos as $delete_photo) {
          $photo = Photo::find($delete_photo);
          $photo->delete();
          if (!File::delete('storage/app/media/' . $photo->path . $photo->filename)) {
            throw new Exception('File delete error ...');
          }
        }
      }

      return redirect('/afterstory');
    }
    catch (Exception $ex) {
      Flash::error($ex->getMessage());
    }
  }

  public function getPhotos($post_id)
  {
    return Photo::where('post_id', $post_id)->get();
  }
}
