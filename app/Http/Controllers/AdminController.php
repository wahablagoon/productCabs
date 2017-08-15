<?php


namespace App\Http\Controllers;

use App\Http\Requests ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Mail;
use View;
use File;
use App\User;
use App\Models\SiteSettings;
use App\Models\CountryCode;
use App\Models\Api;
use App\Models\Category;
use App\Models\PeakHourPricing;
use App\Models\PromoCode;
class AdminController extends Controller
{
	public function index()
	{
		if(is_loggedin())
		{
			return View::make('home');	
		}
		else
		{
			return View::make('auth/login');		
		}	

	}
    public function checklogin(Request $request)
	{	
		$users = User::where('role',3);
		if($users->count()>0 && $request->username=="admin" &&$users->first()->password==$request->password)
		{
			$userdata['trippy_username']=$request->username;
			$userdata['trippy_id']=$users->first()->id;
			$userdata['trippy_loggedin']=true;
			session($userdata);
			echo  "success";
		}
		else
		{
			echo "fail";
		}
	}

	public function comming_soon()
	{
		return View::make('comming_soon');	
	}

	public function view_api()
	{
		$data=Api::all();
		foreach ($data as $key => $value) {
			$api[$value->code]=$value->value;
		}
		return View::make('layouts/admin/view_api',$api);		
	}

	public function view_payment()
	{
		$data=Api::all();
		foreach ($data as $key => $value) {
			$api[$value->code]=$value->value;
		}
		return View::make('layouts/admin/payment',$api);		
	}

	public function view_map()
	{
		return View::make('layouts/admin/view_map');			
	}

	public function view_service()
	{
		$data['services']=Category::all();
		return View::make('layouts/admin/view_service',$data);		
	}
	public function view_create_service()
	{
		$data['services']=Category::all();
		return View::make('layouts/admin/view_service_create');		
	}	

	public function resetadmin(Request $request)
	{
		$users = User::where('role',3)->where('email',$request->email);
		if($users->count()>0)
		{
			$data['email']=$request->email;
			$data['reset_url']=url('reset_password/'.$users->first()->id.'/'.time());
			Mail::send('emails.remainder', ['data' => $data], function ($m) use ($data) {
			    $m->from('praveenak.bsc@gmail.com','trippy');	
			    $m->to($request->email, $users->first()->firstname)->subject('trippy - Reset your password');
			});
			echo  "success";
		}
		else
		{
			echo "fail";
		}
	}

	public function api_settings(Request $request)
	{
		$data=Api::all();
		foreach ($data as $key => $value) {
			if($request[$value->code]!="")
			{
				$update_date['value']=$request[$value->code];
			}
			else
			{
				$update_date['value']="";	
			}
			
			Api::where('code',$value->code)->update($update_date);
		}
		flash('Api Settings Updated Successfully')->success()->important();
		return redirect('admin/settings/api');
	}

	public function logout()
	{
		$userdata['trippy_loggedin']=false;
		session($userdata);
		return redirect('admin/login');
	}

	public function view_settings()
	{
		return View::make('layouts/admin/view_settings');		
	}

	public function view_user()
	{
		$data['user']=User::where('role',1)->where('role','<>',null)->get();
		return View::make('layouts/admin/view_user',$data);		
	}
	public function view_surgeprice()
	{
		$data['surge']=PeakHourPricing::all();
		$data['category']=Category::all();
		return View::make('layouts/admin/view_surge',$data);	
	}

	public function view_provider()
	{
		$data['user']=User::where('role',2)->where('role','<>',null)->get();
		return View::make('layouts/admin/view_provider',$data);		
	}
	public function view_create_user()
	{
		$cc=CountryCode::all();
		foreach($cc as $c)
		{
			$country_code[]=$c;
		}
		$data['country_code']=$country_code;
		return View::make('layouts/admin/view_user_create',$data);			
	}

	public function view_create_provider()
	{
		$cc=CountryCode::all();
		foreach($cc as $c)
		{
			$country_code[]=$c;
		}
		$data['country_code']=$country_code;
		return View::make('layouts/admin/view_driver_create',$data);			
	}

