<?php

namespace App\Http\Controllers;

use App\HomeSection;
use App\Product;
use App\Setting;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    //    \LaravelFacebookPixel::createEvent('PageView', $parameters = []);
        $section = null;
        $rows = 3;
        $cols = 5;
        if ($productsPage = Setting::whereName('products_page')->first()) {
            $rows = $productsPage->value->rows;
            $cols = $productsPage->value->cols;
        }
        $per_page = $request->get('per_page', $rows * $cols);
        if ($section = request('section', 0)) {
            $section = HomeSection::with('categories')->findOrFail($section);
            $products = $section->products(false, $per_page);
        } else {
            $products = Product::whereIsActive(1)
                ->when($request->search, function ($query) use ($request) {
                    $query->search($request->search, null, true);
                })
                ->latest('id')
                ->paginate($per_page);
        }
        $products = $products
            ->appends(request()->query());
        return $this->view(compact('products', 'per_page', 'rows', 'cols', 'section'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $product->load(['brand', 'categories']);
        $categories = $product->categories->pluck('id')->toArray();
        $products = Product::whereHas('categories', function ($query) use ($categories) {
            $query->whereIn('categories.id', $categories);
        })->where('id', '!=', $product->id)->limit(config('services.products_count.related', 20))->get();
    //    \LaravelFacebookPixel::createEvent('ViewContent', $parameters = []);
        return $this->view(compact('products'));
    }
}
