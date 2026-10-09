<?php

declare(strict_types=1);

namespace Inupress\Contracts;

/**
 * WordPress-like extension points. Hook names live in {@see Hooks}.
 * Lower priority runs first; equal priorities run in registration order.
 */
interface HookRegistry
{
    public function addAction(string $hook, callable $callback, int $priority = 10): void;

    public function doAction(string $hook, mixed ...$args): void;

    public function addFilter(string $hook, callable $callback, int $priority = 10): void;

    /** The callback receives $value first, then $args, and must return the new value. */
    public function applyFilters(string $hook, mixed $value, mixed ...$args): mixed;

    public function hasAction(string $hook): bool;

    public function hasFilter(string $hook): bool;
}
