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

    /** Action: a plugin has been enabled. Argument: plugin id. */
    public const PLUGIN_ENABLED = 'plugin.enabled';

    /** Action: a plugin has been disabled. Argument: plugin id. */
    public const PLUGIN_DISABLED = 'plugin.disabled';

    private function __construct() {}
}
