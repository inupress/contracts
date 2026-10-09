# inupress/contracts

Public API of the Inupress CMS. Depends only on `illuminate/contracts`. Filament is optional (`suggest`).

## What is public API

Everything in `src/`, and nothing else:

| Item | Kind | Purpose |
|---|---|---|
| `Plugin` | interface | Plugin lifecycle: `manifest()`, `register()`, `boot()`. Not a service provider. |
| `ProvidesFilament` | interface | Optional: plugin adds something to the admin panel. |
| `PluginManifest` | final readonly class | Immutable plugin description, built from `extra.inupress`. |
| `PluginRepository` | interface | Read-only view of enabled plugins. |
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
implement (`Plugin`, `ProvidesFilament`, `Theme`) only change in a major version.

Until 1.0 anything may change, but each change is still recorded as a decision.

## Not in the contracts on purpose

- `removeAction` / `removeFilter`: removing by callable is not reliably implementable in PHP. It can be added later as a new method.
- Filament types: `ProvidesFilament::filamentPlugin()` returns `object` so the package stays usable without Filament.

## Plugin manifest

```json
"extra": {
  "inupress": {
    "id": "inupress/blog",
    "provider": "Inupress\\Blog\\BlogPlugin",
    "requires": { "core": "^1.0" },
    "provides": ["blog.posts"]
  }
}
```

Do not list the provider under `extra.laravel.providers`: only the core registers plugins.
