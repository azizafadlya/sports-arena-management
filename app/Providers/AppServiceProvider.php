<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\ArenaRepository;
use App\Repositories\Interfaces\ArenaRepositoryInterface;
use App\Repositories\TimeSlotRepository;
use App\Repositories\Interfaces\TimeSlotRepositoryInterface;
use App\Repositories\BookingRepository;
use App\Repositories\Interfaces\BookingRepositoryInterface;
use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->bind(ArenaRepositoryInterface::class, ArenaRepository::class);
        $this->app->bind(TimeSlotRepositoryInterface::class, TimeSlotRepository::class);
        $this->app->bind(BookingRepositoryInterface::class, BookingRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    }
}
