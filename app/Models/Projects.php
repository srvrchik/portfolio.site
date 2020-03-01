<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Projects extends Model
{
    const IMAGE_URL = 'uploads/projects/';

    protected $fillable = [
        'title', 'url', 'category_id'
    ];

    protected $appends = [
        'category'
    ];

    public function getCategoryAttribute()
    {
        try{
            return Category::findOrFail($this->category_id);
        }catch (\Exception $e)
        {
            return null;
        }
    }

    /**
     * Upload Article Image
     *
     * @param $image
     */
    public function uploadImage($image)
    {
        if($image == null) return;

        $this->removeImage();
        $filename = Str::random(10) . '.' . $image->extension();
        $image->storeAs(self::IMAGE_URL, $filename);
        $this->image = $filename;
        $this->save();
    }

    /**
     * Remove Article Image
     */
    public function removeImage()
    {
        if($this->image != null){
            Storage::delete(self::IMAGE_URL . $this->image);
            $this->image = null;
            $this->save();
        }
    }
}
