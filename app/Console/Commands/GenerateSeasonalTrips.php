<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Trip;
use Carbon\Carbon;
class GenerateSeasonalTrips extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:seasonaltrips';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Seasonal Trips Automatically';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $lastseason = Carbon::now()->startOfMonth()->subMonths(2);

        $seasonal=Trip::where('type','موسمية')
        ->where('status','!=','ملغية')
        ->where('start_date','>=',$lastseason)
        ->get();

        foreach ($seasonal as $season)
        {
        $trip = new Trip();
        foreach (config('app.languages') as $key => $lang) {
            $trip->translateOrNew($key)->locale = $season->translate($key)->locale;
            $trip->translateOrNew($key)->name = $season->translate($key)->name;
            $trip->translateOrNew($key)->area = $season->translate($key)->area;
            $trip->translateOrNew($key)->info = $season->translate($key)->info;
        }
        $trip->type = $season->type;
        $trip->image = $season->image;
        $trip->seats = $season->seats;
        $trip->seats_taken = 0;
        $trip->status = 'حجز_مفتوح';
        $trip->price = $season->price;
        $newstartdate = $season->start_date->addDay(90);
        $newenddate = $season->expiry_date->addDay(90);
        $trip->start_date = $newstartdate;
        $trip->expiry_date = $newenddate;
        $trip->save();
        }
        $this->info('Trips generated successfully');
    }
}
