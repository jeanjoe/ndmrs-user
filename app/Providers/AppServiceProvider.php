<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use App\HealthFacility;
use Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        View::composer('*', function($view)
        {
            if (Auth::check()) {

              $healthFacility = HealthFacility::where('id', Auth::user()->health_facility_id)->first();
              $sharedHealthFacilities = HealthFacility::where('level', $healthFacility['level'])->get();
              $sharedLevel = '';

              if ($healthFacility['level'] == 'NATIONAL REFERRAL') {
                $sharedLevel = 'NRH';
              }elseif ($healthFacility['level'] == 'REGIONAL REFERRAL') {
                $sharedLevel = 'RRH';
              }elseif ($healthFacility['level'] == 'HOSPITAL') {
                $sharedLevel = 'DH';
              }elseif ($healthFacility['level'] == 'HCIV') {
                $sharedLevel = 'HCIV';
              }elseif ($healthFacility['level'] == 'HCIII') {
                $sharedLevel = 'HCIII';
              }elseif ($healthFacility['level'] == 'HCII') {
                $sharedLevel = 'HCII';
              }

              $view->with([
                'currentUser' => Auth::user()->load('healthFacility.healthSubDistrict.district.region'),
                'sharedHealthFacilities' => $sharedHealthFacilities,
                'sharedLevel' => $sharedLevel
              ]);
            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
