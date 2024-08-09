<?php

namespace App\Providers;

use App\Actions\Webshop\MigrateSessionCart;
use Money\Money;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Fortify\Fortify;
use App\Factories\CartFactory;
use Money\Currencies\ISOCurrencies;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Blade;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Money\Formatter\IntlMoneyFormatter;




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
    public function boot(): void
    {
       
        Fortify::authenticateUsing(function (Request $request) {
            $user = User::where('email', $request->email)->first();
            if ($user && Hash::check($request->password, $user->password)) {
             
                (new MigrateSessionCart())->migrate(
                    CartFactory::make(),
                    $user->cart ?: $user->cart()->firstOrCreate()
                );
               
    
                return $user;
            }
        });

        
        Model::unguard();
        Blade::stringable(function (Money $money) {
            $currencies = new ISOCurrencies();
            $numberFormatter = new \NumberFormatter('es_CR', \NumberFormatter::CURRENCY);
            $moneyFormatter = new IntlMoneyFormatter($numberFormatter, $currencies);
            return $moneyFormatter->format($money);
        });
    }
}
