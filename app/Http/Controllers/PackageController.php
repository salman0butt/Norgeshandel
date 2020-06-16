<?php

namespace App\Http\Controllers;

use App\Package;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Session;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages = Package::all();
        return view('admin.packages.list-packages',compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.packages.create-update-package');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try{
            $package = new Package($request->all());
            $package->status = 1;
            $package->save();

            DB::commit();
            return redirect()->route('admin.packages.index')->with('success', 'Package has been created successfully.');
        }catch (\Exception $e){
            DB::rollback();
            return back()->with('danger', 'Something went wrong.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $package = Package::find($id);
       if($package){
           return view('admin.packages.create-update-package',compact('package'));
       }else{
           abort(404);
       }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $package = Package::find($id);
        if($package){
            try{
                $package->update($request->all());
                DB::commit();
                return redirect()->route('admin.packages.index')->with('success', 'Package has been updated successfully.');
            }catch (\Exception $e){
                DB::rollback();
                return back()->with('danger', 'Something went wrong.');
            }
        }else{
            abort(404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
