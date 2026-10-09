<?php

declare(strict_types=1);

namespace Inupress\Contracts;

/**
 * Plugins declare settings groups; values are stored by the core under "{plugin id}.{group}".
 */
interface SettingsRegistry
{
    /**
     * @param  array<int|string, mixed>  $schema  form components (Filament) describing the fields
     */
    public function register(string $pluginId, string $group, array $schema): void;

    /**
     * @return array<int|string, mixed>
     */
    public function schema(string $pluginId, string $group): array;

    /**
     * @return list<string> group names declared by the plugin
     */
    public function groups(string $pluginId): array;

    public function get(string $pluginId, string $group, string $key, mixed $default = null): mixed;
}
