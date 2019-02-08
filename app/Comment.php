<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable=['text'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class,'user_id');
    }


    // allow comment

    public function allow()
    {
        $this->status=1;
        $this->save();
    }
    public function deny()
    {
        $this->status=0;
        $this->save();
    }
    public function toggleStatus()
    {
        if($this->status==0){
            return $this->allow();
        }
        return $this->deny();
    }

    //delete comment 
    public function remove()
    {
        $this->delete();
    }
}
