<?php

namespace App\Providers;

use App\Models\Menu_Detail;
use App\Policies\UserPolicy;
use App\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\UserPolicy',
        User::class => UserPolicy::class
    ];

    /**
     * Register any authentication / authorization services. 
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        view()->composer('*', function ($view) {
            if (Auth::check()) {
                $group_id           = Auth::user()->group_id;
                $outlet_id          = Auth::user()->outlet_id;
                $module_url         = Request::segment(1);
                $group_id           = Auth::user()->group_id;
                $menu_master        = Menu_Detail::getMenuDetailByMenuName($module_url, $group_id, "%master%");
                $menu_transaction   = Menu_Detail::getMenuDetailByMenuName($module_url, $group_id, "%transaction%");
                $menu_report        = Menu_Detail::getMenuDetailByMenuName($module_url, $group_id, "%report%");

                $modules            = DB::select('call SP_Modules_GroupByRight_Select(?,?)', [$group_id, $outlet_id]);
                $view->with([
                    'modules'           => $modules,
                    'menu_master'       => $menu_master,
                    'menu_transaction'  => $menu_transaction,
                    'menu_report'       => $menu_report
                ]);
            } else {
                redirect('/login');
            }
        });
    }
}
