<?php

declare(strict_types=1);

use Inupress\Contracts\PluginManifest;

it('builds a manifest from composer extra', function () {
    $m = PluginManifest::fromComposer('inupress/blog', '1.2.0', [
        'inupress' => [
            'id' => 'inupress/blog',
            'provider' => 'Inupress\Blog\BlogPlugin',
            'requires' => ['core' => '^1.0'],
            'provides' => ['blog.posts'],
        ],
    ]);

    expect($m->id)->toBe('inupress/blog')
        ->and($m->name)->toBe('inupress/blog')
        ->and($m->version)->toBe('1.2.0')
        ->and($m->requires)->toBe(['core' => '^1.0'])
        ->and($m->provides)->toBe(['blog.posts']);
});

it('rejects packages without the inupress section', function () {
    PluginManifest::fromComposer('a/b', '1.0.0', []);
})->throws(InvalidArgumentException::class);

it('requires id and provider', function () {
    PluginManifest::fromComposer('a/b', '1.0.0', ['inupress' => ['id' => 'a/b']]);
})->throws(InvalidArgumentException::class);

it('is immutable', function () {
    $m = new PluginManifest('a/b', 'B', '1.0.0', 'X');
    $m->id = 'other';
})->throws(Error::class);
