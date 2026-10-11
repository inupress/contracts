<?php

declare(strict_types=1);

namespace Inupress\Contracts;

/**
 * A theme is what the public part of the site renders through: a shell component the theme
 * overrides, the views that restyle plugin output, and the CSS and JS it loads.
 *
 * See docs/decisions/0010-themes.md for the full picture.
 */
interface Theme
{
    /** Composer package name, or the directory name under themes/. */
    public function id(): string;

    /** Human readable name from the manifest. */
    public function name(): string;

    /** Absolute path inside the theme; the theme root when called without an argument. */
    public function path(string $relative = ''): string;

    /** The id of the theme this one inherits from, or null for a base theme. */
    public function parent(): ?string;

    /** Absolute path of the directory holding the theme's views. */
    public function views(): string;

    /**
     * Absolute paths of the theme's stylesheets, in load order.
     *
     * @return list<string>
     */
    public function styles(): array;

    /**
     * Absolute paths of the theme's scripts, in load order.
     *
     * @return list<string>
     */
    public function scripts(): array;
}
