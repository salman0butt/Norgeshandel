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
//        make sure commented taxonomies are added
//        $taxonomy = new Taxonomy(['name'=>'industry', 'slug'=>str::slug('industry')]);
//        $taxonomy = new Taxonomy(['name'=>'Job Function', 'slug'=>str::slug('Job Function')]);
//        $taxonomy = new Taxonomy(['name'=>'Sector', 'slug'=>str::slug('Sector')]);
//        $taxonomy = new Taxonomy(['name'=>'Commitment type', 'slug'=>str::slug('Commitment type')]);
//        $taxonomy = new Taxonomy(['name'=>'Leadership category', 'slug'=>str::slug('Leadership category')]);
//        $taxonomy->save();
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Taxonomy  $taxonomy
     * @return \Illuminate\Http\Response
     */
    public function show(Taxonomy $taxonomy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Taxonomy  $taxonomy
     * @return \Illuminate\Http\Response
     */
    public function edit(Taxonomy $taxonomy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Taxonomy  $taxonomy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Taxonomy $taxonomy)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Taxonomy  $taxonomy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Taxonomy $taxonomy)
    {
        //
    }
}
