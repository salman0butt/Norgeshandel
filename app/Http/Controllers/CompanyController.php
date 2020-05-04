<?php

namespace App\Http\Controllers;

use App\Helpers\common;
use App\Media;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
//        $companies = Company::all();
        $companies = Company::where('company_type','Jobb')->get();
        return view('user-panel.jobs.companies.companies',compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->file('files')) {
            $files = $request->file('files');
            return common::update_media($files, Auth::user()->id, $request->upload_dropzone_images_type, 'company_gallery', 'false');
        }
        $company = new Company($request->except('company_logo', 'company_gallery','upload_dropzone_images_type','deleted_media','media_position'));
        $company->user_id = Auth::user()->id;
        $company->save();


        $this->update_company_gallery_dropzone_images('company_gallery_temp_images',$company->id);

        if($request->media_position){
            $media_position = common::update_media_position($request->media_position);
        }

        if ($request->file('company_logo')) {
            $file = $request->file('company_logo');
            common::update_media($file, $company->id, 'App\Models\Company', 'company_logo');
        }
//        if ($request->file('company_gallery')) {
//            $files = $request->file('company_gallery');
//            common::update_media($files, $company->id, 'App\Models\Company', 'company_gallery');
//        }
        $request->session()->flash('success', 'Selskapet ble lagt til');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company,$id)
    {
        //
        $company = Company::findOrFail($id);
        return view('user-panel.jobs.companies.signle_company', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        if ($request->file('files')) {
            $files = $request->file('files');
            return common::update_media($files, Auth::user()->id, $request->upload_dropzone_images_type, 'company_gallery', 'false');
        }

        $company->update($request->except('company_logo', 'company_gallery','upload_dropzone_images_type','deleted_media','media_position'));

        $this->update_company_gallery_dropzone_images('company_gallery_temp_images_'.$company->id,$company->id);

        if($request->deleted_media){
            $delete_media = common::delete_json_media($request->deleted_media);
        }
        if($request->media_position){
            $media_position = common::update_media_position($request->media_position);
        }

        if ($request->file('company_logo')) {
            $file = $request->file('company_logo');
            common::update_media($file, $company->id, 'App\Models\Company', 'company_logo');
        }

//        if ($request->file('company_gallery')) {
//            $files = $request->file('company_gallery');
//            common::update_media($files, $company->id, 'App\Models\Company', 'company_gallery');
//        }

        $request->session()->flash('success', 'Selskapet ble oppdatert!');
        return redirect()->back();
    }


    public function update_company_gallery_dropzone_images($mediable_type,$company_id){
        $temp_media = Media::where('mediable_id', Auth::user()->id)->where('mediable_type', $mediable_type)->get();
        if ($temp_media->count() > 0 && $company_id) {
            $max_old_media_order = Media::where('mediable_type', 'App\Models\Company')->where('mediable_id', $company_id)->where('type', 'company_gallery')->orderBy('media_order', 'DESC')->first();

            $order = 0;
            if ($max_old_media_order) {
                $order = $max_old_media_order->media_order;
            }
            foreach ($temp_media as $key => $temp_media_obj) {
                $temp_media_obj->mediable_id = $company_id;
                $temp_media_obj->mediable_type = 'App\Models\Company';
                $temp_media_obj->media_order = $order+1;
                $temp_media_obj->update();
                $order++;
            }

        }
        return 'success';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {

        if($company->jobs->count()){
            foreach ($company->jobs as $company_job){
                $company_job->ad()->delete();
                $company_job->delete();
            }
        }

        if($company->company_logo->count()){
            common::delete_media($company->id, 'App\Models\Company', 'company_logo');
        }
        if($company->company_gallery->count()){
            common::delete_media($company->id, 'App\Models\Company', 'company_gallery');
        }

        $company->delete();
        Session::flash('success', 'Selskapet ble slettet!');
        return redirect()->back();
    }
}
