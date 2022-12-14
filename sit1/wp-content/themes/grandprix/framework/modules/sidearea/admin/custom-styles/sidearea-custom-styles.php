<?php

if ( ! function_exists( 'grandprix_mikado_side_area_slide_from_opener_type_style' ) ) {
	function grandprix_mikado_side_area_slide_from_opener_type_style() {
		
		if ( grandprix_mikado_options()->getOptionValue( 'side_area_type' ) == 'side-menu-slide-from-opener' ) {
			
			if ( grandprix_mikado_options()->getOptionValue( 'side_area_width' ) !== '' ) {
				echo grandprix_mikado_dynamic_css( '.mkdf-side-menu-slide-from-opener .mkdf-side-menu', array(
					'width' => grandprix_mikado_options()->getOptionValue( 'side_area_width' )
				) );
			}
			
			if ( grandprix_mikado_options()->getOptionValue( 'side_area_content_overlay_color' ) !== '' ) {
				
				echo grandprix_mikado_dynamic_css( '.mkdf-side-menu-slide-from-opener .mkdf-wrapper .mkdf-cover', array(
					'background-color' => grandprix_mikado_options()->getOptionValue( 'side_area_content_overlay_color' )
				) );
			}
			
			if ( grandprix_mikado_options()->getOptionValue( 'side_area_content_overlay_opacity' ) !== '' ) {
				
				echo grandprix_mikado_dynamic_css( '.mkdf-side-menu-slide-from-opener.mkdf-right-side-menu-opened .mkdf-wrapper .mkdf-cover', array(
					'opacity' => grandprix_mikado_options()->getOptionValue( 'side_area_content_overlay_opacity' )
				) );
			}
		}
	}
	
	add_action( 'grandprix_mikado_action_style_dynamic', 'grandprix_mikado_side_area_slide_from_opener_type_style' );
}

if ( ! function_exists( 'grandprix_mikado_side_area_icon_color_styles' ) ) {
	function grandprix_mikado_side_area_icon_color_styles() {
		$icon_color             = grandprix_mikado_options()->getOptionValue( 'side_area_icon_color' );
		$icon_hover_color       = grandprix_mikado_options()->getOptionValue( 'side_area_icon_hover_color' );
		$close_icon_color       = grandprix_mikado_options()->getOptionValue( 'side_area_close_icon_color' );
		$close_icon_hover_color = grandprix_mikado_options()->getOptionValue( 'side_area_close_icon_hover_color' );
		
		$icon_hover_selector = array(
			'.mkdf-side-menu-button-opener:hover',
			'.mkdf-side-menu-button-opener.opened'
		);
		
		if ( ! empty( $icon_color ) ) {
			echo grandprix_mikado_dynamic_css( '.mkdf-side-menu-button-opener', array(
				'color' => $icon_color
			) );
		}
		
		if ( ! empty( $icon_hover_color ) ) {
			echo grandprix_mikado_dynamic_css( $icon_hover_selector, array(
				'color' => $icon_hover_color
			) );
		}
		
		if ( ! empty( $close_icon_color ) ) {
			echo grandprix_mikado_dynamic_css( '.mkdf-side-menu a.mkdf-close-side-menu', array(
				'color' => $close_icon_color
			) );
		}
		
		if ( ! empty( $close_icon_hover_color ) ) {
			echo grandprix_mikado_dynamic_css( '.mkdf-side-menu a.mkdf-close-side-menu:hover', array(
				'color' => $close_icon_hover_color
			) );
		}
	}
	
	add_action( 'grandprix_mikado_action_style_dynamic', 'grandprix_mikado_side_area_icon_color_styles' );
}

if ( ! function_exists( 'grandprix_mikado_side_area_styles' ) ) {
	function grandprix_mikado_side_area_styles() {
		$side_area_styles = array();
		$background_color = grandprix_mikado_options()->getOptionValue( 'side_area_background_color' );
		$padding          = grandprix_mikado_options()->getOptionValue( 'side_area_padding' );
		$text_alignment   = grandprix_mikado_options()->getOptionValue( 'side_area_aligment' );
		
		if ( ! empty( $background_color ) ) {
			$side_area_styles['background-color'] = $background_color;
		}
		
		if ( ! empty( $padding ) ) {
			$side_area_styles['padding'] = esc_attr( $padding );
		}
		
		if ( ! empty( $text_alignment ) ) {
			$side_area_styles['text-align'] = $text_alignment;
		}
		
		if ( ! empty( $side_area_styles ) ) {
			echo grandprix_mikado_dynamic_css( '.mkdf-side-menu', $side_area_styles );
		}
		
		if ( $text_alignment === 'center' ) {
			echo grandprix_mikado_dynamic_css( '.mkdf-side-menu .widget img', array(
				'margin' => '0 auto'
			) );
		}
	}
	
	add_action( 'grandprix_mikado_action_style_dynamic', 'grandprix_mikado_side_area_styles' );
}