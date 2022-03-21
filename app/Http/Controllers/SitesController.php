<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use App\Models\UserSite;

class SitesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //
        $allSites = Site::withCount('users')->paginate(10);

        return view('sites.index', compact('allSites'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $users = User::all();
            
        return view('sites.create', compact('users'));
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
        $rules = [
            'site_name' => 'required',
            'district' => 'string|nullable',
            'region' => 'string|nullable',
            'country' => 'string|nullable',
            'site_users' => 'required',
        ];

        $data = $request->validate($rules);
        $data['updated_by'] = Auth::user()->username;

        //Check if Site Already Exists
        $site = Site::where('site_name', $data['site_name'])->count();

        if($site > 0)
        {
            return back()->withinput()->with('error_message','Error Occured, This Site already exists, Please check your Entry and Try again, or Contact IT team for help');
        }

        else{
            $newSite = new Site();
            foreach ($data as $columnName => $value)
            {
                if($columnName != "site_users")
                {
                    $newSite->$columnName = $data[$columnName];
                }      
            }

            try {
                $newSite->save();
            }
            catch(\Exception $exception)
            {
                dd($exception);
                return back()->withinput()->with('error_message','An Error occured in Creating the Site. If the Error persists please contact IT');
            }

            //Get Id of the newly created Site
            $newSiteId = $newSite->id;

            //Associate assigned Users to Site
            foreach ($data['site_users'] as $key => $user)
            {
                try {
                    UserSite::create(
                        ['user_id' => $user,
                        'site_id' => $newSiteId,
                        'updated_by' => Auth::user()->username,]
                    );
                }
                catch(\Exception $exception)
                {
                    return back()->withinput()->with('error_message','The site was created but, there was an error assigning one or more users to the Site');
                }
            }

            return redirect()->route('sites.index')->with('success','Site Information has been saved Successfully.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function show(Site $site)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function edit(Site $site)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Site $site)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function destroy(Site $site)
    {
        //
    }
}
