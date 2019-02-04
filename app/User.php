<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use \Storage;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }


    public static function add($fields)
    {
        $user=new static;
        $user->fill($fields);
        $user->save();

        return $user;
    }
    
    public function edit($fields)
    {
        $this->fill($fields);
        $this->save();
    }

    public function generatePassword($password)
    {
        if ($password!=null) {
            $this->password=bcrypt($password);
            $this->save();   
        }
    }


    public function remove()
    {
        if($this->avatar!=null){
            Storage::delete('uploads/'.$this->avatar);
        }
        $this->delete();
    }

    public function uploadAvatar($image){
        if($image==null) {return true;}
        
        if($this->avatar!=null){
            Storage::delete('uploads/'.$this->avatar);
        }
        $filename=str_random(10).'.'.$image->extension();
        $image->storeAs('uploads',$filename);
        $this->avatar=$filename;
        $this->save();
    }
    public function getImage()
    {
        if($this->avatar==null){
            return '/img/no-image.png';
        }
        return '/uploads/'.$this->avatar;
    }
    //Admin
    public function makeAdmin()
    {
        $this->is_admin=1;
        $this->save();
    }
    public function makeNormal()
    {
        $this->is_admin=0;
        $this->save();
    }
    public function toggleAdmin($value)
    {
        if($value==null){
            return $this->makeNormal();
        }
        return $this->makeAdmin();
    }

    //Ban
    public function ban()
    {
        $this->status=1;
        $this->save();
    }
    public function unban()
    {
        $this->status=0;
        $this->save();
    }
    public function toggleBan($value)
    {
        if($value==null){
            return $this->unban();
        }
        return $this->ban();
    }
}
