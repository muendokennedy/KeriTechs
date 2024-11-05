<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'productCategory' => $this->productCategory,
            'productName' => $this->productName,
            'productSpecifications' => $this->productSpecifications,
            'productInitialPrice' => $this->productInitialPrice,
            'productDiscountPrice' => $this->productDiscountPrice,
            'brandName' => $this->brandName,
            'productWarranty' => $this->productWarranty,
            'productAverageRating' => $this->productAverageRating,
            'productDescription' => $this->productDescription,
            'productFirstImage' => Storage::url($this->productFirstImage),
            'productSecondImage' => Storage::url($this->productSecondImage),
            'productThirdImage' => Storage::url($this->productThirdImage),
            'productFourthImage' => Storage::url($this->productFourthImage),
            'attachments' => [
                Storage::url($this->productFirstImage),
                Storage::url($this->productSecondImage),
                Storage::url($this->productThirdImage),
                Storage::url($this->productFourthImage)
                ]
        ];
    }
}
