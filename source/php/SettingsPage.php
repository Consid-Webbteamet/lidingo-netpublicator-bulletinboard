<?php

declare(strict_types=1);

namespace LidingoNetpublicatorBulletinboard;

class SettingsPage
{
    public const OPTION_KEY = 'lidingo_netpublicator_bulletinboard_key';

    public function addHooks(): void
    {
        add_action('admin_menu', [$this, 'addSettingsPage']);
        add_action('admin_init', [$this, 'registerSettings']);
    }

    public function addSettingsPage(): void
    {
        add_options_page(
            __('Anslagstavla', 'lidingo-netpublicator-bulletinboard'),
            __('Anslagstavla', 'lidingo-netpublicator-bulletinboard'),
            'manage_options',
            'lidingo-netpublicator-bulletinboard',
            [$this, 'render']
        );
    }

    public function registerSettings(): void
    {
        register_setting(
            'lidingo_netpublicator_bulletinboard',
            self::OPTION_KEY,
            [
                'type' => 'string',
                'sanitize_callback' => 'sanitize_text_field',
                'default' => '',
            ]
        );

        add_settings_section(
            'lidingo_netpublicator_bulletinboard_main',
            __('Netpublicator', 'lidingo-netpublicator-bulletinboard'),
            '__return_false',
            'lidingo-netpublicator-bulletinboard'
        );

        add_settings_field(
            self::OPTION_KEY,
            __('Netpublicator-nyckel', 'lidingo-netpublicator-bulletinboard'),
            [$this, 'renderKeyField'],
            'lidingo-netpublicator-bulletinboard',
            'lidingo_netpublicator_bulletinboard_main'
        );
    }

    public function render(): void
    {
        if (!current_user_can('manage_options')) {
            return;
        }

        echo '<div class="wrap">';
        echo '<h1>' . esc_html__('Anslagstavla', 'lidingo-netpublicator-bulletinboard') . '</h1>';
        echo '<form action="options.php" method="post">';
        settings_fields('lidingo_netpublicator_bulletinboard');
        do_settings_sections('lidingo-netpublicator-bulletinboard');
        submit_button();
        echo '</form>';
        echo '</div>';
    }

    public function renderKeyField(): void
    {
        $value = get_option(self::OPTION_KEY, '');

        printf(
            '<input type="password" class="regular-text" name="%1$s" value="%2$s" autocomplete="off">',
            esc_attr(self::OPTION_KEY),
            esc_attr(is_string($value) ? $value : '')
        );
    }

    public static function getKey(): string
    {
        $value = get_option(self::OPTION_KEY, '');

        return is_string($value) ? trim($value) : '';
    }
}
