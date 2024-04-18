<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Trip;
use Carbon\Carbon;
class GenerateMonthlyTrips extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:monthlytrips';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Monthly Trips Automatically';

    /**
     * Execute the console command.
     */
    public function handle()
    { 
        $lastmonth = Carbon::now()->startOfMonth()->subMonths();
       
        $monthly=Trip::where('type','شهرية')
        ->where('status','!=','ملغية')
        ->where('start_date','>=',$lastmonth)
        ->get();

        foreach ($monthly as $month)
        {
        $trip = new Trip();
        foreach (config('app.languages') as $key => $lang) {
            $trip->translateOrNew($key)->locale = $month->translate($key)->locale;
            $trip->translateOrNew($key)->name = $month->translate($key)->name;
            $trip->translateOrNew($key)->area = $month->translate($key)->area;
            $trip->translateOrNew($key)->info = $month->translate($key)->info;
        }
        $trip->type = $month->type;
        $trip->image = $month->image;
        $trip->seats = $month->seats;
        $trip->seats_taken = 0;
        $trip->status = 'حجز_مفتوح';
        $trip->price = $month->price;
        $newstartdate = $month->start_date->addDay(30);
        $newenddate = $month->expiry_date->addDay(30);
        $trip->start_date = $newstartdate;
        $trip->expiry_date = $newenddate;
        $trip->save();
        }
        $this->info('Trips generated successfully');
    }
}
