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
use Illuminate\Support\Facades\Mail;
use Zizaco\Entrust\Entrust;
Auth::routes(['verify' => true]);
Route::get('verified', function (){return view('auth.verified');})->middleware('verified');
Route::get('mail', function () {
    $to_name = 'Zain';
    $to_email = 'zain@digitalmx.no';
    Mail::send('mail.new_user_verification', [], function ($message) use ($to_name, $to_email) {
        $message->to($to_email, $to_name)->subject('email subject');
        $message->from('developer@digitalmx.no', 'Developers of NorgesHandel');
    });
})->middleware('verified');

Route::get('lang', 'TranslationController@index');

Route::get('savedsearches', 'SearchController@index');
Route::post('savedsearches/', 'SearchController@store');
Route::post('recentearches/{value}', 'SearchController@recent');

Route::get('searching/{search}', 'SearchController@search')->name('searching');
//    home routes
Route::get('/', 'HomeController@index');
Route::get('home', 'HomeController@index')->name('home');
//--

//    common routes for all users
Route::get('jobs/search/', 'Admin\Jobs\JobController@search')->name('search');
Route::get('jobs/search/filter_my_ads/{status}/{ad_type}', 'AdController@filter_my_ads');
Route::post('jobs/store_dummy', 'Admin\Jobs\JobController@store_dummy')->name('store_dummy');
Route::post('jobs/update_dummy', 'Admin\Jobs\JobController@update_dummy')->name('update_dummy');

Route::get('shared-lists/{link_id}', function ($link_id) {
    $list = \App\fav_list::where('share_link', $link_id)->get()->first();
    return view('user-panel.my-business.favorites.my_favorites_list', compact('list'));
});

Route::resources([
    'users' => 'Admin\Users\AdminUserController',
    'roles' => 'Admin\Users\RoleController',
    'jobs' => 'Admin\Jobs\JobController',

    'term' => 'TermController',
    'tax' => 'TaxonomyController',
    'media' => 'MediaController',
    'trans' => 'TranslationController'
]);
Route::get('single', function () {
    return view('user-panel/jobs/single');
});
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');
Route::get('forbidden', function () {
    return view('admin.users.forbidden');
})->name('forbidden');
//--
Route::get('us/{p}', function () {
    echo 'hello';
});

