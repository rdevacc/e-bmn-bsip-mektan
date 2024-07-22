<?php

namespace App\Providers;

use App\Models\Barang;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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
        /**
         * * App Authorization *
         */
        Gate::define('isSuperAdmin', function ($user) {
            return $user->role->nama == 'SuperAdmin';
        });

        Gate::define('isAdmin', function (User $user) {
            return $user->role->nama == 'Admin';
        });

        Gate::define('superAdminAndAdmin', function (User $user) {
            return ($user->role->nama == 'SuperAdmin' || $user->role->nama == 'Admin');
        });

        Gate::define('isPJ', function (User $user) {
            return $user->role->nama == 'PJ';
        });

        Gate::define('PJ-Dashboard', function (User $user, Barang $barang) {
            return $user->id === $barang->user_id;
        });

        Gate::define('update-barang', function (User $user, Barang $barang) {
            return ($user->role->nama == 'SuperAdmin' || $user->role->nama == 'Admin' || $user->id == $barang->user_id);
        });

        Gate::define('delete-barang', function (User $user) {
            return $user->role->nama == 'SuperAdmin' || $user->role->nama == 'Admin';
        });

        /**
         * * Bootstrap Paginator *
         */
        Paginator::useBootstrapFive();
        Paginator::useBootstrapFour();
    }
}
