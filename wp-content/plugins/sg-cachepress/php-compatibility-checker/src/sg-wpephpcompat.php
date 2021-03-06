<?php
// Exit if this file is directly accessed
if ( ! defined( 'ABSPATH' ) ) { exit; }

require_once( __DIR__ . '/../vendor/autoload.php' );

/**
 * Summary.
 *
 * Description.
 *
 * @since 1.0.0
 */
class SG_WPEPHPCompat {
	/**
	 * The PHP_CodeSniffer_CLI object.
	 *
	 * @since 1.0.0
	 * @access public
	 * @var object
	 */
	public $cli = null;

	/**
	 * Default values for PHP_CodeSniffer scan.
	 *
	 * @since 1.0.0
	 * @access public
	 * @var array
	 */
	public $values = array();

	/**
	 * Version of PHP to test.
	 *
	 * @since 1.0.0
	 * @access public
	 * @var string
	 */
	public $test_version = null;

	/**
	 * Scan only active plugins or all?
	 *
	 * @since 1.0.0
	 * @access public
	 * @var string
	 */
	public $only_active = null;

	/**
	 * The base directory for the plugin.
	 *
	 * @since 1.0.0
	 * @access public
	 * @var string
	 */
	public $base = null;

        private $whitelistUrl = 'http://updates.sgvps.net/plugins_whitelist.json';  
        
        private $errorsIgnorelistUrl = 'http://updates.sgvps.net/errors_ignorelist.json';                        
        
        private $whitelist = null;   
        
        private $errorsIgnorelist = null;  
        
        private $errorsIgnorelistFallback = array(
            array("rx" => "/WARNING\s+\|\s+INI\s+directive\s+'safe_mode'\s+is\s+deprecated\s+since\s+PHP\s+5\.3\s+and\s+removed\s+since\s+PHP\s+5\.4/"),
            array("str" => "WARNING | INI directive 'safe_mode' is deprecated since PHP 5.3 and removed since PHP 5.4"),
            array("str" => "File has mixed line endings; this may cause incorrect results")
        );    

	/**
	 *  Array of "directory name" => "latest PHP version it's compatible with".
	 *
	 *  @todo Using the directory name is brittle, we shouldn't use it.
	 *  @since 1.0.3
	 *  @var array
	 */
	public $whitelistFallback = array(
          // https://wordpress.org/support/topic/false-positive-showing-bbpress-as-not-php-7-compatible/
          "*/bbpress/*" => array( "bbPress", "2.5.12", "7.0"),

          // https://wordpress.org/support/topic/false-positive-comet-cache/
          "*/comet-cache/*" => array( "Comet Cache", "161221", "7.0"), 

          // https://wordpress.org/support/topic/false-positive-comment-mail/
          "*/comment-mail/*" => array( "Comment Mail", "161213", "7.0",),   

          // https://github.com/wpengine/phpcompat/issues/84
          "*/download-monitor/*" => array( "Download Monitor" , "1.9.5", "7.0",), 

          // https://github.com/wpengine/phpcompat/wiki/Results#easy-digital-downloads
          "*/easy-digital-downloads/*" => array( "Easy Digital Downloads" , "2.6.17","7.0",), 

          // https://github.com/wpengine/phpcompat/issues/85
          "*/gravityforms/*" => array( "GravityForm to Post" , "0.9" ,"7.0",), 

          // https://github.com/wpengine/phpcompat/wiki/Results#jetpack
          "*/jetpack/*" => array( "Jetpack by WordPress.com" , "4.5" ,"7.0",),    

          // https://wordpress.org/support/topic/false-positive-mailpoet-3-not-compatible-with-php7/
          "*/mailpoet/*" => array( "MailPoet" , "3.0.0-beta.15" ,"7.0",),  

          "*/megamenu/*" => array( "Max Mega Menu" , "2.3.4" ,"7.0",),

          "*/myMail/*" => array( "MyMail - Email Newsletter Plugin for WordPress" , "2.1.32", "7.0",),

          // https://wordpress.org/support/topic/false-positive-showing-query-monitor-as-not-php-7-compatible/
          "*/query-monitor/*" => array( "Query Monitor" , "2.13.2", "7.0",),
          "*/sg-cachepress/*" => array( ["SG CachePress", "SG Optimizer"] , "3.0.0", "7.0",),
            // https://wordpress.org/plugins/social-networks-auto-poster-facebook-twitter-g/
          "*/social-networks-auto-poster-facebook-twitter-g/*"  => array( "NextScripts: Social Networks Auto-Poster" , "3.7.14", "7.0",),    
          "*/tablepress/*" => array( "TablePress" , "1.7", "7.0",),
          "*/updraftplus/*" => array( "UpdraftPlus" , "1.12.32", "7.0",),
          "*/vendor/stripe/stripe-php/lib/StripeObject.php" => array( '*' , '*', "7.0",),

          // https://github.com/wpengine/phpcompat/wiki/Results#woocommerce
          "*/woocommerce/*" => array( "WooCommerce" , "2.6.13", "7.0",),

          // https://github.com/wpengine/phpcompat/wiki/Results#wordfence-security
          "*/wordfence/*" => array( "Wordfence Security" , "6.3.0", "7.0",),

          // https://github.com/wpengine/phpcompat/wiki/Results#wp-migrate-db
          "*/wp-migrate-db/*" => array( "WP Migrate DB" , "0.9.2", "7.0",),
          "*/wp-spamshield/*" => array( "WP-SpamShield" , "1.9.9.8.7", "7.0",),
            );
        
