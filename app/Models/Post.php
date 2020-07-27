<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{   
    use SoftDeletes;
    protected $table = 'posts';
    protected $fillable = ['name','description','content','image','published_at','category_id'];
    public $timestamps = true;


    public function deleteImage()
    {
        \Storage::delete($this->image);
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
}
