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
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Zizaco\Entrust\Entrust;

Auth::routes(['verify' => true]);
Route::get('clear-chat', function () {
    \App\MessageThread::where('id', '!=', 0)->delete();
    return redirect('messages');
});

Route::get('verified', function () {
    return view('auth.verified');
})->middleware('verified');
Route::get('{ad_type}/ad', 'HomeController@single_ad');
Route::get('mail', function () {
    $to_name = 'Zain';
    $to_email = 'zain@digitalmx.no';
    Mail::send('mail.new_user_verification', [], function ($message) use ($to_name, $to_email) {
        $message->to($to_email, $to_name)->subject('email subject');
        $message->from('developer@digitalmx.no', 'Developers of NorgesHandel');
    });
})->middleware('verified');

Route::group(['middleware' => 'authverified'], function () {

    Route::get('lang', 'TranslationController@index');

    Route::get('checksearch', 'SearchController@checksearch');
    Route::get('savedsearches', 'SearchController@index');
    Route::post('savedsearches/', 'SearchController@store');
    Route::post('recentearches/{value}/{name}/{ad_type}', 'SearchController@recent');

    Route::get('/residential/and/recreational/land/for/sale', function () {
        return view('user-panel.property.residential_and_recreational_land_for_sale');
    });

    Route::get('searching/{search?}', 'SearchController@search')->name('searching');
    Route::get('global-search/{search}', 'SearchController@global')->name('global');
//    home routes
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/notification', function () {

        return view('notification');
    });
    Route::get('/setting', function () {

        return view('user-panel.my-business.settings');
    });
    Route::get('/price-chart', function () {

        return view('user-panel.my-business.price_chart');
    });
    Route::get('/job-pref', function () {

        return view('user-panel.my-business.job_preferences');
    });

    Route::get('/privacy', function () {
        return view('user-panel.my-business.privacy_setting');
    });
    Route::get('/become-business', function () {
        return view('user-panel.footer.become_business');
    });
    Route::get('/customer-admin-for-business', function () {
        return view('user-panel.footer.customer_admin_for_business');
    });
    Route::get('/personvern', function () {

        return view('user-panel.footer.cookie');
    });
    Route::get('/rating', function () {
        return view('user-panel.my-business.rating');
    });

    Route::get('/customer-services', function () {
        return view('user-panel.footer.customer_service');
    });
    Route::get('/useful-info', function () {
        return view('user-panel.footer.useful_info');
    });

    Route::get('/cookie', function () {

        return view('user-panel.footer.cookie');
    });
    Route::get('/about-us', function () {
        return view('user-panel.footer.about_us');
    });
    Route::get('user/ads/options', function () {
     return view('user-panel.my-business.my_ads_options');
    });
    Route::get('user/ads/statistics', function () {
     return view('user-panel.my-business.ads_statistics');
    });


//Compnies List

    Route::get('/companies', 'CompanyController@index');
    Route::get('/single-company/{id}', 'CompanyController@show');


//--

//property search and filters
    Route::get('property/property-for-sale/search', 'PropertyController@search_property_for_sale');
    Route::get('property/property-for-rent/search', 'PropertyController@search_property_for_rent');
    Route::get('property/commercial-property-for-sale/search', 'PropertyController@search_commercial_property_for_sale');
    Route::get('property/commercial-property-for-rent/search', 'PropertyController@search_commercial_property_for_rent');
    Route::get('property/commercial-plots/search', 'PropertyController@search_commercial_plots');