	public function uploadlogo(Request $request)
	{
		$file = request()->file('file-upload');
		$ext=$file->guessClientExtension();
		$name=$file->getClientOriginalName();
		$file->storeAs('images/',$name);
		$oldfile=site_settings()->site_logo;
		$filename = 'storage/app/images/'.$oldfile;
		File::delete($filename);
		$data['site_logo']=$name;
		$update=SiteSettings::where('id',1)->update($data);
		flash('Site Logo Updated Successfully')->success()->important();
		return redirect('admin/settings');
	}
	public function uploadicon(Request $request)
	{
		$file = request()->file('file-upload');
		$ext=$file->guessClientExtension();
		$name=$file->getClientOriginalName();
		$file->storeAs('images/',$name);
		$oldfile=site_settings()->site_icon;
		$filename = 'storage/app/images/'.$oldfile;
		File::delete($filename);
		$data['site_icon']=$name;
		$update=SiteSettings::where('id',1)->update($data);
		flash('Site Icon Updated Successfully')->success()->important();
		return redirect('admin/settings');
	}


	public function add_service(Request $request)
	{
		unset($request['_token']);
		$category=Category::create($request->all());
		$categoryid=$category->id;
		$marker = request()->file('marker');
		$logo = request()->file('logo');
		$marker_ext=$marker->guessClientExtension();
		$marker_name=$marker->getClientOriginalName();
		$marker->storeAs('images/category/'.$categoryid.'/',$marker_name);
		$logo_ext=$logo->guessClientExtension();
		$logo_name=$logo->getClientOriginalName();
		$logo->storeAs('images/category/'.$categoryid.'/',$logo_name);
		
		$up['marker']=$marker_name;
		$up['logo']=$logo_name;
		Category::where('id',$category->id)->update($up);

		flash('Service Added Successfully')->success()->important();
		return redirect('admin/service');
	}	

	public function edit_service(Request $request)
	{
		unset($request['_token']);
		$categoryid=$request->id;
		if($_FILES['marker']['name']!="")
		{
			$marker = request()->file('marker');
			$marker_ext=$marker->guessClientExtension();
			$marker_name=$marker->getClientOriginalName();
			$marker->storeAs('images/category/'.$categoryid.'/',$marker_name);
			$request1['marker']=$marker_name;
		}
		else
		{
			unset($request['marker']);
			$request1['marker']="";
		}
		
		if($_FILES['logo']['name']!="")
		{
			$logo = request()->file('logo');
			$logo_ext=$logo->guessClientExtension();
			$logo_name=$logo->getClientOriginalName();
			$logo->storeAs('images/category/'.$categoryid.'/',$logo_name);
			$request1['logo']=$logo_name;
		}
		else
		{
			unset($request['logo']);
			$request1['logo']="";
		}
		$category=Category::where('id',$request->id)->update($request->all());
		
		$category=Category::where('id',$request->id)->update($request1);

		flash('Service Updated Successfully')->success()->important();
		return redirect('admin/service');
	}	

	public function view_edit_service(Request $request)
	{
		$category=Category::where('id',$request->id);
		if($category->count()>0)
		{
			$data['category']=$category->get()->first();
			return View::make('layouts/admin/view_edit_service',$data);						
		}
		else
		{
			flash('Service Not available')->error()->important();
			return redirect('admin/service');	
		}
			
	}

	public function delete_service(Request $request)
	{
		Category::where('id',$request->id)->delete();
		flash('Service Deleted Successfully')->success()->important();
		return redirect('admin/service');
	}

	public function set_sitecolor(Request $request)
	{
		$data['site_theme_color']=$request->color;
		$update=SiteSettings::where('id',1)->update($data);
		flash('Site Color Updated Successfully')->success()->important();
		echo "success";
	}

	public function site_settings(Request $request)
	{
		unset($request['_token'],$request['submit']);
		SiteSettings::where('id',1)->update($request->all());
		flash('Site Settings Updated Successfully')->success()->important();
		return redirect('admin/settings');

	}

