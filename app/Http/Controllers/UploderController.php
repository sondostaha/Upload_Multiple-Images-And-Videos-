<?php

namespace App\Http\Controllers;
//use CloudinaryLabs\CloudinaryLaravel\MediaAlly;
use App\Models\Video;
use App\Models\Images;
use App\Jobs\UploadImage;
use App\Jobs\UploadVideo;
use Illuminate\Http\Request;
use FFMpeg\Format\Video\X264;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use ProtoneMedia\LaravelFFMpeg\Filesystem\Disk;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class UploderController extends Controller
{
    public function createImage()
    {
        return view('image.add');
    }

    public function uploadImage(Request $request)
    {
       
        $title = $request->title ;
        $img = $request->images;

        $images = [] ;
  
        foreach($request->images as $image )
        {
      //  dd($image->getRealPath());

            $images = [
                'name' => $image->getClientOriginalExtension() ,
                'path' => $image->getRealPath(),

            ];


             $extension = $image->getClientOriginalExtension();
             $image_name = uniqid().'.'.$extension ;


            $image->move(public_path('images/'),"$image_name");
            $path = public_path('images/'.$image_name);
            UploadImage::dispatch($images ,$title ,$path);


        }

        return "Image Uploaded successfully";

    }

    public function createVideo()
    {
        return view('video.add');
    }

    public function uploadVideo(Request $request)
    {
        $request->validate([
            'title' => 'required|max:50',
            'videos' => 'required|array'
        ]);
       
       //dd($request->file('video'));
        $videos = [];
        $title = $request->title ;
        //dd($request->file('videos'));
      foreach($request->file('videos') as $video)
      { 
        $videos =[
            'path' => $video->getRealPath(),
            'name' => $video->getClientOriginalExtension(),
            
        ];

        $extention = $video->getClientOriginalExtension();
        $path = uniqid().'.'.$extention ;

        $video->move(public_path('upload/video'),"$path");    
       // $path = public_path('upload/video'.$video_name) ;

      
        //  $new_path = public_path('videos/'.$video_name);
        // $disk = Storage::disk('videos_upload')->directories();
        

      //  dd($disk);

        UploadVideo::dispatch($videos, $title,$path );

      } 

       return "video uploaded successfully";
    }
}
