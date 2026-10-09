<?php

declare(strict_types=1);

use Inupress\Contracts\PluginManifest;

it('is a plain immutable value object', function () {
    $m = new PluginManifest('acme/blog', 'Blog', '1.2.0', '/path');

    expect($m->id)->toBe('acme/blog')
        ->and($m->name)->toBe('Blog')
        ->and($m->version)->toBe('1.2.0')
        ->and($m->path)->toBe('/path');
});

it('cannot be modified', function () {
    $m = new PluginManifest('a/b', 'B', '1.0.0', '/p');
    $m->id = 'other';
})->throws(Error::class);
