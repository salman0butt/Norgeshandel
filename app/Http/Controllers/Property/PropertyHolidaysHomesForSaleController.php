<?php

namespace App\Http\Controllers\Property;
use App\Helpers\common;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddPropertyHolidayHomeForSale;
use App\Models\Ad;
use App\Notification;
use App\PropertyHolidaysHomesForSale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Pusher\Pusher;

class PropertyHolidaysHomesForSaleController extends Controller
{
    //
    private $pagination;
    private $pusher;

    public function __construct()
    {
        $options = array(
            'cluster' => 'eu',
            'useTLS' => true
        );

        $this->pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $this->pagination = getenv('PAGINATION');
        $this->pagination = $this->pagination == 0 ? 30 : $this->pagination;
    }
//    zain
    public function search_holiday_homes_for_sale(Request $request, $get_collection = false)
    {
        if(isset($request->search_id) && !$get_collection){
            Notification::where('notifiable_id', '=', $request->search_id)
                ->whereNull('read_at')->update(['read_at'=>now()]);
        }
//        DB::enableQueryLog();
        $col = 'list';
        $sort = 'published';
        if (isset($request->view) && !empty($request->view)) {
            $col = $request->view;
        }
        if (isset($request->sort) && !empty($request->sort)) {
            $sort = $request->sort;
        }
        $query = DB::table('ads')
            ->join('property_holidays_homes_for_sales', 'property_holidays_homes_for_sales.ad_id', '=','ads.id')
//            ->where('ads.status', '=','published')
            ->where('ads.visibility', '=', 1)
            ->whereNull('ads.deleted_at')
            ->whereNull('property_holidays_homes_for_sales.deleted_at')
            ->where(function ($query){
                $date = Date('y-m-d',strtotime('-7 days'));
                $query->where('ads.status', 'published')
                    ->orwhereDate('ads.sold_at','>',$date);
            });

//        if (isset($request->country) && !empty($request->country)) {
//            $query->whereIn('country', $request->country);
//        }
//        DB::enableQueryLog();
        if (isset($request->search) && !empty($request->search)) {
            $query->where('property_holidays_homes_for_sales.ad_headline', 'like', '%' . $request->search . '%');
        }
        if (isset($request->created_at)) {
            $query->whereDate('property_holidays_homes_for_sales.created_at', '=', $request->created_at);
        }
        if (isset($request->asking_price_from) && !empty($request->asking_price_from)) {
            $query->where('property_holidays_homes_for_sales.asking_price', '>=', (int)$request->asking_price_from);
        }
        if (isset($request->asking_price_to) && !empty($request->asking_price_to)) {
            $query->where('property_holidays_homes_for_sales.asking_price', '<=', (int)$request->asking_price_to);
        }
        if (isset($request->total_price_from) && !empty($request->total_price_from)) {
            $query->where('property_holidays_homes_for_sales.total_price', '>=', (int)$request->total_price_from);
        }
        if (isset($request->total_price_to) && !empty($request->total_price_to)) {
            $query->where('property_holidays_homes_for_sales.total_price', '<=', (int)$request->total_price_to);
        }
        if (isset($request->use_area_from) && !empty($request->use_area_from)) {
            $query->where('property_holidays_homes_for_sales.use_area', '>=', (int)$request->use_area_from);
        }
        if (isset($request->use_area_to) && !empty($request->use_area_to)) {
            $query->where('property_holidays_homes_for_sales.use_area', '<=', (int)$request->use_area_to);
        }
        if (isset($request->number_of_bedrooms) && !empty($request->number_of_bedrooms)) {
            $query->where('property_holidays_homes_for_sales.number_of_bedrooms', '>=', (int)$request->number_of_bedrooms);
        }
        if (isset($request->location) && !empty($request->location)) {
            $query->whereIn('property_holidays_homes_for_sales.location', $request->location);
        }
        if (isset($request->owned_site) && !empty($request->owned_site)) {
            $query->whereNotNull('property_holidays_homes_for_sales.owned_site');
        }
        if (isset($request->hhfs_facilities) && !empty($request->hhfs_facilities)) {
            $query->where(function ($query) use ($request) {
                $query->where('property_holidays_homes_for_sales.facilities', 'like', '%' . $request->hhfs_facilities[0] . '%');
                for ($i = 1; $i < count($request->hhfs_facilities); $i++) {
                    $query->orWhere('property_holidays_homes_for_sales.facilities', 'like', '%' . $request->hhfs_facilities[$i] . '%');
                }
                $query->orWhere('property_holidays_homes_for_sales.facilities', 'like', '%' . str_replace('/', '\\\/', $request->hhfs_facilities[0]) . '%');
                for ($i = 1; $i < count($request->hhfs_facilities); $i++) {
                    $query->orWhere('property_holidays_homes_for_sales.facilities', 'like', '%' . str_replace('/', '\\\/', $request->hhfs_facilities[$i]) . '%');
                }
            });
        }
        if (isset($request->hhfs_property_type) && !empty($request->hhfs_property_type)) {
            $query->whereIn('property_holidays_homes_for_sales.property_type', $request->hhfs_property_type);
        }
        if (isset($request->display_date) && !empty($request->display_date)) {
            $query->where(function ($query) use ($request) {
                $query->where('property_holidays_homes_for_sales.delivery_date', 'like', '%' . $request->display_date[0] . '%');
                for ($i = 1; $i < count($request->display_date); $i++) {
                    $query->orWhere('property_holidays_homes_for_sales.delivery_date', 'like', '%' . $request->display_date[$i] . '%');
                }
                $query->orWhere('property_holidays_homes_for_sales.secondary_deliver_date', 'like', '%' . $request->display_date[0] . '%');
                for ($i = 1; $i < count($request->display_date); $i++) {
                    $query->orWhere('property_holidays_homes_for_sales.secondary_deliver_date', 'like', '%' . $request->display_date[$i] . '%');
                }
            });
        }

        $order = $request->order;
        switch ($order) {
            case 'published':
                $query->orderBy('ad.created_at', 'DESC');
                break;
            case 'priced-low-high':
                $query->orderBy('value_rate', 'ASC');
                break;
            case 'priced-high-low':
                $query->orderBy('asking_price', 'DESC');
                break;
        }

        if ($get_collection){
            return $query->get();
        }
        $add_array = $query->paginate($this->pagination);
//        dd(DB::getQueryLog());
        if ($request->ajax()) {
            $html = view('user-panel.property.search-holiday-homes-for-sale-inner', compact('add_array', 'col', 'sort'))->render();
            exit($html);
        }
        return view('user-panel.property.search-holiday-homes-for-sale', compact('col', 'add_array', 'sort'));
    }

