<?php
/**
 * Super_Simple_GA class
 *
 * @package ssga
 * @since   0.1.0
 */

/**
 * Final Super_Simple_GA class.
 *
 * @final
 */
final class Super_Simple_GA {

    /**
     * Version
     *
     * (default value: '0.1.0')
     *
     * @var string
     * @access public
     */
    public $version = '0.1.0';

    /**
     * _instance
     *
     * (default value: null)
     *
     * @var mixed
     * @access protected
     * @static
     */
    protected static $_instance = null;

    /**
     * Instance function.
     *
     * @access public
     * @static
     * @return instance
     */
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    /**
     * Construct class.
     *
     * @access public
     * @return void
     */
    public function __construct() {
        $this->define_constants();
        $this->includes();
        $this->init_hooks();
    }

    /**
     * Define constants.
     *
     * @access private
     * @return void
     */
    private function define_constants() {
        $this->define( 'SSGA_VERSION', $this->version );
        $this->define( 'SSGA_PATH', plugin_dir_path( __FILE__ ) );
        $this->define( 'SSGA_URL', plugin_dir_url( __FILE__ ) );
        $this->define( 'SSGA_ASSETS_URL', plugin_dir_url( __FILE__ ) . 'assets/' );
    }

    /**
     * Custom define function.
     *
     * @access private
     * @param mixed $name string.
     * @param mixed $value string.
     * @return void
     */
    private function define( $name, $value ) {
        if ( ! defined( $name ) ) {
            define( $name, $value );
        }
    }

    /**
     * Include plugin files.
     *
     * @access public
     * @return void
     */
    public function includes() {
        if ( is_admin() ) {
            include_once( SSGA_PATH . '/admin/class-ssga-admin.php' );
        }
    }

    /**
     * Init hooks for plugin.
     *
     * @access private
     * @return void
     */
    private function init_hooks() {
        // add_action( 'init', array( $this, 'load_includes' ), 0 );
        add_action( 'wp_head', array( $this, 'wp_head' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'frontend_scripts_styles' ) );
    }

    public function wp_head() {
        // add code from admin page.
        // $code = get_option( '_ssga_code', '' );
        // validate is code?
    }

    /**
     * Frontend scripts and styles.
     *
     * @access public
     * @return void
     */
    public function frontend_scripts_styles() {
        // wp_enqueue_style( 'slwp-styles', SLWP_ASSETS_URL . 'css/styles.min.css', '', $this->version );
    }

    /**
     * Load includes.
     *
     * @access public
     * @return void
     */
    public function load_includes() {
        foreach ( $dirs as $dir ) :
            foreach ( glob( SSGA_PATH . $dir . '/*.php' ) as $file ) :
                include_once( $file );
            endforeach;
        endforeach;
    }

    /**
     * Add links to plugin action.
     *
     * @access public
     * @param mixed $links array.
     * @return array
     */
    public function plugin_action_links( $links ) {
        $links[] = sprintf( '<a href="%s" target="_blank">%s</a>', 'https://github.com/erikdmitchell/super-simple-ga', __( 'GitHub', 'SSGA' ) );

        return $links;
    }

}

/**
 * SSGA function.
 *
 * @access public
 * @return instance
 */
function ssga() {
    return Super_Simple_GA::instance();
}

// Global for backwards compatibility.
$GLOBALS['ssga'] = ssga();
