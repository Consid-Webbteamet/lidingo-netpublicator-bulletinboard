<?php

declare(strict_types=1);

namespace LidingoNetpublicatorBulletinboard;

class BulletinboardBlock
{
    private bool $hasRendered = false;

    public function addHooks(): void
    {
        add_action('init', [$this, 'register']);
    }

    public function register(): void
    {
        if (!function_exists('register_block_type')) {
            return;
        }

        register_block_type(
            LIDINGO_NETPUBLICATOR_BULLETINBOARD_PATH . 'blocks/netpublicator-bulletinboard',
            [
                'render_callback' => [$this, 'render'],
            ]
        );
    }

    /**
     * Render only one widget per request because the vendor script uses fixed DOM ids.
     */
    public function render(): string
    {
        $key = SettingsPage::getKey();
        if ($key === '' || $this->hasRendered) {
            return '';
        }

        $this->hasRendered = true;
        $this->enqueueAssets($key);

        return '<div id="bulletinboard"></div>';
    }

    private function enqueueAssets(string $key): void
    {
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

        wp_enqueue_script(
            'lidingo-netpublicator-bulletinboard-chosen',
            $assetUrl . 'vendor/chosen.jquery.js',
            ['jquery'],
            $version,
            true
        );

        wp_enqueue_script(
            'lidingo-netpublicator-bulletinboard-netpublicator',
            $assetUrl . 'vendor/np-publicbulletinboard-v1.1.5.min.js',
            ['jquery', 'lidingo-netpublicator-bulletinboard-chosen'],
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
    }
}
