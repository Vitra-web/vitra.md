<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', '\App\Http\Controllers\Client\Home\IndexController@main')->name('home');

Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'App\Http\Controllers\Client\LanguageController@switchLang']);

Route::get('/industry/{industry}', '\App\Http\Controllers\Client\Industry\IndexController@main')->name('client.industry');
Route::get('/category/{category}', '\App\Http\Controllers\Client\Category\IndexController@main')->name('client.category');
Route::get('/subcategory/{subcategory}', '\App\Http\Controllers\Client\Subcategory\IndexController@main')->name('client.subcategory');
Route::get('/product/{category?}/{subcategory?}/{product}/', '\App\Http\Controllers\Client\Product\IndexController@main')->name('client.product');

Route::get('/news', '\App\Http\Controllers\Client\News\IndexController@main')->name('client.news');
Route::get('/news/{item}', '\App\Http\Controllers\Client\News\IndexController@view')->name('client.newsView');
Route::get('/portfolio', '\App\Http\Controllers\Client\Portfolio\IndexController@main')->name('client.portfolio');
Route::get('/portfolio/category/{item}', '\App\Http\Controllers\Client\Portfolio\IndexController@viewCategory')->name('client.portfolioViewCategory');
Route::get('/portfolio/{item}', '\App\Http\Controllers\Client\Portfolio\IndexController@view')->name('client.portfolioView');

Route::get('/solution', '\App\Http\Controllers\Client\Solution\IndexController@main')->name('client.solution');
Route::get('/solution/{item}', '\App\Http\Controllers\Client\Solution\IndexController@viewIndustry')->name('client.solutionIndustry');
Route::get('/resolve', '\App\Http\Controllers\Client\Resolve\IndexController@main')->name('client.resolve');
Route::get('/resolve/{resolve}', '\App\Http\Controllers\Client\Resolve\IndexController@view')->name('client.resolveView');
Route::get('/company', '\App\Http\Controllers\Client\About\IndexController@main')->name('client.about');
Route::get('/careers', '\App\Http\Controllers\Client\Careers\IndexController@main')->name('client.careers');
Route::get('/contacts', '\App\Http\Controllers\Client\Contacts\IndexController@main')->name('client.contacts');
Route::get('/favorite', '\App\Http\Controllers\Client\Favorite\IndexController@main')->name('client.favorite');

Route::get('/our-services', '\App\Http\Controllers\Client\CommonPage\IndexController@services')->name('client.services');
Route::get('/terms', '\App\Http\Controllers\Client\CommonPage\IndexController@terms')->name('client.terms');
Route::get('/delivery', '\App\Http\Controllers\Client\CommonPage\IndexController@delivery')->name('client.delivery');
Route::get('/policy', '\App\Http\Controllers\Client\CommonPage\IndexController@policy')->name('client.policy');

Route::post('/webhook-our-chat', '\App\Http\Controllers\Admin\Webhook\ChatWebhookController@webhookHandler');
Route::post('/maib-callback', '\App\Http\Controllers\Admin\Webhook\OrderWebhookController@webhookHandler');

Route::get('/user-signup', '\App\Http\Controllers\Auth\UserAuthController@signup')->name('client.signup');
Route::post('/user-signup', '\App\Http\Controllers\Auth\UserAuthController@postSignup')->name('client.postSignup');

Route::get('/user-login', '\App\Http\Controllers\Auth\UserAuthController@login')->name('client.login');
Route::post('/user-login', '\App\Http\Controllers\Auth\UserAuthController@postLogin')->name('client.postLogin');
Route::get('/user-type/{user}', '\App\Http\Controllers\Auth\UserAuthController@chooseType')->name('client.chooseType');
Route::post('/user-type', '\App\Http\Controllers\Auth\UserAuthController@chooseTypePost')->name('client.chooseTypePost');
Route::get('/auth/google', '\App\Http\Controllers\Auth\GoogleController@redirectToGoogle')->name('google.redirect');
Route::get('/auth/google/callback', '\App\Http\Controllers\Auth\GoogleController@handleGoogleCallback')->name('google.callback');
Route::get('/auth/facebook', '\App\Http\Controllers\Auth\FacebookController@redirect')->name('facebook.redirect');
Route::get('/auth/facebook/callback', '\App\Http\Controllers\Auth\FacebookController@handleCallback')->name('facebook.callback');
Route::get('/auth/linkedin', '\App\Http\Controllers\Auth\LinkedinController@redirect')->name('linkedin.redirect');
Route::get('/auth/linkedin/callback', '\App\Http\Controllers\Auth\LinkedinController@handleCallback')->name('linkedin.callback');
Route::get('/auth/apple', '\App\Http\Controllers\Auth\AppleController@redirect')->name('apple.redirect');
Route::get('/auth/apple/callback', '\App\Http\Controllers\Auth\AppleController@handleCallback')->name('apple.callback');
Route::get('/auth/twitter', '\App\Http\Controllers\Auth\TwitterController@redirectToTwitter')->name('twitter.redirect');
Route::get('/auth/twitter/callback', '\App\Http\Controllers\Auth\TwitterController@handleCallback')->name('twitter.callback');

