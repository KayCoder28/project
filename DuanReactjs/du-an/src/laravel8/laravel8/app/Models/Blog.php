<?php

namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use Notifiable;
    protected $table = "blog";
    public $timestamp = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'image', 'description', 'content', 'id_auth'
    ];

    public function comment() {
        return $this->hasMany('App\Models\comment', 'id_blog');
    }
}
