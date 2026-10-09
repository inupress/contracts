<?php

declare(strict_types=1);

namespace Inupress\Contracts;

interface Theme
{
    public function id(): string;

    public function name(): string;

    /** Absolute path inside the theme package. */
    public function path(string $relative = ''): string;
}
