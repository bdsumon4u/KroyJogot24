<?php

namespace App\Http\Controllers;

use App\Category;
use App\HomeSection;
use App\Product;
use App\Slide;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // \LaravelFacebookPixel::createEvent('PageView', $parameters = []);
        $slides = Slide::whereIsActive(1)->get();
        $sections = HomeSection::orderBy('order', 'asc')->get();
        return view('index', compact('slides', 'sections'));
    }
}
