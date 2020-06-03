<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use FarhanWazir\GoogleMaps\Facades\GMapsFacade as GMaps;

class MapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // $config = array();
        // $config['center'] = '37.4419, -122.1419';
        // $config['zoom'] = 'auto';
        // $config['places'] = TRUE;
        // $config['placesLocation'] = '37.4419, -122.1419';
        // // $config['placesRadius'] = 200;

        // // $config['trafficOverlay'] = TRUE;
        // // $config['bicyclingOverlay'] = true;
        // // $config['panoramio'] = true;
        // // $config['panoramioTag'] = 'sunset';
        // // $config['map_type'] = 'STREET';
        // // $config['streetViewPovHeading'] = 90;
        // // $config['kmlLayerURL'] = 'http://api.flickr.com/services/feeds/geo/?g=322338@N20&lang=en-us&format=feed-georss';

        // $config['placesAutocompleteInputID'] = 'myPlaceTextBox';
        // $config['placesAutocompleteBoundsMap'] = TRUE; // set results biased towards the maps viewport
        // $config['placesAutocompleteOnChange'] = 'console.log(\'You selected a place\');';
        
        // GMaps::initialize($config);
        // $map = GMaps::create_map();
        return view('user-panel.my-business.map');

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
        //
    }
}
