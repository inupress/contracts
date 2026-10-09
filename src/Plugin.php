<?php

declare(strict_types=1);

namespace Inupress\Contracts;

/**
 * A plugin is a plain class with a lifecycle, NOT a Laravel service provider.
 * Only the PluginManager instantiates and calls it, so a disabled plugin is never touched.
 */
interface Plugin
{
    public function manifest(): PluginManifest;

    /** Bindings and config only. Other plugins may not be ready yet. */
    public function register(): void;

    /** Events, hooks, routes, views. All enabled plugins are registered by now. */
    public function boot(): void;
}
