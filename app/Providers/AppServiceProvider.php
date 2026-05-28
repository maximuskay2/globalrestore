<?php

namespace App\Providers;

use App\Livewire\SubdirectoryHandleRequests;
use App\Models\SiteSetting;
use Illuminate\Pagination\Paginator;
use Livewire\Mechanisms\HandleRequests\HandleRequests;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(HandleRequests::class, SubdirectoryHandleRequests::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (! $this->app->runningUnitTests() && ($rootUrl = config('app.url'))) {
            URL::forceRootUrl(rtrim($rootUrl, '/'));

            // Livewire injects /livewire/livewire.js (site root). Prefix for subdirectory installs.
            $livewireScript = config('app.debug') ? 'livewire.js' : 'livewire.min.js';
            config([
                'livewire.asset_url' => url('/livewire/'.$livewireScript),
            ]);
        }

        Paginator::useTailwind();

        $this->suppressTempnamSystemDirectoryWarnings();

        View::composer('layouts.app', function ($view): void {
            if (! array_key_exists('settings', $view->getData())) {
                $view->with('settings', SiteSetting::current());
            }
        });
    }

    /**
     * PHP 8.2+ warns when tempnam() cannot use the target directory; Laravel turns that
     * into an ErrorException and masks the real error (often unwritable storage/views).
     */
    protected function suppressTempnamSystemDirectoryWarnings(): void
    {
        $previous = set_error_handler(function (int $level, string $message, string $file = '', int $line = 0) use (&$previous) {
            if (str_contains($message, 'tempnam(): file created in the system')) {
                return true;
            }

            return is_callable($previous)
                ? $previous($level, $message, $file, $line)
                : false;
        });
    }
}
