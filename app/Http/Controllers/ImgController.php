<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\ImgRequest;

use App\Img;
use App\Product;
use Validator;



class ImgController extends Controller
{


    public function upload($id, ImgRequest $request) {


        if($request->ajax()) {

		#$validator = Validator::make($request->all());

/*
		$messages = $validator->errors();

		return response()->json($messages);

		return $messages->first('file');

		
		if ($validator->fails()) {
			return $validator->fails();
			#return $validator->errors()->all();
			#return $validator->errors()->all()->file[0];
			#return response()->json(['name' => 'Abigail', 'state' => 'CA']);
		}
*/

		$file = $request->file('file');

    	$img = $this->uniqfilename($file)->makeImg($file);

		Product::findOrFail($id)->addImage($img);

    	return 'ok';

    	}
    }

		public function uniqfilename($file) {

			$this->suf = null;

			$name = $file->getClientOriginalName();
			$name = substr(str_slug($name), 0, -3);
			$name_ext = $name.'.'.$file->getClientOriginalExtension();

			$img = Img::where('filename', $name_ext)->first();

			if(isset($img)) {

				$this->suf = '-1';

				$img2 = Img::where('filename', 'like', $name.'-%.%')
						->orderBy('filename', 'desc')
						->first();

			if(isset($img2)) {

				$a = explode('-', $img2->filename);
				$b = explode('.', last($a));
				if (is_numeric($b[0])) { 
					$suf = $b[0] + 1;
		        	$this->suf = (string)'-'.$suf.'';
		     	}

			}

			}

			return $this;
		}
		
		public function makeImg($file) {
			return Img::named($file, $this->suf)->move($file);
		}
}
