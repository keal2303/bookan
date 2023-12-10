<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

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
        Validator::extend('safe_html', function ($attribute, $value)
        {
            $allowed = '<br><p></p><i></i><strong></strong><a></a><ul></ul><ol></ol><li></li><blockquote></blockquote><figure></figure><table></table><tbody></tbody><tr></tr><td></td>';
            $clean = strip_tags($value, $allowed);
            return $clean === $value;
        }, 'The :attribute field contains invalid HTML tags.');
    }
}