        public function get_list($listName) {
            if ($this->$listName !== null) {
                return $this->$listName;
            }

            ini_set('default_socket_timeout', 10);
            $listJson = file_get_contents($this->{$listName . 'Url'});
            $listArray = json_decode($listJson, true);

            if (json_last_error() === JSON_ERROR_NONE) {
                $this->$listName = $listArray;
            } else {
                $this->$listName = $this->{$listName . 'Fallback'};
            }
            
            return $this->$listName;
        }

	/**
	 * @param string $dir Base plugin directory.
	 */
	function __construct( $dir ) {
		$this->base = $dir;
		$this->cli = new PHP_CodeSniffer_CLI();
	}

	/**
	 * Start the testing process.
	 *
	 * @since  1.0.0
	 * @return  null
	 */
	public function start_test() {
		$this->debug_log( 'startScan: ' . isset( $_POST['startScan'] ) );

		/**
		* Filters the scan timeout.
		*
		* Lets you change the timeout of the scan. The value is how long the scan
		* runs before dying and picking back up on a cron. You can set $timeout to
		* 0 to disable the timeout and the cron.
		*
		* @since 1.0.4
		*
		* @param int $timeout The timeout in seconds.
		*/
		$timeout = apply_filters( 'sg_wpephpcompat_scan_timeout', MINUTE_IN_SECONDS );
		$this->debug_log( 'timeout: ' . $timeout );

		// No reason to lock if there's no timeout.
		if ( 0 !== $timeout ) {
			// Try to lock.
			$lock_result = add_option( 'sg_wpephpcompat.lock', time(), '', 'no' );

			$this->debug_log( 'lock: ' . $lock_result );

			if ( ! $lock_result ) {
				$lock_result = get_option( 'sg_wpephpcompat.lock' );

				// Bail if we were unable to create a lock, or if the existing lock is still valid.
				if ( ! $lock_result || ( $lock_result > ( time() - $timeout ) ) ) {
					$this->debug_log( 'Process already running (locked), returning.' );

					$timestamp = wp_next_scheduled( 'sg_wpephpcompat_start_test_cron' );

					if ( false == $timestamp ) {
						wp_schedule_single_event( time() + $timeout, 'sg_wpephpcompat_start_test_cron' );
					}
					return;
				}
			}
			update_option( 'sg_wpephpcompat.lock', time(), false );
		}

		// Check to see if scan has already started.
		$scan_status = get_option( 'sg_wpephpcompat.status' );
		$this->debug_log( 'scan status: ' . $scan_status );
		if ( ! $scan_status ) {

			// Clear the previous results.
			delete_option( 'sg_wpephpcompat.scan_results' );

			update_option( 'sg_wpephpcompat.status', '1', false );
			update_option( 'sg_wpephpcompat.test_version', $this->test_version, false );
			update_option( 'sg_wpephpcompat.only_active', $this->only_active, false );

			$this->debug_log( 'Generating directory list.' );
			//Add plugins and themes.
			$this->generate_directory_list();

			$count_jobs = wp_count_posts( 'sg_wpephpcompat_jobs' );
			update_option( 'sg_wpephpcompat.numdirs', $count_jobs->publish, false );
		} else {
			// Get scan settings from database.
			$this->test_version = get_option( 'sg_wpephpcompat.test_version' );
			$this->only_active = get_option( 'sg_wpephpcompat.only_active' );
		}

		$args = array(
			'posts_per_page' => -1,
			'post_type'      => 'sg_wpephpcompat_jobs',
			'orderby'        => 'title',
			'order'          => 'ASC',
		);
		$directories = get_posts( $args );
		$this->debug_log( count( $directories ) . ' plugins left to process.' );

		// If there are no directories to scan, we're finished!
		if ( ! $directories ) {
			$this->debug_log( 'No more plugins to process.' );
			update_option( 'sg_wpephpcompat.status', '0', false );

			return;
		}
		if ( 0 !== $timeout ) {
			wp_schedule_single_event( time() + $timeout, 'sg_wpephpcompat_start_test_cron' );
		}

		if ( ! $this->is_command_line() ) {
			// Close the connection to the browser.
			$this->close_connection( 'started' );

			/**
			 * Kill cron after a configurable timeout.
			 * Subtract 5 from the timeout if we can to avoid race conditions.
			 */
			set_time_limit( ( $timeout > 5 ? $timeout - 5 : $timeout ) );
		}

		$scan_results = get_option( 'sg_wpephpcompat.scan_results' );

		foreach ( $directories as $directory ) {
                        $data = json_decode($directory->post_excerpt, true);                                                  
                        $myVersion = isset($data['Version']) && strlen($data['Version']) ? $data['Version'] : 'XXX';
                        $ts = time();
			$this->debug_log( 'Processing: ' . $directory->post_title );

			// Add the plugin/theme name to the results.
			$scan_results .= __( 'Name', 'sg-cachepress' ) . ': ' . $directory->post_title . "\n\n";

			// Keep track of the number of times we've attempted to scan the plugin.
			$count = get_post_meta( $directory->ID, 'count', true ) ?: 1;
			$this->debug_log( 'Attempted scan count: ' . $count );

			if ( $count > 2 ) { // If we've already tried twice, skip it.
				$scan_results .= __( 'The plugin/theme was skipped as it was too large to scan before the server killed the process.', 'sg-cachepress' ) . "\n\n";
				update_option( 'sg_wpephpcompat.scan_results', $scan_results , false );
				wp_delete_post( $directory->ID );
				$count = 0;
				$this->debug_log( 'Skipped: ' . $directory->post_title );
				continue;
			}

			// Increment and save the count.
			$count++;
			update_post_meta( $directory->ID, 'count', $count );

			// Start the scan.
			$report = $this->process_file( $directory->post_content, $directory->post_title, $data );

			if ( ! $report ) {
				$report = 'PHP ' . $this->test_version . __( ' compatible.', 'sg-cachepress' );
			}

			$scan_results .= $report . "\n";

			$update = get_post_meta( $directory->ID, 'update', true );

			if ( ! empty( $update ) ) {
				$version = get_post_meta( $directory->ID, 'version', true );
				$scan_results .= 'Update Available: ' . $update . '; Current Version: ' . $version . ";\n";
			}

			$scan_results .= "\n";

			update_option( 'sg_wpephpcompat.scan_results', $scan_results , false );

			wp_delete_post( $directory->ID );
		}

		update_option( 'sg_wpephpcompat.status', '0', false );

		$this->debug_log( 'Scan finished.' );
                
                $lines = array();
                $i = 0;                
                
                foreach(explode(PHP_EOL, $scan_results) as $line) {
                    $lines[$i] = $line;
                    $isIgnored = false;
                    
                    // check if this row match some of the whitelisted (ignored) warnings
                    foreach ($this->get_list('errorsIgnorelist') as $ignoredErr) {
                        if (isset($ignoredErr['str']) && strpos($line, $ignoredErr['str']) !== false) {
                            $isIgnored = true;
                        }
                   
                        if (isset($ignoredErr['rx']) && preg_match($ignoredErr['rx'], $line)) {
                            $isIgnored = true;
                        }                         
                    }
                    
                    // delete the whole block
                    if ($isIgnored) {
                        foreach (range(0, 4) as $num) {
                            if (strlen($lines[$i - $num])) {
                                $lines[$i - $num] = '';
                            }
                        }
                    }
                    
                    $i++;
                }               
                
                $scan_results = implode(PHP_EOL, $lines);   
                                
                $scan_results .= 'End Report ';
                $scan_results .= time();                
                update_option( 'sg_wpephpcompat.scan_results', $scan_results , false );                
		return $scan_results;
	}

