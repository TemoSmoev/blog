<?php

namespace App;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Carbon\Carbon;
use App\Category;

class Post extends Model
{
    use Sluggable;

    protected $fillable=['title','content','date','description'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function tags()
    {
        return $this->belongsToMany(
            Tag::class,
            'post_tags',
            'post_id',
            'tag_id'
        );
    }
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public static function add($fields){
        $post=new static;
        $post->fill($fields);
        $post->user_id=1;
        $post->save();
        return $post;
    }
    public function edit($field)
    {
        $this->fill($field);
        $this->save();
    }
    public function remove(){
        $this->removeImage();
        $this->delete();
        
    }

    //image
    public function uploadImage($image){
        if($image==null) {return;}
        $this->removeImage();
        $filename=str_random(10).'.'.$image->extension();
        $image->storeAs('uploads',$filename);
        $this->image=$filename;
        $this->save();
    }
    public function removeImage()
    {
        if($this->image!=null){

            Storage::delete('uploads/'.$this->image);
            //dd('temo');
        }
    }
    public function getImage()
    {
        if($this->image==null){
            return '/img/no-image.png';
        }
        return '/uploads/'.$this->image;
    }

    //category
    public function setCategory($id)
    {
        if($id==null)  {return;}
        $this->category_id=$id;
        $this->save();
    }

    //tags
    public function setTags($ids){
        if($ids==null) {return;}
        $this->tags()->sync($ids);
    }



    // draft or public
    public function setDraft(){
        $this->status=0;
        $this->save();
    }
    public function setPublic(){
        $this->status=1;
        $this->save();
    }
    public function toggleStatus($value){
        if($value==null){
            return $this->setDraft();
        }
        return $this->setPublic();
    }

    //featured or standart
    public function setFeatured(){
        $this->is_featured=1;
        $this->save();
    }
    public function setStandart(){
        $this->is_featured=0;
        $this->save();
    }
    public function toggleFeatured($value){
        if($value==null){
            return $this->setStandart();
        }
        return $this->setFeatured();
    }

    public function setDateAttribute($value)
    {
        $date=Carbon::createFromFormat('m/d/y',$value)->format('Y-m-d');
        $this->attributes['date']=$date;
    }
    public function getDateAttribute($value)
    {
        $date=Carbon::createFromFormat('Y-m-d',$value)->format('m/d/y');
        return $date;
    }
    public function getCategoryTitle()
    {
        return $this->category!=null ? $this->category->title : 'нет категории';
    }
    public function getTagsTitle()
    {
        return !$this->tags->isEmpty() ? implode(', ',$this->tags->pluck('title')->all()) : 'Нет тега';
    }

    public function getCategoryId()
    {
        return $this->category!=null ? $this->category->id : null;
    }
    public function hasCategory()
    {
        return $this->category!=null ? true : false;
    }
    public function getDate()
    {
        return Carbon::createFromFormat('m/d/y',$this->date)->format('F d, Y');
    }
    public function hasPrevious()
    {
        return self::where('id','<',$this->id)->max('id');
    }
    
    function getPrevious()
    {
        $postId= $this->hasPrevious();
        return self::find($postId);
    }
    public function hasNext()
    {
        return self::where('id','>',$this->id)->min('id');
    }
    public function getNext()
    {
        $postId=$this->hasNext();
        return self::find($postId);
    }
    public function related()
    {
        return self::all()->except($this->id);
    }

    //  FOR VIEW COMPOSER IN APP SERVICE PROVIDER
    public static function getPopularPosts()
    {
        return self::orderBy('views','desc')->take(3)->get();
    }
    public static function getFeaturedPosts()
    {
        return self::where('is_featured','1')->take(3)->get();
    }

    public static function getRecentPosts()
    {
        return self::orderBy('date','desc')->take(4)->get();
    }
    public static function getCategories()
    {
        return Category::all();
    }
   
}
