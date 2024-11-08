<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\StoreProductRequest;
use App\Http\Requests\Admin\UpdateProductRequest;

class AdminProductController extends Controller
{
    //
    public function storeProduct(StoreProductRequest $request)
    {
        $data = $request->validated();

        DB::beginTransaction();

        $allFilePaths = [];

        try {

            $product = new Product;

            $product->productCategory = $data['productCategory'];
            $product->productName = $data['productName'];
            $product->productSpecifications = $data['productSpecifications'];
            $product->productInitialPrice = $data['productInitialPrice'];
            $product->productDiscountPrice = $data['productDiscountPrice'];
            $product->brandName = $data['brandName'];
            $product->productWarranty = $data['productWarranty'];
            $product->productAverageRating = $data['productAverageRating'];
            $product->productDescription = $data['productDescription'];

            $files = $data['attachments'] ?? '';

            foreach($files as $file){

                $path = $file->store('products/'. $data['productCategory'] . 's/' . count($allFilePaths) + 1, 'public');

                $allFilePaths[] = $path;

            }

            $product->productFirstImage = $allFilePaths[0];
            $product->productSecondImage = $allFilePaths[1];
            $product->productThirdImage = $allFilePaths[2];
            $product->productFourthImage = $allFilePaths[3];

            $product->save();

            DB::commit();

        } catch (\Exception $e) {

            foreach($allFilePaths as $path){
                Storage::disk('public')->delete($path);
            }

            DB::rollback();

            throw $e;
        }

        return back()->with('success', 'The product has been created successfully');
    }

    public function updateProduct(UpdateProductRequest $request, Product $product)
    {
        $data = $request->validated();

        DB::beginTransaction();

        $allFilePaths = [];

        try {
            $product->productCategory = $data['productCategory'];
            $product->productName = $data['productName'];
            $product->productSpecifications = $data['productSpecifications'];
            $product->productInitialPrice = $data['productInitialPrice'];
            $product->productDiscountPrice = $data['productDiscountPrice'];
            $product->brandName = $data['brandName'];
            $product->productWarranty = $data['productWarranty'];
            $product->productAverageRating = $data['productAverageRating'];
            $product->productDescription = $data['productDescription'];

            $files = $data['attachments'] ?? '';

            if(!empty($files)){
                foreach($files as $file){

                    $path = $file->store('products/'. $data['productCategory'] . 's/' . count($allFilePaths) + 1, 'public');

                    $allFilePaths[] = $path;

                }
            }

            $imageAttributes = ['productFirstImage', 'productSecondImage', 'productThirdImage', 'productFourthImage'];

            foreach($imageAttributes as $index => $attribute){
                $product->$attribute = !empty($allFilePaths[$index]) ? $allFilePaths[$index] : $product->$attribute;
            }

            $product->save();

            DB::commit();

        } catch (\Exception $e) {

            foreach($allFilePaths as $path){
                Storage::disk('public')->delete($path);
            }

            DB::rollback();

            throw $e;
        }

        return back()->with('success', 'The product has been updated successfully');
    }

    public function deleteProduct(Product $product)
    {
        $product->delete();

        return back()->with('success', 'The product has been deleted successfully');
    }
}
