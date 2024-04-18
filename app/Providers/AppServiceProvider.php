<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Models\Category;
use App;
use Illuminate\Http\Request;
use Illuminate\Session\SessionManager;
use App\Models\User;
use Laravel\Cashier\Cashier;
//use Illuminate\Support\Pluralizer;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(Request $request,SessionManager $session)//: void
    {
        Schema::defaultStringLength(191);

        //Pluralizer::useLanguage('ar');

        Cashier::useCustomerModel(User::class);

        $categories = Category::all();
        View()->share([
            'categories'=>$categories
        ]);
        if($request->lang)
        {
        App::setLocale($session->put('locale','ar'));
        return redirect()->back();
        }
    }
}
