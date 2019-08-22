<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class RailwayapiController extends Controller
{
	public function index(Request $request)
	 {
	$response = [];
	 	$client = new \GuzzleHttp\Client();
	    $apikey = 'fgfggfgfgfgfgfg';
	    // 12392
	    $validator = Validator::make($request->all(), [
            'train_number' => 'required|numeric|max:5'
        ]);

        if ($validator->fails()) {
            $messages = $validator->messages();
    		return redirect('/getTrainroutes/')->with('message', 'Register Failed');
        }
	    if(!empty($request->train_number)){
	    	// echo "string";die();
		$request = $client->get('https://api.railwayapi.com/v2/route/train/'.$request->train_number.'/apikey/'.$apikey.'/');
	    $response = $request->getBody();//->getContents();
	    /*echo "<pre>";
	    print_r($response);
	    echo "</br>";
	    echo "</br>";
	    echo "</br>";*/
	    $response = json_decode($response);
	}
	    // dd($response);
	    return view('railway/route',compact('response'));
	 } 
}
