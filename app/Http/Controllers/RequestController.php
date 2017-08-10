<?php


namespace App\Http\Controllers;

use App\Http\Requests ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use App\Models\RequestModel;
use App\User;
use App\Models\Firebase;
class RequestController extends Controller
{
	public function setRequest(Request $request)    // For Rider
  	{
		$data1['pickup']['lat'] = $request->start_lat;	
		$data1['pickup']['long'] = $request->start_long;	
		$data['pickup']=json_encode($data1['pickup']);
		$data1['destination']['lat'] = $request->end_lat;	
		$data1['destination']['long'] = $request->end_long;
		$data['destination']=json_encode($data1['destination']);	
		$res_corp = User::where('role',1)->where('id',$request->passenger_id)->get();
		foreach($res_corp as $row_corp)
		{
            if(isset($row_corp->c_id) && $row_corp->c_id != null && $row_corp->c_id!= "")
			{
				$data['c_id'] = $row_corp->c_id;
			}
			else
			{
				$data['c_id'] = '' ;	
			}
		}

		unset($request['start_lat'],$request['start_long'],$request['end_lat'],$request['end_long']);
		//dd($request->all());
		$id=RequestModel::create($request->all());
		RequestModel::where('id',$id->id)->update($data);
		$result=RequestModel::where('id',$id->id)->get();
		foreach($result as $getRequestData){}
		return response()->json(array($getRequestData));
	}


	public function getRequest(Request $request)   // For Rider
  	{
		$request_id = $request->id;	
		$result=RequestModel::where('id',$request_id)->get();
		foreach($result as $getRequestData){}
		return response()->json(array($getRequestData));
	}
	
	public function updateRequest(Request $request)   //For Driver
  	{
		$request_id = $request->request_id;	
		$data['request_status'] = $request->request_status;	 // "accept" , "no_driver" , "cancel"
		$data['driver_id'] = $request->driver_id;	
		$data1['driver_location']['lat'] = $request->lat;		
		$data1['driver_location']['long'] = $request->long;	
		$data['driver_location']=json_encode($data1);
		$update=RequestModel::where('id',$request_id)->update($data);
		$result=RequestModel::where('id',$request_id)->get();
		foreach($result as $getRequestData){}
		return response()->json(array($getRequestData));
	}

	public function processRequest(Request $request)
	{
		$request_id = $request->request_id;
		$resultRequest=DB::table('request')->where('id',$request_id)->get();
		//$resultRequest=RequestModel::where('id',$request_id)->get();
	    echo "<pre>";
		//print_r($resultRequest);exit;
		foreach($resultRequest as $getRequestData){}
		//print_r($getRequestData);exit;
		$jsonLatLong  = json_decode($getRequestData->pickup);
	            $pickupLat = $jsonLatLong->lat;
		$pickupLong = $jsonLatLong->long;
		$pickupAddress = $getRequestData->pickup_address;
		$dropAddress = $getRequestData->drop_address;
		$passengerId = $getRequestData->passenger_id;
		
		$circle_radius = 3959;
		$max_distance = 20;
		$nearDrivers = DB::select(
            'SELECT * FROM
                (SELECT id, name, email, phone, lat, lang, (' . $circle_radius . ' * acos(cos(radians(' . $pickupLat . ')) * cos(radians(lat)) *
                cos(radians(lang) - radians(' . $pickupLong. ')) +
                sin(radians(' . $pickupLat . ')) * sin(radians(lat))))
                AS distance
                FROM users) AS distances
            WHERE distance < ' . $max_distance . '
            ORDER BY distance;
           ');
		$firebase = new Firebase();
		foreach($nearDrivers as $row)
		{
			$path='drivers_data/'.$row->id;
			$currentStatus = json_decode($firebase->getdata($path));
			if($currentStatus->request->status == 0 && $currentStatus->accept->status == 0){
				$firebase->update(array(
				'request/status' => 1,
				'request/eta' => 1,
				'request/distance' => 1,
				'request/estFare' => 1,
				'request/pickupAddress' => $pickupAddress,
				'request/dropAddress' => $dropAddress,
				'request/req_id' => $request_id,
				'request/rider_id' => $passengerId,
				),'drivers_data/'.$row->id);
			}	
		}
	}


	public function updatereq(Request $request)
	{
		$firebase = new Firebase();
		$path='drivers_data/58dfb254192d2e5256234fde/request/';
		$data=array(
			'status' => 2,
			'eta' => "12 minutes",
			'estFare' => '',
			'distance' => 0,
			'pickupAddress' => '',
			'dropAddress' => '',
			'req_id' => '',
			'rider_id' => ''
			);
		$res=$firebase->setdata($path,$data);
		print_r($res);				// Update driver req status in fb
	}
	


	//calculate miles

	function distance($lat1, $lon1, $lat2, $lon2, $unit) {
	
	  $theta = $lon1 - $lon2;
	  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
	  $dist = acos($dist);
	  $dist = rad2deg($dist);
	  $miles = $dist * 60 * 1.1515;
	  $unit = strtoupper($unit);
	
	  if ($unit == "K") {
	    return ($miles * 1.609344);
	  } else if ($unit == "N") {
	      return ($miles * 0.8684);
	    } else {
	        return $miles;
	      }
	}

	//calculate miles
}

