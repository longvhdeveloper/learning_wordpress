<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '[Z&liPDn+?yZE2Y|-tioCb@HYwk2fo$9#xqJp6T[ -YmXJAlsKj7&&43L4y _T*t');
define('SECURE_AUTH_KEY',  '2-&+qUE#`;s8MNa->tgc!zQ+g(jv6WC+QJ@zmS~|b-+6*O^49ZPD`_9^sAa1V988');
define('LOGGED_IN_KEY',    '@}0<O9ney~>.<9j&ELii_}vm696lw-0_4X(sHF9;N<y+Z:ibPQj4}e#P+[&BB<nF');
define('NONCE_KEY',        'W vlSTi-s|0>(vGYb(kd@WSWn.]RB+q#<pMQ(C1s*cN&Qe*ZD9x}H: vur=}rxph');
define('AUTH_SALT',        'kZf8[^^8CBxh4?Y-HM{om-oZS1513|%R+X}/+pHb<]8JBAK+|Fi4DzZ[p8]IF~Q.');
define('SECURE_AUTH_SALT', 'aTOO?Zuk+tc]|><5s]loW}}Pgv$-13(3nW>$9MF.EcO.67M^@2-c@S@:q0UOQE|1');
define('LOGGED_IN_SALT',   '- Tc]`CZ|p,u3B^=BAb>TjwX:PM8khsLHW87|PimPt1CCP=+d{KIK|-M`i#KWos0');
define('NONCE_SALT',       '3D=uLKtV%)fW9EVAzpR@r7QGe1w$&{(Bx@JYC88ycG{D[|Xx$R:MI9v=#}-Gch~^');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

define('FS_METHOD', 'direct');
