<?php

if ( ! function_exists( 'grandprix_mikado_sidebar_layout' ) ) {
	/**
	 * Function that check is sidebar is enabled and return type of sidebar layout
	 */
	function grandprix_mikado_sidebar_layout() {
		$sidebar_layout         = '';
		$sidebar_layout_meta    = grandprix_mikado_get_meta_field_intersect( 'sidebar_layout' );
		$archive_sidebar_layout = grandprix_mikado_options()->getOptionValue( 'archive_sidebar_layout' );
		$search_sidebar_layout  = grandprix_mikado_options()->getOptionValue( 'search_page_sidebar_layout' );
		$single_sidebar_layout  = grandprix_mikado_get_meta_field_intersect( 'blog_single_sidebar_layout' );
		
		if ( ! empty( $sidebar_layout_meta ) ) {
			$sidebar_layout = $sidebar_layout_meta;
		}
		
		if ( is_singular( 'post' ) && ! empty( $single_sidebar_layout ) ) {
			$sidebar_layout = $single_sidebar_layout;
		}
		
		if ( is_search() && ! grandprix_mikado_is_woocommerce_shop() && ! empty( $search_sidebar_layout ) ) {
			$sidebar_layout = $search_sidebar_layout;
		}
		
		if ( ( is_archive() || ( is_home() && is_front_page() ) ) && ! grandprix_mikado_is_woocommerce_page() && ! empty( $archive_sidebar_layout ) ) {
			$sidebar_layout = $archive_sidebar_layout;
		}
		
		if ( ! empty( $sidebar_layout ) && ! is_active_sidebar( grandprix_mikado_get_sidebar() ) ) {
			$sidebar_layout = '';
		}
		
		return apply_filters( 'grandprix_mikado_filter_sidebar_layout', $sidebar_layout );
	}
}

if ( ! function_exists( 'grandprix_mikado_get_content_sidebar_class' ) ) {
	/**
	 * Return classes for content holder when sidebar is active
	 *
	 * @return string
	 */
	function grandprix_mikado_get_content_sidebar_class() {
		$sidebar_layout = grandprix_mikado_sidebar_layout();
		$content_class  = array( 'mkdf-page-content-holder' );
		
		switch ( $sidebar_layout ) {
			case 'sidebar-33-right':
				$content_class[] = 'mkdf-grid-col-8';
				break;
			case 'sidebar-25-right':
				$content_class[] = 'mkdf-grid-col-9';
				break;
            case 'sidebar-20-right':
                $content_class[] = 'mkdf-grid-col-10';
                break;
			case 'sidebar-33-left':
				$content_class[] = 'mkdf-grid-col-8';
				$content_class[] = 'mkdf-grid-col-push-4';
				break;
			case 'sidebar-25-left':
				$content_class[] = 'mkdf-grid-col-9';
				$content_class[] = 'mkdf-grid-col-push-3';
				break;
            case 'sidebar-20-left':
                $content_class[] = 'mkdf-grid-col-10';
                $content_class[] = 'mkdf-grid-col-push-2';
                break;
			default:
				$content_class[] = 'mkdf-grid-col-12';
				break;
		}
		
		return grandprix_mikado_get_class_attribute( $content_class );
	}
}

if ( ! function_exists( 'grandprix_mikado_get_sidebar_holder_class' ) ) {
	/**
	 * Return classes for sidebar holder when sidebar is active
	 *
	 * @return string
	 */
	function grandprix_mikado_get_sidebar_holder_class() {
		$sidebar_layout = grandprix_mikado_sidebar_layout();
		$sidebar_class  = array( 'mkdf-sidebar-holder' );
		
		switch ( $sidebar_layout ) {
			case 'sidebar-33-right':
				$sidebar_class[] = 'mkdf-grid-col-4';
				break;
			case 'sidebar-25-right':
				$sidebar_class[] = 'mkdf-grid-col-3';
				break;
            case 'sidebar-20-right':
                $sidebar_class[] = 'mkdf-grid-col-2';
                break;
			case 'sidebar-33-left':
				$sidebar_class[] = 'mkdf-grid-col-4';
				$sidebar_class[] = 'mkdf-grid-col-pull-8';
				break;
			case 'sidebar-25-left':
				$sidebar_class[] = 'mkdf-grid-col-3';
				$sidebar_class[] = 'mkdf-grid-col-pull-9';
				break;
            case 'sidebar-20-left':
                $sidebar_class[] = 'mkdf-grid-col-2';
                $sidebar_class[] = 'mkdf-grid-col-pull-10';
		}
		
		return grandprix_mikado_get_class_attribute( $sidebar_class );
	}
}