	/**
	* Runs the actual PHPCompatibility test.
	*
	* @since  1.0.0
	* @return string Scan results.
	*/
	public function process_file( $dir, $plugin_name, $plugin_data ) {            
                $plugin_version = isset($plugin_data['Version']) ? $plugin_data['Version'] : false;
                
		$this->values['files']       = $dir;
		$this->values['testVersion'] = $this->test_version;
		$this->values['standard']    = 'PHPCompatibility';
		$this->values['reportWidth'] = '9999';
		$this->values['extensions']  = array( 'php' );

		// Whitelist.
		$this->values['ignored'] = $this->generate_ignored_list($plugin_name, $plugin_version);
                
		PHP_CodeSniffer::setConfigData( 'testVersion', $this->test_version, true );

		ob_start();

		$this->cli->process( $this->values );

		$report = ob_get_clean();

		return $this->clean_report( $report );
	}

	/**
	 * Generate a list of ignored files and directories.
	 *
	 * @since 1.0.3
	 * @return array An array containing files and directories that should be ignored.
	 */
	public function generate_ignored_list($plugin_name, $current_plugin_version) {
		// Default ignored list.
		$ignored = array(
			'*/tests/*', // No reason to scan tests.
			'*/test/*', // Another common test directory.
			'*/node_modules/*', // Commonly used for development but not in production.
			'*/tmp/*', // Temporary files.
		);
                
                //print_r(json_encode($this->get_list('whitelist')));exit;
		foreach ( $this->get_list('whitelist') as $plugin => $whitelistData ) {
                    $whitelisted_plugin_name = $whitelistData[0];
                    $whitelisted_plugin_version = $whitelistData[1];
                    $whitelisted_php_version = $whitelistData[2];
                    
                    // plugin name not mtach (array)
                    if ($whitelisted_plugin_version !== '*' && // is not wildcard
                            is_array($whitelisted_plugin_name) &&  
                            !in_array( $plugin_name, $whitelisted_plugin_name )
                        ) {
                        continue;
                    }
                    
                    // plugin name not mtach (string)
                    if ($whitelisted_plugin_version !== '*' && // is not wildcard
                            !is_array($whitelisted_plugin_name) && 
                            $plugin_name !== $whitelisted_plugin_name) {
                        continue;
                    }
                    
                    // compare plugin version
                    if ($whitelisted_plugin_version !== null && !version_compare( $current_plugin_version, $whitelisted_plugin_version, '>=' )) {                                               
                        continue;
                    } 
                                                 
                                         
                    // Check to see if the plugin is compatible with the tested PHP version.
                    if ( version_compare( $this->test_version, $whitelisted_php_version, '<=' ) ) {
				array_push( $ignored, $plugin );
			}
		}

		return apply_filters( 'phpcompat_whitelist', $ignored );
	}

