<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function post()
    {
        return $this->hasOne(Post::class);
    }

    public function author()
    {
        return $this->hasOne(User::class);
    }


    // allow comment

    public function allow()
    {
        $this->status=1;
    }
    public function deny()
    {
        $this->status=0;
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
