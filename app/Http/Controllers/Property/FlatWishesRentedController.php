<?php

namespace App\Http\Controllers\Property;
use App\FlatWishesRented;
use App\Helpers\common;
use App\Http\Controllers\Controller;
use App\Http\Controllers\NotificationController;
use App\Http\Requests\AddFlatWishesRented;
use App\Models\Ad;
use App\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Pusher\Pusher;

class FlatWishesRentedController extends Controller
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
    public function search_flat_wishes_rented(Request $request, $get_collection = false)
    {
        if(isset($request->search_id) && !$get_collection){
            Notification::where('notifiable_id', '=', $request->search_id)
                ->whereNull('read_at')->update(['read_at'=>now()]);
        }
        $col = 'list';
        $sort = 'published';
        if (isset($request->view) && !empty($request->view)) {
            $col = $request->view;
        }
        if (isset($request->sort) && !empty($request->sort)) {
            $sort = $request->sort;
        }
        $query = DB::table('ads')
            ->join('flat_wishes_renteds', 'flat_wishes_renteds.ad_id', '=','ads.id')
            ->where('ads.status', '=','published')
            ->where('ads.visibility', '=', 1)
            ->whereNull('ads.deleted_at')
            ->whereNull('flat_wishes_renteds.deleted_at');
//        DB::enableQueryLog();

        if (isset($request->search) && !empty($request->search)) {
            $query->where('flat_wishes_renteds.headline', 'like', '%' . $request->search . '%');
        }
        if (isset($request->created_at)) {
            $query->whereDate('flat_wishes_renteds.created_at', '=', $request->created_at);
        }
        if (isset($request->price_from) && !empty($request->price_from)) {
            $query->where('flat_wishes_renteds.max_rent_per_month', '>=', (int)$request->price_from);
        }
        if (isset($request->price_to) && !empty($request->price_to)) {
            $query->where('flat_wishes_renteds.max_rent_per_month', '<=', (int)$request->price_to);
        }
        if (isset($request->country) && !empty($request->country)) {
            $query->whereIn('flat_wishes_renteds.region', $request->country);
        }
        if (isset($request->fwr_property_type) && !empty($request->fwr_property_type)) {
            $query->where(function ($query) use ($request) {
                $query->where('flat_wishes_renteds.property_type', 'like', '%' . $request->fwr_property_type[0] . '%');
                for ($i = 1; $i < count($request->fwr_property_type); $i++) {
                    $query->orWhere('flat_wishes_renteds.property_type', 'like', '%' . $request->fwr_property_type[$i] . '%');
                }
            });
        }
        if (isset($request->wanted_from) && !empty($request->wanted_from)) {
            $query->where(function ($query) use ($request) {
                $query->where('flat_wishes_renteds.wanted_from', 'like', '%' . $request->wanted_from[0] . '%');
                for ($i = 1; $i < count($request->wanted_from); $i++) {
                    $query->orWhere('flat_wishes_renteds.wanted_from', 'like', '%' . $request->wanted_from[$i] . '%');
                }
            });
        }
        if (isset($request->number_of_tenants) && !empty($request->number_of_tenants)) {
            $query->where(function ($query) use ($request) {
                $query->whereIn('flat_wishes_renteds.number_of_tenants', $request->number_of_tenants);
                if (in_array(4, $request->number_of_tenants)) {
                    $query->orWhere('flat_wishes_renteds.number_of_tenants', '>=', 4);
                }
            });
        }

        switch ($sort) {
            case 'published':
                $query->orderBy('flat_wishes_renteds.created_at', 'DESC');
                break;
            case 'priced-low-high':
                $query->orderBy('flat_wishes_renteds.max_rent_per_month', 'ASC');
                break;
            case 'priced-high-low':
                $query->orderBy('flat_wishes_renteds.max_rent_per_month', 'DESC');
                break;
        }

        if ($get_collection){
            return $query->get();
        }

        $add_array = $query->paginate($this->pagination);
        if ($request->ajax()) {
            $html = view('user-panel.property.search-flat-wishes-rented-inner', compact('add_array', 'col', 'sort'))->render();
            exit($html);
        }
        return view('user-panel.property.search-flat-wishes-rented', compact('col', 'add_array', 'sort'));
    }

    //prooperty for new_property_for_flat_wishes_rented new
    public function new_property_for_flat_wishes_rented(Request $request)
    {

        $ad = new Ad(['ad_type' => 'property_flat_wishes_rented', 'status' => 'saved', 'user_id' => Auth::id()]);
        $ad->save();


        if ($ad) {
            $property = new FlatWishesRented(['user_id' => Auth::id()]);
            $ad->propertyFlatWishesRented()->save($property);
            if ($property) {

                return redirect(url('complete/ad/' . $ad->id));
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }
    }

    //update dummy property for sale to published
    public function updateDummyFlatWishesRented(AddFlatWishesRented $request, $id)
    {
        //  DB::connection()->enableQueryLog();
        $property = FlatWishesRented::find($id);
        $message = '';
        $ad = $property->ad;
        if ($ad->status == 'saved') {
            $message = 'Ny bolig er publisert';
        } elseif ($ad->status == 'published') {
            $message = 'Eiendommen er oppdatert';
        }
        $response = $ad->update(['status' => 'published']);

//            notification bellow
        common::send_search_notification($property, 'saved_search', $message, $this->pusher, 'property/flat-wishes-rented');
//            end notification
        //  dd(DB::getQueryLog());

        $data['success'] = $response;
        echo json_encode($data);
    }

    public function editAddFlatWishesRented($id)
    {
        $flat_wishes_rented1 = FlatWishesRented::findOrFail($id);
        if ($flat_wishes_rented1) {
            if (!Auth::user()->hasRole('admin') && $flat_wishes_rented1->user_id != Auth::user()->id) {
                abort(404);
            }
            return view('user-panel.property.flat_wishes_rented', compact('flat_wishes_rented1'));
        } else {
            abort(404);
        }
    }

    public function updateFlatWishesRented(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $flat_wishes_rented_data = $request->except('upload_dropzone_images_type');
            $regions = "";
            if (isset($flat_wishes_rented_data['region'])) {
                foreach ($flat_wishes_rented_data['region'] as $key => $val) {
                    $regions .= $val . ",";
                }
                $flat_wishes_rented_data['region'] = $regions;
            } else {
                $flat_wishes_rented_data['region'] = null;
            }

            $property_types = "";
            if (isset($flat_wishes_rented_data['property_type'])) {
                foreach ($flat_wishes_rented_data['property_type'] as $key => $val) {
                    $property_types .= $val . ",";
                }
                $flat_wishes_rented_data['property_type'] = $property_types;
            } else {
                $flat_wishes_rented_data['property_type'] = null;
            }


            unset($flat_wishes_rented_data['flat_wishes_rented']);
            $flat_wishes_rented_data['user_id'] = Auth::user()->id;

            $response = FlatWishesRented::findOrFail($id);

            //Update media (mediable id and mediable type)
            if ($response && $response->ad) {
                $flat_wishes_rented_data = common::updated_dropzone_images_type($flat_wishes_rented_data, $request->upload_dropzone_images_type, $response->ad->id);
            }

            $response->update($flat_wishes_rented_data);
            DB::commit();

            $data['success'] = $response;
            echo json_encode($data);

        } catch (\Exception $e) {
            DB::rollback();
            (header("HTTP/1.0 404 Not Found"));
            $data['failure'] = $e->getMessage();
            echo json_encode($data);
            exit();
        }
    }

    public function flatWishesRentedDescription($id)
    {
        $property_data = FlatWishesRented::where('id', $id)->first();
        return view('common.partials.property.flat_wishes_rented_description')->with(compact('property_data'));
    }
}
