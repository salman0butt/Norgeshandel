<?php

namespace App\Http\Controllers;

use App\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
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
        return view('media');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $name_unique = date('ymd').'-'.time().'-'.mt_rand(1000000, 9999999);
        if ($request->file('file')) {
            $file = $request->file('file');

            $user_id = 1;
            $fk_type = "";
            $name = "";
            $name_unique = "";
            $type = $file->getClientOriginalExtension();

            $path = 'public/uploads/' . date('Y') . '/' . date('m');

            if ($file->getClientOriginalExtension() == 'jpg' ||
                $file->getClientOriginalExtension() == 'jpeg' ||
                $file->getClientOriginalExtension() == 'png'
            ) {
                $file->move($path, 'profile_' . $user_id . '.' . $file->getClientOriginalExtension());
                copy('public/uploads/index.php', $path . '/index.php');
                User::where('id', $user_id)->update(['image_path' => $path . '/profile_' . $user_id . '.' . $file->getClientOriginalExtension()]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function show(Media $media)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function edit(Media $media)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Media $media)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function destroy(Media $media)
    {
        //
    }

}
