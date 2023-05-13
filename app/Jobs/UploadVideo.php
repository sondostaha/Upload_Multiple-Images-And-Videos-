<?php

namespace App\Jobs;

use cloudinary;
use App\Models\Video;
use FFMpeg\Format\Video\X264;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class UploadVideo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $videos ;
    protected $title ;

    protected $path ;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($videos , $title ,$path)
    {
        $this->videos = $videos ;
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
        $video = $this->videos ; 
        $path = $this->path ;

            $title = $this->title ;
            
            // $new_path = (public_path('videos/'.$video_name));

            $ffmge =FFMpeg::fromDisk('videos_upload')
            ->open($path)
            ->export()
            ->toDisk('converted_videos')
            ->inFormat(new X264)
            ->resize(640, 480)
            ->save($path);
              $extination = $video['name'] ;
              $video_name = uniqid().'.'.$extination;
            Video::create([
                'title' => $title ,
                'video' => $video_name
            ]);
        
       
    }
}
