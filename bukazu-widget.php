<?php
/*
Plugin Name: Bukazu Search Widget
Plugin URI: https://bukazu.com
Description: Search widget and shortcode for bukazu calendar
Version: 3.3.2
Author: Bob van Oorschot
Author URI: http://bukazu.com
Text Domain: bukazu-search-widget
Domain Path: /languages
License: GPLv2
*/
// The widget class



class Bukazu_Search_Widget extends WP_Widget
{

	// Main constructor
	public function __construct()
	{
		parent::__construct(
			'bukazu_search_widget',
			__('Bukazu Search', 'bukazu-search-widget'),
			array(
				'customize_selective_refresh' => true,
			)
		);
	}



	// The widget form (for the backend )
	public function form($instance)
	{
		// Set widget defaults
		$defaults = array(
			'title'    => '',
			'search_url' => '',
			'view_style' => '',
			'locale' => 'nl'
		);

		// Parse current settings with defaults
		extract(wp_parse_args((array) $instance, $defaults)); ?>

		<?php // Widget Title 
		?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Widget Title', 'bukazu-search-widget'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>

		<?php // Search Url Field 
		?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('search_url')); ?>"><?php _e('Search Url:', 'bukazu-search-widget'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('search_url')); ?>" name="<?php echo esc_attr($this->get_field_name('search_url')); ?>" type="text" value="<?php echo esc_attr($search_url); ?>" />
		</p>

		<?php // Dropdown 
		?>
		<p>
			<label for="<?php echo $this->get_field_id('view_style'); ?>"><?php _e('View style', 'bukazu-search-widget'); ?></label>
			<select name="<?php echo $this->get_field_name('view_style'); ?>" id="<?php echo $this->get_field_id('view_style'); ?>" class="widefat">
				<?php
				// Your options array
				$options = array(
					''        => __('View style', 'bukazu-search-widget'),
					'row' => __('Row', 'bukazu-search-widget'),
					'column' => __('Column', 'bukazu-search-widget'),
				);

				// Loop through options and add each one to the select dropdown
				foreach ($options as $key => $name) {
					echo '<option value="' . esc_attr($key) . '" id="' . esc_attr($key) . '" ' . selected($view_style, $key, false) . '>' . $name . '</option>';
				} ?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('locale'); ?>"><?php _e('Locale', 'bukazu-search-widget'); ?></label>
			<select name="<?php echo $this->get_field_name('locale'); ?>" id="<?php echo $this->get_field_id('locale'); ?>" class="widefat">
				<?php
				// Your options array
				$options = array(
					''        => __('Locale', 'bukazu-search-widget'),
					'nl' => __('Dutch', 'bukazu-search-widget'),
					'de' => __('German', 'bukazu-search-widget'),
					'en' => __('English', 'bukazu-search-widget'),
					'fr' => __('French', 'bukazu-search-widget'),
					'es' => __('Spanish', 'bukazu-search-widget'),
					'it' => __('Italian', 'bukazu-search-widget'),
				);

				// Loop through options and add each one to the select dropdown
				foreach ($options as $key => $name) {
					echo '<option value="' . esc_attr($key) . '" id="' . esc_attr($key) . '" ' . selected($view_style, $key, false) . '>' . $name . '</option>';
				} ?>
			</select>
		</p>

		<?php
	}

	// Update widget settings
	public function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = isset($new_instance['title']) ? wp_strip_all_tags($new_instance['title']) : '';
		$instance['search_url'] = isset($new_instance['search_url']) ? wp_strip_all_tags($new_instance['search_url']) : '';
		$instance['view_style'] = isset($new_instance['view_style']) ? wp_strip_all_tags($new_instance['view_style']) : '';
		$instance['locale'] = isset($new_instance['locale']) ? wp_strip_all_tags($new_instance['locale']) : '';
		return $instance;
	}

	// Display the widget
	public function widget($args, $instance)
	{
		extract($args);



		// Check the widget options
		$title    = isset($instance['title']) ? apply_filters('widget_title', $instance['title']) : '';
		$text     = isset($instance['search_url']) ? $instance['search_url'] : '';
		$view_style     = isset($instance['view_style']) ? $instance['view_style'] : '';
		$locale     = isset($instance['locale']) ? $instance['locale'] : '';

		// WordPress core before_widget hook (always include )
		echo $before_widget;

		// Display the widget
		echo '<div class="widget-bukazu-search wp_widget_plugin_box">';

		// Display widget title if defined
		if ($title) {
			echo $before_title . $title . $after_title;
		}

		// Display text field
		if ($text) {
			echo '<form action="' . $text . '" method="get" class="bukazu_search_form ' . $view_style . '">';
		?>
			<div class="bukazu_search_form_field wider">
				<label for=""><?php
								if ($locale == 'en') {
									_e('Date', 'bukazu-search-widget');
								} else {
									_e('Datum', 'bukazu-search-widget');
								}  ?>:</label>
				<input type="text" name="datepicker" id='bukazu-datepicker' value="" class="date-field" placeholder="<?php _e('Selecteer aankomst en vertrek', 'bukazu-search-widget') ?>">
			</div>

			<div class="bukazu_search_form_field wider" style="display: none">
				<label for=""><?php _e('Inchecken', 'bukazu-search-widget') ?>:</label>
				<input type="text" name="checkin" value="" class="date-field" placeholder="<?php _e('Incheck datum', 'bukazu-search-widget') ?>">
			</div>

			<div class="bukazu_search_form_field wider" style="display: none">
				<label for=""><?php _e('Uitchecken', 'bukazu-search-widget') ?>:</label>
				<input type="text" name="checkout" value="" class="date-field" placeholder="<?php _e('Uitcheck datum', 'bukazu-search-widget') ?>">
			</div>

			<div class="bukazu_search_form_field">
				<label for="">
					<?php
					if ($locale == 'en') {
						_e('Persons', 'bukazu-search-widget');
					} else {
						_e('Personen', 'bukazu-search-widget');
					}
					?>
					:</label>
				<select class="" name="persons">
					<option value="1">1</option>
					<option value="2" selected="selected">2</option>
					<option value="4">4</option>
					<option value="6">6</option>
					<option value="8">8</option>
					<option value="10">10</option>
					<option value="15">15</option>
					<option value="20">25</option>
					<option value="30">30</option>
					<option value="40">40</option>
					<option value="45">45</option>
				</select>
			</div>

			<div class="bukazu_search_form_field">
				<input type="submit" value="<?php
											if ($locale == 'en') {
												_e('Search', 'bukazu-search-widget');
											} else if ($locale == 'de') {
												_e('Suchen', 'bukazu-search-widget');
											} else {
												_e('Zoeken', 'bukazu-search-widget');
											}
											?>">
			</div>
<?php
			echo "</form>";
		}

		echo '</div>';

		// WordPress core after_widget hook (always include )
		echo $after_widget;
	}
}

