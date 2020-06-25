<?php

namespace App\Http\Controllers;

use App\Package;
use App\UserPackage;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
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

    //list user packages(user subscribed packages list)
    public function list_user_packages(){
        if(Auth::user()->hasRole('agent')){
            $user_packages = UserPackage::where('user_id',Auth::user()->created_by_company->user_id)->get();
        }else{
            $user_packages = UserPackage::where('user_id',Auth::id())->get();
        }
        return view('user-panel.my-business.list-user-packages',compact('user_packages'));
    }

    //User purchased package
    public function purchase_package($id){
        if(Auth::user()){
            if($id){
                $package = Package::find($id);
                if($package){
                    DB::beginTransaction();
                    try{
                        UserPackage::create([
                            'user_id' => Auth::id(),
                            'package_id' => $package->id,
                            'total_ads' => $package->no_of_ads,
                            'available_ads' => $package->no_of_ads,
                            'total_price' => $package->total_price,
                            'ad_expiry' => $package->ad_expiry,
                            'ad_expiry_unit' => $package->ad_expiry_unit,
                            'purchased_date' => date("Y-m-d"),
                            'status' => 1,
                        ]);

                        DB::commit();
                        Session::flash('success','Pakken er kjøpt!');
                        return redirect(url('my-business/packages'));
                    }catch (\Exception $e){
                        DB::rollback();
                        return back()->with('danger','noe gikk galt!');
                    }
                }else{
                    return back()->with('danger','Pakken ble ikke funnet.');
                }
            }else{
                return back()->with('danger','Prøv igjen senere.');
            }
        }else{
            return redirect('forbidden');
        }
    }


    //list all users packages to admin
    public function all_users_packages(){
        $users_packages = UserPackage::all();
        return view('admin.packages.list-users-packages',compact('users_packages'));
    }
}
