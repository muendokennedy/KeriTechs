<?php

namespace App\Models;

use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    // protected $guard = [];

    protected $fillable = [
        'productCategory',
        'productName',
        'productSpecifications',
        'productInitialPrice',
        'productDiscountPrice',
        'brandName',
        'productWarranty',
        'productAverageRating',
        'productDescription',
        'productFirstImage',
        'productSecondImage',
        'productThirdImage',
        'productFourthImage'
    ];

    protected static function boot()
    {
       parent::boot();

       $images = ['productFirstImage', 'productSecondImage', 'productThirdImage', 'productFourthImage'];

       static::updating(function(self $model) use ($images){

           foreach($images as $image){
                Storage::disk('public')->delete($model->getOriginal($image));
           }

       });

       static::deleted(function(self $model) use ($images){

            foreach($images as $image){
                Storage::disk('public')->delete($model->$image);
            }

       });
    }
}
