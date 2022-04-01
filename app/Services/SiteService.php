<?php

namespace App\Services;

use App\Models\Site;

class SiteService
{
    public function checkIfDuplicateSiteNameExists(string $siteName)
    {
        $site = Site::where('site_name', $siteName)->count();

        if($site > 0)
        {
            return back()->withinput()->with('error_message','Error Occured, The Site name you entered already exists, Please check your Entry or Contact IT team for help');
        }
    }
}