//Banner ads mangment
    Route::get('/admin/ads', 'Admin\ads\BannerController@index')->middleware(['role:admin|manager']);
    Route::get('/admin/ads/{id}/edit', 'Admin\ads\BannerController@edit')->middleware(['role:admin|manager']);
    Route::patch('/admin/ads/{id}/', 'Admin\ads\BannerController@update')->middleware(['role:admin|manager']);
    Route::delete('/admin/ads/{id}/', 'Admin\ads\BannerController@destroy')->middleware(['role:admin|manager']);
    Route::post('/admin/ads/', 'Admin\ads\BannerController@store')->middleware(['role:admin|manager']);
    Route::get('/admin/ads/create', 'Admin\ads\BannerController@create')->middleware(['role:admin|manager']);

    Route::post('/banner/ad/click', 'Admin\ads\BannerClickController@ad_clicked');

//Banner Group   /admin/banner-group/

// Route::resource('bannerGroup', 'Admin\ads\BannerGroupController');

    Route::get('/admin/banner-group/create', 'Admin\ads\BannerGroupController@create')->middleware(['role:admin|manager']);
    Route::post('/admin/banner-group/store', 'Admin\ads\BannerGroupController@store')
        ->middleware(['role:admin|manager'])->name('banner-group-new');
    Route::get('/admin/banner-group/index', 'Admin\ads\BannerGroupController@index')->middleware(['role:admin|manager']);
    Route::delete('/admin/banner-group/{id}', 'Admin\ads\BannerGroupController@destroy')->middleware(['role:admin|manager']);
    Route::get('/admin/banner-group/{id}/edit', 'Admin\ads\BannerGroupController@edit')->middleware(['role:admin|manager']);
    Route::patch('/admin/banner-group/{id}', 'Admin\ads\BannerGroupController@update')->middleware(['role:admin|manager']);


//language switch
    Route::get('my-business/cv/{locale}', function ($locale) {
        Session::put('locale', $locale);
        return redirect()->back();
    });