Route::get('/user-cabinet', '\App\Http\Controllers\Client\Cabinet\IndexController@main')->name('client.cabinet');

Route::group(['middleware' => ['userCabinet']],function () {
//    Route::get('/user-cabinet', '\App\Http\Controllers\Client\Cabinet\IndexController@main')->name('client.cabinet');
    Route::get('/user-account', '\App\Http\Controllers\Client\Cabinet\IndexController@account')->name('client.account');
    Route::get('/user-orders', '\App\Http\Controllers\Client\Cabinet\OrdersController@main')->name('client.orders');
    Route::get('/user-favorites', '\App\Http\Controllers\Client\Cabinet\FavoriteController@main')->name('client.favorites');
    Route::post('/personal-info', '\App\Http\Controllers\Client\Cabinet\IndexController@updatePersonalInfo')->name('client.personalInfo');
    Route::post('/contact-info', '\App\Http\Controllers\Client\Cabinet\IndexController@updateContactInfo')->name('client.contactInfo');
    Route::post('/toggle-favorite', '\App\Http\Controllers\Client\AjaxRequest\IndexController@toggleFavorite')->name('client.toggleFavorite');
    Route::post('/add-basket', '\App\Http\Controllers\Client\AjaxRequest\IndexController@addBasket')->name('client.addBasket');
    Route::post('/remove-basket', '\App\Http\Controllers\Client\AjaxRequest\IndexController@removeBasket')->name('client.removeBasket');
    Route::post('/quantity-basket', '\App\Http\Controllers\Client\AjaxRequest\IndexController@quantityBasket')->name('client.quantityBasket');


    Route::get('/logout', '\App\Http\Controllers\Auth\UserAuthController@logout')->name('client.logout');
});

Route::get('/search', '\App\Http\Controllers\Client\Home\IndexController@search')->name('client.search');
Route::get('/search-popular', '\App\Http\Controllers\Client\Home\IndexController@searchPopular')->name('client.searchPopular');
Route::get('/search-page/{value}', '\App\Http\Controllers\Client\Search\IndexController@main')->name('client.searchPage');
Route::post('/search-more', '\App\Http\Controllers\Client\Search\IndexController@searchMore')->name('client.searchMore');


Route::get('/synchronization', '\App\Http\Controllers\Admin\Synchronization\HurakanController@test')->name('synchronization');


Route::get('/basket', '\App\Http\Controllers\Client\Basket\IndexController@main')->name('client.basket');
Route::get('/payment', '\App\Http\Controllers\Client\Payment\IndexController@main')->name('client.payment');
Route::post('/payment', '\App\Http\Controllers\Client\Payment\IndexController@postOrder')->name('client.postOrder');
Route::get('/maib-success', '\App\Http\Controllers\Client\Payment\IndexController@successPage')->name('client.paymentSuccess');
Route::get('/maib-fail', '\App\Http\Controllers\Client\Payment\IndexController@errorPage')->name('client.paymentError');

Route::post('/consultation', '\App\Http\Controllers\Client\MailController@consultation')->name('client.consultation');
Route::post('/main-page-consultation', '\App\Http\Controllers\Client\MailController@mainPage')->name('client.mainPageConsultation');
Route::post('/contact-mail', '\App\Http\Controllers\Client\MailController@contact')->name('client.contactMail');
Route::post('/vacancy-mail', '\App\Http\Controllers\Client\MailController@vacancy')->name('client.vacancyMail');
Route::post('/vacancy-mail-full', '\App\Http\Controllers\Client\MailController@vacancyFull')->name('client.vacancyFullMail');
Route::post('/vacancy-special', '\App\Http\Controllers\Client\MailController@vacancySpecial')->name('client.vacancySpecial');
Route::post('/feedback-mail', '\App\Http\Controllers\Client\MailController@feedback')->name('client.feedbackMail');
Route::post('/about-mail', '\App\Http\Controllers\Client\MailController@about')->name('client.aboutMail');


Route::post('/send-message', '\App\Http\Controllers\Client\ChatController@sendMessage')->name('client.chat');

Route::get('/define-destination', '\App\Http\Controllers\Client\DestinationController@index')->name('client.destination');
Route::get('/mail-test', '\App\Http\Controllers\Client\Payment\IndexController@testMail')->name('client.testMail');

