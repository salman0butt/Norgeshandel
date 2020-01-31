<?php

namespace App\Http\Controllers;

use App\Taxonomy;
use App\Term;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TaxonomyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $taxonomies = Taxonomy::orderBy('id', 'desc')->get();
        return view('admin.categories.taxonomies', compact('taxonomies'));
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $taxonomy = new Taxonomy(['name' => $request->name, 'slug' => str::slug($request->name)]);
        $taxonomy->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Taxonomy $taxonomy
     * @return \Illuminate\Http\Response
     */
    public function show(Taxonomy $taxonomy)
    {
        $taxonomies = Taxonomy::orderBy('id', 'desc')->get();
        return view('admin.categories.taxonomies', compact('taxonomies', 'taxonomy'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Taxonomy $taxonomy
     * @return \Illuminate\Http\Response
     */
    public function edit(Taxonomy $taxonomy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Taxonomy $taxonomy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Taxonomy $taxonomy)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Taxonomy $taxonomy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Taxonomy $taxonomy)
    {
        //
    }
}
