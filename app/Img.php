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

/*
    public function getThumbnailPathAttribute($thumbnail_path)
    {
        return $this->attributes['thumbnail_path'] = '/'.$thumbnail_path;
    }

    public function getPathAttribute($path)
    {
        return $this->attributes['path'] = '/'.$path;
    }
    */

	/*
    public function getPathAttribute($path)
    {
        return $this->attributes['path'] = '/'.$this->base_dir.'/'.$path;
    }
    */
    


/*
    public function setNameAttribute($name)
    {
    	    $rule = 'NFD; [:Nonspacing Mark:] Remove; NFC';
			$myTrans = Transliterator::create($rule); 
			#return $myTrans->transliterate($str);

        return $this->attributes['name'] = $myTrans->transliterate($str);
    }
    */

/*
    public static function translit($str) {
    		$rule = 'NFD; [:Nonspacing Mark:] Remove; NFC';
			$myTrans = Transliterator::create($rule); 
			return $myTrans->transliterate($str);
    }
    */


    public static function named($file) {
      return (new static)->saveAs($file);
    }



    public function saveAs($file)
    {	
    	/*
        $this->name = $name;
        $this->path = sprintf('%s/%s', $this->base_dir, $this->filename);
        $this->thumbnail_path = sprintf('%s/thumbnail/%s', $this->base_dir, $this->filename);
        
        */

		
			#$name = str_slug($file->getClientOriginalName());
			#$name = substr($name, 0, -3);
			#$name .= '.';
			#$name .= $file->getClientOriginalExtension();

        $this->user_id = Auth::user()->id;
        $this->name = $file->getClientOriginalName();
        $this->filename = substr(str_slug($this->name), 0, -3).'.'.$file->getClientOriginalExtension();
        $this->filemime = $file->getMimeType();
        $this->filesize = $file->getSize();

        return $this;
    }

    public function move($file)
    {	

        $file->move($this->base_dir, $this->name);

        $this->makeThumbnail();
        $this->resizeImg();

        return $this;

    }    

    public function resizeImg()
    {	

        $path = sprintf('%s/%s', $this->base_dir, $this->name);
        $path_new = sprintf('%s/%s', $this->base_dir, $this->filename);

        Image::make($path)->resize(1200, null, function ($constraint) {
		    $constraint->aspectRatio();
		})->save($path_new);

    }   

    public function makeThumbnail()
    {
    	$path = sprintf('%s/%s', $this->base_dir, $this->name);
        $path_new = sprintf('%s/thumbnail/%s', $this->base_dir, $this->filename);
        
        Image::make($path)->fit(250)->save($path_new);
    }   

}
