<?php

namespace App\Http\Controllers\Cv;

use App\Models\Cv\CvMeta;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Auth;

class CvMetaController extends Controller
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
        $cv_meta = CvMeta::where('user_id',Auth::id())->where('key',$request->key)->where('value',$request->value)->first();
        if($cv_meta){
            $data['msg'] = 'Cv er allerede på listen.';
            return $data;
            exit();
        }

        DB::beginTransaction();
        try{
            $cv_meta = new CvMeta($request->all());
            $cv_meta->user_id = Auth::id();
            $cv_meta->save();
            DB::commit();
            $data['msg'] = 'Cv er vellykket på listen.';
            return $data;

        }catch (\Exception $e){
            DB::rollback();
            (header("HTTP/1.0 404 Not Found"));
            $data['failure'] = $e->getMessage();
            echo json_encode($data);
            exit();
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cv_meta = CvMeta::find($id);
        if(!$cv_meta || ($cv_meta && $cv_meta->user_id != Auth::id())){
            (header("HTTP/1.0 404 Not Found"));
            $data['failure'] = 'failure';
            echo json_encode($data);
            exit();
        }

        DB::beginTransaction();
        try{
            $cv_meta->delete();
            DB::commit();
            $data['msg'] = 'Cv er vellykket på listen.';
            return $data;

        }catch (\Exception $e){
            DB::rollback();
            (header("HTTP/1.0 404 Not Found"));
            $data['failure'] = $e->getMessage();
            echo json_encode($data);
            exit();
        }
    }
}