//    routes for all non guest users
Route::group(['middleware' => 'auth'], function () {
//    Route::get('my-business', function () {return view('user-panel.my_business');})->name('my-business');

//    my business/min handel page routes
    Route::group(['prefix' => 'my-business'], function () {
        Route::get('/', function () {
            return view('user-panel.my-business.my_business');
        });
        Route::get('my-ads/{status?}', 'AdController@my_ads');

//      favorites routes
        Route::get('favorites', 'FavoriteController@index');
        Route::get('get-favorites', 'FavoriteController@get_favorites');
        Route::get('add-list/{name}', 'FavoriteController@add_list')->name('add-list');
        Route::get('add-fav/{list_id}/{ad_id}', 'FavoriteController@add_fav');
        Route::get('remove-fav/{ad_id}', 'FavoriteController@remove_fav');
        Route::get('rename-list/{list_id}/{name}', 'FavoriteController@rename_list');
        Route::get('delete-list/{list_id}', 'FavoriteController@delete_list');
        Route::get('favorite-list/{list_id}', function ($list_id) {
            $list = \App\fav_list::where('id', $list_id)->get()->first();
            return view('user-panel.my-business.favorites.my_favorites_list', compact('list'));
        });
        Route::resource('cv', 'Cv\CvController');
        Route::group(['prefix' => 'cv'], function () {
            Route::resources([
                'cvpersonal' => 'Cv\CvPersonalController',
                'cvexperience' => 'Cv\CvExperienceController',
                'cveducation' => 'Cv\CvEducationController'
            ]);
            Route::post('upload_cv_profile', 'Cv\CvController@upload_cv_profile')->name('upload_cv_profile');
//            Route::post('update_skills', 'Cv\CvController@update_skills')->name('update_skills');
            Route::post('update_skills/{cv_id}', 'Cv\CvController@update_skills')->name('update_skills');
            Route::post('update_languages/{cv_id}', 'Cv\CvController@update_languages')->name('update_languages');
            Route::post('update_preference/{cv_id}', 'Cv\CvController@update_preference')->name('update_preference');
            Route::get('download_pdf/{cv_id}', 'Cv\CvController@download_pdf')->name('download_pdf');
        });
        Route::get('profile', 'Admin\Users\AdminUserController@profile')->name('profile');
        Route::post('profile/request_company_profile', 'Admin\Users\AdminUserController@request_company_profile')->name('request_company_profile');
        Route::get('profile/select_company_profile_type', function (){
            return view('user-panel.my-business.profile.company_request_1');
        });
        Route::get('profile/company_profile_form/{type}', function ($type){
            return view('user-panel.my-business.profile.company_request_2', compact('type'));
        });
        Route::resource('company', 'App\Models\Company');
        Route::get('cv/extend', 'Cv\CvController@extend');
        Route::resource('job-preferences', 'JobPreferenceController');
    });

//    new ad routes
    Route::group(['prefix' => 'new'], function () {
        Route::get('/', function () {
            return view('user-panel.select-ad-category');
        });

//        new job routes
        Route::group(['prefix' => 'job', 'middleware' => 'auth'], function () {
            Route::get('full_time', function () {
                return view('user-panel.jobs.new_full_time');
            });
            Route::get('part_time', function () {
                return view('user-panel.jobs.new_part_time');
            });
            Route::get('management', function () {
                return view('user-panel.jobs.new_management');
            });
        });
    });

});
Route::get('profile/public/{id}', 'Admin\Users\AdminUserController@public_profile')->name('public_profile');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware'=>['role:admin|manager']], function () {

//    dashboard
    Route::get('/', 'Admin\DashboardController@index')->name('dashboard');
//    job custom routes
    Route::get('/jobs/select_category', function () {
        return view('admin.jobs.jobs_select_category');
    });
    Route::get('/jobs/create/{type}', 'Admin\Jobs\JobController@create')->name('jobs.create');
    Route::get('/jobs/status_change/{ad}/status/{status}', 'Admin\Jobs\JobController@status_change')->name('jobs.status_change');
//    edit user role
    Route::post('/roles/edit_role', 'Admin\Users\RoleController@edit_role')->name('roles.edit_role');
//    route to change user role
    Route::POST('/users/change_role', 'Admin\Users\AdminUserController@change_role')->name('users.change_role');
//    all general resources
    Route::resources([
        'dashboard' => 'Admin\DashboardController',
        'users' => 'Admin\Users\AdminUserController',
        'roles' => 'Admin\Users\RoleController',
        'jobs' => 'Admin\Jobs\JobController',

        'term' => 'TermController',
        'tax' => 'TaxonomyController',
        'media' => 'MediaController',
    ]);
});

Route::get('reset', function () {
    \App\User::all()->first()->update(['password' => \Illuminate\Support\Facades\Hash::make('gujrat786')]);

});

