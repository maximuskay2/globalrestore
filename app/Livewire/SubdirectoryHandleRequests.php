<?php

namespace App\Livewire;

use Livewire\Mechanisms\HandleRequests\HandleRequests as BaseHandleRequests;

/**
 * Livewire's default update URI is root-relative (/livewire/update), which breaks
 * when the app is served from a subdirectory (e.g. XAMPP /GlobalRestore).
 */
class SubdirectoryHandleRequests extends BaseHandleRequests
{
    public function getUpdateUri(): string
    {
        $route = $this->updateRoute ?? $this->findUpdateRoute();

        if ($route?->getName()) {
            return route($route->getName());
        }

        return parent::getUpdateUri();
    }
}
