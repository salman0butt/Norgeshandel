<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Media;
use App\Models\Ad;
use Zizaco\Entrust\Entrust;
Auth::routes();

//    home routes
Route::get('/', function () {
    $ads = Ad::where('status','published')->orderBy('id', 'desc')->get();
    return view('home', compact('ads')); });
Route::get('home', function () {
    $ads = Ad::where('status','published')->orderBy('id', 'desc')->get();
    return view('home', compact('ads')); })->name('home');
//--

//    common routes for all users
Route::get('jobs/search', 'Admin\Jobs\JobController@search')->name('search');
Route::get('jobs/search/filter_my_ads/{status}/{ad_type}', 'AdController@filter_my_ads');
Route::post('jobs/store_dummy', 'Admin\Jobs\JobController@store_dummy')->name('store_dummy');
Route::post('jobs/update_dummy', 'Admin\Jobs\JobController@update_dummy')->name('update_dummy');

Route::get('shared-lists/{link_id}', function ($link_id){
    $list = \App\fav_list::where('share_link', $link_id)->get()->first();
    return view('user-panel.my-business.favorites.my_favorites_list', compact('list'));
});

Route::resources([
    'users'           => 'Admin\Users\AdminUserController',
    'roles'           => 'Admin\Users\RoleController',
    'jobs'            => 'Admin\Jobs\JobController',

    'term'       => 'TermController',
    'tax'       => 'TaxonomyController',
    'media'       => 'MediaController',
    'trans'     => 'TranslationController'
]);
Route::get('single', function (){return view('user-panel/jobs/single');});
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');
Route::get('forbidden', function (){ return view('admin.users.forbidden'); })->name('forbidden');
//--
Route::get('us/{p}', function (){
    echo 'hello';
});

//    routes for all non guest users
Route::group(['middleware'=>'auth'], function(){
//    Route::get('my-business', function () {return view('user-panel.my_business');})->name('my-business');

//    my business/min handel page routes
    Route::group(['prefix'=>'my-business'], function () {
        Route::get('/', function () {return view('user-panel.my-business.my_business');});
        Route::get('my-ads/{status?}', 'AdController@my_ads');

//      favorites routes
        Route::get('favorites', 'FavoriteController@index');
        Route::get('get-favorites', 'FavoriteController@get_favorites');
        Route::get('add-list/{name}', 'FavoriteController@add_list')->name('add-list');
        Route::get('add-fav/{list_id}/{ad_id}', 'FavoriteController@add_fav');
        Route::get('remove-fav/{ad_id}', 'FavoriteController@remove_fav');
        Route::get('rename-list/{list_id}/{name}', 'FavoriteController@rename_list');
        Route::get('delete-list/{list_id}', 'FavoriteController@delete_list');
        Route::get('favorite-list/{list_id}', function ($list_id){
            $list = \App\fav_list::where('id', $list_id)->get()->first();
            return view('user-panel.my-business.favorites.my_favorites_list', compact('list'));
        });
        Route::resource('cv', 'Cv\CvController');
        Route::group(['prefix'=>'cv'], function (){
            Route::resources([
                'cvpersonal'=>'Cv\CvPersonalController',
                'cvexperience'=>'Cv\CvExperienceController'
            ]);
            Route::post('upload_cv_profile', 'Cv\CvController@upload_cv_profile')->name('upload_cv_profile');
//            Route::post('update_skills', 'Cv\CvController@update_skills')->name('update_skills');
            Route::post('update_skills/{cv_id}', 'Cv\CvController@update_skills')->name('update_skills');
            Route::post('update_languages/{cv_id}', 'Cv\CvController@update_languages')->name('update_languages');
            Route::post('update_preference/{cv_id}', 'Cv\CvController@update_preference')->name('update_preference');
        });
        Route::get('cv/extend', 'Cv\CvController@extend');
    });



//    new ad routes
    Route::group(['prefix'=>'new'], function(){
        Route::get('/', function (){return view('user-panel.select-ad-category');});

//        new job routes
        Route::group(['prefix'=>'job', 'middleware'=>'auth'], function(){
            Route::get('full_time', function (){return view('user-panel.jobs.new_full_time');});
            Route::get('part_time', function (){return view('user-panel.jobs.new_part_time');});
            Route::get('management', function (){return view('user-panel.jobs.new_management');});
        });
    });

});