	public function signup(Request $request)
	{
		 $this->validate($request, [
        'name' => 'required',
        'phone' => 'required',
        'email' => 'required',
        'password' => 'required',
        'city' => 'required',
    	]);

		if($request['edit'])
		{	
			$userid=$request['edit'];
			unset($request['_token'],$request['edit']);
			User::where('id',$userid)->update($request->all());
			if($request->role=="1")
			{
				flash('Passengers Updated Successfully')->success()->important();
				return redirect('admin/passengers');
			}
			else
			{
				flash('Driver Updated Successfully')->success()->important();
				return redirect('admin/drivers');	
			}
		}
		else
		{
			unset($request['_token'],$request['edit']);
			User::create($request->all());
			if($request->role=="1")
			{
				flash('Passengers Added Successfully')->success()->important();
				return redirect('admin/passengers');
			}
			else
			{
				flash('Driver Added Successfully')->success()->important();
				return redirect('admin/drivers');	
			}
		}
	}

	public function delete_user(Request $request)
	{
		$rider = User::where('id',$request->id)->delete();
		if($request->role==1)
		{
			flash('Passenger Deleted Successfully')->success()->important();
			return redirect('admin/passengers');			
		}
		else
		{
			flash('Driver Deleted Successfully')->success()->important();
			return redirect('admin/drivers');
		}
	
	}

	public function delete_peak(Request $request)
	{
		$rider = PeakHourPricing::where('id',$request->id)->delete();
		flash('Deleted Successfully')->success()->important();
		return redirect('admin/surge');			
	}
	public function delete_promo(Request $request)
	{
		$rider = PromoCode::where('id',$request->id)->delete();
		flash('Deleted Successfully')->success()->important();
		return redirect('admin/promocode');			
	}

	public function edit_user(Request $request)
	{
		$cc=CountryCode::all();
		foreach($cc as $c)
		{
			$country_code[]=$c;
		}
		$data['country_code']=$country_code;
		if($request->role==1)
		{
			$user = User::where('id',$request->id)->where('role',$request->role);
			if($user->count())
			{
				$data['users']=$user->get()->first();
				return View::make('layouts/admin/view_user_create',$data);
			}
			else
			{
				flash('Invalid Passenger id')->error()->important();
				return redirect('admin/passengers');
			}			
		}
		else
		{
			$user = User::where('id',$request->id)->where('role',$request->role);
			if($user->count())
			{
				$data['users']=$user->get()->first();
				return View::make('layouts/admin/view_driver_create',$data);
			}
			else
			{
				flash('Invalid Driver id')->error()->important();
				return redirect('admin/passengers');
			}			
		}	
	}

	public function getCategory(Request $request)
	{
		$cat=Category::all();
		foreach ($cat as $value) {
			$myArray[]=$value;
		}
	    return response()->json($myArray);

	}

	public function excel()
	{
		Excel::create('Filename', function($excel) {

    $excel->sheet('Sheetname', function($sheet) {

        $sheet->fromArray(array(
            array('data1', 'data2'),
            array('data3', 'data4')
        ));

    });
		})->export('xls');
	}

	public function export(Request $request)
	{
		$users=User::where('role',$request->role)->where('role','<>',null)->get();
		$data_header=array("Id","Name","Email","Phone","Proof Status","Created");
		$data=array();
		foreach($users as $key => $value){
			$data[]=array(
				$value->id,
				$value->name,
				$value->email,
				$value->countrycode." ".$value->phone,
				$value->proof_status,
				$value->created_at,
				);
		}
		$export=new Export();
		$export->generate($data,$data_header,$request->type,$request->title);
	}

