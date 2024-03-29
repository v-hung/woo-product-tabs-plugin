<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class VI_WOO_PRODUCT_TABS_DATA {
	private $params;
	private $default;

	/**
	 * VI_WOO_PRODUCT_TABS_DATA constructor.
	 * Init setting
	 */
	public function __construct() {

		global $product_tabs_settings;
		if ( ! $product_tabs_settings ) {
			$product_tabs_settings = get_option( 'woo_product_tabs_params', array() );
		}
		$this->default = array(
      'wpt_tab_layout' => 'default',
      'wpt_title_normal_font_size' => 16,
      'wpt_title_normal_icon_font_size' => 24,
      'wpt_title_normal_color' => '#666',
      'wpt_title_normal_background_color' => '#fff',
      'wpt_title_normal_icon_color' => '#666',
      'wpt_title_active_font_size' => 16,
      'wpt_title_active_icon_font_size' => 24,
      'wpt_title_active_color' => '#111',
      'wpt_title_active_background_color' => '#fff',
      'wpt_title_active_icon_color' => '#111',
      'wpt_content_color' => '#666',
      'wpt_content_background_color' => '#fff',
      'wpt_content_width' => 'full_width',
      'wpt_product_tabs' => json_encode($this->get_core_tabs())
		);

		$this->params = apply_filters( 'woo_product_tabs_params', wp_parse_args( $product_tabs_settings, $this->default ) );
	}

	/**
	 * Get add to cart redirect
	 * @return mixed|void
	 */
	public function get_params( $name = "" ) {
		if ( ! $name ) {
			return $this->params;
		} elseif ( isset( $this->params[ $name ] ) ) {
			return apply_filters( 'woo_product_tabs_params' . $name, $this->params[ $name ] );
		} else {
			return false;
		}
	}

	public function get_default( $name = "" ) {
		if ( ! $name ) {
			return $this->default;
		} elseif ( isset( $this->default[ $name ] ) ) {
			return apply_filters( 'woo_product_tabs_params_default' . $name, $this->default[ $name ] );
		} else {
			return false;
		}
	}

  public function get_core_tabs () {
    return array(
      array(
        'id'            => 'description',
        'position'      => 0,
        'type'          => 'core',
        'title'         => __( 'Description', 'woo-product-tab' ),
        'description'   => __( 'Displays the product content set in the main content editor.', 'woo-product-tab' ),
        'heading'       => __( 'Product Description', 'woo-product-tab' ),
        'active'        => true,
        'mobile_active' => true,
        'icon'          => '',
        'display'       => 'inherit',
        'children'      => array(
          array(
            'id'       => 'product_description',
            'position' => 0,
            'title'    => __( 'Product Description', 'woo-product-tab' ),
            'active'   => true,
          )
        )
      ),
      array(
        'id'            => 'additional_information',
        'position'      => 1,
        'type'          => 'core',
        'title'         => __( 'Additional Information', 'woo-product-tab' ),
        'description'   => __( 'Displays the product attributes and properties configured in the Product Data panel.', 'woo-product-tab' ),
        'heading'       => __( 'Additional Information', 'woo-product-tab' ),
        'active'        => false,
        'mobile_active' => false,
        'icon'          => '',
        'display'       => 'inherit'
      ),
      array(
        'id'            => 'reviews',
        'position'      => 2,
        'type'          => 'core',
        'title'         => __( 'Reviews', 'woo-product-tab' ),
        'description'   => __( 'Displays the product review form and any reviews. Use %d in the Title to substitute the number of reviews for the product.', 'woo-product-tab' ),
        'active'        => true,
        'mobile_active' => true,
        'icon'          => '',
        'display'       => 'inherit'
      ),
    );
  }

}

new VI_WOO_PRODUCT_TABS_DATA();