	/**
	* Generate a list of directories to scan and populate the queue.
	*
	* @since  1.0.0
	* @return null
	*/
	public function generate_directory_list() {
		if ( ! function_exists( 'get_plugins' ) ) {

			require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		}

		$plugin_base = dirname( $this->base ) . DIRECTORY_SEPARATOR;

		$all_plugins = get_plugins();

		$update_plugins = get_site_transient( 'update_plugins' );

		foreach ( $all_plugins as $k => $v ) {
			//Exclude our plugin.
			if ( 'PHP Compatibility Checker' === $v['Name'] ) {
				continue;
			}

			// Exclude active plugins if only_active = "yes".
			if ( 'yes' === $this->only_active ) {
				// Get array of active plugins.
				$active_plugins = get_option( 'active_plugins' );

				if ( ! in_array( $k, $active_plugins ) ) {
					continue;
				}
			}

			$plugin_file = plugin_dir_path( $k );

			// Plugin in root directory (like Hello Dolly).
			if ( './' === $plugin_file ) {
				$plugin_path = $plugin_base . $k;
			} else {
				$plugin_path = $plugin_base . $plugin_file;
			}

                        $data = isset($v['Version']) ? array( 'Version' => $v['Version']) : false;
			$id = $this->add_directory( $v['Name'], $plugin_path, $data );

			if ( is_object( $update_plugins ) && is_array( $update_plugins->response ) ) {
				// Check for plugin updates.
				foreach ( $update_plugins->response as $uk => $uv ) {
					// If we have a match.
					if ( $uk === $k ) {
						$this->debug_log( 'An update exists for: ' . $v['Name'] );
						// Save the update version.
						update_post_meta( $id, 'update', $uv->new_version );
						// Save the current version.
						update_post_meta( $id, 'version', $v['Version'] );
					}
				}
			}
		}

		// Add themes.
		$all_themes = wp_get_themes();

		foreach ( $all_themes as $k => $v ) {
			if ( 'yes' === $this->only_active ) {
				$current_theme = wp_get_theme();
				if ( $all_themes[ $k ]->Name != $current_theme->Name ) {
					continue;
				}
			}

			$theme_path = $all_themes[ $k ]->theme_root . DIRECTORY_SEPARATOR . $k . DIRECTORY_SEPARATOR;

                        $data = isset($all_themes[ $k ]->Version) ? array( 'Version' => $all_themes[ $k ]->Version) : false;   
			$this->add_directory( $all_themes[ $k ]->Name, $theme_path, $data );
		}

		// Add parent theme if the current theme is a child theme.
		if ( 'yes' === $this->only_active && is_child_theme() ) {
			$parent_theme_path = get_template_directory();
			$theme_data        = wp_get_theme();
			$parent_theme_name = $theme_data->parent()->Name;

                        $parent_theme_version = $theme_data->parent()->Version;
                        $data = isset($parent_theme_version) ? array( 'Version' => $parent_theme_version) : false;                                                 
			$this->add_directory( $parent_theme_name, $parent_theme_path, $data );
		}
	}

