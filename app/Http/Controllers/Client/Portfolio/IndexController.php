<?php

namespace App\Http\Controllers\Client\Portfolio;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Industry;
use App\Models\News;
use App\Models\Portfolio;
use App\Models\PortfolioCategory;
use App\Models\PortfolioImage;
use App\Models\SolutionCategory;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function main( )
    {
        $categories = Category::all();
        $portfolios = Portfolio::query()->orderBy('date', 'desc')->get();
        $portfolioCategories = PortfolioCategory::all();
//        foreach ($portfolioCategories as $item) {
//            dump($item->portfolios);
//        }
//        dd('end');
        $title = trans('nav.portfolio');
        return view('client.portfolio.index', compact('title','portfolios', 'categories', 'portfolioCategories'));
    }
    public function view( Portfolio $item)
    {
        $categories = Category::all();
        $images = PortfolioImage::where('portfolio_id',$item->id )->get();
        $title = $item->name_ro;
        $parentLink = [
            'url'=>'client.portfolio',
            'transValue'=>trans('nav.portfolio'),
        ];

        return view('client.portfolio.view', compact('title','item', 'categories', 'images', 'parentLink'));
    }

}
