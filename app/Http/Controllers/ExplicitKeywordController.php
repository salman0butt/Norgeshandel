<?php

namespace App\Http\Controllers;

use App\ExplicitKeyword;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class ExplicitKeywordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $explicit_keywords = ExplicitKeyword::orderBy('id','DESC')->get();
        return view('admin.explicit-keywords.list-explicit-keywords',compact('explicit_keywords'));
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
        $validatedData = $request->validate([
            'value' => 'required|unique:explicit_keywords',
        ]);
        DB::beginTransaction();
        try{
            $explicit_keyword = new ExplicitKeyword($request->all());
            $explicit_keyword->save();
            DB::commit();
            Session::flash('success', 'Record has been added successfully.');
            return back();

        }catch (\Exception $e){
            DB::rollback();
            Session::flash('danger', 'Something went wrong.');
            return back();
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
        $explicit_keyword = ExplicitKeyword::find($id);

        $data = View::make('admin.explicit-keywords.edit-keyword-form',compact('explicit_keyword'))->render();
        $response = array();
        $response['data'] = $data;
        return json_encode($response);
        exit;
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
        $explicit_keyword = ExplicitKeyword::find($id);
        if($explicit_keyword){
            $validatedData = $request->validate([
                'value' => 'required|unique:explicit_keywords,value,'.$id
            ]);

            DB::beginTransaction();
            try{
                $explicit_keyword->update($request->all());
                DB::commit();
                Session::flash('success', 'Record has been updated successfully.');
                return back();

            }catch (\Exception $e){
                DB::rollback();
                Session::flash('danger', 'Something went wrong.');
                return back();
            }

        }else{
            return back()->with(Session::flash('danger', 'Record not found.'));
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
        $explicit_keyword = ExplicitKeyword::find($id);
        if($explicit_keyword){

            DB::beginTransaction();
            try{
                $explicit_keyword->delete();
                DB::commit();
                Session::flash('success', 'Record has been deleted successfully.');
                return back();

            }catch (\Exception $e){
                DB::rollback();
                Session::flash('danger', 'Something went wrong.');
                return back();
            }

        }else{
            return back()->with(Session::flash('danger', 'Record not found.'));
        }
    }
}
