<?php

namespace App\Observers;

use App\Models\Gardner;
use Illuminate\Support\Facades\Hash;

class GardnerObserver
{
    /**
     * Handle the Gardner "created" event.
     *
     * @param  \App\Models\Gardner  $gardner
     * @return void
     */
    public function creating(Gardner $gardner)
    {
        $gardner->password = Hash::make($gardner->password);
    }
    public function created(Gardner $gardner)
    {
        //
        $gardner->attachRole('gardner');

    }

    /**
     * Handle the Gardner "updated" event.
     *
     * @param  \App\Models\Gardner  $gardner
     * @return void
     */
    public function updated(Gardner $gardner)
    {
        //
    }

    /**
     * Handle the Gardner "deleted" event.
     *
     * @param  \App\Models\Gardner  $gardner
     * @return void
     */
    public function deleted(Gardner $gardner)
    {
        //
    }

    /**
     * Handle the Gardner "restored" event.
     *
     * @param  \App\Models\Gardner  $gardner
     * @return void
     */
    public function restored(Gardner $gardner)
    {
        //
    }

    /**
     * Handle the Gardner "force deleted" event.
     *
     * @param  \App\Models\Gardner  $gardner
     * @return void
     */
    public function forceDeleted(Gardner $gardner)
    {
        //
    }
}
