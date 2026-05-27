<?php

declare(strict_types=1);

namespace LidingoNetpublicatorBulletinboard\Module;

use LidingoNetpublicatorBulletinboard\Assets;
use LidingoNetpublicatorBulletinboard\SettingsPage;

class NetpublicatorBulletinboard extends \Modularity\Module
{
    public $slug = 'netpublicator-bulletinboard';
    public $supports = [];
    public $isBlockCompatible = true;
    public $expectsTitleField = false;

    public function init(): void
    {
        $this->nameSingular = __('Anslagstavla', 'lidingo-netpublicator-bulletinboard');
        $this->namePlural = __('Anslagstavla', 'lidingo-netpublicator-bulletinboard');
        $this->description = __('Visar kommunens anslagstavla från Netpublicator.', 'lidingo-netpublicator-bulletinboard');
    }

    public function data(): array
    {
        $this->getFields();

        return [
            'hasKey' => SettingsPage::getKey() !== '',
        ];
    }

    public function template(): string
    {
        return 'netpublicator-bulletinboard.blade.php';
    }

    public function style(): void
    {
        if (SettingsPage::getKey() === '') {
            return;
        }

        Assets::enqueueStyles();
    }

    public function script(): void
    {
        $key = SettingsPage::getKey();
        if ($key === '') {
            return;
        }

        Assets::enqueueScripts($key);
    }
}
