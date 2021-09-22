<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileManager extends Model
{
    use HasFactory;

    protected $appends = ['thumbnail', 'width'];

    public function getWidthAttribute()
    {
        $ext = $this->getRawOriginal('file_ext');
        $width = '';

        if (in_array($ext, ['image/png','image/jpg','image/jpeg', 'image/svg+xml'])) {
            $width = "100%";
            
        } elseif (in_array($ext, ['audio/wav'])) {
            $width = "50%";
            
        }elseif (in_array($ext, ['application/pdf'])) {
            
            $width = "40%";
            
        }elseif (in_array($ext, ['application/vnd.openxmlformats-officedocument.wordprocessingml.document'])) {
            $width = "50%";
            
        }
        return $width;
    }
    
    public function getThumbnailAttribute()
    {
        $ext = $this->getRawOriginal('file_ext');
        $thumbnail = '';

        if (in_array($ext, ['image/png','image/jpg','image/jpeg', 'image/svg+xml'])) {
            $thumbnail = $this->file_path;
        } elseif (in_array($ext, ['audio/wav'])) {
            $thumbnail = $this->file_path;
            $thumbnail = asset('assets/img/audio.jpeg');
        }elseif (in_array($ext, ['application/pdf'])) {
            $thumbnail = asset('assets/img/pdf.png');
            
        }elseif (in_array($ext, ['application/vnd.openxmlformats-officedocument.wordprocessingml.document'])) {
            $thumbnail = asset('assets/img/word.jpg');
        }
        return $thumbnail;
    }
    
    
}
