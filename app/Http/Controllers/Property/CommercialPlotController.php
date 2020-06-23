<?php

namespace App\Http\Controllers\Property;
use App\CommercialPlot;
use App\Helpers\common;
use App\Http\Controllers\Controller;
use App\Http\Controllers\NotificationController;
use App\Http\Requests\AddCommercialPlot;
use App\Models\Ad;
use App\Notification;
use App\PropertyForSale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Pusher\Pusher;

class CommercialPlotController extends Controller
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
    public function search_commercial_plots(Request $request, $get_collection = false)
    {
        if(isset($request->search_id) && !$get_collection){
            Notification::where('notifiable_id', '=', $request->search_id)
                ->whereNull('read_at')->update(['read_at'=>now()]);
        }
        $table = 'commercial_plots';
        $col = 'list';
        $sort = 'published';
        if (isset($request->view) && !empty($request->view)) {
            $col = $request->view;
        }
        if (isset($request->sort) && !empty($request->sort)) {
            $sort = $request->sort;
        }
        $query = DB::table('ads')
            ->join($table, $table . '.ad_id', '=', 'ads.id')
//            ->where('ads.status', '=','published')
            ->where('ads.visibility', '=', 1)
            ->whereNull('ads.deleted_at')
            ->whereNull($table . '.deleted_at')
            ->where(function ($query){
                $date = Date('y-m-d',strtotime('-7 days'));
                $query->where('ads.status', 'published')
                    ->orwhereDate('ads.sold_at','>',$date);
            });

        if (isset($request->country) && !empty($request->country)) {
            $query->whereIn('country', $request->country);
        }
        if (isset($request->search) && !empty($request->search)) {
//            $query->where('headline', 'like', '%' . $request->search . '%');
            common::table_search($query, common::get_model_columns(CommercialPlot::class), $request->search, 'commercial_plots');
        }
        if (isset($request->created_at)) {
            $query->whereDate($table . '.created_at', '=', $request->created_at);
        }
        if (isset($request->use_area_from) && !empty($request->use_area_from)) {
            $query->where($table . '.plot_size', '>=', (int)$request->use_area_from);
        }
        if (isset($request->use_area_to) && !empty($request->use_area_to)) {
            $query->where($table . '.plot_size', '<=', (int)$request->use_area_to);
        }

        if (isset($request->user_id) && !empty($request->user_id)) {
            $query->where('ads.user_id', $request->user_id);
        }
        if (isset($request->company_id) && !empty($request->company_id)) {
            $query->where('ads.company_id', $request->company_id);
        }

        //Property Map Filters
       if ($request->ajax()) {
             if(isset($request->map) && $request->map){
                 $query->select(['commercial_plots.headline AS ad_heading', 'commercial_plots.*']);
                $all_ads = common::propertyMapFilters($query);
                 return response()->json(['data'=>$all_ads]);
             }
        }


        switch ($sort) {
            case 'most_relevant':
                $query->orderBy('ads.updated_at', 'DESC');
                break;
            case 'published':
                $query->orderBy('ads.published_on', 'DESC');
                break;
            case 'priced-low-high':
                $query->orderBy('asking_price', 'ASC');
                break;
            case 'priced-high-low':
                $query->orderBy('asking_price', 'DESC');
                break;
            case 'area_low_high':
                $query->orderBy('plot_size', 'ASC');
                break;
            case 'area_high_low':
                $query->orderBy('plot_size', 'DESC');
                break;
            case '99':
                if(isset($request->lat) && $request->lat && isset($request->lon) && $request->lon){
                    common::find_nearby_ads($request->lat, $request->lon,$query,$table);
                    break;
                }
        }

//        $query->orderBy('ads.published_on', 'DESC');

        if ($get_collection){
            return $query->get();
        }

        $add_array = $query->paginate($this->pagination);
        if ($request->ajax()) {
            $html = view('user-panel.property.search-commercial-plots-inner', compact('add_array', 'col', 'sort'))->render();
            exit($html);
        }
        return view('user-panel.property.search-commercial-plots', compact('col', 'add_array', 'sort'));
    }

    //prooperty for new_commercial_plots new
    public function new_commercial_plots(Request $request)
    {
        DB::beginTransaction();
        try{
            $company_id = 0;
            if(Auth::user()->hasRole('agent')){
                $company_id = Auth::user()->created_by_company_id;
            }
            if(Auth::user()->hasRole('company') && Auth::user()->property_companies->first() && Auth::user()->property_companies->first()->id){
                $company_id = Auth::user()->property_companies->first()->id;
            }
            $auth_id = Auth::id();
            $ad = new Ad(['ad_type' => 'property_commercial_plots', 'status' => 'saved', 'user_id' => $auth_id, 'company_id'=>$company_id]);
            $ad->save();
            if ($ad) {
                $property = new CommercialPlot(['user_id' => $auth_id]);
                $ad->propertyCommercialPlot()->save($property);
                if ($property) {
                    DB::commit();
                    return redirect(url('complete/ad/' . $ad->id));
                } else {
                    DB::rollback();
                    abort(404);
                }
            } else {
                DB::rollback();
                abort(404);
            }
        }catch (\Exception $e){
            DB::rollback();
            abort(404);
        }
    }


    public function editCommercialPlots($id)
    {
        common::delete_media(Auth::user()->id, 'commercial_plots_temp_images', 'gallery');
        $commercial_plots = CommercialPlot::findOrFail($id);
        if ($commercial_plots) {
            if (!Auth::user()->hasRole('admin') && ($commercial_plots->user_id != Auth::user()->id || $commercial_plots->ad->status == 'sold')) {
                abort(404);
            }
            return view('user-panel.property.commercial_plots', compact('commercial_plots'));
        } else {
            abort(404);
        }
    }

    //update dummy updateDummyCommercialPropertyForRent
    public function updateDummyCommercialPlots(AddCommercialPlot $request, $id)
    {
        $msg = $this->updateCommercialPlots($request,$id,'controller');
        if($msg['flag'] == 'success'){
            $property = CommercialPlot::find($id);
            $message = '';
            $ad = $property->ad;
            if ($ad && $ad->status == 'saved') {
                $message = 'Annonsen din er publisert.';
            } elseif ($ad && $ad->status == 'published') {
                $message = 'Annonsen din er oppdatert.';
                $media = common::updated_dropzone_images_type($request->all(),'commercial_plots_temp_images',$ad->id);
                if($request->media_position){
                    $media_position = common::update_media_position($request->media_position);
                }
                if($request->deleted_media){
                    $delete_media = common::delete_json_media($request->deleted_media);
                }
            }
            $published_date = date("Y-m-d H:i:s");

            $response = $ad->update(['status' => 'published', 'published_on' => $published_date]);

//            notification bellow
            common::send_search_notification($property, 'saved_search', 'Søk varsel: ny annonse', $this->pusher, 'property/commercial-plots',$ad);
//            end notification

            $msg['message'] = $message;
//                $data['success'] = $response;
            $msg['status'] = $ad->status;
            echo json_encode($msg);
        }else{
            echo json_encode($msg);
            exit();
        }
    }

    public function updateCommercialPlots(Request $request, $id,$call_by='')
    {
        $property_pdf = '';
        DB::beginTransaction();
        try {
            if (!$request->owned_plot_facilities) {
                $request->merge(['owned_plot_facilities' => null]);
            }
            $commercial_plot = $request->except('upload_dropzone_images_type','media_position','deleted_media','company_id','agent_id','old_price');
            unset($commercial_plot['commercial_plot_pdf']);
//            $commercial_plot['user_id'] = Auth::user()->id;

            if (isset($commercial_plot['published_on']) && $commercial_plot['published_on'] == 'on') {
                $commercial_plot['published_on'] = 1;
            } else {
                $commercial_plot['published_on'] = 0;
            }

            $response = CommercialPlot::findOrFail($id);

            //Update media (mediable id and mediable type)
            if ($response && $response->ad) {
                $commercial_plot = common::updated_dropzone_images_type($commercial_plot, $request->upload_dropzone_images_type, $response->ad->id);

                //Store commercial_plot_pdf file
                if($request->file('commercial_plot_pdf')){
                    $property_pdf = common::update_media($request->file('commercial_plot_pdf'), $response->ad->id, 'App\Models\Ad', 'pdf');
                    if($property_pdf){
//                        $property_pdf = json_decode($property_pdf);
                        $property_pdf = $property_pdf['file_names'][0];//$property_pdf->file_names[0];
                    }
                }

                common::sync_ad_agents($response->ad,$request->agent_id);
            }

            $response->update($commercial_plot);
            
            if ($request->old_price != $request->monthly_rent) {
                $ad_id = CommercialPlot::where('id', '=', $id)->first();
                $ad = Ad::find($ad_id->ad_id);
                common::property_notification($ad, $this->pusher, Auth::user()->id,'commercial_plot');
            }

            DB::commit();
            $data['success'] = $response;
            $data['property_pdf'] = $property_pdf;
            if($call_by){
                $data['flag'] = 'success';
                return $data;
            }
            echo json_encode($data);

        } catch (\Exception $e) {
            DB::rollback();
            (header("HTTP/1.0 404 Not Found"));
            $data['failure'] = $e->getMessage();
            if($call_by){
                $data['flag'] = 'failure';
                return $data;
            }
            echo json_encode($data);
            exit();
        }
    }

    public function commercialPlotDescription($id)
    {
        $property_data = CommercialPlot::where('id', $id)->first();
        return view('common.partials.property.commercial_plots_description')->with(compact('property_data'));
    }
}
