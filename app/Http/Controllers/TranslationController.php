<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TranslationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $blades;
    protected $content;
    public function __construct()
    {
        $this->blades = [
//      removing blade will cause remove translation
//      give path starting after resources\views\
            'common\partials\job-form.blade.php',
            'auth\login.blade.php',
            'auth\retister.blade.php',
            'auth\verified.blade.php',
            'auth\verify.blade.php',
            'layouts\app.blade.php',
        ];
        $this->content = '';
    }

    public function index()
    {

        $path = str_replace('/','\\',$_SERVER['DOCUMENT_ROOT'].'\norgeshandel\resources\views\\');
        foreach ($this->blades as $blade){
            if(file_exists($path.$blade)){
                $this->content .= file_get_contents($path.$blade);
            }
        }
        $strings = $this->get_strings($this->content);
        $translated = json_decode(file_get_contents(resource_path('lang\nb.json')), true);
//        foreach ($json as $key=>$val){
//            echo $key.'=>'.$val.'<br>';
//        }

        return view('translations', compact('strings', 'translated'));
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
        $keys = $request->all()['key'];
        $vals = $request->all()['val'];
        $arr = [];
        for($i=0; $i<count($keys); $i++){
            $arr[$keys[$i]]=$vals[$i];
        }
        $file = fopen(resource_path('lang\nb.json'), 'w');
        fwrite($file, json_encode($arr));
        fclose($file);
        $request->session()->flash('success', 'Translations updated successfully');
        return back();
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
    private function get_strings($content){
        preg_match_all("[\{\{__\('.*\'\)\}\}]",$content, $matches);
//        dd($matches);
        $arr = array();
        foreach ($matches[0] as $match){
            $match = str_replace('\')}}', '', $match);
            $match = str_replace('{{__(\'', '', $match);

            array_push($arr, $match);
        }
        return $arr;
    }
}
