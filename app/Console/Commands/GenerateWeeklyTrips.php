<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Trip;
use Carbon\Carbon;
class GenerateWeeklyTrips extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:weeklytrips';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Weekly Trips Automatically';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $lastweek = Carbon::now()->startOfWeek()->subWeeks();
        
        $weekly=Trip::where('type','اسبوعية')
        ->where('status','!=','ملغية')
        ->where('start_date','>=',$lastweek)
        ->get();
        
        foreach ($weekly as $week)
        {
        $trip = new Trip();
        foreach (config('app.languages') as $key => $lang) {
            $trip->translateOrNew($key)->locale = $week->translate($key)->locale;
            $trip->translateOrNew($key)->name = $week->translate($key)->name;
            $trip->translateOrNew($key)->area = $week->translate($key)->area;
            $trip->translateOrNew($key)->info = $week->translate($key)->info;
        }
        $trip->type = $week->type;
        $trip->image = $week->image;
        $trip->seats = $week->seats;
        $trip->seats_taken = 0;
        $trip->status = 'حجز_مفتوح';
        $trip->price = $week->price;
        $newstartdate = $week->start_date->addDay(7);
        $newenddate = $week->expiry_date->addDay(7);
        $trip->start_date = $newstartdate;
        $trip->expiry_date = $newenddate;
        $trip->save();
        }
        $this->info('Trips generated successfully');
    }
}
