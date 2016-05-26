<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Image;
use Transliterator;
use Auth;

Relation::morphMap([
    Product::class,
    #App\Comment::class,
]);

class Img extends Model
{

  protected $table = 'imgs';
  protected $fillable = ['name', 'filename', 'filemime', 'filesize'];
  protected $base_dir = 'files/images';


    public function imgable() {
        return $this->morphTo();
    }


    public static function named($file, $filenameSuf = null) {
      return (new static)->saveAs($file, $filenameSuf);
    }


    public function saveAs($file, $filenameSuf = null)
    {
        $this->user_id = Auth::user()->id;
        $this->name = $file->getClientOriginalName();
        $this->filename = substr(str_slug($this->name), 0, -3).$filenameSuf.'.'.$file->getClientOriginalExtension();
        $this->filemime = $file->getMimeType();
        $this->filesize = $file->getSize();

        return $this;
    }

    public function move($file)
    {	
        $file->move($this->base_dir, $this->filename);

        $this->resizeImg();
        $this->makeThumbnail();

        return $this;

    }    

    public function resizeImg()
    {	

        $path = sprintf('%s/%s', $this->base_dir, $this->filename);
        $path_new = sprintf('%s/%s', $this->base_dir, $this->filename);

        Image::make($path)->resize(1200, null, function ($constraint) {
		    $constraint->aspectRatio();
		})->save($path_new);

    }   

    public function makeThumbnail()
    {
    	$path = sprintf('%s/%s', $this->base_dir, $this->filename);
        $path_new = sprintf('%s/thumbnail/%s', $this->base_dir, $this->filename);
        
        Image::make($path)->fit(250)->save($path_new);
    }   

}
