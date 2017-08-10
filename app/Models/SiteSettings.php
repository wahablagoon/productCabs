<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSettings extends Model
{
    protected $table = 'site_settings';
    protected $fillable =['site_name','site_appstore_link','site_copyright','site_playstore_link','site_email','site_status','site_company_phone','site_company_email','site_currency'];
}
