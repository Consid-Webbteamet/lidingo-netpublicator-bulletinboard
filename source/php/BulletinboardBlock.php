<?php

declare(strict_types=1);

namespace LidingoNetpublicatorBulletinboard;

class BulletinboardBlock
{
    public function addHooks(): void
    {
        add_action('init', [$this, 'register']);
        add_action('wp_enqueue_scripts', [$this, 'enqueueAssetsForCurrentPage']);
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

    public function render(): string
    {
        $key = SettingsPage::getKey();
        if ($key === '') {
            return '';
        }

        return '<div id="bulletinboard"></div>';
    }

    public function enqueueAssetsForCurrentPage(): void
    {
        if (!is_singular()) {
            return;
        }

        $post = get_post();
        $key = SettingsPage::getKey();

        if (!$post instanceof \WP_Post || $key === '' || !has_block('lidingo/netpublicator-bulletinboard', $post)) {
            return;
        }

        $this->enqueueAssets($key);
    }

    private function enqueueAssets(string $key): void
    {
        Assets::enqueueStyles();
        Assets::enqueueScripts($key);
    }
}
