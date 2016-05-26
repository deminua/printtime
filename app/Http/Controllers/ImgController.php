<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Img;
use App\Product;

class ImgController extends Controller
{
    public function upload($id, Request $request) {

    	$img = $this->makeImg($request->file('file'));
    	#return dd($image);

		Product::find($id)->addImage($img);

    	return 'OK';
    }


		public function makeImg($file) {
			/*
			$name = str_slug($file->getClientOriginalName());
			$name = substr($name, 0, -3);
			$name .= '.';
			$name .= $file->getClientOriginalExtension();
			*/

			return Img::named($file)->move($file);
		}
}
