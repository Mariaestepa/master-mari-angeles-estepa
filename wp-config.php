<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'mariangelesestepa' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

if ( !defined('WP_CLI') ) {
    define( 'WP_SITEURL', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] );
    define( 'WP_HOME',    $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] );
}



/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'nZg940s1a8OU7E6XCoD0ieJfbZXwyMLDJt6hdJsguHhdvy13sftRz1D9EThY86O2' );
define( 'SECURE_AUTH_KEY',  'MNRJ0RrFM2wwTideXodpSsEgycbayChLc3a5xp1L42c3Q4MkKHwYKA9LyVus8H1i' );
define( 'LOGGED_IN_KEY',    'APY1GgoknrKN4NTDKFgEF5o1MPzOVC78Oom4lfTYAye1g2Ukc2f5AgzEOLVW5zRC' );
define( 'NONCE_KEY',        'XgihCCx4eGuKpejideAIpsTMEx4mXMAkDWIOBW6u66XYRhMExrUvGSlzDxHlqlia' );
define( 'AUTH_SALT',        'oljHmgncbe1Sk6cdBC1vrAyfRx54TlpZistBFvEfAkK5i5odKzQTAdvdWaHk9xwX' );
define( 'SECURE_AUTH_SALT', 'S62gUcTLf6jcMoxnSOw4LtproNFUKiz6MWErvWBf7iykyoL2Qp7ekg4yKFWUecv2' );
define( 'LOGGED_IN_SALT',   '7suGnINTf4diAKKRWotV9pDI8zcCwqq6Y92E74bSKU2ZJMkquW1Gdgtn3XgW5CJD' );
define( 'NONCE_SALT',       'UuBXT8KyQtszJeqhJEx0V2nskbAgTpgrAudDUT46gr4X0KsqXgJM5XTgiMHp2uAY' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
