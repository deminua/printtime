<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
  protected $table = 'products';
  protected $fillable = ['name'];

    public function imgs() {
        return $this->morphMany('App\Img', 'imgable');
    }

    public function addImage(Img $img) {
        return $this->imgs()->save($img);
    }

}
