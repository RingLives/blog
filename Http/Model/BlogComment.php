<?php

namespace Sohidur\Blog\Http\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogComment extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'parent_id', 'type', 'title', 'slug', 'description', 'short_description', 'is_active'];

    public function scopeActive($query) {
    	$query->where('is_active', true);
    }
    
    public static function list($paginate = null) {
    	if(is_null($paginate)) {
    		return static::active()->orderBy('updated_at', 'desc')->get();
    	}
    	return static::active()->orderBy('updated_at', 'desc')->paginate($paginate);
    }
    public static function findById($id) {
        return static::find($id);
    }
    public static function getComments()
    {
        return static::active()->orderBy('created_at', 'desc')->get();
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];
}