	/**
	 * Cleans and formats the final report.
	 *
	 * @param  string $report The full report.
	 * @return string         The cleaned report.
	 */
	public function clean_report( $report ) {
		// Remove unnecessary overview.
		$report = preg_replace( '/Time:.+\n/si', '', $report );

		// Remove whitespace.
		$report = trim( $report );

		return $report;
	}

	/**
	 * Remove all database entries created by the scan.
	 *
	 * @since  1.0.0
	 * @return null
	 */
	public function clean_after_scan() {
		// Delete options created during the scan.
		delete_option( 'sg_wpephpcompat.lock' );
		delete_option( 'sg_wpephpcompat.status' );
		delete_option( 'sg_wpephpcompat.numdirs' );

		// Clear scheduled cron.
		wp_clear_scheduled_hook( 'sg_wpephpcompat_start_test_cron' );

		//Make sure all directories are removed from the queue.
		$args = array(
			'posts_per_page' => -1,
			'post_type'      => 'sg_wpephpcompat_jobs',
		);
		$directories = get_posts( $args );

		foreach ( $directories as $directory ) {
			wp_delete_post( $directory->ID );
		}
	}

	/**
	 * Add a path to the sg_wpephpcompat_jobs custom post type.
	 *
	 * @param string $name Plugin or theme name.
	 * @param string $path Full path to the plugin or theme directory.
	 * @return null
	 */
	private function add_directory( $name, $path, $data=array() ) {
		$dir = array(
			'post_title'    => $name,
			'post_content'  => $path,
                        'post_excerpt'  => json_encode($data),
			'post_status'   => 'publish',
			'post_author'   => 1,
			'post_type'     => 'sg_wpephpcompat_jobs',
		);

		return wp_insert_post( $dir );
	}

	/**
	 * Log to the error log if WP_DEBUG is enabled.
	 *
	 * @since  1.0.0
	 * @param  string $message Message to log.
	 * @return null
	 */
	private function debug_log( $message ) {
		if ( defined( 'WP_DEBUG' ) && WP_DEBUG === true && ! $this->is_command_line() ) {
			if ( is_array( $message ) || is_object( $message ) ) {
				error_log( print_r( $message , true ) );
			} else {
				error_log( 'WPE PHP Compatibility: ' . $message );
			}
		}
	}

	/**
	 * Are we running on the command line?
	 *
	 * @since  1.0.0
	 * @return boolean Returns true if the request came from the command line.
	 */
	private function is_command_line() {
		return defined( 'WP_CLI' ) || defined( 'PHPUNIT_TEST' ) || php_sapi_name() == 'cli';
	}

	/**
	* Close the connection to the browser but continue processing the operation.
	* @since  1.0.0
	* @param  string $body The message to send to the client.
	* @return null
	*/
	private function close_connection( $body ) {
		ignore_user_abort( true );
		if ( ob_get_length() ) { ob_end_clean(); }
		// Start buffering.
		ob_start();
		// Echo our response.
		//echo $body;
		// Get the length of the buffer.
		$size = ob_get_length();
		// Close the connection.
		header( 'Connection: close\r\n' );
		header( 'Content-Encoding: none\r\n' );
		header( 'Content-Length: $size' );
		// Flush and close the buffer.
		ob_end_flush();
		// Flush the system output buffer.
		flush();
	}
}