/**
 * Load Translation
 */
function seed_bukazu_load_textdomain()
{
	load_plugin_textdomain('bukazu-search-widget', false, dirname(plugin_basename(__FILE__)) . '/languages/');
}
add_action('plugins_loaded', 'seed_bukazu_load_textdomain');

add_filter('no_texturize_shortcodes', 'shortcodes_to_exempt_from_wptexturize');

function shortcodes_to_exempt_from_wptexturize($shortcodes)
{
	$shortcodes[] = 'bukazu_search';
	return $shortcodes;
}

function initialize_iframe($atts)
{


	$persons = '';
	$date = '';
	$date2 = '';

	if (isset($_GET["persons"])) {
		$persons = $_GET["persons"];
	}
	if (isset($_GET["checkin"])) {
		$date = $_GET["checkin"];
	}
	if (isset($_GET["checkout"])) {
		$date2 = $_GET["checkout"];
	}
	$nights = 1;

	if ($date) {
		$newDate = date("Y-n-j", strtotime($date));
		$datetime1 = strtotime($date);
		$datetime2 = strtotime($date2);

		$secs = $datetime2 - $datetime1; // == <seconds between the two times>
		$nights = $secs / 86400;
	}
	$jsonData = array(
		'persons_min' => $persons,
		'arrival_date' => $date,
		'no_nights_min' => $nights
	);

	$json = json_encode($jsonData);

	$a = shortcode_atts(array(
		'shortcode' => '',
		'language' => 'en',
		'objectcode' => '',
		'page' => ''
	), $atts);

	$portal_code = $a['shortcode'];
	$language = $a['language'];
	$objectcode = $a['objectcode'];
	$page = $a['page'];

	// ob_start();
	$tag = '<div class="bukazu-app" id="bukazu-app"';
	$tag .= "portal-code=\"{$portal_code}\"";
	$tag .= "object-code=\"{$objectcode}\"";
	$tag .= "language=\"{$language}\"";
	$tag .= "page=\"{$page}\"";
	$tag .= "filters='{$json}'";
	$tag .= '></div>';

	return $tag;
}


add_shortcode('bukazu_search', 'initialize_iframe');


// Register the widget
function my_register_custom_widget()
{
	register_widget('Bukazu_Search_Widget');
}
add_action('widgets_init', 'my_register_custom_widget');

function callback_for_setting_up_scripts()
{
	wp_enqueue_script('moment', plugins_url('js/moment.js', __FILE__), '', '1.1', false);
	wp_enqueue_script('datepicker', 'https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js', array('jquery', 'moment'), '1.1', false);
	wp_enqueue_script('bukazu_search', plugins_url('js/main.js', __FILE__), array('jquery'));
	wp_register_script('Bukazu_portal-js', 'https://portal.bukazu.com/main.js', '', '1.16', true);
	wp_enqueue_script('Bukazu_portal-js');

	wp_enqueue_style('main-css', plugins_url('css/main.css', __FILE__), false);
	wp_register_style('main-css', plugins_url('css/main.css'));
	wp_enqueue_style('main-css');
	wp_register_style('datepick-css', "https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css");
	wp_enqueue_style('datepick-css');
	wp_register_style('Bukazu_portal-css', 'https://portal.bukazu.com/main.css');
	wp_enqueue_style('Bukazu_portal-css');
}

add_action('wp_enqueue_scripts', 'callback_for_setting_up_scripts');


?>