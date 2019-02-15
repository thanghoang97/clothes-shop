<?php

namespace App\Http\Controllers;

use App\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Intervention\Image\Facades\Image;

class UploadImagesController extends Controller
{
	private $photos_path;

	public function __construct()
	{
		$this->photos_path = public_path('/images');
	}

    /**
     * Display all of the images.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        // dd($request->all());
    	$photos = ProductImage::where('product_id',$request->id)->get();
    	// dd($photos);
    	$output= "";
    	foreach($photos as $photo){
    		$output .= 
    		'{{csrf_field()}}
    		<tr><td><img src="/images/'.$photo->resized_name.'"></td><td>'.$photo->original_name.'</td><td><button class="btn btn-danger img-delete" data-id="'.$photo->id.'"​ data-name="'.$photo->filename.'"><i class="fa fa-times" aria-hidden="true"></i></button></td></tr>';
    	}
    	// dd($output);
    	// echo $output;
    	// return $output;
    	// echo json_encode($output);
    	return response()->json(['output' => $output]);
    }

    /**
     * Show the form for creating uploading new images.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	return view('upload');
    }

    /**
     * Saving images uploaded through XHR Request.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$photos = $request->file('file');

    	if (!is_array($photos)) {
    		$photos = [$photos];
    	}

    	if (!is_dir($this->photos_path)) {
    		mkdir($this->photos_path, 0777);
    	}

    	for ($i = 0; $i < count($photos); $i++) {
    		$photo = $photos[$i];
    		$name = sha1(date('YmdHis') . str_random(30));
    		$save_name = $name . '.' . $photo->getClientOriginalExtension();
    		$resize_name = $name . str_random(2) . '.' . $photo->getClientOriginalExtension();

    		Image::make($photo)
    		->resize(250, null, function ($constraints) {
    			$constraints->aspectRatio();
    		})
    		->save($this->photos_path . '/' . $resize_name);

    		$photo->move($this->photos_path, $save_name);

    		$upload = new ProductImage;
    		$upload->product_id = $request->product_id;
    		$upload->filename = $save_name;
    		$upload->resized_name = $resize_name;
    		$upload->original_name = basename($photo->getClientOriginalName());
    		$upload->save();
    	}
    	return Response::json([
    		'message' => 'Image saved Successfully'
    	], 200);
    }

    /**
     * Remove the images from the storage.
     *
     * @param Request $request
     */
    public function destroy(Request $request)
    {
        // dd($request->id);
    	// $id = $request->id;
     //    $filename = ProductImage::find($id)->select('original_name');
     //    dd($filename);
     //    // if($filename)
     //    $uploaded_image = ProductImage::where('id', $id)->first();
    	$filename = $request->id;
    	
    	$uploaded_image = ProductImage::where('filename', basename($filename))->first();
        if($uploaded_image === null){
            $uploaded_image = ProductImage::where('original_name', basename($filename))->first();
        }
    	if (empty($uploaded_image)) {
    		return Response::json(['message' => 'Sorry file does not exist'], 400);
    	}

    	$file_path = $this->photos_path . '/' . $uploaded_image->filename;
    	$resized_file = $this->photos_path . '/' . $uploaded_image->resized_name;

    	if (file_exists($file_path)) {
    		unlink($file_path);
    	}

    	if (file_exists($resized_file)) {
    		unlink($resized_file);
    	}

    	if (!empty($uploaded_image)) {
    		$uploaded_image->delete();
    	}

    	return Response::json(['message' => 'File successfully delete'], 200);
    }
}
