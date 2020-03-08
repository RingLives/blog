<?php

namespace Sohidur\Blog\Http\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogCategory extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'parent_id', 'type', 'title', 'slug', 'description', 'short_description', 'is_active'];

    public function scopeActive($query)
    {
    	$query->where('is_active', true);
    }    

    public static function list($paginate = null)
    {
    	if(is_null($paginate)) {
    		return static::orderBy('created_at', 'desc')->get();
    	}
    	return static::orderBy('created_at', 'desc')->paginate($paginate);
    }

    public static function findById($id)
    {
        return static::find($id);
    }

    public static function getCategory()
    {
        return static::active()->orderBy('title','asc')->get();
    }
    /**
     * Set the post User id.
     *
     * @param  string  $value
     * @return void
     */
    public function setUserIdAttribute($value)
    {
        $this->attributes['user_id'] = $value ?? auth()->user()->id;
    }
    /**
     * Set the post slug.
     *
     * @param  string  $value
     * @return void
     */
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = str_replace(" ", "-", $value ?? $this->title);
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
     * @author Shohid
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
                    data-target='".Route('category_status').'/'.$this->id."'
                    name='is_active'
                    id='is_active'
                    data-style='radius'
                />";
    }
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];
}