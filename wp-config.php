<?php
/**
 * As configurações básicas do WordPress
 *
 * O script de criação wp-config.php usa esse arquivo durante a instalação.
 * Você não precisa usar o site, você pode copiar este arquivo
 * para "wp-config.php" e preencher os valores.
 *
 * Este arquivo contém as seguintes configurações:
 *
 * * Configurações do MySQL
 * * Chaves secretas
 * * Prefixo do banco de dados
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar estas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define( 'DB_NAME', 'wp' );

/** Usuário do banco de dados MySQL */
define( 'DB_USER', 'root' );

/** Senha do banco de dados MySQL */
define( 'DB_PASSWORD', '' );

/** Nome do host do MySQL */
define( 'DB_HOST', 'localhost' );

/** Charset do banco de dados a ser usado na criação das tabelas. */
define( 'DB_CHARSET', 'utf8mb4' );

/** O tipo de Collate do banco de dados. Não altere isso se tiver dúvidas. */
define( 'DB_COLLATE', '' );

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las
 * usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org
 * secret-key service}
 * Você pode alterá-las a qualquer momento para invalidar quaisquer
 * cookies existentes. Isto irá forçar todos os
 * usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'y3r}Ghjh0r^B s/_&|tiVolR&DB<L;YCsP+ _>.YavBfB;H8q.%:&^V63?ma6jcR' );
define( 'SECURE_AUTH_KEY',  'IU9c`]ppu+$?DDjrdy;,fU(9bK*Nxr/]@a3#iZB%Cc3I<G9^(|IudXHU Rw{A2A_' );
define( 'LOGGED_IN_KEY',    'T&T%(TH>d*p6us1r0dZhVu&v3XS]OrLDlWzK~$p!9}uH6K!MF<VeS+>+(p3]@s.^' );
define( 'NONCE_KEY',        'U^>V8wMuT)k`O=D2QUXS]{64s).fZ5eHJu&!n1$4VOz?btV.~2F%_Qcf:w;Jbz|-' );
define( 'AUTH_SALT',        '!5^&O<2T=0;FA#38*T;W@niqz.#zgG!<*1X V?laW:~#c#YEcoH)3Hnd!ch2;*~|' );
define( 'SECURE_AUTH_SALT', '.zCSD&/Qm/W[3HKD7&}%/&B3|*kz1|-BZ%7I;Q`{Jk&<y>ff9&~U9J}RO)5<Qnf(' );
define( 'LOGGED_IN_SALT',   'Df9$)iJArs2F:p`v[{$%Bn2w%J:UCl$26qNTHW!K7,.3Is!8U0 L^Vy^d]BV&4&d' );
define( 'NONCE_SALT',       'S0{|Mh42sGm`)MvqVZ~6-/3G%)vYMq1PS[qf&kNSMG[#u~@nZNM%({MdacLKjm10' );

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der
 * um prefixo único para cada um. Somente números, letras e sublinhados!
 */
$table_prefix = 'wp_';

/**
 * Para desenvolvedores: Modo de debug do WordPress.
 *
 * Altere isto para true para ativar a exibição de avisos
 * durante o desenvolvimento. É altamente recomendável que os
 * desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 *
 * Para informações sobre outras constantes que podem ser utilizadas
 * para depuração, visite o Codex.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Configura as variáveis e arquivos do WordPress. */
require_once ABSPATH . 'wp-settings.php';
