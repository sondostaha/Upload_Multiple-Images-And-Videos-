<?php

namespace App\Jobs;

use App\Models\Images;
use DebugBar\DebugBar;
use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Intervention\Image\Facades\Image;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Symfony\Component\Console\Input\Input;
use Symfony\Component\ErrorHandler\Debug;

class UploadImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $images ;
    protected $title ;

    protected $path ;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($images ,$title ,$path)
    {
        $this->images = $images ;
        $this->title = $title ;
        $this->path = $path ;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
      //  dd($request->images);
        $image =$this->images ;

        $path = $this->path ;

            $extension = $image['name'];
            $image_name = uniqid().'.'.$extension ;
            $destination = public_path('images/'.$image_name);
            dd($image['path']);

            
            $test = public_path('images/6458e6c8cdde1.JPG');
           //dd(public_path('images/'.$image_name));
            $image_file = Image::make($path); 
            $image_file->resize(150,150);
            $image_file->text('TheStoke', 100, 70, function($font) { 
                $font->size(35);  
                $font->color('#ffffff');  
                $font->align('left');  
                $font->valign('bottom');  
                $font->angle(90);  
            });

            $image_file->save($destination);
           // $image->move(public_path('images/'),$image_name);
            $title  = $this->title ;
            Images::create([
                'image' => $image_name ,
                'title' => $title ,
            ]);
    
    }
}
