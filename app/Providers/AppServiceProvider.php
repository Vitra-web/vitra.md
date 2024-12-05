<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Chat;
use App\Models\Industry;
use App\Models\Mail;
use App\Models\News;
use App\Models\Order;
use App\Models\Subcategory;
use App\Models\UserFavorite;
use App\Models\UserProduct;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use  \App\Classes\LanguageHandler;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Collection::macro('paginate', function ($perPage = 10) {
            $page = LengthAwarePaginator::resolveCurrentPage('page');

            return new LengthAwarePaginator($this->forPage($page, $perPage), $this->count(), $perPage, $page, [
                'path' => LengthAwarePaginator::resolveCurrentPath(),
                'query' => request()->query(),
            ]);
        });
        view()->composer('*',function($view) {
            $view->with('language', new LanguageHandler());
//            $view->with('industries', Cache::remember('industries', 600, function () {
//                return Industry::all();
//            }));
            $view->with('industries', Industry::all());
            $view->with('categories', Category::all());
            $view->with('subcategoriesGlobal', Subcategory::where('status', 1)->get());
            $view->with('promotionNews', News::orderBy('sort_order', 'desc')->first());
            $view->with('basketProducts', Auth::user() ? count( UserProduct::where('user_id', Auth::user()->id)->get()) : 0);

        });

        view()->composer('panel/*',function($view) {

            $view->with('newChats', Chat::where('checked', 0)->get());
            $view->with('newMessages', Mail::where('status', 'new')->get());
            $view->with('newOrders', Order::where('status', 'new')->get());


        });




    }
}
