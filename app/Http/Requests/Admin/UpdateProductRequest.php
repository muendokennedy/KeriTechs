<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public static array $extensions = [
        'jpg', 'jpeg', 'png', 'svg', 'webp'
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //

            'productCategory' => 'required | string',
            'productName' => 'required | string',
            'productSpecifications' => 'required | string',
            'productInitialPrice' => 'required | numeric',
            'productDiscountPrice' => 'required | numeric',
            'brandName' => 'required | string',
            'productWarranty' => 'required | string',
            'productAverageRating' => 'required | numeric',
            'productDescription' => 'required | string',
            'attachments' => [
                'array',
                'max:4',
                'sometimes',
                'required',
                function($attribute, $value, $fail){
                    // Custom rule to check the total size of all files
                    $totalSize = collect($value)->sum(function($file){
                        return $file->getSize();
                    });

                    if($totalSize > 1024 * 1024 * 20){
                        $fail('The total size of all files must not exceed 20MB');
                    }
                }
            ],
            'attachments.*' => [
                'file',
                File::types(self::$extensions)
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'attachments.required' => 'Please attach the images of the product'
        ];
    }
}
