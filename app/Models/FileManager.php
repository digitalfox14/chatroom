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

        if (in_array($ext, ['png','jpg','jpeg', 'svg+xml'])) {
            $width = "100%";
            
        } elseif (in_array($ext, ['wav'])) {
            $width = "50%";
            
        }elseif (in_array($ext, ['pdf'])) {
            
            $width = "40%";
            
        }elseif (in_array($ext, ['vnd.openxmlformats-officedocument.wordprocessingml.document'])) {
            $width = "50%";
            
        }elseif (in_array($ext, ['zip'])) {
            
            $width = "60%";
        }
        return $width;
    }
    
    public function getThumbnailAttribute()
    {
        $ext = $this->getRawOriginal('file_ext');
        $thumbnail = '';

        if (in_array($ext, ['png','jpg','jpeg', 'svg+xml'])) {
            $thumbnail = $this->file_path;
        } elseif (in_array($ext, ['wav'])) {
            
            $thumbnail = asset('assets/img/audio.jpeg');
            
        }elseif (in_array($ext, ['pdf'])) {
            $thumbnail = asset('assets/img/pdf.png');
            
        }elseif (in_array($ext, ['vnd.openxmlformats-officedocument.wordprocessingml.document'])) {
            $thumbnail = asset('assets/img/word.jpg');
            
        }elseif (in_array($ext, ['zip'])) {
            $thumbnail = asset('assets/img/zip.png');
        }    
        return $thumbnail;
    }

    public function shares()
    {
        return $this->hasMany(ShereFile::class, 'file_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
