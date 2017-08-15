<?php

    
    namespace App\Http\Controllers;
    
    use App\Http\Requests ;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Input;
    use Illuminate\Support\Facades\DB;
    use App\Models\RequestModel;
    use App\Models\member;
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
            $data['payment_mode'] = $request->payment_mode;
            $data['rider_id'] = $request->userid;
            $data['category'] = urldecode(utf8_encode($request->category));
            $data['pickup_address'] = urldecode(utf8_encode($request->pickup_address));
            $data['drop_address'] = urldecode(utf8_decode($request->drop_address));
            
            if($request->request_type)
            {
                $data['request_type']= $request->request_type;
            }
            else
            {
                $data['request_type']= "normal";
            }
            
            $data['trip_id'] = "" ;
            //for version 1.0 only normal
            $data['ride_type'] = $request->ride_type; // shared // normal // ride_later
            //$data['max_share'] = $request->max_share;
            
            $data['request_status'] = "processing";
            $data['driver_id'] = "";
            $data['payment_mode'] =$data['payment_mode'];
            $data['eta'] = "";
            $data['driver_location'] = "";
            $data['driver_category'] = "";
            $data['created'] = time();
            $data['status'] = "Success";
            $res_corp = member::where('role',1)->where('id',$data['rider_id'])->get();
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
            //echo"<pre>";print_r($data);exit;
            $id=RequestModel::create($data);
            $data['request_id'] = $id->id;
            return response()->json(array($data));
        }
        
        
        public function getRequest(Request $request)   // For Rider
        {
            $request_id = $request['request_id'];
            $result=DB::table('request')->where('id',$request_id)->get();
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
        public function updatereq(Request $request)
        {
            echo "test";
            $firebase = new Firebase();
            $path='drivers_data/58dfb254192d2e5256234fde/request/';
            $data=array(
                        'status' => 3,
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
	public function processRequest(Request $request)
	{ 
                $request_id = $request['request_id'];
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
		//print_r($nearDrivers); 
		$numberofdrivers = sizeof($nearDrivers) ; 
		$i = 0 ;
		if($getRequestData->request_status != 'cancel') { // Don't process if cancelled		
		if($numberofdrivers >=1 ){
                $firebase = new Firebase();
		foreach($nearDrivers as $row)
		{
			$path='drivers_data/'.$row->id;
			//echo $path;
			$currentStatus = json_decode($firebase->getdata($path));
                        //print_r($currentStatus);exit;
			if($currentStatus->request->status == 0 && $currentStatus->accept->status == 0)
			{
            			$path='drivers_data/'.$row->id;
				$data=array(
                        	'request/status' => 1,
                        	'request/eta' => "10 minutes",
                        	'request/estFare' => '5',
                        	'request/distance' => 10,
                        	'request/pickupAddress' => $pickupAddress,
                        	'request/dropAddress' => $dropAddress,
                        	'request/req_id' => $request_id,
                        	'request/rider_id' => $passengerId
                        	);
            			$res=$firebase->updatedata($path,$data);
				for($timer=0; $timer<5; $timer++) 
				{
					$currentStatus = json_decode($firebase->getdata('drivers_data/'.$row->id));
					//print_r($current_status);exit;
					if ($currentStatus->accept->status != 1 ) {
			 		sleep(1);
					}
					else {
					break;	
					}
				}
				$currentStatus = json_decode($firebase->getdata('drivers_data/'.$row->id));
				if($currentStatus->request->status == 1 && $currentStatus->accept->status == 1 && $currentStatus->request->req_id == $request_id)
				{	
					$pickupLatLong  = json_decode($getRequestData->pickup);
                			$pickupLat = $jsonLatLong->lat;
                			$pickupLong = $jsonLatLong->long;
                			$pickupAddress = $getRequestData->pickup_address;
                			$dropAddress = $getRequestData->drop_address;
                			$passengerId = $getRequestData->passenger_id;
					//Need to update everyting into trips table

				}else{
					$pathNA='drivers_data/'.$row->id;//Not accepted
	                                $dataNA=array(
	                                'request/status' => 0,
	                                'request/eta' => "",
        	                        'request/estFare' => '',
                	                'request/distance' => 0,
                        	        'request/pickupAddress' => '',
                                	'request/dropAddress' => '',
                                	'request/req_id' => '',
                                	'request/rider_id' => ''
                                	);
                                	$firebase->updatedata($pathNA,$dataNA);			
					if ($i == $numberofdrivers - 1) {
						//Need to update "no_driver" in request table => where request_id
					}
				}
			}$i++;
		}
		}else{
			//Need to update "no_driver" in request table => where request_id
		}
		}else{
			//Neet to get the value from request table => where request_id
		}
		print_r($nearDrivers); 
        }
        public function getTrips_get()   // For Rider
        {
            
            if(checkisEmpty($this->get()))
            {
                $trip_id = $this->get('trip_id');
                $response_array = array();
                if($this->get('trip_id') === NULL ) //Check whether params are passed
                {
                    $final['status']="Fail";
                    $final['message']="Missing Parameter.";
                    array_push($response_array,$final);
                }
                else
                {
                    
                    $result=$this->Request_model->find_data('trips',array("_id" => new MongoId($trip_id) ) );
                    $get_config = GetLimitConfig();
                    foreach($result as $getTripsData){}
                    $getTripsData['request_id'] = $getTripsData['_id']->{'$id'};
                    $driverData  =  getUserData( 'drivers',  new MongoId($getTripsData['driver_id']) );
                    $driverProfile = $driverData['profile_pic'];
                    $getTripsData['driver_profile'] = $driverProfile;
                    $getTripsData['driver_name'] = $driverData['first_name']." ".$driverData['last_name'];
                    
                    $get_config = GetLimitConfig();
                    
                    
                    if(isset($getTripsData['tax_percentage']))
                    {
                        $getTripsData['tax_percentage'] = $getTripsData['tax_percentage'];
                    }
                    else {
                        $getTripsData['tax_percentage'] = $get_config['tax_percentage'];
                    }
                    
                    if(isset($getTripsData['airport_surge']))
                    {
                        $getTripsData['airport_surge'] = $getTripsData['airport_surge'];
                    }
                    else {
                        $getTripsData['airport_surge'] = $get_config['airport_surge'];
                    }
                    
                    if(isset($getTripsData['book_fee']))
                    {
                        $getTripsData['book_fee'] = $getTripsData['book_fee'];
                    }
                    else {
                        $getTripsData['book_fee'] = $get_config['book_fee'];
                    }
                    
                    if(isset($getTripsData['cancelation_fee']))
                    {
                        $getTripsData['cancelation_fee'] = $getTripsData['cancelation_fee'];
                    }
                    else {
                        $getTripsData['cancelation_fee'] = "0";
                    }
                    
                    if(isset($getTripsData['waypoint_fee']))
                    {
                        $getTripsData['waypoint_fee'] = $getTripsData['waypoint_fee'];
                    }
                    else {
                        $getTripsData['waypoint_fee'] = "0";
                    }
                    
                    
                    if(isset($getTripsData['DestinationWaypoints']))
                    {
                        $getTripsData['DestinationWaypoints'] = $getTripsData['DestinationWaypoints'];
                    }
                    else {
                        
                        $getTripsData['DestinationWaypoints'] = "None";
                    }
                    unset($getTripsData['_id']);
                    array_push($response_array,$getTripsData);
                }
                
            }else{
                $final['status']="Fail";
                $final['message']="Missing Parameter value.";
                array_push($response_array,$final);
            }
            $this->response($response_array, REST_Controller::HTTP_OK);
            
            
        }
        
        public function getDriverTrips_get()   // For Driver
        {
            
            if(checkisEmpty($this->get()))
            {
                $trip_id = $this->get('trip_id');
                $response_array = array();
                if($this->get('trip_id') === NULL ) //Check whether params are passed
                {
                    $final['status']="Fail";
                    $final['message']="Missing Parameter.";
                    array_push($response_array,$final);
                }
                else
                {
                    
                    
                    $result=$this->Request_model->find_data('trips',array("_id" => new MongoId($trip_id) ) );
                    $get_config = GetLimitConfig();
                    foreach($result as $getTripsData){}
                    $getTripsData['request_id'] = $getTripsData['_id']->{'$id'};
                    $riderData  =  getUserData( 'riders',  new MongoId($getTripsData['rider_id']) );
                    $riderProfile = $riderData['profile_pic'];
                    $getTripsData['rider_profile'] = $riderProfile;
                    $getTripsData['rider_name'] = $riderData['first_name']." ".$riderData['last_name'];
                    
                    $get_config = GetLimitConfig();
                    
                    
                    if(isset($getTripsData['tax_percentage']))
                    {
                        $getTripsData['tax_percentage'] = $getTripsData['tax_percentage'];
                    }
                    else {
                        $getTripsData['tax_percentage'] = $get_config['tax_percentage'];
                    }
                    
                    if(isset($getTripsData['airport_surge']))
                    {
                        $getTripsData['airport_surge'] = $getTripsData['airport_surge'];
                    }
                    else {
                        $getTripsData['airport_surge'] = $get_config['airport_surge'];
                    }
                    
                    if(isset($getTripsData['book_fee']))
                    {
                        $getTripsData['book_fee'] = $getTripsData['book_fee'];
                    }
                    else {
                        $getTripsData['book_fee'] = $get_config['book_fee'];
                    }
                    
                    if(isset($getTripsData['company_name']))
                    {
                        $getTripsData['company_name'] = $getTripsData['company_name'];
                    }
                    else {
                        $getTripsData['company_name'] = "None";
                    }
                    
                    if(isset($getTripsData['company_fee']))
                    {
                        $getTripsData['company_fee'] = $getTripsData['company_fee'];
                    }
                    else {
                        $getTripsData['company_fee'] = "0";
                    }
                    
                    if(isset($getTripsData['cancelation_fee']))
                    {
                        $getTripsData['cancelation_fee'] = $getTripsData['cancelation_fee'];
                    }
                    else {
                        $getTripsData['cancelation_fee'] = "0";
                    }
                    
                    if(isset($getTripsData['waypoint_fee']))
                    {
                        $getTripsData['waypoint_fee'] = $getTripsData['waypoint_fee'];
                    }
                    else {
                        $getTripsData['waypoint_fee'] = "0";
                    }
                    
                    if(isset($getTripsData['DestinationWaypoints']))
                    {
                        $getTripsData['DestinationWaypoints'] = $getTripsData['DestinationWaypoints'];
                    }
                    else {
                        
                        $getTripsData['DestinationWaypoints'] = "None";
                    }
                    unset($getTripsData['_id']);
                    
                    array_push($response_array,$getTripsData);
                    //print_r(json_encode(array($data),JSON_UNESCAPED_SLASHES));exit;
                }
                
            }else{
                $final['status']="Fail";
                $final['message']="Missing Parameter value.";
                array_push($response_array,$final);
            }
            $this->response($response_array, REST_Controller::HTTP_OK);
            
            
        }
        
        
        function updateTrips_get()   //For Driver
        {
            
            //echo date('h')."\n";
            $ip = $_SERVER['REMOTE_ADDR'];
            
            $details = json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));
            //echo $details->geoplugin_countryCode;
            
            if($details->geoplugin_countryCode == 'CN')
            {
                $time_now=mktime(date('h')+6,date('i')+00,date('s'));
                $time_now=date('h:i:s A',$time_now);
                $current_time = strtotime($time_now);
            }
            else
            {
                $time_now=mktime(date('h')+3,date('i')+30,date('s'));
                $time_now=date('h:i:s A',$time_now);
                $current_time = strtotime($time_now);
            }
            //echo date("g:i A",$current_time);exit;
            if(checkisEmpty($this->get()))
            {
                $trip_id = $this->get('trip_id');
                $user_id = $this->get('user_id');
                $data['trip_status'] = $this->get('trip_status');	// on,off,end
                $data['accept_status'] = $this->get('accept_status'); // 2=> Arrive ,3=> Begin, 4 => End, 5 => Cancel
                $data['total_distance'] = $this->get('distance');
                
                //$last_ride = $this->get('last_ride');  // ride share - check whether the ride is last or not
                $get_config = GetLimitConfig();
                $price_per_km = $get_config['price_per_km'];
                
                if($this->get('total_amount'))
                {
                    $total_price = ($this->get('total_amount') * 100);
                    
                }else{
                    
                    $total_price = ($price_per_km * $data['total_distance'] * 100);
                }
                
                $response_array = array();
                if($trip_id === NULL || $data['trip_status'] === NULL || $data['accept_status'] === NULL ) //Check whether params are passed
                {
                    $final['status']="Fail";
                    $final['message']="Missing Parameter.";
                    array_push($response_array,$final);
                }
                else
                {
                    
                    require_once APPPATH.'libraries/firebase-php/firebase_config.php';
                    
                    $result=$this->Request_model->find_data('trips',array("_id" => new MongoId($trip_id) ) );
                    foreach($result as $getTripsData){}
                    $getTripsData['trip_id'] = $getTripsData['_id']->{'$id'};
                    unset($getTripsData['_id']);
                    $updatekey = array("_id"=> new MongoId($trip_id));
                    
                    $getData  =  getUserData( 'riders', $getTripsData['rider_id']); // rider details
                    $result_driver_last=$this->Request_model->find_data('drivers',array("_id" => new MongoId($getTripsData['driver_id']) ) );
                    foreach($result_driver_last as $getTripsData_driver){}
                    
                    if($data['accept_status'] == 4 || $data['accept_status'] == 5){   // Ending the trip; clear all status for driver
                        
                        
                        $drop_price="0";
                        
                        $result_category=$this->Request_model->find_data('category',array("categoryname" => $getTripsData['car_category']));
                        foreach($result_category as $getCategoryData){}
                        
                        if(isset($getCategoryData['drop_price'])){
                            $drop_price = $getCategoryData['drop_price'];
                        }
                        
                        //Cancelling the Trip
                        if($data['accept_status'] == 5){
                            
                            if($user_id === NULL){}
                            else{
                                
                                $isRider = $this->mongo_db->db->riders->find(array('_id'=>new MongoId($user_id)));
                                
                                
                                if($isRider->count()>0)
                                {
                                    
                                    $tripAcceptedTime = $getTripsData['created'];
                                    $cancelationTime="5";
                                    $cancelationFee="0";
                                    
                                    if(isset($getCategoryData['cancellation_fee_time'])){
                                        $cancelationTime = $getCategoryData['cancellation_fee_time'];
                                    }
                                    
                                    if(isset($getCategoryData['cancellation_fee'])){
                                        $cancelationFee = $getCategoryData['cancellation_fee'];
                                    }
                                    
                                    
                                    $cancelTime = time();
                                    $difference = $cancelTime - $tripAcceptedTime;
                                    $difference_minute =  $difference/60;
                                    $interval_minute = intval($difference_minute);
                                    
                                    
                                    if($total_price==0){
                                        
                                        $cancelationFee = ($cancelationFee*100);
                                    }
                                    
                                    if((int)$interval_minute > (int)$cancelationTime){
                                        
                                        $total_price = $total_price + $cancelationFee;
                                        
                                    }
                                }
                                
                            }
                            
                        }
                        
                        // Payment process
                        if($getTripsData['payment_mode'] == "stripe"){
                            require_once APPPATH.'libraries/stripe/init.php';
                            $get_settings = GetSettings();
                            \Stripe\Stripe::setApiKey($get_settings['Test_ApiKey']);
                            
                            $customer_id = $getData['s_customerid'];
                            $charge = \Stripe\Charge::create(array(
                                                                   'customer' => $customer_id,
                                                                   'amount'   => $total_price,
                                                                   'currency' => 'sgd'
                                                                   ));
                            $data_finance['s_transid'] = $charge ->id ;
                        }
                        $firebase->update(array(
                                                'request/status' => 0,
                                                'request/eta' => 0,
                                                'request/estFare' => '',
                                                'request/distance' => 0,
                                                'request/pickupAddress' => '',
                                                'request/dropAddress' => '',
                                                'request/req_id' => '',
                                                'accept/status' => 0,
                                                'request/rider_id' => '',
                                                'accept/trip_id' => ''
                                                ),'drivers_data/'.$getTripsData['driver_id']);	// Update driver req status as not accepted fb
                        
                        $data_finance['total_price']  = ($total_price/100);
                        $data_finance['total_distance'] = $data['total_distance'];
                        $data_finance['payment_status'] = 'Not completed';
                        $data_finance['trip_status'] = $data['trip_status'];
                        $data_finance['accept_status'] = $data['accept_status'];
                        $data_finance['payment_mode'] = $getTripsData['payment_mode'];
                        $data_finance['update_created'] = time();
                        $data_finance['referral_amount_driver'] = 0 ;
                        $data_finance['referral_amount_rider'] = 0 ;
                        
                        
                        $data_finance['end_time'] = date("g:00 A", strtotime('+1 hours', $current_time));
                        
                        $result_surge=$this->mongo_db->db->surge_price->find(array("start_time"=>$getTripsData['start_time'],"end_time"=>$data_finance['end_time']));
                        if($result_surge->count() > 0)
                        {
                            foreach($result_surge as $row)
                            {
                                $data_finance['percentage'] = $row['percentage'];
                            }
                        }
                        else
                        {
                            $data_finance['percentage'] = 0;
                        }
                        
                        
                        if($data['accept_status'] == 4){
                            
                            /// update admin commission //
                            $get_config = GetLimitConfig();
                            $commission_percentage = $get_config['commission_percentage'];
                            $commission_amount = floatval(($data_finance['total_price'] * $commission_percentage) / 100);
                            $commission_amount = number_format($commission_amount,2);
                            
                            $data_finance['tax_percentage'] = $get_config['tax_percentage'];
                            $data_finance['airport_surge'] = $get_config['airport_surge'];
                            $data_finance['book_fee'] = $get_config['book_fee'];
                            $data_finance['admin_commission'] = $commission_amount;
                            $data_finance['waypoint_fee'] = $drop_price;
                            
                            
                        }
                        else {
                            
                            $data_finance['tax_percentage'] = "0";
                            $data_finance['airport_surge'] = "0";
                            $data_finance['book_fee'] = "0";
                            $data_finance['admin_commission'] = "0";
                            $data_finance['cancelation_fee'] = $cancelationFee;
                            
                        }
                        
                        
                        /// update Company commission //
                        $result_details = $this->mongo_db->db->drivers->find(array('_id'=>new MongoId($getTripsData['driver_id'])));
                        
                        foreach($result_details as $item) {
                            
                            if(isset($item['company_id'])){
                                
                                $company_id=$item['company_id']->{'$id'};
                                
                                $company_details = $this->mongo_db->db->company->find(array('_id'=>new MongoId($company_id)));
                                
                                foreach($company_details as $companyitem) {
                                    
                                    if(isset($companyitem['companyname'])){
                                        
                                        $data_finance['company_name']=$companyitem['companyname'];
                                        
                                        if($data['accept_status'] == 4){
                                            
                                            if(isset($companyitem['percentage'])){
                                                
                                                $data_finance['company_fee']=$companyitem['percentage'];
                                                
                                            }else{
                                                
                                                $data_finance['company_fee']="0";
                                            }
                                        }else{
                                            
                                            $data_finance['company_fee']="0";
                                        }
                                        
                                        
                                    }else {
                                        
                                        $data_finance['company_name']="None";
                                        $data_finance['company_fee']="0";
                                    }
                                }
                                
                                
                            }else{
                                
                                $data_finance['company_name']="None";
                                $data_finance['company_fee']="0";
                                
                            }
                        }
                        
                        /// end ///
                        
                        
                        if($this->get('end_lat'))
                        {
                            $data_finance['destination']['lat'] = $this->get('end_lat');
                        }
                        if($this->get('end_long'))
                        {
                            $data_finance['destination']['long'] = $this->get('end_long');
                        }
                        if(urldecode(utf8_decode($this->get('drop_address'))))
                        {
                            $data_finance['drop_address'] = urldecode(utf8_decode($this->get('drop_address')));
                        }
                        
                        $this->Request_model->update_trips($updatekey, $data_finance);
                        
                        if($data['accept_status'] == 4){
                            
                            /// update referral amount for both rider & driver///
                            
                            
                            $setting_image = $this->mongo_db->db->settings->find();
                            
                            if($setting_image->hasNext())
                            {
                                foreach($setting_image as $documentimage)
                                {
                                    $admin_mail   = $documentimage['admin_mail'];
                                    $title = $documentimage['title'];
                                }
                            }else{
                                $admin_mail = "productcogz@gmail.com";
                                $title = "SIX";
                            }
                            
                            $from_email = $admin_mail ;
                            
                            
                            if(isset($getData['referral_code_used']))
                            {
                                $ref_code_rider = $getData['referral_code_used'] ;
                                $user == "rider";
                                updateRefAmount($trip_id,$data_finance['total_price'],$ref_code_rider,$user);
                                
                                
                                $email = $getData['email'];
                                $splvars = array("{username}"=> $getData['first_name']);
                                $code = "referral_rider";
                                //$mail_result = $this->Email_model->sendMail($email,$from_email,$title,$splvars,$code);
                                
                            }
                            
                            /// rider
                            if(isset($getTripsData_driver['referral_code_used']))
                            {
                                $user == "driver";
                                $ref_code_driver = $getTripsData_driver['referral_code_used'] ;
                                updateRefAmount($trip_id,$data_finance['total_price'],$ref_code_driver,$user);
                                
                                $email = $getTripsData_driver['email'];
                                $splvars = array("{username}"=> $getTripsData_driver['first_name']);
                                $code = "referral_driver";
                                //$mail_result = $this->Email_model->sendMail($email,$from_email,$title,$splvars,$code);
                            } // driver
                            
                            /// end update referral amount ///
                            
                            if($user_id===NULL){
                                
                            }else{
                                
                                $total_Amount=$data_finance['total_price'];
                                $admin_comm_Amount=$data_finance['admin_commission'];
                                updateDriverEarn($user_id,$total_Amount);
                                
                                
                                $result = $this->mongo_db->db->drivers->find(array("_id"=>new MongoId($user_id)));
                                
                                foreach($result as $item) {
                                    
                                    if(isset($item['total_trips_daily'])){
                                        
                                        $total_trips_daily = $item['total_trips_daily'];
                                    }else{
                                        $total_trips_daily = 0;
                                    }
                                    
                                    if(isset($item['admin_commission_daily'])){
                                        
                                        $admin_commission_daily = $item['admin_commission_daily'];
                                    }else{
                                        $admin_commission_daily = 0;
                                    }
                                    
                                    
                                    
                                    if(isset($item['total_trips_weekly'])){
                                        
                                        $total_trips_weekly = $item['total_trips_weekly'];
                                    }else{
                                        $total_trips_weekly = 0;
                                    }
                                    
                                    if(isset($item['admin_commission_weekly'])){
                                        
                                        $admin_commission_weekly = $item['admin_commission_weekly'];
                                    }else{
                                        $admin_commission_weekly = 0;
                                    }
                                    
                                    
                                    if(isset($item['total_trips_monthly'])){
                                        
                                        $total_trips_monthly = $item['total_trips_monthly'];
                                    }else{
                                        $total_trips_monthly = 0;
                                    }
                                    
                                    if(isset($item['admin_commission_monthly'])){
                                        
                                        $admin_commission_monthly = $item['admin_commission_monthly'];
                                    }else{
                                        $admin_commission_monthly = 0;
                                    }
                                    
                                    
                                    if(isset($item['total_trips_yearly'])){
                                        
                                        $total_trips_yearly = $item['total_trips_yearly'];
                                    }else{
                                        $total_trips_yearly = 0;
                                    }
                                    
                                    if(isset($item['admin_commission_yearly'])){
                                        
                                        $admin_commission_yearly = $item['admin_commission_yearly'];
                                    }else{
                                        $admin_commission_yearly = 0;
                                    }
                                    
                                    
                                }
                                $plusone=1;
                                $data['total_trips_daily'] = $total_trips_daily+$plusone;
                                $data['admin_commission_daily'] = $admin_commission_daily + $admin_comm_Amount;
                                
                                $data['total_trips_weekly'] = $total_trips_weekly+$plusone;
                                $data['admin_commission_weekly'] = $admin_commission_weekly + $admin_comm_Amount;
                                
                                $data['total_trips_monthly'] = $total_trips_monthly+$plusone;
                                $data['admin_commission_monthly'] = $admin_commission_monthly + $admin_comm_Amount;
                                
                                $data['total_trips_yearly'] = $total_trips_yearly+$plusone;
                                $data['admin_commission_yearly'] = $admin_commission_yearly + $admin_comm_Amount;
                                
                                $this->mongo_db->db->drivers->update(array("_id"=>new MongoId($user_id)),array('$set'=>$data));
                            }
                            
                            /// update the driver ride share details for last ride
                            
                            if(isset($getTripsData_driver['is_share']))
                            {
                                if($getTripsData_driver['is_share'] == "yes")
                                {
                                    if($getTripsData_driver['used_share']==$getTripsData_driver['max_share'])
                                    {
                                        $updatekey = array("_id"=> new MongoId($getTripsData['driver_id']));
                                        $update_data_req['is_share'] = "";
                                        $update_data_req['used_share'] = 0;
                                        $update_data_req['max_share'] = 0;
                                        $this->Drivers_model->update_driver($updatekey, $update_data_req);
                                    }
                                }
                                
                            }
                            // end
                            
                            $start_lat = $getTripsData['pickup']['lat'];
                            $start_lng = $getTripsData['pickup']['long'];
                            $end_lat = $getTripsData['destination']['lat'];
                            $end_lng = $getTripsData['destination']['long'];
                            
                            $start_map_icon = base_url().'image_home/start_loc.png';
                            $end_map_icon = base_url().'image_home/end_loc.png';
                            
                            $get_direction_url = 'https://maps.googleapis.com/maps/api/directions/json?origin='."$start_lat".','.$start_lng.'&destination='."$end_lat".','.$end_lng.'&mode=driving&key=AIzaSyC7_SQvUhme8s7M-RXalrKX1GxckAEoN6o';
                            
                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, $get_direction_url);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($ch, CURLOPT_POST, false);
                            $dir_points = curl_exec($ch);
                            curl_close($ch);
                            //print_r($dir_points); exit ;
                            $googleDirection = json_decode($dir_points, true);
                            @$polyline = urlencode($googleDirection['routes'][0]['overview_polyline']['points']);
                            
                            @$map_img = 'https://maps.googleapis.com/maps/api/staticmap?key=AIzaSyC7_SQvUhme8s7M-RXalrKX1GxckAEoN6o&size=640x300
                            &path=fillcolor:0xAA000033%7Cenc:'.$polyline.'&format=png
                            &markers=icon:'.$start_map_icon.'|'.$start_lat.','.$start_lng.'
                            &markers=icon:'.$end_map_icon.'|'.$end_lat.', '.$end_lng.'&sensor=false&maptype=roadmap
                            &style=feature:water|element:geometry.fill|weight:3.3|hue:|lightness:95|saturation:93|gamma:0.1|color:0x5cb8e4';
                            
                            //$map_img = 'https://maps.googleapis.com/maps/api/staticmap?key=AIzaSyC7_SQvUhme8s7M-RXalrKX1GxckAEoN6o&size=640x300&path=enc:'.$polyline.'color:0x54B6F7ff|weight:5|&format=png&markers=icon:'.$start_map_icon.'|'.$start_lat.','.$start_lng.'&markers=icon:'.$end_map_icon.'|'.$end_lat.', '.$end_lng.'&sensor=false&maptype=roadmap&style=feature:water|element:geometry.fill|weight:3.3|hue:|lightness:95|saturation:93|gamma:0.1|color:0x5cb8e4';
                            //$map_img = 'https://maps.googleapis.com/maps/api/staticmap?key=AIzaSyC7_SQvUhme8s7M-RXalrKX1GxckAEoN6o&size=600x300&path=color:0x54B6F7ff|weight:5|'.$start_lat.', '.$start_lng.'|'.$end_lat.', '.$end_lng.'&format=png&markers=icon:http://www.donpedrolake.com/sites/all/themes/perspective/favicon.ico|'.$start_lat.','.$start_lng.'&markers=icon:https://img1-secure.targetimg1.com/wcsstore/marketing/com/mobile/images/template/favicon-32x32.png|'.$end_lat.', '.$end_lng.'&sensor=false&maptype=roadmap&style=feature:water|element:geometry.fill|weight:3.3|hue:|lightness:95|saturation:93|gamma:0.1|color:0x5cb8e4';
                            
                            if(isset($getData['first_name']))
                                $ridername = $getData['first_name'];
                            else
                                $ridername = '';
                            
                            if(isset($getTripsData_driver['profile_pic']))
                                $driver_pic = $getTripsData_driver['profile_pic'];
                            else
                                $driver_pic = '';
                            
                            if(isset($getTripsData_driver['first_name']))
                                $driver_name = $getTripsData_driver['first_name'];
                            else
                                $driver_name = '';
                            
                            $start_time = $getTripsData['start_time'];
                            
                            $end_time = $getTripsData['end_time'];
                            
                            $start = new \DateTime("2016-09-28 ".$start_time);
                            $end   = new \DateTime("2016-09-28 ".$end_time);
                            
                            $interval = $end->diff($start);
                            
                            $time = sprintf(
                                            '%d:%02d:%02d',
                                            ($interval->d * 24) + $interval->h,
                                            $interval->i,
                                            $interval->s
                                            );
                            
                            $pickup_address = $getTripsData['pickup_address'];
                            $drop_address = $getTripsData['drop_address'];
                            $trip_date = date('F d, Y', $getTripsData['update_created']);
                            
                            $miles = round($this->distance($start_lat, $start_lng, $end_lat, $end_lng, "M"),3);
                            
                            $car_category = $getTripsData['car_category'];
                            
                            $mapicon = base_url().'image_home/mapicon.png';
                            
                            $email = $getData['email'];
                            $splvars = array("{username}"=> $getData['first_name'],"{img}"=> $map_img,"{totalprice}"=> $getTripsData['total_price'],"{rider_name}"=> $ridername,"{trip_date}"=> $trip_date,"{start_time}"=> $start_time,"{end_time}"=> $end_time,"{pickup_address}"=> $pickup_address,"{drop_address}"=> $drop_address,"{mapicon}"=> $mapicon,"{driver_profile_pic}"=> $driver_pic,"{driver_name}"=> $driver_name,"{miles}"=> $miles,"{trip_time}"=> $time,"{car_category}"=> $car_category);
                            $code = "end_trip";
                            $mail_result = $this->Email_model->sendMail($email,$from_email,$title,$splvars,$code);
                            
                        }
                        
                    }
                    else{
                        
                        if($data['accept_status'] == 3)
                        {
                            $data_finance['start_time'] = date("g:00 A",$current_time);
                        }
                        
                        $data_finance['total_price'] = ($total_price/100);
                        $data_finance['total_distance'] = $data['total_distance'];
                        $data_finance['payment_status'] = 'Not completed';
                        $data_finance['trip_status'] = $data['trip_status'];
                        $data_finance['accept_status'] = $data['accept_status'];
                        $data_finance['payment_mode'] = $getTripsData['payment_mode'];
                        $data_finance['update_created'] = time();
                        $data_finance['referral_amount_driver'] = 0 ;
                        $data_finance['referral_amount_rider'] = 0 ;
                        
                        /// update admin commission //
                        $get_config = GetLimitConfig();
                        $commission_percentage = $get_config['commission_percentage'];
                        $commission_amount = floatval(($data_finance['total_price'] * $commission_percentage) / 100);
                        $commission_amount = number_format($commission_amount,2);
                        
                        $data_finance['admin_commission'] = $commission_amount ;
                        /// end ///
                        
                        if($this->get('end_lat'))
                        {
                            $data_finance['destination']['lat'] = $this->get('end_lat');	
                        }
                        if($this->get('end_long'))
                        {
                            $data_finance['destination']['long'] = $this->get('end_long');
                        }
                        if($this->get('drop_address'))
                        {
                            $data_finance['drop_address'] = urldecode(utf8_decode($this->get('drop_address')));						
                        }
                        
                        $this->Request_model->update_trips($updatekey, $data_finance);
                        
                        /// update referral amount for both rider & driver///
                        
                        if(isset($getData['referral_code_used']))
                        {
                            $ref_code_rider = $getData['referral_code_used'] ;
                            updateRefAmount($trip_id,$data_finance['total_price'],$ref_code_rider);							
                        } /// rider
                        if(isset($getTripsData_driver['referral_code_used']))
                        {
                            $ref_code_driver = $getTripsData_driver['referral_code_used'] ;
                            updateRefAmount($trip_id,$data_finance['total_price'],$ref_code_driver);							
                        } // driver
                        
                        /// end update referral amount ///
                        
                        if($user_id===NULL){
                            
                        }else{
                            
                            $total_Amount=$data_finance['total_price'];
                            updateDriverEarn($user_id,$total_Amount);
                        }
                        
                    }
                    $result=$this->Request_model->find_data('trips',array("_id" => new MongoId($trip_id) ) );
                    foreach($result as $getTripsData){}
                    $getTripsData['trip_id'] = $getTripsData['_id']->{'$id'};
                    unset($getTripsData['_id']);
                    array_push($response_array,$getTripsData);
                    
                }
                
            }else{
                $response_array = array();
                $final['status']="Fail";
                $final['message']="Missing Parameter value.";	
                array_push($response_array,$final);
            }
            $this->response($response_array, REST_Controller::HTTP_OK);
            
            
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
        
        
        public function rideLater_get()
        {
            if(checkisEmpty($this->get()))
            {
                $response_array = array();
                
                $data['pickup']['lat'] = $this->get('start_lat');	
                $data['pickup']['long'] = $this->get('start_long');	
                $data['destination']['lat'] = $this->get('end_lat');	
                $data['destination']['long'] = $this->get('end_long');	
                $data['payment_mode'] = $this->get('payment_mode');	
                $data['rider_id'] = $this->get('userid');	
                $data['category'] = $this->get('category');	
                $data['pickup_address'] = urldecode(utf8_encode($this->get('pickup_address')));	
                $data['drop_address'] = urldecode(utf8_decode($this->get('drop_address')));	
                $data['trip_id'] = "" ; 
                $data['ride_type'] = "ride_later";
                //echo strtotime(urldecode(utf8_encode($this->get('date_time'))));
                $data['ride_date_time'] = strtotime(urldecode(utf8_encode($this->get('date_time'))));
                
                $data_check = array('ride_date_time'=> $data['ride_date_time'],'ride_type'=>$data['ride_type']);
                $result_ride=$this->Request_model->find_data('request',$data_check);
                if($result_ride->count() > 0)
                {
                    $final['status']="Fail";
                    $final['message']="Already added the ride on this time.";
                    array_push($response_array,$final);	
                    $this->response($response_array, REST_Controller::HTTP_OK);
                    exit;	
                } 	
                
                
                if($this->get('category') === NULL || $this->get('userid') === NULL || $data['pickup']['lat'] === NULL || $data['pickup']['long']=== NULL || $data['destination']['lat'] === NULL || $data['destination']['long'] === NULL  || $data['payment_mode'] === NULL ) //Check whether params are passed
                {
                    
                    $final['status']="Fail";
                    $final['message']="Missing Parameter.";
                    array_push($response_array,$final);
                    
                }else{
                    
                    $data['driver_id'] = "";
                    $data['eta'] = "";
                    $data['driver_location'] = "";
                    $data['driver_category'] = "";
                    $data['created'] = time();
                    $result=$this->Request_model->insert_data('request', $data);
                    $data['request_id'] = $data['_id']->{'$id'};
                    unset($data['_id']);
                    
                    $final['status']="Success";
                    $final['request_id']=$data['request_id'];	
                    $final['car_category']=$data['category'];	
                    array_push($response_array,$final);
                    
                }
                ///// end
            }else
            {
                $final['status']="Fail";
                $final['message']="Missing Parameter value.";	
                array_push($response_array,$final);
            }
            $this->response($response_array, REST_Controller::HTTP_OK);
        }
        
        
        public function rideLaterList_get()
        {
            if(checkisEmpty($this->get()))
            {
                
                $data_check['rider_id'] = $this->get('rider_id');
                $data_check['ride_type'] = "ride_later";
                
                $created = time();
                $data_check['ride_date_time'] = array('$gte'=>$created);
                
                $response_array = array();
                
                if($this->get('rider_id') === NULL)   // Check whether params are passed
                {
                    
                    $final['status']="Fail";
                    $final['message']="Missing Parameter.";
                    array_push($response_array,$final);
                    $this->response($response_array, REST_Controller::HTTP_OK);
                    
                }else{
                    
                    $result_ride=$this->Request_model->find_data('request',$data_check);
                    if($result_ride->count() > 0)
                    {
                        $i=0;
                        foreach($result_ride as $getTripsData){
                            $final[$i]['status']="success";
                            $final[$i]['request_id'] = $getTripsData['_id']->{'$id'};
                            $final[$i]['rider_id'] = $getTripsData['rider_id'];
                            $final[$i]['pickup_location'] = $getTripsData['pickup_address'];					
                            $final[$i]['dropup_location'] = $getTripsData['drop_address'];
                            $final[$i]['ride_date_time'] = date('d-m-Y H:i:s A',$getTripsData['ride_date_time']);
                            $final[$i]['category']= $getTripsData['category'];
                            $final[$i]['status']="Success";
                            unset($getTripsData['_id']);
                            $i++;	
                        }
                        print_r(json_encode(($final),JSON_UNESCAPED_SLASHES));exit;
                        
                    }
                    else
                    {
                        $final['status']="Fail";
                        $final['message']="No record found";	
                        array_push($response_array,$final);
                        $this->response($response_array, REST_Controller::HTTP_OK);
                    }
                    
                }
                ///// end
            }else
            {
                $final['status']="Fail";
                $final['message']="Missing Parameter value.";	
                array_push($response_array,$final);
                $this->response($response_array, REST_Controller::HTTP_OK);
            }
        }
        
        public function yourTrips_get()   // For Rider
        {
            
            $response_array = array();
            if(checkisEmpty($this->get()))
            {
                $userid = $this->get('userid');	
                
                if($userid === NULL ) //Check whether params are passed
                {
                    $final['status']="Fail";
                    $final['message']="Missing Parameter.";
                    array_push($response_array,$final);
                    $this->response($response_array, REST_Controller::HTTP_OK);
                }
                else
                {
                    
                    $result=$this->Request_model->find_data('trips',array("rider_id" => $userid ) );
                    if($result->count() > 0)
                    {
                        $i = 0 ;
                        foreach($result as $getTripsData){
                            $driverData  =  getUserData( 'drivers',  new MongoId($getTripsData['driver_id']) );
                            $driverProfile = $driverData['profile_pic'];
                            $final[$i]['trip_id'] = $getTripsData['_id']->{'$id'};					
                            $final[$i]['driver_profile'] = $driverProfile;
                            $final[$i]['driver_name'] = $driverData['first_name']." ".$driverData['last_name'];
                            
                            $final[$i]['pickup_address'] = $getTripsData['pickup_address'];					
                            $final[$i]['drop_address'] = $getTripsData['drop_address'];
                            
                            $final[$i]['car_category'] = $getTripsData['car_category'];					
                            $final[$i]['created'] = date("d-m-Y",$getTripsData['created']);
                            $final[$i]['total_price'] = $getTripsData['total_price'];	
                            if(isset($getTripsData['payment_mode']))
                            {
                                $final[$i]['payment_mode'] = $getTripsData['payment_mode'];	
                            }					
                            $final[$i]['status']="success";
                            unset($getTripsData['_id']);
                            
                            $i++;
                        }
                        print_r(json_encode(($final),JSON_UNESCAPED_SLASHES));exit;
                        
                    }else{
                        $final['status']="Fail";
                        $final['message']="No record found";
                        array_push($response_array,$final);	
                        $this->response($response_array, REST_Controller::HTTP_OK);		
                    }
                    
                }
                
            }else{
                $final['status']="Fail";
                $final['message']="Missing Parameter value.";
                array_push($response_array,$final);	
                $this->response($response_array, REST_Controller::HTTP_OK);
            }
            
            
        } 
        
        public function yourTripsDriver_get()   // For Driver
        {
            
            $response_array = array();
            if(checkisEmpty($this->get()))
            {
                $userid = $this->get('userid');	
                
                if($userid === NULL ) //Check whether params are passed
                {
                    $final['status']="Fail";
                    $final['message']="Missing Parameter.";
                    array_push($response_array,$final);
                    $this->response($response_array, REST_Controller::HTTP_OK);
                }
                else
                {
                    
                    $result=$this->Request_model->find_data('trips',array("driver_id" => $userid ) );
                    if($result->count() > 0)
                    {
                        $i = 0 ;
                        foreach($result as $getTripsData){
                            $riderData  =  getUserData( 'riders',  new MongoId($getTripsData['rider_id']) );
                            $riderProfile = $riderData['profile_pic'];
                            $final[$i]['trip_id'] = $getTripsData['_id']->{'$id'};					
                            $final[$i]['rider_profile'] = $riderProfile;
                            $final[$i]['rider_name'] = $riderData['first_name']." ".$driverData['last_name'];
                            
                            $final[$i]['pickup_address'] = $getTripsData['pickup_address'];					
                            $final[$i]['drop_address'] = $getTripsData['drop_address'];
                            
                            $final[$i]['car_category'] = $getTripsData['car_category'];					
                            $final[$i]['created'] = date("d-m-Y",$getTripsData['created']);
                            $final[$i]['created_timestamp'] = $getTripsData['created'];
                            $final[$i]['update_created'] = $getTripsData['update_created'];
                            $final[$i]['admin_commission'] = $getTripsData['admin_commission'];
                            $final[$i]['total_price'] = $getTripsData['total_price'];	
                            
                            if(isset($getTripsData['company_name']))
                            {
                                $final[$i]['company_name'] = $getTripsData['company_name'];	
                            }	
                            else {
                                $final[$i]['company_name'] = "None";
                            }
                            
                            if(isset($getTripsData['company_fee']))
                            {
                                $final[$i]['company_fee'] = $getTripsData['company_fee'];	
                            }	
                            else {
                                $final[$i]['company_fee'] = "0";
                            }
                            
                            if(isset($getTripsData['payment_mode']))
                            {
                                $final[$i]['payment_mode'] = $getTripsData['payment_mode'];	
                            }	
                            
                            
                            $final[$i]['status']="success";
                            unset($getTripsData['_id']);
                            
                            $i++;
                        }
                        print_r(json_encode(($final),JSON_UNESCAPED_SLASHES));exit;
                        
                    }else{
                        $final['status']="Fail";
                        $final['message']="No record found";
                        array_push($response_array,$final);	
                        $this->response($response_array, REST_Controller::HTTP_OK);		
                    }
                    
                }
                
            }else{
                $final['status']="Fail";
                $final['message']="Missing Parameter value.";
                array_push($response_array,$final);	
                $this->response($response_array, REST_Controller::HTTP_OK);
            }
            
            
        }
        
        public function triggerRide_get()
        {
            $response_array = array();				
            $created_from = strtotime("00:00:00");	
            $created_to = strtotime("+1 day",$created_from);
            
            $current_time = strtotime(date('d-m-Y H:i',time()));
            
            $data_request = $this->Request_model->find_data('request',array("ride_type" => 'ride_later','ride_date_time'=> array('$gte'=>$created_from,'$lt'=>$created_to) ) );		
            if($data_request->count()>0)
            {
                require_once APPPATH.'libraries/firebase-php/firebase_config.php';
                foreach($data_request as $getTripsData){
                    
                    $trip_time = $getTripsData['ride_date_time'];
                    $rider_id = $getTripsData['rider_id'];
                    $request_id = $getTripsData['_id']->{'$id'};
                    $timestamp = strtotime(date('d-m-Y H:i',$trip_time));
                    $timestamp_before = strtotime('-30 minutes',$timestamp);
                    if($current_time == $timestamp_before)
                    {
                        /// update the ride data for push notification in firebase for ride later
                        $firebase->update(array(
                                                'status' => "ready_for_ride"
                                                ),'ride_later/'.$rider_id.'/'.$request_id); 
                        /// end			
                    }		
                    
                    if($current_time == $timestamp)
                    {
                        /// update the ride data in firebase for ride later
                        $firebase->update(array(
                                                'status' => "request"
                                                ),'ride_later/'.$rider_id.'/'.$request_id); 
                        /// end			
                    }
                    unset($getTripsData['_id']);
                    
                }
                $final['status']="success";
                array_push($response_array,$final);			
            }else{
                $final['status']="Fail";
                $final['message']="No data found";	
                array_push($response_array,$final);
            }
            $this->response(array($response_array), REST_Controller::HTTP_OK);
            echo "<b>Cron executed successfully</b>";
            exit;
            
        } 		
        
        
        public function updateRideLater_get()
        {
            $response_array = array();				
            if(checkisEmpty($this->get()))
            {
                $rider_id = $this->get('rider_id');	
                $request_id = $this->get('request_id');
                
                if($rider_id === NULL && $request_id === NULL) //Check whether params are passed
                {
                    $final['status']="Fail";
                    $final['message']="Missing Parameter value.";
                }
                else
                {
                    $data_request = $this->Request_model->find_data('request',array("_id" => new MongoId($request_id)) );		
                    if($data_request->count()>0)
                    {
                        require_once APPPATH.'libraries/firebase-php/firebase_config.php';
                        /// empty the status of ride data in firebase for ride later
                        $firebase->update(array(
                                                'status' => ""
                                                ),'ride_later/'.$rider_id.'/'.$request_id); 
                        /// end	
                        $final['status']="Success";
                        $final['message']="Updated";	
                    }else{
                        $final['status']="Fail";
                        $final['message']="No request found";	
                    }
                    
                }
            }else{
                $final['status']="Fail"; 
                $final['message']="Missing Parameter.";
            }
            array_push($response_array,$final);
            $this->response($response_array, REST_Controller::HTTP_OK);
        } 
        
        function cron_corp_get()
        {
            $updatekey = array("c_id"=> array('$exists'=>true,'$ne'=>''));
            $update_data = array('coporate_payment_status'=> 'Not completed');
            $this->mongo_db->db->trips->update($updatekey,array('$set'=>$update_data), array("multiple" => true));
            
        }
        
        
        public function getReferralUserList_get(){
            
            $response_array = array();	
            
            if(checkisEmpty($this->get()))
            {
                
                $user_id=$this->get('user_id');
                
                if($user_id === NULL) //Check whether params are passed
                {
                    $final['status']="Fail";
                    $final['message']="Missing Parameter value.";
                    
                    array_push($response_array,$final);
                }
                else
                {
                    
                    $data_array = array('referral_ownerid'=>$user_id);
                    $result=$this->Drivers_model->find_data('referral_data', $data_array);
                    
                    
                    if($result->hasNext())
                    {
                        foreach($result as $document)
                        {
                            //Referral Code Owner Details	
                            $refdata['status']="Success";				 									
                            $refdata['user_id']=$document["userid"];
                            $user_type=$document["user_type"];
                            
                            $data_array = array("_id" => new MongoId($refdata['user_id']));
                            
                            if($user_type=="Rider"){
                                
                                $result=$this->Rider_model->find_data('riders', $data_array);
                                
                            }else{
                                
                                $result=$this->Drivers_model->find_data('drivers', $data_array);
                                
                            }
                            
                            
                            if($result->hasNext())
                            {
                                foreach($result as $document)
                                {
                                    
                                    $refdata['first_name']=$document["first_name"];
                                    $refdata['last_name']=$document["last_name"];
                                    $refdata['email']=$document["email"];
                                    $refdata['profile_pic']=$document["profile_pic"];
                                    $refdata['mobile']=$document["country_code"].$document["mobile"];
                                    $refdata['user_type']=$user_type;
                                    if($user_type=="Driver"){
                                        $refdata['category']=$document["category"];	
                                    }else{
                                        $refdata['category']="Nill";	
                                    }
                                    
                                }
                                
                            }
                            
                            
                            array_push($response_array,$refdata);
                        }
                        
                        print_r(json_encode($response_array,JSON_UNESCAPED_SLASHES));exit;
                    }else{
                        
                        $final['status']="Fail";
                        $final['message']="Your Referral Code Not used.";	
                        array_push($response_array,$final);
                        
                    }	
                }
            }
            else
            {
                
                $final['status']="Fail";
                $final['message']="Missing Parameter value.";	
                array_push($response_array,$final);
                
            }
            
            print_r(json_encode($response_array,JSON_UNESCAPED_SLASHES));exit;
            
        }
        
        
        public function updateDestinationWaypoints_get()    // For Rider
        {
            
            if(checkisEmpty($this->get()))
            {
                
                $response_array = array();
                $waypoints=array();
                $coordinatesValue= urldecode(utf8_encode($this->get('coordinates')));
                $CountryCodevalue= urldecode(utf8_encode($this->get('countrycodes')));
                $addressvalue= urldecode(utf8_encode($this->get('address')));
                $tripid= $this->get('trip_id');
                
                
                if($coordinatesValue === NULL || $CountryCodevalue === NULL || $addressvalue==NULL ||$tripid===NULL)
                {
                    $final['status']="Fail";
                    $final['message']="Missing Parameter.";
                    array_push($response_array,$final);
                    
                }else{
                    
                    $result=$this->Request_model->find_data('trips',array("_id" => new MongoId($tripid) ) );
                    foreach($result as $getWaypointsData){}
                    $waypoints['DestinationWaypoints'] = $getWaypointsData['DestinationWaypoints'];
                    $arrlengthss = count($waypoints['DestinationWaypoints']);
                    
                    $splitedCoordinates =explode(',', $coordinatesValue);
                    $arrCoorlength = count($splitedCoordinates);
                    
                    $splitedcc =explode(',', $CountryCodevalue);
                    $splitedaddress =explode('|', $addressvalue);
                    
                    $plus = 1;
                    
                    for($x = 0; $x < $arrCoorlength; $x++) {
                        
                        $count = $arrlengthss + $x + $plus;
                        
                        $splitedLatLng =explode('|', $splitedCoordinates[$x]);
                        
                        $waypoints['DestinationWaypoints']["WayPoint ".$count]['Coordinates']['lat'] = $splitedLatLng[0];	
                        $waypoints['DestinationWaypoints']["WayPoint ".$count]['Coordinates']['long'] = $splitedLatLng[1];	
                        $waypoints['DestinationWaypoints']["WayPoint ".$count]['CountryCode'] = $splitedcc[$x];	
                        $waypoints['DestinationWaypoints']["WayPoint ".$count]['Address'] = $splitedaddress[$x];	
                        
                    }
                    
                    $this->mongo_db->db->trips->update(array("_id"=>new MongoId($tripid)),array('$set'=>$waypoints));
                    $final['status']="Success";
                    $final['message']="Waypoints updated successfully.";	
                    $this->response($final+$waypoints, REST_Controller::HTTP_OK);
                    exit;
                }
                
            }
            else{
                $final['status']="Fail";
                $final['message']="Missing Parameter value.";	
                array_push($response_array,$final);
            }
            $this->response($response_array, REST_Controller::HTTP_OK);
        }
    }