Route::group(['prefix' => 'panel'],function () {
    Route::get('/login', '\App\Http\Controllers\Auth\AuthController@login')->name('login');

    Route::post('/login','\App\Http\Controllers\Auth\AuthController@postLogin')->name('postLogin');



    Route::group(['middleware' => ['auth','adminPanel']],function () {
        Route::get('/logout', '\App\Http\Controllers\Auth\AuthController@logout')->name('logout');
        Route::get('/', '\App\Http\Controllers\Admin\StatisticController@main')->name('statistic');
        Route::get('/show/{mail}', '\App\Http\Controllers\Admin\StatisticController@show')->name('statistic.show');
        Route::patch('/mail/{mail}', '\App\Http\Controllers\Admin\StatisticController@update')->name('statistic.update');
        Route::get('/change-status/{mail}/{status}', '\App\Http\Controllers\Admin\StatisticController@changeStatus')->name('statistic.changeStatus');
        Route::get('/orders', '\App\Http\Controllers\Admin\OrderController@main')->name('orders');
        Route::get('/orders/{order}', '\App\Http\Controllers\Admin\OrderController@show')->name('order.show');
        Route::get('/order-check/{order}', '\App\Http\Controllers\Admin\OrderController@check')->name('order.check');
        Route::get('/order-return/{order}', '\App\Http\Controllers\Admin\OrderController@return')->name('order.return');

        Route::patch('/post-order/{order}', '\App\Http\Controllers\Admin\OrderController@update')->name('order.update');

        Route::post('/editor/upload', '\App\Http\Controllers\Admin\ProductController@editor')->name('ckeditor.upload');

        Route::get('/chat', 'App\Http\Controllers\Admin\ChatController@index')->name('chat');
        Route::get('/chat-show{chat}', 'App\Http\Controllers\Admin\ChatController@show')->name('chat.show');
        Route::post('/send-message', '\App\Http\Controllers\Admin\ChatController@sendMessage')->name('chat.send');

        Route::group(['prefix' => 'users'], function() {
            Route::get('/', '\App\Http\Controllers\Admin\UserController@index')->name('user');
            Route::get('/create', '\App\Http\Controllers\Admin\UserController@create')->name('user.create');
            Route::post('/', '\App\Http\Controllers\Admin\UserController@store')->name('user.store');
            Route::get('/{user}/edit', '\App\Http\Controllers\Admin\UserController@edit')->name('user.edit');
            Route::get('/{user}', '\App\Http\Controllers\Admin\UserController@show')->name('user.show');
            Route::patch('/{user}', '\App\Http\Controllers\Admin\UserController@update')->name('user.update');
            Route::delete('/{user}', '\App\Http\Controllers\Admin\UserController@delete')->name('user.delete');
        });

        Route::group(['prefix' => 'roles'], function() {
            Route::get('/', '\App\Http\Controllers\Admin\RoleController@index')->name('role');
            Route::get('/create', '\App\Http\Controllers\Admin\RoleController@create')->name('role.create');
            Route::post('/', '\App\Http\Controllers\Admin\RoleController@store')->name('role.store');
            Route::get('/{role}/edit', '\App\Http\Controllers\Admin\RoleController@edit')->name('role.edit');
            Route::get('/{role}', '\App\Http\Controllers\Admin\RoleController@show')->name('role.show');
            Route::patch('/{role}', '\App\Http\Controllers\Admin\RoleController@update')->name('role.update');
            Route::delete('/{role}', '\App\Http\Controllers\Admin\RoleController@delete')->name('role.delete');
        });
        Route::group(['prefix' => 'industry'], function() {
            Route::get('/', '\App\Http\Controllers\Admin\Industry\IndexController@index')->name('industry');
            Route::get('/create', '\App\Http\Controllers\Admin\Industry\IndexController@create')->name('industry.create');
            Route::post('/', '\App\Http\Controllers\Admin\Industry\IndexController@store')->name('industry.store');

            Route::get('/categories', '\App\Http\Controllers\Admin\Industry\IdeasController@categories')->name('industry.categories');
            Route::get('/category', '\App\Http\Controllers\Admin\Industry\IdeasController@createCategory')->name('industry.createCategory');
            Route::get('/category-products/{industry}', '\App\Http\Controllers\Admin\Industry\IdeasController@createCategoryProducts')->name('industry.createCategoryProducts');
            Route::post('/category-products', '\App\Http\Controllers\Admin\Industry\IdeasController@storeCategoryProducts')->name('industry.storeCategoryProducts');
            Route::get('/category-products/{industryCategory}/{industry}/edit', '\App\Http\Controllers\Admin\Industry\IdeasController@editCategoryProducts')->name('industry.editCategoryProducts');
            Route::patch('/category-products/{industryCategory}', '\App\Http\Controllers\Admin\Industry\IdeasController@updateCategoryProducts')->name('industry.updateCategoryProducts');
//            Route::delete('/category-products/{industryCategory}', '\App\Http\Controllers\Admin\Industry\IdeasController@deleteCategoryProducts')->name('industry.deleteCategoryProducts');

            Route::post('/category', '\App\Http\Controllers\Admin\Industry\IdeasController@storeCategory')->name('industry.storeCategory');
            Route::get('/category/{industryCategory}/edit', '\App\Http\Controllers\Admin\Industry\IdeasController@editCategory')->name('industry.editCategory');
            Route::patch('/category/{industryCategory}', '\App\Http\Controllers\Admin\Industry\IdeasController@updateCategory')->name('industry.updateCategory');
            Route::delete('/category/{industryCategory}', '\App\Http\Controllers\Admin\Industry\IdeasController@deleteCategory')->name('industry.deleteCategory');


            Route::get('/{industry}/edit', '\App\Http\Controllers\Admin\Industry\IndexController@edit')->name('industry.edit');
            Route::patch('/{industry}', '\App\Http\Controllers\Admin\Industry\IndexController@update')->name('industry.update');
//            Route::delete('/{industry}', '\App\Http\Controllers\Admin\Industry\IndexController@delete')->name('industry.delete');
        });
        Route::group(['prefix' => 'category'], function() {
            Route::get('/', '\App\Http\Controllers\Admin\Category\IndexController@index')->name('category');
            Route::get('/create', '\App\Http\Controllers\Admin\Category\IndexController@create')->name('category.create');
            Route::post('/', '\App\Http\Controllers\Admin\Category\IndexController@store')->name('category.store');

            Route::get('/categories', '\App\Http\Controllers\Admin\Category\IdeasController@categories')->name('category.categories');
            Route::get('/category', '\App\Http\Controllers\Admin\Category\IdeasController@createCategory')->name('category.createCategory');
            Route::get('/category-products/{industry}/{category}', '\App\Http\Controllers\Admin\Category\IdeasController@createCategoryProducts')->name('category.createCategoryProducts');
            Route::post('/category-products', '\App\Http\Controllers\Admin\Category\IdeasController@storeCategoryProducts')->name('category.storeCategoryProducts');
            Route::get('/category-products/{categoryIdea}/{industry}/{category}/edit', '\App\Http\Controllers\Admin\Category\IdeasController@editCategoryProducts')->name('category.editCategoryProducts');
            Route::patch('/category-products/{categoryIdea}', '\App\Http\Controllers\Admin\Category\IdeasController@updateCategoryProducts')->name('category.updateCategoryProducts');

            Route::post('/category', '\App\Http\Controllers\Admin\Category\IdeasController@storeCategory')->name('category.storeCategory');
            Route::get('/category/{categoryIdea}/edit', '\App\Http\Controllers\Admin\Category\IdeasController@editCategory')->name('category.editCategory');
            Route::patch('/category/{categoryIdea}', '\App\Http\Controllers\Admin\Category\IdeasController@updateCategory')->name('category.updateCategory');
            Route::delete('/category/{categoryIdea}', '\App\Http\Controllers\Admin\Category\IdeasController@deleteCategory')->name('category.deleteCategory');


            Route::get('/{category}/edit', '\App\Http\Controllers\Admin\Category\IndexController@edit')->name('category.edit');
            Route::get('/{category}', '\App\Http\Controllers\Admin\Category\IndexController@show')->name('category.show');
            Route::patch('/{category}/update', '\App\Http\Controllers\Admin\Category\IndexController@update')->name('category.update');
            Route::delete('/{category}/delete', '\App\Http\Controllers\Admin\Category\IndexController@delete')->name('category.delete');
        });

        Route::group(['prefix' => 'subcategory'], function() {
            Route::get('/', '\App\Http\Controllers\Admin\SubCategoryController@index')->name('subcategory');
            Route::get('/create', '\App\Http\Controllers\Admin\SubCategoryController@create')->name('subcategory.create');
            Route::post('/', '\App\Http\Controllers\Admin\SubCategoryController@store')->name('subcategory.store');
            Route::get('/{subcategory}/edit', '\App\Http\Controllers\Admin\SubCategoryController@edit')->name('subcategory.edit');
            Route::get('/{subcategory}', '\App\Http\Controllers\Admin\SubCategoryController@show')->name('subcategory.show');
            Route::patch('/{subcategory}', '\App\Http\Controllers\Admin\SubCategoryController@update')->name('subcategory.update');
            Route::delete('/{subcategory}', '\App\Http\Controllers\Admin\SubCategoryController@delete')->name('subcategory.delete');
        });

        Route::group(['prefix' => 'subcategory-type'], function() {
            Route::get('/', '\App\Http\Controllers\Admin\SubCategoryTypeController@index')->name('type');
            Route::get('/create', '\App\Http\Controllers\Admin\SubCategoryTypeController@create')->name('type.create');
            Route::post('/', '\App\Http\Controllers\Admin\SubCategoryTypeController@store')->name('type.store');
            Route::get('/{type}/edit', '\App\Http\Controllers\Admin\SubCategoryTypeController@edit')->name('type.edit');

            Route::get('/{type}', '\App\Http\Controllers\Admin\SubCategoryTypeController@show')->name('type.show');
            Route::patch('/{type}', '\App\Http\Controllers\Admin\SubCategoryTypeController@update')->name('type.update');
            Route::delete('/{type}', '\App\Http\Controllers\Admin\SubCategoryTypeController@delete')->name('type.delete');
        });


        Route::group(['prefix' => 'product'], function() {
            Route::get('/', '\App\Http\Controllers\Admin\Product\IndexController@index')->name('product');
            Route::get('/create', '\App\Http\Controllers\Admin\Product\IndexController@create')->name('product.create');
            Route::get('/components', '\App\Http\Controllers\Admin\Product\ComponentController@components')->name('product.components');
            Route::get('/components/{component}/edit', '\App\Http\Controllers\Admin\Product\ComponentController@componentEdit')->name('product.componentEdit');


            Route::get('/wheels/create', '\App\Http\Controllers\Admin\Product\ComponentController@wheelCreate')->name('product.wheelCreate');
            Route::get('/wheels/edit/{wheel}', '\App\Http\Controllers\Admin\Product\ComponentController@wheelEdit')->name('product.wheelEdit');
            Route::get('/colors/create/{component}', '\App\Http\Controllers\Admin\Product\ComponentController@colorCreate')->name('product.colorCreate');
            Route::get('/colors/edit/{color}/{component}', '\App\Http\Controllers\Admin\Product\ComponentController@colorEdit')->name('product.colorEdit');

            Route::post('/', '\App\Http\Controllers\Admin\Product\IndexController@store')->name('product.store');
            Route::post('/wheels', '\App\Http\Controllers\Admin\Product\ComponentController@wheelStore')->name('product.wheelStore');
            Route::post('/colors', '\App\Http\Controllers\Admin\Product\ComponentController@colorStore')->name('product.colorStore');
            Route::get('/{product}/edit', '\App\Http\Controllers\Admin\Product\IndexController@edit')->name('product.edit');

            Route::get('/{product}', '\App\Http\Controllers\Admin\Product\IndexController@show')->name('product.show');
            Route::patch('/{product}/update', '\App\Http\Controllers\Admin\Product\IndexController@update')->name('product.update');
            Route::patch('/wheels/{wheel}/update', '\App\Http\Controllers\Admin\Product\ComponentController@wheelUpdate')->name('product.wheelUpdate');
            Route::patch('/colors/{color}/update', '\App\Http\Controllers\Admin\Product\ComponentController@colorUpdate')->name('product.colorUpdate');
            Route::delete('/{product}/delete', '\App\Http\Controllers\Admin\Product\IndexController@delete')->name('product.delete');
            Route::delete('/wheels/{wheel}/delete', '\App\Http\Controllers\Admin\Product\ComponentController@wheelDelete')->name('product.wheelDelete');
            Route::delete('/colors/{color}/{component}/delete', '\App\Http\Controllers\Admin\Product\ComponentController@colorDelete')->name('product.colorDelete');
        });

        Route::group(['prefix' => 'mission'], function() {
            Route::get('/', '\App\Http\Controllers\Admin\MissionController@index')->name('mission');
            Route::get('/create', '\App\Http\Controllers\Admin\MissionController@create')->name('mission.create');
            Route::post('/', '\App\Http\Controllers\Admin\MissionController@store')->name('mission.store');
            Route::get('/{mission}/edit', '\App\Http\Controllers\Admin\MissionController@edit')->name('mission.edit');

            Route::get('/{mission}', '\App\Http\Controllers\Admin\MissionController@show')->name('mission.show');
            Route::patch('/{mission}/update', '\App\Http\Controllers\Admin\MissionController@update')->name('mission.update');
            Route::delete('/{mission}/delete', '\App\Http\Controllers\Admin\MissionController@delete')->name('mission.delete');
        });



        Route::group(['prefix' => 'feature'], function() {
            Route::get('/create/{product}', '\App\Http\Controllers\Admin\Product\FeatureController@createFeature')->name('product.createFeature');
            Route::get('/{feature}/{product}/edit', '\App\Http\Controllers\Admin\Product\FeatureController@editFeature')->name('product.editFeature');
            Route::post('/', '\App\Http\Controllers\Admin\Product\FeatureController@storeFeature')->name('product.storeFeature');
            Route::patch('/{feature}', '\App\Http\Controllers\Admin\Product\FeatureController@updateFeature')->name('product.updateFeature');
            Route::delete('/{feature}/{product}', '\App\Http\Controllers\Admin\Product\FeatureController@deleteFeature')->name('product.deleteFeature');
        });

        Route::group(['prefix' => 'slider'], function() {
            Route::get('/', '\App\Http\Controllers\Admin\SliderController@index')->name('slider');
            Route::get('/create', '\App\Http\Controllers\Admin\SliderController@create')->name('slider.create');
            Route::post('/', '\App\Http\Controllers\Admin\SliderController@store')->name('slider.store');

            Route::get('/category', '\App\Http\Controllers\Admin\SliderController@createCategory')->name('slider.createCategory');
            Route::post('/category', '\App\Http\Controllers\Admin\SliderController@storeCategory')->name('slider.storeCategory');

            Route::get('/{slider}/edit', '\App\Http\Controllers\Admin\SliderController@edit')->name('slider.edit');
            Route::get('/{slider}', '\App\Http\Controllers\Admin\SliderController@show')->name('slider.show');
            Route::patch('/{slider}', '\App\Http\Controllers\Admin\SliderController@update')->name('slider.update');
            Route::delete('/{slider}', '\App\Http\Controllers\Admin\SliderController@delete')->name('slider.delete');

        });

        Route::group(['prefix' => 'news'], function() {
            Route::get('/', '\App\Http\Controllers\Admin\NewsController@index')->name('news');
            Route::get('/create', '\App\Http\Controllers\Admin\NewsController@create')->name('news.create');
            Route::post('/', '\App\Http\Controllers\Admin\NewsController@store')->name('news.store');

            Route::get('/category', '\App\Http\Controllers\Admin\NewsController@createCategory')->name('news.createCategory');
            Route::post('/category', '\App\Http\Controllers\Admin\NewsController@storeCategory')->name('news.storeCategory');
            Route::get('/{news}/edit', '\App\Http\Controllers\Admin\NewsController@edit')->name('news.edit');

            Route::get('/editPage/{newsPage}', '\App\Http\Controllers\Admin\NewsController@editPage')->name('news.editPage');
            Route::patch('/updatePage/{newsPage}', '\App\Http\Controllers\Admin\NewsController@updatePage')->name('news.updatePage');

            Route::get('/{news}', '\App\Http\Controllers\Admin\NewsController@show')->name('news.show');
            Route::patch('/{news}', '\App\Http\Controllers\Admin\NewsController@update')->name('news.update');
            Route::delete('/{news}', '\App\Http\Controllers\Admin\NewsController@delete')->name('news.delete');
        });

        Route::group(['prefix' => 'contacts'], function() {
            Route::get('/', '\App\Http\Controllers\Admin\ContactsController@index')->name('contacts');
            Route::get('/editPage/{page}', '\App\Http\Controllers\Admin\ContactsController@editPage')->name('contacts.editPage');
            Route::patch('/updatePage/{page}', '\App\Http\Controllers\Admin\ContactsController@updatePage')->name('contacts.updatePage');
            Route::get('/{contact}/edit', '\App\Http\Controllers\Admin\ContactsController@edit')->name('contacts.edit');
            Route::patch('/{contact}', '\App\Http\Controllers\Admin\ContactsController@update')->name('contacts.update');
         });

        Route::group(['prefix' => 'careers'], function() {
            Route::get('/', '\App\Http\Controllers\Admin\CareersController@index')->name('careers');
            Route::get('/create', '\App\Http\Controllers\Admin\CareersController@create')->name('careers.create');
            Route::post('/', '\App\Http\Controllers\Admin\CareersController@store')->name('careers.store');

            Route::get('/editPage/{careersPage}', '\App\Http\Controllers\Admin\CareersController@editPage')->name('careers.editPage');
            Route::patch('/updatePage/{careersPage}', '\App\Http\Controllers\Admin\CareersController@updatePage')->name('careers.updatePage');

            Route::get('/create-benefit', '\App\Http\Controllers\Admin\CareersController@createBenefit')->name('careers.createBenefit');
            Route::post('/benefit', '\App\Http\Controllers\Admin\CareersController@storeBenefit')->name('careers.storeBenefit');
            Route::get('/benefit/{benefit}/edit', '\App\Http\Controllers\Admin\CareersController@editBenefit')->name('careers.editBenefit');
            Route::patch('/benefit/{benefit}', '\App\Http\Controllers\Admin\CareersController@updateBenefit')->name('careers.updateBenefit');
            Route::delete('/benefit/{benefit}', '\App\Http\Controllers\Admin\CareersController@deleteBenefit')->name('careers.deleteBenefit');


            Route::get('/vacancy/{vacancy}/edit', '\App\Http\Controllers\Admin\CareersController@edit')->name('careers.edit');
            Route::get('/vacancy/{vacancy}', '\App\Http\Controllers\Admin\CareersController@show')->name('careers.show');
            Route::patch('/vacancy/{vacancy}', '\App\Http\Controllers\Admin\CareersController@update')->name('careers.update');
            Route::delete('/vacancy/{vacancy}', '\App\Http\Controllers\Admin\CareersController@delete')->name('careers.delete');
        });

        Route::group(['prefix' => 'portfolio'], function() {
            Route::get('/', '\App\Http\Controllers\Admin\PortfolioController@index')->name('portfolio');
            Route::get('/create', '\App\Http\Controllers\Admin\PortfolioController@create')->name('portfolio.create');
            Route::post('/', '\App\Http\Controllers\Admin\PortfolioController@store')->name('portfolio.store');

            Route::get('/categories', '\App\Http\Controllers\Admin\PortfolioController@categories')->name('portfolio.categories');
            Route::get('/category', '\App\Http\Controllers\Admin\PortfolioController@createCategory')->name('portfolio.createCategory');
            Route::post('/category', '\App\Http\Controllers\Admin\PortfolioController@storeCategory')->name('portfolio.storeCategory');
            Route::get('/category/{portfolioCategory}/edit', '\App\Http\Controllers\Admin\PortfolioController@editCategory')->name('portfolio.editCategory');
            Route::patch('/category/{portfolioCategory}', '\App\Http\Controllers\Admin\PortfolioController@updateCategory')->name('portfolio.updateCategory');
            Route::delete('/category/{portfolioCategory}', '\App\Http\Controllers\Admin\PortfolioController@deleteCategory')->name('portfolio.deleteCategory');

            Route::get('/{portfolio}/edit', '\App\Http\Controllers\Admin\PortfolioController@edit')->name('portfolio.edit');
            Route::get('/{portfolio}', '\App\Http\Controllers\Admin\PortfolioController@show')->name('portfolio.show');
            Route::patch('/{portfolio}', '\App\Http\Controllers\Admin\PortfolioController@update')->name('portfolio.update');
            Route::delete('/{portfolio}', '\App\Http\Controllers\Admin\PortfolioController@delete')->name('portfolio.delete');
        });

        Route::group(['prefix' => 'resolve'], function() {
            Route::get('/', '\App\Http\Controllers\Admin\ResolveController@index')->name('resolve');
            Route::get('/create', '\App\Http\Controllers\Admin\ResolveController@create')->name('resolve.create');
            Route::post('/', '\App\Http\Controllers\Admin\ResolveController@store')->name('resolve.store');

            Route::get('/{resolve}/edit', '\App\Http\Controllers\Admin\ResolveController@edit')->name('resolve.edit');
            Route::get('/{resolve}', '\App\Http\Controllers\Admin\ResolveController@show')->name('resolve.show');
            Route::patch('/{resolve}', '\App\Http\Controllers\Admin\ResolveController@update')->name('resolve.update');
            Route::delete('/{resolve}', '\App\Http\Controllers\Admin\ResolveController@delete')->name('resolve.delete');
        });

        Route::group(['prefix' => 'solution'], function() {
            Route::get('/', '\App\Http\Controllers\Admin\SolutionController@index')->name('solution');
            Route::get('/create', '\App\Http\Controllers\Admin\SolutionController@create')->name('solution.create');
            Route::post('/', '\App\Http\Controllers\Admin\SolutionController@store')->name('solution.store');

            Route::get('/categories', '\App\Http\Controllers\Admin\SolutionController@categories')->name('solution.categories');
            Route::get('/category', '\App\Http\Controllers\Admin\SolutionController@createCategory')->name('solution.createCategory');
            Route::post('/category', '\App\Http\Controllers\Admin\SolutionController@storeCategory')->name('solution.storeCategory');
            Route::get('/category/{solutionCategory}/edit', '\App\Http\Controllers\Admin\SolutionController@editCategory')->name('solution.editCategory');
            Route::patch('/category/{solutionCategory}', '\App\Http\Controllers\Admin\SolutionController@updateCategory')->name('solution.updateCategory');
            Route::delete('/category/{solutionCategory}', '\App\Http\Controllers\Admin\SolutionController@deleteCategory')->name('solution.deleteCategory');

            Route::get('/{solution}/edit', '\App\Http\Controllers\Admin\SolutionController@edit')->name('solution.edit');
            Route::get('/{solution}', '\App\Http\Controllers\Admin\SolutionController@show')->name('solution.show');
            Route::patch('/{solution}', '\App\Http\Controllers\Admin\SolutionController@update')->name('solution.update');
            Route::delete('/{solution}', '\App\Http\Controllers\Admin\SolutionController@delete')->name('solution.delete');
        });

        Route::group(['prefix' => 'about'], function() {
            Route::get('/', '\App\Http\Controllers\Admin\AboutController@index')->name('about');
            Route::get('/benefits/create', '\App\Http\Controllers\Admin\AboutController@createBenefit')->name('about.createBenefit');
            Route::post('/benefits', '\App\Http\Controllers\Admin\AboutController@storeBenefit')->name('about.storeBenefit');
            Route::get('/benefits/{item}/edit', '\App\Http\Controllers\Admin\AboutController@editBenefit')->name('about.editBenefit');
            Route::patch('/benefits/{item}', '\App\Http\Controllers\Admin\AboutController@updateBenefit')->name('about.updateBenefit');
            Route::delete('/benefits/{item}', '\App\Http\Controllers\Admin\AboutController@deleteBenefit')->name('about.deleteBenefit');

            Route::get('/{item}/edit', '\App\Http\Controllers\Admin\AboutController@edit')->name('about.edit');
            Route::patch('/{item}', '\App\Http\Controllers\Admin\AboutController@update')->name('about.update');

        });
        Route::group(['prefix' => 'home-page'], function() {
            Route::get('/', '\App\Http\Controllers\Admin\SolutionController@mainPageSolutions')->name('mainPage');
            Route::get('/solution/{solution}/edit', '\App\Http\Controllers\Admin\SolutionController@editSolution')->name('mainPage.editSolution');

        });

        Route::group(['prefix' => 'pages'], function() {
            Route::get('/', '\App\Http\Controllers\Admin\PageController@index')->name('pages');
            Route::get('/{page}/edit', '\App\Http\Controllers\Admin\PageController@edit')->name('pages.edit');
            Route::patch('/{page}', '\App\Http\Controllers\Admin\PageController@update')->name('pages.update');
        });

        Route::group(['prefix' => 'scrapping'], function() {
            Route::get('/', '\App\Http\Controllers\Admin\Scraper\ScraperController@index')->name('scraper');
            Route::get('/{parser}/show', '\App\Http\Controllers\Admin\Scraper\ScraperController@show')->name('scraper.show');
            Route::post('/{parser}', '\App\Http\Controllers\Admin\Scraper\ScraperController@send')->name('scraper.send');

            Route::get('/hurakan', '\App\Http\Controllers\Admin\Scraper\ScraperController@hurakan')->name('hurakan');
        });
        Route::group(['prefix' => 'search-settings'], function() {
            Route::get('/', '\App\Http\Controllers\Admin\Settings\SearchController@index')->name('searchSettings');
            Route::get('/create-product-type', '\App\Http\Controllers\Admin\Settings\SearchController@createProductType')->name('searchSettings.createProductType');
            Route::get('/create-category-type', '\App\Http\Controllers\Admin\Settings\SearchController@createCategoryType')->name('searchSettings.createCategoryType');
            Route::post('/product-type', '\App\Http\Controllers\Admin\Settings\SearchController@storeProductType')->name('searchSettings.storeProductType');

            Route::post('/category-type', '\App\Http\Controllers\Admin\Settings\SearchController@storeCategoryType')->name('searchSettings.storeCategoryType');

            Route::get('/{searchSetting}/edit-product', '\App\Http\Controllers\Admin\Settings\SearchController@editProductType')->name('searchSettings.editProductType');
            Route::get('/{searchSetting}/edit-category', '\App\Http\Controllers\Admin\Settings\SearchController@editCategoryType')->name('searchSettings.editCategoryType');

            Route::patch('/{searchSetting}/edit-product', '\App\Http\Controllers\Admin\Settings\SearchController@updateProductType')->name('searchSettings.updateProductType');
            Route::patch('/{searchSetting}/edit-category', '\App\Http\Controllers\Admin\Settings\SearchController@updateCategoryType')->name('searchSettings.updateCategoryType');
            Route::delete('/{searchSetting}', '\App\Http\Controllers\Admin\Settings\SearchController@delete')->name('searchSettings.delete');
        });


    });


});
