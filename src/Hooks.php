<?php

declare(strict_types=1);

namespace Inupress\Contracts;

/**
 * Names of the core extension points. These strings are public API: they are never renamed
 * inside a major version.
 */
final class Hooks
{
    /** Filter: list of admin navigation items. */
    public const ADMIN_MENU = 'admin.menu';

    /** Filter: list of dashboard widgets. */
    public const DASHBOARD_WIDGETS = 'dashboard.widgets';

    /** Filter: entry attributes before they are saved. */
    public const CONTENT_BEFORE_SAVE = 'content.before_save';

    /** Action: an entry has been saved. */
    public const CONTENT_SAVED = 'content.saved';

    /** Filter: HTML of rendered content. */
    public const CONTENT_RENDER = 'content.render';

    /**
     * Filter: the admin form field used for a block of content, so a plugin can replace the
     * built-in editor. Arguments: `string $name` (the field), `string $source` (who asks:
     * `pages`, `widgets`). The callback returns a Filament field; `inupress/editor-ckeditor`
     * answers with CKEditor.
     */
    public const CONTENT_EDITOR = 'content.editor';

    /** Action: a plugin has been enabled. Argument: plugin id. */
    public const PLUGIN_ENABLED = 'plugin.enabled';

    /** Action: a plugin has been disabled. Argument: plugin id. */
    public const PLUGIN_DISABLED = 'plugin.disabled';

    private function __construct() {}
}
