<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class AssignTask extends Model
{
    protected $table = 'assign_task';
    public $timestamps = true;


    public static function boot()
    {
        parent::boot();
        static::creating(function($post)
        {
            $post->created_by = isset(Auth::user()->id) ? Auth::user()->id : 1;
            $post->updated_by = isset(Auth::user()->id) ? Auth::user()->id : 1;
        });

        static::updating(function($post)
        {
            $post->updated_by = isset(Auth::user()->id) ? Auth::user()->id : 1;
        });

    }
}
