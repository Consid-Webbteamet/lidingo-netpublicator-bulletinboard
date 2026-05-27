<?php

declare(strict_types=1);

namespace LidingoNetpublicatorBulletinboard;

class Assets
{
    private static bool $stylesEnqueued = false;
    private static bool $scriptsEnqueued = false;

    public static function enqueueStyles(): void
    {
        if (self::$stylesEnqueued) {
            return;
        }

        $assetUrl = LIDINGO_NETPUBLICATOR_BULLETINBOARD_URL . 'assets/';
        $version = LIDINGO_NETPUBLICATOR_BULLETINBOARD_VERSION;

        wp_enqueue_style(
            'lidingo-netpublicator-bulletinboard-chosen',
            $assetUrl . 'vendor/bootstrap-chosen.css',
            [],
            $version
        );

        wp_enqueue_style(
            'lidingo-netpublicator-bulletinboard-netpublicator',
            $assetUrl . 'vendor/np-publicbulletinboard-v1.1.5.min.css',
            ['lidingo-netpublicator-bulletinboard-chosen'],
            $version
        );

        wp_enqueue_style(
            'lidingo-netpublicator-bulletinboard-fixes',
            $assetUrl . 'css/frontend.css',
            ['lidingo-netpublicator-bulletinboard-chosen'],
            $version
        );

        self::$stylesEnqueued = true;
    }

    public static function enqueueScripts(string $key): void
    {
        if (self::$scriptsEnqueued || $key === '') {
            return;
        }

        $assetUrl = LIDINGO_NETPUBLICATOR_BULLETINBOARD_URL . 'assets/';
        $version = LIDINGO_NETPUBLICATOR_BULLETINBOARD_VERSION;

        wp_enqueue_script(
            'lidingo-netpublicator-bulletinboard-jquery-compat',
            $assetUrl . 'js/jquery-compat.js',
            ['jquery'],
            $version,
            true
        );

        wp_enqueue_script(
            'lidingo-netpublicator-bulletinboard-chosen',
            $assetUrl . 'vendor/chosen.jquery.js',
            ['jquery', 'lidingo-netpublicator-bulletinboard-jquery-compat'],
            $version,
            true
        );

        wp_enqueue_script(
            'lidingo-netpublicator-bulletinboard-netpublicator',
            $assetUrl . 'vendor/np-publicbulletinboard-v1.1.5.min.js',
            ['jquery', 'lidingo-netpublicator-bulletinboard-jquery-compat', 'lidingo-netpublicator-bulletinboard-chosen'],
            $version,
            true
        );

        wp_enqueue_script(
            'lidingo-netpublicator-bulletinboard-frontend',
            $assetUrl . 'js/frontend.js',
            ['jquery', 'lidingo-netpublicator-bulletinboard-netpublicator'],
            $version,
            true
        );

        wp_add_inline_script(
            'lidingo-netpublicator-bulletinboard-frontend',
            'window.LidingoNetpublicatorBulletinboard = ' . wp_json_encode(['id' => $key]) . ';',
            'before'
        );

        self::$scriptsEnqueued = true;
    }
}
