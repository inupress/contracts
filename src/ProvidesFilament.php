<?php

declare(strict_types=1);

namespace Inupress\Contracts;

/**
 * Implemented by the plugin's service provider (PackageServiceProvider) when the plugin
 * adds something to the admin panel. Headless plugins simply do not implement it,
 * so they do not need Filament.
 */
interface ProvidesFilament
{
    /**
     * @return object an instance of Filament\Contracts\Plugin
     */
    public function filamentPlugin(): object;
}
