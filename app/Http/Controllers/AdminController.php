<?php


namespace App\Http\Controllers;

use App\Http\Requests ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Mail;
use View;
use File;
use App\User;
use App\Models\Export;
use App\Models\SiteSettings;
use App\Models\CountryCode;
use App\Models\Api;
use App\Models\Category;
use Excel;
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

		SiteSettings::where('id',1)->update($request->all());
		flash('Site Settings Updated Successfully')->success()->important();
		return redirect('admin/settings');

	}

	public function rider_signup(Request $request)
	{
		unset($request['_token']);
		$rider = User::create($request->all());
		flash('Rider Added Successfully')->success()->important();
		return redirect('admin/passengers');
	}

	public function provider_signup(Request $request)
	{
		unset($request['_token']);

		$rider = User::create($request->all());
		flash('Provider Added Successfully')->success()->important();
		return redirect('admin/drivers');
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


}