if ( ! function_exists( 'grandprix_mikado_get_sidebar' ) ) {
	/**
	 * Return Sidebar name
	 *
	 * @return string
	 */
	function grandprix_mikado_get_sidebar() {
		$sidebar_name                = 'sidebar';
		$custom_sidebar_area         = grandprix_mikado_get_meta_field_intersect( 'custom_sidebar_area' );
		$custom_archive_sidebar_area = grandprix_mikado_options()->getOptionValue( 'archive_custom_sidebar_area' );
		$custom_search_sidebar_area  = grandprix_mikado_options()->getOptionValue( 'search_custom_sidebar_area' );
		$custom_single_sidebar_area  = grandprix_mikado_get_meta_field_intersect( 'blog_single_custom_sidebar_area' );
		
		if ( ! empty( $custom_sidebar_area ) ) {
			$sidebar_name = $custom_sidebar_area;
		}
		
		if ( is_singular( 'post' ) && ! empty( $custom_single_sidebar_area ) ) {
			$sidebar_name = $custom_single_sidebar_area;
		}
		
		if ( is_search() && ! empty( $custom_search_sidebar_area ) ) {
			$sidebar_name = $custom_search_sidebar_area;
		}
		
		if ( ( is_archive() || ( is_home() && is_front_page() ) ) && ! grandprix_mikado_is_woocommerce_page() && ! empty( $custom_archive_sidebar_area ) ) {
			$sidebar_name = $custom_archive_sidebar_area;
		}
		
		return apply_filters( 'grandprix_mikado_filter_sidebar_name', $sidebar_name );
	}
}

if ( ! function_exists( 'grandprix_mikado_get_custom_sidebars' ) ) {
	/**
	 * Function that returns all custom made sidebars.
	 *
	 * @uses get_option()
	 * @return array array of custom made sidebars where key and value are sidebar name
	 */
	function grandprix_mikado_get_custom_sidebars() {
		$grandprix_custom_sidebars = get_option( 'mkdf_sidebars' );
		$formatted_array             = array();
		
		if ( is_array( $grandprix_custom_sidebars ) && count( $grandprix_custom_sidebars ) ) {
			foreach ( $grandprix_custom_sidebars as $custom_sidebar ) {
				$formatted_array[ sanitize_title( $custom_sidebar ) ] = $custom_sidebar;
			}
		}
		
		return $formatted_array;
	}
}

if ( ! function_exists( 'grandprix_mikado_get_custom_sidebars_options' ) ) {
	function grandprix_mikado_get_custom_sidebars_options( $enable_default = false ) {
		$sidebar_options = array();
		
		if ( $enable_default ) {
			$sidebar_options[''] = esc_html__( 'Default', 'grandprix' );
		}
		
		$sidebar_options['no-sidebar']       = esc_html__( 'No Sidebar', 'grandprix' );
		$sidebar_options['sidebar-33-right'] = esc_html__( 'Sidebar 1/3 Right', 'grandprix' );
		$sidebar_options['sidebar-25-right'] = esc_html__( 'Sidebar 1/4 Right', 'grandprix' );
		$sidebar_options['sidebar-20-right'] = esc_html__( 'Sidebar 1/5 Right', 'grandprix' );
		$sidebar_options['sidebar-33-left']  = esc_html__( 'Sidebar 1/3 Left', 'grandprix' );
		$sidebar_options['sidebar-25-left']  = esc_html__( 'Sidebar 1/4 Left', 'grandprix' );
		$sidebar_options['sidebar-20-left']  = esc_html__( 'Sidebar 1/5 Left', 'grandprix' );
		
		return $sidebar_options;
	}
}