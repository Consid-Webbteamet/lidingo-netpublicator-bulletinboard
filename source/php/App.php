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
    }
}
