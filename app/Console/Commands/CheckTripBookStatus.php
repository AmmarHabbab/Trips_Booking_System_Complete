<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Trip;

class CheckTripBookStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:bookstatus';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check and Update the trip book status';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $trips = Trip::where('status', 'حجز_مفتوح')->get();
    
        foreach ($trips as $trip) {
            if($trip->seats == $trip->seats_taken)
            {
                $trip->status = 'حجز_مغلق';
                $trip->save();
            }  
        }
    }
}
