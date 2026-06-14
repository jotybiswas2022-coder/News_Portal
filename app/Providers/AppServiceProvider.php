<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Product;
use App\Models\SourceCode;
use App\Models\UserNotification;
use Illuminate\Support\Facades\Auth;

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
        // Share store data with the navbar for the drawer
        View::composer('frontend.forex.partials.navbar', function ($view) {
            $view->with('storeProducts', Product::where('available', true)->orderBy('name')->get());
            $view->with('storeSourceCodes', SourceCode::where('available', true)->orderBy('name')->get());

            // Share unread notifications for authenticated users
            $unreadNotifications = collect();
            $unreadCount = 0;
            if (Auth::check()) {
                $unreadNotifications = UserNotification::forUser(Auth::id())
                    ->unread()
                    ->latest()
                    ->take(10)
                    ->get();
                $unreadCount = UserNotification::forUser(Auth::id())->unread()->count();
            }
            $view->with('unreadNotifications', $unreadNotifications);
            $view->with('unreadNotificationCount', $unreadCount);
        });
    }
}
