<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Trip;
use Carbon\Carbon;
class GenerateYearlyTrips extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:yearlytrips';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Yearly Trips Automatically';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $lastyear = Carbon::now()->startOfYear()->subYear();

        $yearly=Trip::where('type','سنوية')
        ->where('status','!=','ملغية')
        ->where('start_date','>=',$lastyear)
        ->get();

        foreach ($yearly as $year)
        {
        $trip = new Trip();
        foreach (config('app.languages') as $key => $lang) {
            $trip->translateOrNew($key)->locale = $year->translate($key)->locale;
            $trip->translateOrNew($key)->name = $year->translate($key)->name;
            $trip->translateOrNew($key)->area = $year->translate($key)->area;
            $trip->translateOrNew($key)->info = $year->translate($key)->info;
        }
        $trip->type = $year->type;
        $trip->image = $year->image;
        $trip->seats = $year->seats;
        $trip->seats_taken = 0;
        $trip->status = 'حجز_مفتوح';
        $trip->price = $year->price;
        $newstartdate = $year->start_date->addDay(365);
        $newenddate = $year->expiry_date->addDay(365);
        $trip->start_date = $newstartdate;
        $trip->expiry_date = $newenddate;
        $trip->save();
        }
        $this->info('Trips generated successfully');
    }
}
