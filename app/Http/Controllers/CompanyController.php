<?php

namespace App\Http\Controllers;

use App\Helpers\common;
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
        $company = new Company($request->except('company_logo', 'company_gallery'));
        $company->user_id = Auth::user()->id;
        $company->save();
        if ($request->file('company_logo')) {
            $file = $request->file('company_logo');
            common::update_media($file, $company->id, 'App\Models\Company', 'company_logo');
        }
        if ($request->file('company_gallery')) {
            $files = $request->file('company_gallery');
            common::update_media($files, $company->id, 'App\Models\Company', 'company_gallery');
        }
        $request->session()->flash('success', 'Selskapet ble lagt til');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
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
        $company->update($request->except('company_logo', 'company_gallery'));

        if ($request->file('company_logo')) {
            $file = $request->file('company_logo');
            common::update_media($file, $company->id, 'App\Models\Company', 'company_logo');
        }
        if ($request->file('company_gallery')) {
            $files = $request->file('company_gallery');
            common::update_media($files, $company->id, 'App\Models\Company', 'company_gallery');
        }

        $request->session()->flash('success', 'Selskapet ble oppdatert!');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company->delete();
        Session::flash('success', 'Selskapet ble slettet!');
        return redirect()->back();
    }
}
