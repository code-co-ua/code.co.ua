<?php

namespace App\Providers;

use App\FakeData\CourseFakeData;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use joshtronic\LoremIpsum;
use Parsedown;

class PackagesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('parsedown', function ($expression) {
            return "<?php echo parsedown($expression); ?>";
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('parsedown', function () {
            $parsedown = new Parsedown;
            $parsedown->setSafeMode(true);
            return $parsedown;
        });

        $this->app->singleton('CourseFakeData', function ($app) {
            return new CourseFakeData(new LoremIpsum());
        });
    }
}