    //property for new_property_for_holiday_homes_for_sale new
    public function new_property_for_holiday_homes_for_sale(Request $request)
    {

        $ad = new Ad(['ad_type' => 'property_holiday_home_for_sale', 'status' => 'saved', 'user_id' => Auth::id()]);
        $ad->save();


        if ($ad) {
            $property = new PropertyHolidaysHomesForSale(['user_id' => Auth::id()]);
            $ad->propertyHolydaysHomesForSale()->save($property);
            if ($property) {

                return redirect(url('complete/ad/' . $ad->id));
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }
    }

    public function editHolidayHomeForSale($id)
    {
        $holiday_home_for_sale1 = PropertyHolidaysHomesForSale::findOrFail($id);
        if ($holiday_home_for_sale1) {
            if (!Auth::user()->hasRole('admin') && ($holiday_home_for_sale1->user_id != Auth::user()->id || $holiday_home_for_sale1->ad->status == 'sold')) {
                abort(404);
            }
            return view('user-panel.property.holiday_home_for_sale', compact('holiday_home_for_sale1'));
        } else {
            abort(404);
        }

    }

    public function updateHomeForSaleAd(Request $request, $id)
    {
        $property_quote = $property_pdf = '';
        DB::beginTransaction();
        try {
            if (!$request->amenities) {
                $request->merge(['amenities' => null]);
            }
            if (!$request->owned_site) {
                $request->merge(['owned_site' => null]);
            }
            $property_home_for_sale_data = $request->except('upload_dropzone_images_type');

            //Add More ViewingTimes
            if (isset($property_home_for_sale_data['delivery_date']) && $property_home_for_sale_data['delivery_date'] != "") {
                $property_home_for_sale_data['secondary_deliver_date'] = null;
                $i = 0;
                foreach ($property_home_for_sale_data['delivery_date'] as $key => $val) {
                    if ($i == 0) {
                        $property_home_for_sale_data['delivery_date'] = $val;
                    } else {
                        $property_home_for_sale_data['secondary_deliver_date'] .= $val . ",";
                    }
                    $i++;
                }
            }

            $property_home_for_sale_data['secondary_from_clock'] = "";
            if (isset($property_home_for_sale_data['from_clock'])) {
                $i = 0;
                foreach ($property_home_for_sale_data['from_clock'] as $key => $val) {
                    if ($i == 0) {
                        $property_home_for_sale_data['from_clock'] = $val;
                    } else {
                        $property_home_for_sale_data['secondary_from_clock'] .= $val . ",";
                    }
                    $i++;
                }
            }

            $property_home_for_sale_data['secondary_clockwise'] = "";
            if (isset($property_home_for_sale_data['clockwise'])) {
                $i = 0;
                foreach ($property_home_for_sale_data['clockwise'] as $key => $val) {
                    if ($i == 0) {
                        $property_home_for_sale_data['clockwise'] = $val;
                    } else {
                        $property_home_for_sale_data['secondary_clockwise'] .= $val . ",";
                    }
                    $i++;
                }
            }

            $property_home_for_sale_data['secondary_note'] = "";
            if (isset($property_home_for_sale_data['note'])) {
                $i = 0;
                foreach ($property_home_for_sale_data['note'] as $key => $val) {
                    if ($i == 0) {
                        $property_home_for_sale_data['note'] = $val;
                    } else {
                        $property_home_for_sale_data['secondary_note'] .= $val . ",";
                    }
                    $i++;
                }
            }
            //Manage Facilities
            if (isset($property_home_for_sale_data['facilities'])) {
                $facilities = "";
                foreach ($property_home_for_sale_data['facilities'] as $key => $val) {
                    $facilities .= $val . ",";
                }
                $property_home_for_sale_data['facilities'] = $facilities;
            }

            $property_home_for_sale_data['user_id'] = Auth::user()->id;
            unset($property_home_for_sale_data['property_home_for_sale_pdf']);
            unset($property_home_for_sale_data['property_home_for_sale_sales_quote']);
            $response = PropertyHolidaysHomesForSale::findOrFail($id);

            //Update media (mediable id and mediable type)
            if ($response && $response->ad) {
                $property_home_for_sale_data = common::updated_dropzone_images_type($property_home_for_sale_data, $request->upload_dropzone_images_type, $response->ad->id);

                //Store property_home_for_sale_sales_quote file
                if($request->file('property_home_for_sale_sales_quote')){
                    $property_quote = common::update_media($request->file('property_home_for_sale_sales_quote'), $response->ad->id, 'App\Models\Ad', 'sales_information');
                    if($property_quote){
                        $property_quote = json_decode($property_quote);
                        $property_quote = $property_quote->file_names[0];
                    }
                }

                //Store property_home_for_sale_pdf file
                if($request->file('property_home_for_sale_pdf')){
                    $property_pdf = common::update_media($request->file('property_home_for_sale_pdf'), $response->ad->id, 'App\Models\Ad', 'pdf');
                    if($property_pdf){
                        $property_pdf = json_decode($property_pdf);
                        $property_pdf = $property_pdf->file_names[0];
                    }
                }

            }

            $response->update($property_home_for_sale_data);
            DB::commit();

            $data['success'] = $response;
            $data['property_quote'] = $property_quote;
            $data['property_pdf'] = $property_pdf;
            echo json_encode($data);


        } catch (\Exception $e) {
            DB::rollback();
            (header("HTTP/1.0 404 Not Found"));
            $data['failure'] = $e->getMessage();
            echo json_encode($data);
            exit();
        }


    }

    public function deleteHomeForSaleAd($id)
    {

        $holiday_home_for_sale = PropertyHolidaysHomesForSale::findOrFail($id);

        //$ad = Ad::findOrFail($id);

        if (!empty($holiday_home_for_sale->media)) {
            if ($holiday_home_for_sale->media->first())
                common::delete_media($holiday_home_for_sale->media->first->mediable_id, $holiday_home_for_sale->media->first->mediable_type, $holiday_home_for_sale->media->first->type);
        }
        $holiday_home_for_sale->delete();

        Session::flash('success', 'Property Deleted Successfully');

        return redirect('/my-business/my-ads');
    }

    //update dummy updateDummyHomeForSaleAd
    public function updateDummyHomeForSaleAd(AddPropertyHolidayHomeForSale $request, $id)
    {
        $property = PropertyHolidaysHomesForSale::find($id);
        $message = '';
        $ad = $property->ad;
        if ($ad->status == 'saved') {
            $message = 'Ny bolig er publisert';
        } elseif ($ad->status == 'published') {
            $message = 'Eiendommen er oppdatert';
        }
        $response = $ad->update(['status' => 'published']);

//            notification bellow
        common::send_search_notification($property, 'saved_search', $message, $this->pusher, 'property/holiday-homes-for-sale');
//            end notification

        $data['success'] = $response;
        echo json_encode($data);
    }


    public function holidayHomeForSaleDescription($id)
    {
        $property_data = PropertyHolidaysHomesForSale::where('id', $id)->first();
        return view('common.partials.property.holiday_home_for_sale_description')->with(compact('property_data'));
    }
}
