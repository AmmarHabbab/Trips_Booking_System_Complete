<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Trip;
use Carbon\Carbon;
class GenerateDailyTrips extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:dailytrips';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Daily Trips Automatically';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $date = Carbon::yesterday();

        $daily=Trip::where('type','يومية')
        ->where('status','!=','ملغية')
        ->where('start_date','>=',$date)
        ->get();
        
        foreach ($daily as $day)
        {
        $trip = new Trip();
        foreach (config('app.languages') as $key => $lang) {
            $trip->translateOrNew($key)->locale = $day->translate($key)->locale;
            $trip->translateOrNew($key)->name = $day->translate($key)->name;
            $trip->translateOrNew($key)->area = $day->translate($key)->area;
            $trip->translateOrNew($key)->info = $day->translate($key)->info;
        }
        $trip->type = $day->type;
        $trip->image = $day->image;
        $trip->seats = $day->seats;
        $trip->seats_taken = 0;
        $trip->status = 'حجز_مفتوح';
       // $trip->priceusd = $day->priceusd;
        $trip->price = $day->price;
        $newstartdate = $day->start_date->addDay();
        $newenddate = $day->expiry_date->addDay();
        $trip->start_date = $newstartdate;
        $trip->expiry_date = $newenddate;
        $trip->save();
        }
        $this->info('Trips generated successfully');
    }
}
