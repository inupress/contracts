# inupress/contracts

Public API of the Inupress CMS. Depends only on `illuminate/contracts`. Filament is optional (`suggest`).

## What is public API

Everything in `src/`, and nothing else:

| Item | Kind | Purpose |
|---|---|---|
| `ProvidesFilament` | interface | Optional, implemented by the plugin's service provider: adds something to the admin panel. |
| `PluginManifest` | final readonly class | Immutable description of an installed plugin (id, name, version, path). |
| `PluginRepository` | interface | Read-only list of installed plugins (Composer packages of type `inupress-plugin`). |
| `HookRegistry` | interface | Actions and filters. |
| `Hooks` | final class | Hook name constants. The strings are frozen within a major version. |
| `SettingsRegistry` | interface | Settings groups declared by plugins. |
| `PermissionRegistrar` | interface | Permissions named `plugin::resource.action`. |
| `Theme` | interface | Theme identity and paths. |

`tests/api.snapshot.json` is a snapshot of all signatures. If `PublicApiTest` fails, a contract changed:
update the snapshot on purpose and add a note to `docs/decisions/`.

## Versioning

Semver. Within a major version: no removed or renamed methods or constants, no changed signatures.
New methods on interfaces that only the core implements (`HookRegistry`, `SettingsRegistry`,
`PermissionRegistrar`, `PluginRepository`) are allowed in a minor version. Interfaces that plugins
implement (`ProvidesFilament`, `Theme`) only change in a major version.

Until 1.0 anything may change, but each change is still recorded as a decision.

## Not in the contracts on purpose

- `removeAction` / `removeFilter`: removing by callable is not reliably implementable in PHP. It can be added later as a new method.
- Filament types: `ProvidesFilament::filamentPlugin()` returns `object` so the package stays usable without Filament.

## Plugin entry point

The entry point of a plugin is its service provider (`Spatie\LaravelPackageTools\PackageServiceProvider`, with `public static string $name`), like any Filament plugin. The package has `"type": "inupress-plugin"` and lists the provider in `extra.laravel.providers`; Laravel boots it. Plugins are activated and removed only with Composer.

```json
{
  "name": "acme/blog",
  "type": "inupress-plugin",
  "require": { "inupress/core": "^0.1" },
  "extra": { "laravel": { "providers": ["Acme\\Blog\\BlogServiceProvider"] } }
}
```