//    common routes for all users
    Route::get('jobs/search/', 'Admin\Jobs\JobController@search')->name('search');
    Route::get('jobs/search/filter_my_ads/{status}/{ad_type}', 'AdController@filter_my_ads');
    Route::post('jobs/store_dummy', 'Admin\Jobs\JobController@store_dummy')->name('store_dummy');
    Route::post('jobs/update_dummy', 'Admin\Jobs\JobController@update_dummy')->name('update_dummy');
    Route::get('jobs/mega_menu_search', 'Admin\Jobs\JobController@mega_menu_search')->name('mega_menu_search_url');

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
    Route::get('dummy', function () {
        return view('user-panel.nav');
    });
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
    Route::group(['middleware' => ['verified']], function () {
        Route::delete('property/delete/{obj}', 'PropertyController@property_destroy')->name('delete-property');
        // message
        Route::get('messages/thread/{thread_id}', 'MessageController@view_thread');
        Route::get('messages/delete/{thread_id}', 'MessageController@delete_thread');
        Route::get('messages/new/{ad_id}', 'MessageController@new_thread');
        Route::get('messages/render-thread/{thread_id}', 'MessageController@render_thread');
        Route::get('/messages', 'MessageController@index');

        Route::post('message', 'MessageController@send');
        Route::get('messages/read_all/{thread_id}', 'MessageController@read_all');


        Route::get('notifications/all', 'NotificationController@showAllNotifications');

        Route::get('show/notifications/all', 'NotificationController@showAllNotifications');

        //Clear Searches
        Route::post('clear-searches', 'HomeController@clearSearches')->name('clear-searches');

//    Route::get('my-business', function () {return view('user-panel.my_business');})->name('my-business');

//    my business/min handel page routes
        Route::group(['prefix' => 'my-business'], function () {
            Route::get('savedsearches', 'SearchController@index');
            Route::resource('search', 'SearchController');

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
            Route::get('profile/select_company_profile_type', function () {
                return view('user-panel.footer.become_business');
//                return view('user-panel.my-business.profile.company_request_1');
            });
            Route::get('profile/company_profile_form/{type}', function ($type) {
                return view('user-panel.my-business.profile.company_request_2', compact('type'));
            });
            Route::resource('company', 'CompanyController');
            Route::get('cv/extend', 'Cv\CvController@extend');
            Route::resource('job-preferences', 'JobPreferenceController');
            Route::resource('following', 'FollowingController');
        });

//    new ad routes
        Route::group(['prefix' => 'new'], function () {
            Route::get('/', function () {
                return view('user-panel.select-ad-category');
            });

//        new job routes
            Route::group(['prefix' => 'job'], function () {
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
        Route::get('profile/public/{id}', 'Admin\Users\AdminUserController@public_profile')->name('public_profile');
    });

    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['role:admin|manager']], function () {

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
Route::get('new/property/rent/ad/{id}/edit', 'PropertyController@newAddedit');
Route::patch('add/property/for/rent/ad/{id}', 'PropertyController@UpdatePropertyForRentAdd');
Route::post('add/property/for/rent/ad', 'PropertyController@newPropertyForRentAdd');
Route::delete('property/for/rent/ad/{id}', 'PropertyController@deletePropertyForRent');
Route::post('property/for/rent/sorted/ad', 'PropertyController@sortedAddsPropertyForRent');
Route::get('new/property/sale/ad', 'PropertyController@newSaleAdd');
Route::get('new/property/sale/ad/{id}/edit', 'PropertyController@editSaleAdd');
Route::get('property/for/sale', 'PropertyController@adsPropertyForSale');
Route::post('property/for/sale/sorted/ad', 'PropertyController@sortedAddsPropertyForSale');
Route::patch('new/property/sale/ad/{id}', 'PropertyController@updateSaleAdd');
Route::post('add/property/sale/ad', 'PropertyController@addSaleAdd');

//Holiday home for sale
Route::get('holiday/home/for/sale', 'PropertyController@holidayHomeForSale');
Route::get('holiday/home/for/sale/{id}/edit','PropertyController@editHolidayHomeForSale');
Route::patch('holiday/home/for/sale/{id}','PropertyController@updateHomeForSaleAd');
Route::post('add/property/home/for/sale/ad', 'PropertyController@addHomeForSaleAd');
Route::post('get/property/holiday/home/for/sale/ad', 'PropertyController@getHomeForSaleAdd');

Route::get('property/for/rent', 'PropertyController@adsForRent');
Route::get('property/for/holidays', 'PropertyController@adsForHomeHolidays');
Route::get('new/flat/wishes/rented', 'PropertyController@newAddFlatWishesRented');
Route::get('new/flat/wishes/rented/{id}/edit', 'PropertyController@editAddFlatWishesRented');
Route::patch('new/flat/wishes/rented/{id}', 'PropertyController@updateFlatWishesRented');
Route::delete('flat/wishes/rented/{id}', 'PropertyController@deleteFlatWishesRented');
Route::post('new/add/flat/wishes/rented', 'PropertyController@addFlatWishesRented');
Route::get('add/new/realestate/business/plot', 'PropertyController@addNewRealEstateBusinessPlot');
Route::post('add/realestate/business/plot', 'PropertyController@addRealEstateBusinessPlot');
Route::get('add/new/commercial/property/for/sale', 'PropertyController@commercialPropertyForSale');
Route::get('add/new/commercial/property/for/sale/{id}/edit', 'PropertyController@editcommercialPropertyForSale');
Route::patch('add/new/commercial/property/for/sale/{id}', 'PropertyController@updateCommercialPropertyForSale');
Route::post('add/commercial/property/for/sale', 'PropertyController@addCommercialPropertyForSale');
Route::get('/property/description/{id}', ['uses' => 'PropertyController@propertyDescription']);
Route::get('/property/for/sale/description/{id}', ['uses' => 'PropertyController@propertyForSaleDescription']);


    /// Upload images using dropzone
    Route::post('upload-images', 'PropertyController@upload_dropzone_images')->name('upload-images'); // upload images on add form request
    Route::patch('update-upload-images', 'PropertyController@upload_dropzone_images'); // upload images on edit form request

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

    //commercial property for rent
    Route::get('/add/new/commercial/property/for/rent', 'PropertyController@commercialPropertyForRent');
    Route::get('add/new/commercial/property/for/rent/{id}/edit', 'PropertyController@editCommercialPropertyForRent');
    Route::patch('add/new/commercial/property/for/rent/{id}', 'PropertyController@updateCommercialPropertyForRent');
    Route::post('/add/commercial/property/for/rent', 'PropertyController@addCommercialPropertyForRent');
    Route::get('/commercial/property/for/rent/ads', 'PropertyController@commercialPropertyForRentAds');
    Route::post('property/commercial/for/rent/sorted/ad', 'PropertyController@commercialPropertyForRentSortedAds');

    Route::get('/commercial/property/for/rent/description/{id}', 'PropertyController@commercialForRentDescription');

    // Business for sale
    Route::get('/business/for/sale', 'PropertyController@BusinessForSale');
    Route::post('add/business/for/sale', 'PropertyController@addBusinessForSale');
    Route::post('add/business/for/sale/{id}/edit', 'PropertyController@editBusinessForSale');
    Route::patch('add/business/for/sale/{id}', 'PropertyController@updateBusinessForSale');
    Route::get('/business/for/sale/ads', 'PropertyController@businessForSaleAds');
    Route::get('add/business/for/sale/{id}/edit', 'PropertyController@editBusinessForSale');
    Route::patch('add/business/for/sale/{id}', 'PropertyController@updateBusinessForSale');

    Route::post('business/for/sales/sorted/ad', 'PropertyController@businessForSaleSortedAds');

    Route::get('/business/for/sale/description/{id}', 'PropertyController@businessForSaleDescription');

    //Commercial Plots
    Route::get('/commercial/plots', 'PropertyController@commercialPlots');
    Route::get('/commercial/plots/{id}/edit', 'PropertyController@editCommercialPlots');
    Route::patch('commercial/plots/{id}', 'PropertyController@updateCommercialPlots');
    Route::post('/add/commercial/plot/ad', 'PropertyController@addcommercialPlotsAd');

    Route::get('/commercial/plots/ads', 'PropertyController@commercialPlotsAds');

    Route::post('get/commercial/plot/ad', 'PropertyController@commercialPlotSortedAds');

    Route::get('/commercial/plots/ads/description/{id}', 'PropertyController@commercialPlotDescription');

    Route::get('/map/test', 'PropertyController@mapTest');

    Route::get('general/property/description/{id}/{type}', 'PropertyController@generalPropertyDescription');

    Route::get('test', function () {
        event(new App\Events\PropertyForRent('Guest'));
        return "Event has been sent!";
    });


Route::get('/delete-media-dz',function(){
    $media = Media::where('name_unique',$_GET['filename'])->first();
    if ($media) {
        $path = 'public/uploads/' . date('Y', strtotime($media->updated_at)) . '/' . date('m', strtotime($media->updated_at)) . '/';
        $arr = explode('.', $media->name_unique);

        foreach (glob($path . $arr[0] . '*.*') as $file) {
            unlink($file);
        }
        $media->delete();
    }
    $response = array();
    $response['flag'] = 'success';
    return json_encode($response);
    });
    Route::post('/update-media-positions', function (Request $request) {
        $response = array();
        $response['flag'] = 'failure';
        if (isset($request->dataArr)) {
            $data = json_decode($request->dataArr);
            foreach ($data as $data_arr) {
                $response['flag'] = 'success';
                $media = Media::where('name_unique', $data_arr[0])->first();
                if ($media) {
                    $media->order = $data_arr[1];
                    $media->save();
                }
            }
        }
        return json_encode($response);
    });

    Route::post('search/notification/exists', 'NotificationController@searchNotificationExists');
    Route::get('/{handel?}', 'HomeController@index');
});