Route::group(['prefix'=>'admin', 'as'=>'admin.', 'middleware' => ['role:admin|manager|salesman']], function (){
//    dashboard
    Route::get('/', 'Admin\DashboardController@index')->name('dashboard');
//    job custom routes
    Route::get('/jobs/select_category', function (){ return view('admin.jobs.jobs_select_category'); });
    Route::get('/jobs/create/{type}', 'Admin\Jobs\JobController@create')->name('jobs.create');
    Route::get('/jobs/status_change/{ad}/status/{status}', 'Admin\Jobs\JobController@status_change')->name('jobs.status_change');
//    edit user role
    Route::post('/roles/edit_role', 'Admin\Users\RoleController@edit_role')->name('roles.edit_role');
//    route to change user role
    Route::POST('/users/change_role', 'Admin\Users\AdminUserController@change_role')->name('users.change_role');
//    all general resources
    Route::resources([
        'dashboard'       => 'Admin\DashboardController',
        'users'           => 'Admin\Users\AdminUserController',
        'roles'           => 'Admin\Users\RoleController',
        'jobs'            => 'Admin\Jobs\JobController',

        'term'            => 'TermController',
        'tax'             => 'TaxonomyController',
        'media'           => 'MediaController',
    ]);
});

Route::get('reset', function (){
    \App\User::all()->first()->update(['password'=>\Illuminate\Support\Facades\Hash::make('gujrat786')]);

});

//  zille bellow
Route::get('property/realestate', 'PropertyController@list');
Route::get('property/realestate/homes', 'PropertyController@ads');
Route::get('new/property/rent/ad', 'PropertyController@newAdd');
Route::post('add/property/for/rent/ad', 'PropertyController@newPropertyForRentAdd');
Route::post('get/property/ad', 'PropertyController@getAd');
Route::post('property/for/rent/sorted/ad', 'PropertyController@sortedAddsPropertyForRent');
Route::get('new/property/sale/ad', 'PropertyController@newSaleAdd');
Route::get('property/for/sale', 'PropertyController@adsPropertyForSale');
Route::post('property/for/sale/sorted/ad', 'PropertyController@sortedAddsPropertyForSale');
Route::post('add/property/sale/ad', 'PropertyController@addSaleAdd');
Route::get('holiday/home/for/sale', 'PropertyController@holidayHomeForSale');
Route::get('property/for/rent', 'PropertyController@AdsForRent');
Route::get('property/for/holidays', 'PropertyController@adsForHomeHolidays');
Route::post('add/property/home/for/sale/ad', 'PropertyController@addHomeForSaleAdd');
Route::post('get/property/holiday/home/for/sale/ad', 'PropertyController@getHomeForSaleAdd');
Route::get('new/flat/wishes/rented', 'PropertyController@newAddFlatWishesRented');
Route::post('add/flat/wishes/rented', 'PropertyController@addFlatWishesRented');
Route::get('add/new/realestate/business/plot', 'PropertyController@addNewRealEstateBusinessPlot');
Route::post('add/realestate/business/plot', 'PropertyController@addRealEstateBusinessPlot');
Route::get('add/new/commercial/property/for/sale', 'PropertyController@commercialPropertyForSale');
Route::post('add/commercial/property/for/sale', 'PropertyController@addCommercialPropertyForSale');
Route::get('/property/description/{id}', ['uses' =>'PropertyController@propertyDescription']);
Route::get('/property/for/sale/description/{id}', ['uses' =>'PropertyController@propertyForSaleDescription']);

Route::get('lang', function (){
//    $langs = ['Norsk', 'Svensk', 'Dansk', 'Finsk', 'Engelsk', 'Tysk', 'Fransk', 'Spansk', 'Italiensk', 'Portugisisk', 'Russisk', 'Japansk', 'Nederlandsk', 'Norsk tegnspråk', 'Britisk tegnspråk', 'Amerikansk tegnspråk', 'Albansk', 'Arabisk', 'Armensk', 'Bengali', 'Bosnisk', 'Bulgarsk', 'Burmesisk', 'Eskimoisk/Inuitisk', 'Estisk', 'Filipinsk', 'Færøysk', 'Georgisk', 'Gresk', 'Grønlandsk', 'Gælisk', 'Hebraisk', 'Hindi', 'Hviterussisk', 'Indonesisk', 'Irsk', 'Islandsk', 'Kantonesisk/Yue', 'Katalansk', 'Kinesisk', 'Koreansk', 'Kroatisk', 'Kurdisk', 'Latin', 'Latvisk', 'Litauisk', 'Luxemburgisk', 'Makedonsk', 'Mandarin', 'Mongolsk', 'Nepalsk', 'Persiska (Farsi)', 'Polsk', 'Rumensk', 'Samisk', 'Samoansk', 'Serbisk', 'Slovakisk', 'Slovensk', 'Somalisk', 'Swahili', 'Syrisk/Assyrisk', 'Tamil', 'Thai', 'Tibetansk', 'Tsjekkisk', 'Tsjetsjensk', 'Tyrkisk', 'Ukrainsk', 'Ungarsk', 'Urdu', 'Vietnamesisk', 'Walisisk', 'Zulu', 'Pashto', 'Punjabi/Panjabi', 'Usbekisk'];
//
//    foreach ($langs as $lang){
//        \App\Models\Language::create(['name'=>$lang]);
//    }
//
});
