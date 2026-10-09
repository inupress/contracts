<?php

declare(strict_types=1);

namespace Inupress\Contracts;

/**
 * Implemented by plugins that add something to the admin panel.
 * Kept separate from Plugin so headless plugins do not need Filament.
 */
interface ProvidesFilament
{
    /**
     * @return object an instance of Filament\Contracts\Plugin
     */
    public function filamentPlugin(): object;
}
