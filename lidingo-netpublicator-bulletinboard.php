<?php

declare(strict_types=1);

/**
 * Plugin Name:       Lidingo Netpublicator Bulletinboard
 * Description:       Displays the Netpublicator bulletin board as a Gutenberg block.
 * Version:           0.1.0
 * Author:            Consid Webbteamet
 * Text Domain:       lidingo-netpublicator-bulletinboard
 * Domain Path:       /languages
 */

namespace LidingoNetpublicatorBulletinboard;

if (!defined('ABSPATH')) {
    exit;
}

define('LIDINGO_NETPUBLICATOR_BULLETINBOARD_PATH', plugin_dir_path(__FILE__));
define('LIDINGO_NETPUBLICATOR_BULLETINBOARD_URL', plugin_dir_url(__FILE__));
define('LIDINGO_NETPUBLICATOR_BULLETINBOARD_VERSION', '0.1.0');

$autoload = LIDINGO_NETPUBLICATOR_BULLETINBOARD_PATH . 'vendor/autoload.php';
if (file_exists($autoload)) {
    require_once $autoload;
} else {
    spl_autoload_register(static function (string $class): void {
        $prefix = __NAMESPACE__ . '\\';
        if (strpos($class, $prefix) !== 0) {
            return;
        }

        $relativeClass = substr($class, strlen($prefix));
        $relativePath = str_replace('\\', DIRECTORY_SEPARATOR, $relativeClass) . '.php';
        $file = LIDINGO_NETPUBLICATOR_BULLETINBOARD_PATH . 'source/php/' . $relativePath;

        if (file_exists($file)) {
            require_once $file;
        }
    });
}

add_action('plugins_loaded', static function (): void {
    if (!class_exists(App::class)) {
        return;
    }

    new App();
});
