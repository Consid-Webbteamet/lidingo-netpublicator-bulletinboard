<?php

declare(strict_types=1);

namespace LidingoNetpublicatorBulletinboard;

class App
{
    private SettingsPage $settingsPage;
    private BulletinboardBlock $block;

    public function __construct()
    {
        $this->settingsPage = new SettingsPage();
        $this->block = new BulletinboardBlock();

        $this->addHooks();
    }

    private function addHooks(): void
    {
        $this->settingsPage->addHooks();
        $this->block->addHooks();
        add_action('init', [$this, 'registerModule']);
        add_filter('/Modularity/externalViewPath', [$this, 'registerExternalViewPath'], 10, 1);
    }

    public function registerModule(): void
    {
        if (!function_exists('modularity_register_module')) {
            return;
        }

        modularity_register_module(
            LIDINGO_NETPUBLICATOR_BULLETINBOARD_MODULE_PATH,
            'NetpublicatorBulletinboard'
        );
    }

    public function registerExternalViewPath(array $paths): array
    {
        $paths['mod-netpublicator-bulletinboard'] = LIDINGO_NETPUBLICATOR_BULLETINBOARD_MODULE_VIEW_PATH;

        return $paths;
    }
}
