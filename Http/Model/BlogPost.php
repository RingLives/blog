<?php

namespace Sohidur\Blog\Http\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogPost extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'parent_id', 'type', 'title', 'slug', 'description', 'short_description', 'is_active','blog_category_id', 'publish_on','disabled'];

    public function scopeActive($query) 
    {
    	$query->where('is_active', true);
    }
    public static function list($paginate = null) 
    {
    	if(is_null($paginate)) {
    		return static::with('category')->orderBy('created_at', 'desc')->get();
    	}
    	return static::with('category')->orderBy('created_at', 'desc')->paginate($paginate);
    }
    public static function findById($id) 
    {
        return static::find($id);
    }
    public static function getPosts()
    {
        return static::active()->with('category')->orderBy('created_at', 'desc')->get();
    }
    public function category() 
    {
        return $this->hasOne(BlogCategory::class,'id','blog_category_id');
    }
    /**
     * Set the post User id.
     *
     * @param  string  $value
     * @return void
     */
    public function setSlugAttribute($value)
    { 
        $this->attributes['slug'] = strtolower(str_replace(" ", "-",  $value ?? $this->title));
    }
    /**
     * Set the post User id.
     *
     * @param  string  $value
     * @return void
     */
    public function setUserIdAttribute($value)
    { 
        $this->attributes['user_id'] = ($value ? $value : (auth()->user()->id  ?? 0));
    }
    /**
     * Set the post User id.
     *
     * @param  string  $value
     * @return void
     */
    public function setDisabledAttribute($value)
    {
        $this->attributes['disabled'] = ($value == 'on') ? 1 : 0;
    }
    /**
     * Set the post User id.
     *
     * @param  string  $value
     * @return void
     */
    public function setIsActiveAttribute($value)
    { 
        $this->attributes['is_active'] = ($value == 'on') ? 1 : 0;
    }
    /**
     * Set the post slug.
     *
     * @param  string  $value
     * @return void
     */
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;

        if(! $this->slug) {
            $this->attributes['slug'] = strtolower(str_replace(" ", "-",  $value));
        }

        if(! $this->user_id) {
            $this->attributes['user_id'] = auth()->user()->id ?? 0;
        }
    }
    /**
     * Set the post User id.
     *
     * @param  string  $value
     * @return void
     */
    public function getPublishOnAttribute($value)
    {
        // if (! $value) {
            return $value;
        // }
        
        // return Carbon::parse($value)->format('d-m-Y');
    }
    /**
     * Set the post User id.
     *
     * @param  string  $value
     * @return void
     */
    public function getDisabledHtmlAttribute()
    {
        $disabled = $this->disabled ? 'checked' : '';
        return "<input 
                    type='checkbox'
                    {$disabled}
                    data-toggle='toggle'
                    data-on='On'
                    data-off='Off'
                    data-width='70'
                    data-height='20'
                    data-onstyle='".config('blog.button.on')."'
                    data-offstyle='".config('blog.button.off')."'
                    data-action='onchange'
                    data-target='".Route('post_disabled').'/'.$this->id."'
                    name='disabled'
                    id='disabled_".$this->id."'
                    data-style='radius'
                />";
    }
    /**
     * Set the post User id.
     *
     * @param  string  $value
     * @return void
     */
    public function getIsActiveHtmlAttribute()
    { 
        $is_active = $this->is_active ? 'checked' : '';
        return "<input
                    type='checkbox'
                    {$is_active}
                    data-toggle='toggle'
                    data-on='On'
                    data-off='Off'
                    data-width='70'
                    data-height='20'
                    data-onstyle='".config('blog.button.on')."'
                    data-offstyle='".config('blog.button.off')."'
                    data-action='onchange'
                    data-target='".Route('post_status').'/'.$this->id."'
                    name='is_active'
                    id='is_active_".$this->id."'
                    data-style='radius'
                />";
    }
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'publish_on',
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'disabled' => 'boolean',
        'is_active' => 'boolean',
    ];
}