<?php

namespace App\Http\Controllers;

use App\Http\Requests\Sites\StoreSiteRequest;
use App\Models\Site;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use App\Models\UserSite;
use App\Services\SiteService;

class SitesController extends Controller
{
    protected $siteService;

    public function __construct(SiteService $siteService)
    {
        $this->middleware('auth');
        $this->siteService = $siteService;
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
        $users = User::all();
            
        return view('sites.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSiteRequest $request)
    {
        $newSite = Site::create($request->validated());

        $newSite->assignUsers($request->site_users);

        return redirect()->route('sites.index')->with('success','Site Information has been saved Successfully.');
    }
}
