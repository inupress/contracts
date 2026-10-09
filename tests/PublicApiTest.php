<?php

declare(strict_types=1);

/**
 * Snapshot of the public API. A failure here means a contract changed:
 * update tests/api.snapshot.json deliberately and record a decision in docs/decisions/.
 */
function inupressApiSnapshot(): array
{
    $out = [];
    $files = glob(__DIR__.'/../src/*.php');
    sort($files);

    foreach ($files as $file) {
        $class = 'Inupress\\Contracts\\'.basename($file, '.php');
        $r = new ReflectionClass($class);
        $entry = ['kind' => $r->isInterface() ? 'interface' : 'class'];

        foreach ($r->getReflectionConstants() as $c) {
            $entry['const'][$c->getName()] = $c->getValue();
        }

        foreach ($r->getMethods(ReflectionMethod::IS_PUBLIC) as $m) {
            $params = array_map(fn (ReflectionParameter $p) => trim(
                ($p->getType() ?? 'mixed').' '.($p->isVariadic() ? '...' : '').'$'.$p->getName()
            ), $m->getParameters());
            $entry['methods'][] = $m->getName().'('.implode(', ', $params).'): '.($m->getReturnType() ?? 'none');
        }

        $out[basename($file, '.php')] = $entry;
    }

    return $out;
}

it('matches the committed public API snapshot', function () {
    $path = __DIR__.'/api.snapshot.json';
    $current = json_encode(inupressApiSnapshot(), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

    if (! file_exists($path)) {
        file_put_contents($path, $current."\n");
    }

    expect($current)->toBe(rtrim(file_get_contents($path)));
});
