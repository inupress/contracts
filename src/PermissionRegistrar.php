<?php

declare(strict_types=1);

namespace Inupress\Contracts;

/**
 * Plugins declare permissions named "{plugin}::{resource}.{action}", e.g. "blog::posts.edit".
 */
interface PermissionRegistrar
{
    /**
     * @param  list<string>  $permissions
     */
    public function register(string $pluginId, array $permissions): void;

    /**
     * @return list<string>
     */
    public function all(): array;
}
