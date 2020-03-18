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
            ->join($table, $table . '.ad_id', 'ads.id')
            ->where('ads.status', 'published')
            ->whereNull('ads.deleted_at')
            ->whereNull($table . '.deleted_at');

        if (isset($request->country) && !empty($request->country)) {
            $query->whereIn('country', $request->country);
        }
        if (isset($request->search) && !empty($request->search)) {
            $query->where('headline', 'like', '%' . $request->search . '%');
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

        switch ($sort) {
            case 'published':
                $query->orderBy($table . '.created_at', 'DESC');
                break;
            case 'priced-low-high':
                $query->orderBy('value_rate', 'ASC');
                break;
            case 'priced-high-low':
                $query->orderBy('value_rate', 'DESC');
                break;
        }

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

        $ad = new Ad(['ad_type' => 'property_commercial_plots', 'status' => 'saved', 'user_id' => Auth::id()]);
        $ad->save();


        if ($ad) {
            $property = new CommercialPlot(['user_id' => Auth::id()]);
            $ad->propertyCommercialPlot()->save($property);
            if ($property) {
                return redirect(url('complete/ad/' . $ad->id));
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }
    }

    //update dummy updateDummyCommercialPropertyForRent
    public function updateDummyCommercialPlots(AddCommercialPlot $request, $id)
    {

        $property = CommercialPlot::find($id);
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

        $data['success'] = $response;
        echo json_encode($data);
    }

    public function editCommercialPlots($id)
    {
        $commercial_plots = CommercialPlot::findOrFail($id);
        if ($commercial_plots) {
            if (!Auth::user()->hasRole('admin') && $commercial_plots->user_id != Auth::user()->id) {
                return redirect('forbidden');
            }
            return view('user-panel.property.commercial_plots', compact('commercial_plots'));
        } else {
            abort(404);
        }
    }

    public function updateCommercialPlots(Request $request, $id)
    {
        $property_pdf = '';
        DB::beginTransaction();
        try {
            if (!$request->owned_plot_facilities) {
                $request->merge(['owned_plot_facilities' => null]);
            }
            $commercial_plot = $request->except('upload_dropzone_images_type');
            unset($commercial_plot['commercial_plot_pdf']);
            $commercial_plot['user_id'] = Auth::user()->id;

            $response = CommercialPlot::findOrFail($id);

            //Update media (mediable id and mediable type)
            if ($response && $response->ad) {
                $commercial_plot = common::updated_dropzone_images_type($commercial_plot, $request->upload_dropzone_images_type, $response->ad->id);

                //Store commercial_plot_pdf file
                if($request->file('commercial_plot_pdf')){
                    $property_pdf = common::update_media($request->file('commercial_plot_pdf'), $response->ad->id, 'App\Models\Ad', 'pdf');
                    if($property_pdf){
                        $property_pdf = json_decode($property_pdf);
                        $property_pdf = $property_pdf->file_names[0];
                    }
                }
            }


            $response->update($commercial_plot);

            DB::commit();
            $data['success'] = $response;
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

    public function commercialPlotDescription($id)
    {
        $property_data = CommercialPlot::where('id', $id)->first();
        return view('common.partials.property.commercial_plots_description')->with(compact('property_data'));
    }
}
