<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use HTMLPurifier;
use HTMLPurifier_Config;

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
         * Extends validation rules to allow specific HTML tags.
         */
        Validator::extend('safe_html', function ($attribute, $value) {
            // Configure HTMLPurifier to allow certain elements and attributes
            $config = HTMLPurifier_Config::createDefault();
            $config->set('HTML.Allowed', 'br,p,i,strong,a[href|title],ul,ol,li,blockquote,table,tbody,tr,td');
            $config->set('CSS.AllowedProperties', 'font,font-size,font-weight,font-style,text-decoration');
            $config->set('AutoFormat.AutoParagraph', true);
            $config->set('AutoFormat.RemoveEmpty', true);

            $purifier = new HTMLPurifier($config);
            $clean = $purifier->purify($value);

            return $clean === $value;
        }, 'The :attribute field contains invalid HTML tags.');
    }
}
