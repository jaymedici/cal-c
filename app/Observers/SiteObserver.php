<?php

namespace App\Observers;

use App\Models\Site;
use Illuminate\Support\Facades\Auth;

class SiteObserver
{
    public $username;

    public function __construct()
    {
        $this->username = Auth::user()->username;
    }

    /**
     * Handle the Site "created" event.
     *
     * @param  \App\Models\Site  $site
     * @return void
     */
    public function created(Site $site)
    {
        //
        $site->updated_by = $this->username;
        $site->save();
    }

    /**
     * Handle the Site "updated" event.
     *
     * @param  \App\Models\Site  $site
     * @return void
     */
    public function updated(Site $site)
    {
        //
    }

    /**
     * Handle the Site "deleted" event.
     *
     * @param  \App\Models\Site  $site
     * @return void
     */
    public function deleted(Site $site)
    {
        //
    }

    /**
     * Handle the Site "restored" event.
     *
     * @param  \App\Models\Site  $site
     * @return void
     */
    public function restored(Site $site)
    {
        //
    }

    /**
     * Handle the Site "force deleted" event.
     *
     * @param  \App\Models\Site  $site
     * @return void
     */
    public function forceDeleted(Site $site)
    {
        //
    }
}