	public function view_promocode()
	{
		$data['coupon']=PromoCode::all();
		return View::make('layouts/admin/view_coupon_code',$data);
	}
	public function addPeak(Request $request)
	{
		$response["errors"]="";
		$response["stats"]="success";
		if(strtotime($request['start_peak']) >= strtotime($request['end_peak']))
		{
			$response["errors"]="Invalid time selection";
			$response["stats"]="fail";
		}
		else
		{
			$data['start_time']=$request['start_peak'];
			$data['end_time']=$request['end_peak'];
			$data['days']=$request['days'];
			$data['type']=$request['type'];
			$data['category']=$request['category'];
			$data['amount']=$request['price'];
			if(isset($request['edit']) && $request['edit']=="yes")
			{
				PeakHourPricing::where('id',$request['id'])->update($data);
				flash('Peak hour added Successfully')->success()->important();
			}
			else
			{
				PeakHourPricing::create($data);
				flash('Peak hour Updated Successfully')->success()->important();
			}

		}
		echo json_encode(array($response));
	}

	public function addPromo(Request $request)
	{
		$response["errors"]="";
		$response["stats"]="success";
		if(strtotime($request['expired']) <= time())
		{
			$response["errors"]="Invalid time selection";
			$response["stats"]="fail";
		}
		else
		{
			$data['expired_in']=$request['expired'];
			$data['code']=$request['code'];
			$data['status']=$request['status'];
			$data['type']=$request['type'];
			$data['amount']=$request['price'];
			if(isset($request['edit']) && $request['edit']=="yes")
			{
				PromoCode::where('id',$request['id'])->update($data);
				flash('Promo hour added Successfully')->success()->important();
			}
			else
			{
				PromoCode::create($data);
				flash('Promo hour Updated Successfully')->success()->important();
			}

		}
		echo json_encode(array($response));
	}

	public function view_tranlation()
	{
		$data['wait_page']="Translations";
		$data['wait_title']="Comming Soon...";
		$data['wait_message']="In this page we can select the language translation. We provide the two language selection providers.
		one is Google language translation and other one is our inbuild language translation.";
		$data['contact']="We'd like to thank you for deciding to use our script. We enjoyed creating it and hope you enjoy using it to achieve your goals :). If you want something changed to suit your venture's needs better, drop us a line: ak@bluelagoontechnologies.com ";
		return View::make('errors/waiting',$data);					
	}
	public function view_help()
	{
		$data['wait_page']="Help";
		$data['wait_title']="Comming Soon...";
		$data['wait_message']="In this page manage the help contents.";
		$data['contact']="We'd like to thank you for deciding to use our script. We enjoyed creating it and hope you enjoy using it to achieve your goals :). If you want something changed to suit your venture's needs better, drop us a line: ak@bluelagoontechnologies.com";
		return View::make('errors/waiting',$data);					
	}

	public function view_add_document()
	{
		$data['wait_page']="Add Documents";
		$data['wait_title']="Comming Soon...";
		$data['wait_message']="In this page we add documents name for what things give from drivers";
		$data['contact']="We'd like to thank you for deciding to use our script. We enjoyed creating it and hope you enjoy using it to achieve your goals :). If you want something changed to suit your venture's needs better, drop us a line: ak@bluelagoontechnologies.com";
		return View::make('errors/waiting',$data);					
	}
	public function view_privacy()
	{
		return View::make('layouts/admin/privacy');					
	}
	public function view_payment_history()
	{
		return View::make('layouts/admin/payment_history');					
	}
	public function view_document()
	{
		return View::make('layouts/admin/documents');					
	}

	public function view_requests()
	{
		return View::make('layouts/admin/requests');					
	}
	public function view_scheduled()
	{
		return View::make('layouts/admin/scheduled');					
	}
	public function view_ridelater()
	{
		return View::make('layouts/admin/ridelater');					
	}
	public function view_review_passenger()
	{
		return View::make('layouts/admin/review_passenger');					
	}
	public function view_review_driver()
	{
		return View::make('layouts/admin/review_driver');					
	}
	public function view_overall_statement()
	{
		return View::make('layouts/admin/overall_statement');					
	}
	public function view_today_statement()
	{
		return View::make('layouts/admin/today_statement');					
	}
	public function view_monthly_statement()
	{
		return View::make('layouts/admin/monthly_statement');					
	}
	public function view_yearly_statement()
	{
		return View::make('layouts/admin/yearly_statement');					
	}
	public function view_driver_statement()
	{
		return View::make('layouts/admin/driver_statement');					
	}

}
