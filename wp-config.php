<?php
/** 
 * Configuración básica de WordPress.
 *
 * Este archivo contiene las siguientes configuraciones: ajustes de MySQL, prefijo de tablas,
 * claves secretas, idioma de WordPress y ABSPATH. Para obtener más información,
 * visita la página del Codex{@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} . Los ajustes de MySQL te los proporcionará tu proveedor de alojamiento web.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** Ajustes de MySQL. Solicita estos datos a tu proveedor de alojamiento web. ** //
/** El nombre de tu base de datos de WordPress */
//define('WP_CACHE', true); //Added by WP-Cache Manager
define( 'WPCACHEHOME', 'C:\xampp\htdocs\doctaforumdb2\wp-content\plugins\wp-super-cache/' ); //Added by WP-Cache Manager
define('DB_NAME', 'doctaforumdb2');

/** Tu nombre de usuario de MySQL */
define('DB_USER', 'root');

/** Tu contraseña de MySQL */
define('DB_PASSWORD', '');

/** Host de MySQL (es muy probable que no necesites cambiarlo) */
define('DB_HOST', 'localhost');

/** Codificación de caracteres para la base de datos. */
define('DB_CHARSET', 'utf8mb4');

/** Cotejamiento de la base de datos. No lo modifiques si tienes dudas. */
define('DB_COLLATE', '');

/**#@+
 * Claves únicas de autentificación.
 *
 * Define cada clave secreta con una frase aleatoria distinta.
 * Puedes generarlas usando el {@link https://api.wordpress.org/secret-key/1.1/salt/ servicio de claves secretas de WordPress}
 * Puedes cambiar las claves en cualquier momento para invalidar todas las cookies existentes. Esto forzará a todos los usuarios a volver a hacer login.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', 'zW1h!_>r&AuIC<,ckL`7L&A)+#7~Fakpvx`mjJ;e`Z74*n1!^sts-NGUHwGH;(Ym');
define('SECURE_AUTH_KEY', '!~,{1 Z;`Y53:*-/AUpG&$kYy;&a]=/4uaw=kt[90l&/OQM(cqM6}`Grvg>#Vr#O');
define('LOGGED_IN_KEY', 'Y*reaR|R6:QMZFq$;B?nk6u7H?2([i|s*%@dz#yQ[6dG} dZ*fu!lGVu18BL3h%,');
define('NONCE_KEY', 'rqDZU4rTftD@~;oE/R3AT;zHxKMlpuL/3nA^i-$;B%n2fEF;v>p~j|ok>s?Isf%Y');
define('AUTH_SALT', '@*D86U:2O625vm|X[4>&k[h5[jNs4}AN%(9Gt4_8bK3vZ6<Qt]IxRDZ2Tm;bWvj`');
define('SECURE_AUTH_SALT', '>_pz>s<Q<|1<r~kBe3^70s+c/{o&,2!Mw,|FO0X47h IZWf3!&tHKYYe4yw)2_T+');
define('LOGGED_IN_SALT', '<S;uS%!1<c^!$o6zf0+)Q{i|.yJ<OBJW4z6FXocV)>yEQTm%OATR/Z7qTM9:Vgdy');
define('NONCE_SALT', 'A ?i@l3z^Wtu$R=U*0nnZqrgX(rQd*Gy5s:kY8tKq[r,RdM$;Ycy}a){Xe6rsb;V');

/**#@-*/

/**
 * Prefijo de la base de datos de WordPress.
 *
 * Cambia el prefijo si deseas instalar multiples blogs en una sola base de datos.
 * Emplea solo números, letras y guión bajo.
 */
$table_prefix  = 'wp_';


/**
 * Para desarrolladores: modo debug de WordPress.
 *
 * Cambia esto a true para activar la muestra de avisos durante el desarrollo.
 * Se recomienda encarecidamente a los desarrolladores de temas y plugins que usen WP_DEBUG
 * en sus entornos de desarrollo.
 */
define('WP_DEBUG', false);

/* ¡Eso es todo, deja de editar! Feliz blogging */

/** WordPress absolute path to the Wordpress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');


define('ENABLE_CACHE', true );