//  zille bellow
Route::get('property/realestate', 'PropertyController@list');
Route::get('property/realestate/homes', 'PropertyController@ads');
Route::get('new/property/rent/ad', 'PropertyController@newAdd');
Route::post('add/property/for/rent/ad', 'PropertyController@newPropertyForRentAdd');
Route::post('property/for/rent/sorted/ad', 'PropertyController@sortedAddsPropertyForRent');
Route::get('new/property/sale/ad', 'PropertyController@newSaleAdd');
Route::get('property/for/sale', 'PropertyController@adsPropertyForSale');
Route::post('property/for/sale/sorted/ad', 'PropertyController@sortedAddsPropertyForSale');
Route::post('add/property/sale/ad', 'PropertyController@addSaleAdd');
Route::get('holiday/home/for/sale', 'PropertyController@holidayHomeForSale');
Route::get('property/for/rent', 'PropertyController@adsForRent');
Route::get('property/for/holidays', 'PropertyController@adsForHomeHolidays');
Route::post('add/property/home/for/sale/ad', 'PropertyController@addHomeForSaleAd');
Route::post('get/property/holiday/home/for/sale/ad', 'PropertyController@getHomeForSaleAdd');
Route::get('new/flat/wishes/rented', 'PropertyController@newAddFlatWishesRented');
Route::post('add/flat/wishes/rented', 'PropertyController@addFlatWishesRented');
Route::get('add/new/realestate/business/plot', 'PropertyController@addNewRealEstateBusinessPlot');
Route::post('add/realestate/business/plot', 'PropertyController@addRealEstateBusinessPlot');
Route::get('add/new/commercial/property/for/sale', 'PropertyController@commercialPropertyForSale');
Route::post('add/commercial/property/for/sale', 'PropertyController@addCommercialPropertyForSale');
Route::get('/property/description/{id}', ['uses' => 'PropertyController@propertyDescription']);
Route::get('/property/for/sale/description/{id}', ['uses' => 'PropertyController@propertyForSaleDescription']);


//flatwishesrented
Route::get('/property/flat/wishes/rented', 'PropertyController@adsForFlatWishedRented');
Route::post('/property/flat/wishes/rented/sorted/ad', 'PropertyController@flatWishesRentedSortedAd');
Route::get('/flat/wishes/rented/description/{id}', ['uses' => 'PropertyController@flatWishesRentedDescription']);

//holidayhomeforsale
Route::get('/holiday/home/for/sale/ads', 'PropertyController@holidayHomeForSaleAds');
Route::get('/holiday/home/for/sale/description/{id}', ['uses' => 'PropertyController@holidayHomeForSaleDescription']);

//commercialpropertyforsale
Route::get('/commercial/property/for/sale/ads', 'PropertyController@commercialPropertyForSaleAds');
Route::post('/property/commercial/for/sale/sorted/ad', 'PropertyController@commercialPropertyForSaleSortedAds');
Route::get('/commercial/property/for/sale/description/{id}', ['uses' => 'PropertyController@commercialForSaleDescription']);

//commercialpropertyforrent
Route::get('/add/new/commercial/property/for/rent', 'PropertyController@commercialPropertyForRent');
Route::post('/add/commercial/property/for/rent', 'PropertyController@addCommercialPropertyForRent');
Route::get('/commercial/property/for/rent/ads', 'PropertyController@commercialPropertyForRentAds');
Route::post('property/commercial/for/rent/sorted/ad', 'PropertyController@commercialPropertyForRentSortedAds');

Route::get('/commercial/property/for/rent/description/{id}', 'PropertyController@commercialForRentDescription');

Route::get('/business/for/sale', 'PropertyController@BusinessForSale');
Route::post('add/business/for/sale', 'PropertyController@addBusinessForSale');
Route::get('/business/for/sale/ads', 'PropertyController@businessForSaleAds');

Route::post('business/for/sales/sorted/ad', 'PropertyController@businessForSaleSortedAds');

Route::get('/business/for/sale/description/{id}', 'PropertyController@businessForSaleDescription');

Route::get('/commercial/plots', 'PropertyController@commercialPlots');
Route::post('/add/commercial/plot/ad', 'PropertyController@addcommercialPlotsAd');

Route::get('/commercial/plots/ads', 'PropertyController@commercialPlotsAds');

Route::post('get/commercial/plot/ad', 'PropertyController@commercialPlotSortedAds');

Route::get('/commercial/plots/ads/description/{id}', 'PropertyController@commercialPlotDescription');

Route::get('/map/test', 'PropertyController@mapTest');

Route::get('general/property/description/{id}/{type}', 'PropertyController@generalPropertyDescription');

