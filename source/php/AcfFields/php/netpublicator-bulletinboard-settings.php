<?php

declare(strict_types=1);

if (!function_exists('acf_add_local_field_group')) {
    return;
}

acf_add_local_field_group([
    'key' => 'group_modularity_netpublicator_bulletinboard_settings',
    'title' => __('Anslagstavla', 'lidingo-netpublicator-bulletinboard'),
    'fields' => [
        [
            'key' => 'field_netpublicator_bulletinboard_editor_info',
            'label' => __('Instruktion', 'lidingo-netpublicator-bulletinboard'),
            'name' => '',
            'type' => 'message',
            'message' => __('Den här modulen visar kommunens anslagstavla från Netpublicator. Ingen ytterligare inställning behövs här i blocket. Nyckeln hanteras centralt under Inställningar > Anslagstavla. Använd en anslagstavla per sida.', 'lidingo-netpublicator-bulletinboard'),
            'new_lines' => 'wpautop',
            'esc_html' => 0,
        ],
    ],
    'location' => [
        [
            [
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'mod-netpublicator-bulletinboard',
            ],
        ],
        [
            [
                'param' => 'block',
                'operator' => '==',
                'value' => 'acf/netpublicator-bulletinboard',
            ],
        ],
    ],
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => true,
    'description' => '',
    'show_in_rest' => 0,
]);
