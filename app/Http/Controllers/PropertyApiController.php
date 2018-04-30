<?php

namespace App\Http\Controllers;

use App\Properties;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class PropertyApiController extends BaseController
{
    //use AuthorizesRequests, DispatchesJobs, ValidatesRequests; Let it burn
public $api_key='AIzaSyAUE093iBiOQzc8P527tzFmuJAY5f_m3Hk';
    public function meh(){
        return ['api'=>'endpoint'];
    }
    public function list(){
        return Properties::all();
    }

    public function add(Request $Request){
        $property=new Properties();
        $property->Address1=$Request->input('Address1');
        $property->Address2=$Request->input('Address2');
	$property->City=$Request->input('City');
	$property->Postcode=$Request->input('Postcode');


        $client = new Client();
        $res = $client->get('https://maps.googleapis.com/maps/api/geocode/json?key='.$this->api_key.'&address='.urlencode(implode(',',(array)$Request->all())));
	//echo $res->getStatusCode(); // 200
        if(($response=json_decode($res->getBody(),true))===false){
            return ['status'=>'failed to decode'];
        }
        if($response['status']!=='OK'){
            return ['status'=>'google says no'];
	}
//	print_r($response['results'][0]);
	//	die();
	try{
		$coords=$response['results'][0]['geometry']['location']['lat'].','.$response['results'][0]['geometry']['location']['lng'];
	}catch(\Exception $e){
		return ['status'=>'Malformed response'];
	}
	$property->Coords=$coords;
	try{
		$property->save();
	}catch(\Exception $e){
		return ['status'=>'Database error:'.$e->getMessage()];
	}
        return ['status'=>'ok'];
    }

    public function delete(Request $Request){
	    if(Properties::destroy($Request->get('id'))){
	    	return['status'=>'ok'];
	    };
	    	return['status'=>'No records were deleted'];

    }

    public function search(Request $Request){
        return Properties::where('Address1', 'like', '%'.$Request->get('String').'%')
            ->orWhere('Address2', 'like', '%'.$Request->get('String').'%')
            ->orWhere('City', 'like', '%'.$Request->get('String').'%')
            ->orWhere('Postcode', 'like', '%'.$Request->get('String').'%')
            ->get();
    }

    public function get(Request $Request){
        return Properties::find($Request->get('id'));
    }

    public function clients(){

    }
}
