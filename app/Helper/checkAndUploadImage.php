<?php

namespace App\Helper;

use Auth;
use App\Event;
use Validator;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;

Trait checkAndUploadImage 
{
    
    public function checkAndUploadImage(Request $request, $data) {

                //if the request has an image
                if($request->hasFile('image') and $request->file('image')->isValid()){
                    
                    $path = 'images/frontend_images/events';
                    $imageNameWithNoExtension = explode('.', $request->image->getClientOriginalName()); 
                    $imageName =  $imageNameWithNoExtension[0].rand(1, 99999).date('ymdhis').'.'.$request->image->getClientOriginalExtension();
                    
                    //Intervention resize image pakage starts here
                    //This resizes the image and stores it in th epath i specified.
            
                    $fp = 'images/frontend_images/events/'.$imageName;
                    Image::make(input::file('image'))->resize(287, 412)->save($fp);
                    return $imageName; 

                    //ends here

                    //use cloudinary instead

                    // $height = 50;
                    // $width = 50;
                    // $image_size = array("height"=>$height, "width"=>$width, "crop"=>"scale");
                    // $image_name = $request->file('image_name')->getRealPath();;
                    // $path = "cinemaxii/events/";
                    // $uniqueid = Date('Ymdhis').rand(1,99999);
                    // Cloudder::upload($image_name, $path.$uniqueid.$request->file('image_name')->getClientOriginalName(), $image_size);
                    // $CloudderArray = Cloudder::getResult();
                    // $image_url = $CloudderArray['url'];
                    //dd($image_url);
             
                    
                } else{
                    return $data['image'] = 'default.jpg';
                }

   

    }

}