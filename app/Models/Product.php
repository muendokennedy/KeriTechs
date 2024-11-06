<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

       static::updating(function(self $model){
            Storage::disk('public')->delete($model->productFirstImage);
            Storage::disk('public')->delete($model->productSecondImage);
            Storage::disk('public')->delete($model->productThirdImage);
            Storage::disk('public')->delete($model->productFourthImage);
       });

       static::deleting(function(self $model){
            Storage::disk('public')->delete($model->productFirstImage);
            Storage::disk('public')->delete($model->productSecondImage);
            Storage::disk('public')->delete($model->productThirdImage);
            Storage::disk('public')->delete($model->productFourthImage);
       });
    }
}
