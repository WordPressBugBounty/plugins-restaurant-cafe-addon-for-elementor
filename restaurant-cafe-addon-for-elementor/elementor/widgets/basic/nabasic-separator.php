<?php
/*
 * Elementor Restaurant & Cafe Addon for Elementor Separator Widget
 * Author & Copyright: NicheAddon
*/

namespace Elementor;

if (!isset(get_option( 'rcafe_bw_settings' )['nbeds_separator'])) { // enable & disable

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Restaurant_Elementor_Addon_Separator extends Widget_Base{

	/**
	 * Retrieve the widget name.
	*/
	public function get_name(){
		return 'narestaurant_basic_separator';
	}

	/**
	 * Retrieve the widget title.
	*/
	public function get_title(){
		return esc_html__( 'Separator', 'restaurant-cafe-addon-for-elementor' );
	}

	/**
	 * Retrieve the widget icon.
	*/
	public function get_icon() {
		return 'eicon-divider-shape';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	*/
	public function get_categories() {
		return ['narestaurant-basic-category'];
	}

	/**
	 * Register Restaurant & Cafe Addon for Elementor Separator widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	*/
	protected function register_controls(){

		$this->start_controls_section(
			'section_separator',
			[
				'label' => __( 'Separator Options', 'restaurant-cafe-addon-for-elementor' ),
			]
		);
		$this->add_control(
			'separator_style',
			[
				'label' => esc_html__( 'Separator Style', 'restaurant-cafe-addon-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'one' => esc_html__( 'Icon Separator', 'restaurant-cafe-addon-for-elementor' ),
					'two' => esc_html__( 'Border Separator', 'restaurant-cafe-addon-for-elementor' ),
				],
				'default' => 'one',
				'description' => esc_html__( 'Select your separator style.', 'restaurant-cafe-addon-for-elementor' ),
			]
		);
		$this->add_control(
			'separator_border_style',
			[
				'label' => esc_html__( 'Border Style', 'restaurant-cafe-addon-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'one' => esc_html__( 'Single', 'restaurant-cafe-addon-for-elementor' ),
					'two' => esc_html__( 'Double', 'restaurant-cafe-addon-for-elementor' ),
				],
				'default' => 'one',
				'condition' => [
					'separator_style' => array('one'),
				],
				'description' => esc_html__( 'Select your border style.', 'restaurant-cafe-addon-for-elementor' ),
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'separator_border',
				'label' => esc_html__( 'Border', 'restaurant-cafe-addon-for-elementor' ),
				'selector' => '{{WRAPPER}} .narep-separator',
				'condition' => [
					'separator_style' => array('two'),
				],
			]
		);
		$this->add_control(
			'separator_type',
			[
				'label' => __( 'Separator Type', 'restaurant-cafe-addon-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'text' => esc_html__( 'Text', 'restaurant-cafe-addon-for-elementor' ),
					'icon' => esc_html__( 'Icon', 'restaurant-cafe-addon-for-elementor' ),
					'image' => esc_html__( 'Image', 'restaurant-cafe-addon-for-elementor' ),
				],
				'default' => 'icon',
				'condition' => [
					'separator_style' => array('one'),
				],
			]
		);
		$this->add_control(
			'separator_text',
			[
				'label' => esc_html__( 'Separator Text', 'restaurant-cafe-addon-for-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Separator', 'restaurant-cafe-addon-for-elementor' ),
				'placeholder' => esc_html__( 'Type separator text here', 'restaurant-cafe-addon-for-elementor' ),
				'label_block' => true,
				'condition' => [
					'separator_type' => array('text'),
					'separator_style' => array('one'),
				],
			]
		);
		$this->add_control(
			'separator_icon',
			[
				'label' => esc_html__( 'Separator Icon', 'restaurant-cafe-addon-for-elementor' ),
				'type' => Controls_Manager::ICON,
				'options' => NAREP_Controls_Helper_Output::get_include_icons(),
				'frontend_available' => true,
				'default' => 'fa fa-life-ring',
				'condition' => [
					'separator_type' => array('icon'),
					'separator_style' => array('one'),
				],
			]
		);
		$this->add_control(
			'choose_image',
			[
				'label' => esc_html__( 'Upload Icon', 'restaurant-cafe-addon-for-elementor' ),
				'type' => Controls_Manager::MEDIA,
				'frontend_available' => true,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'separator_type' => array('image'),
					'separator_style' => array('one'),
				],
				'description' => esc_html__( 'Set your icon image.', 'restaurant-cafe-addon-for-elementor'),
			]
		);
		$this->add_responsive_control(
			'img_width',
			[
				'label' => esc_html__( 'Image Width', 'restaurant-cafe-addon-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 1000,
						'step' => 1,
					],
				],
				'size_units' => [ 'px' ],
				'condition' => [
					'separator_type' => array('image'),
					'separator_style' => array('one'),
				],
				'selectors' => [
					'{{WRAPPER}} .narep-sep img' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_alignment',
			[
				'label' => esc_html__( 'Icon/Text Alignment', 'restaurant-cafe-addon-for-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'restaurant-cafe-addon-for-elementor' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'restaurant-cafe-addon-for-elementor' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'restaurant-cafe-addon-for-elementor' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'center',
				'condition' => [
					'separator_style' => array('one'),
				],
			]
		);
		$this->add_responsive_control(
			'icon_position',
			[
				'label' => esc_html__( 'Seperator Position', 'restaurant-cafe-addon-for-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'top' => [
						'title' => esc_html__( 'Top', 'restaurant-cafe-addon-for-elementor' ),
						'icon' => 'fa fa-arrow-circle-up',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'restaurant-cafe-addon-for-elementor' ),
						'icon' => 'fa fa-arrow-circle-right',
					],
					'bottom' => [
						'title' => esc_html__( 'Bottom', 'restaurant-cafe-addon-for-elementor' ),
						'icon' => 'fa fa-arrow-circle-down',
					],
				],
				'default' => 'center',
				'condition' => [
					'separator_style' => array('one'),
				],
			]
		);
		$this->add_responsive_control(
			'section_alignment',
			[
				'label' => esc_html__( 'Section Alignment', 'restaurant-cafe-addon-for-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'restaurant-cafe-addon-for-elementor' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'restaurant-cafe-addon-for-elementor' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'restaurant-cafe-addon-for-elementor' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'center',
			]
		);
		$this->end_controls_section();// end: Section

		// Separator
		$this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__( 'Section', 'restaurant-cafe-addon-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'max_width',
			[
				'label' => esc_html__( 'Width', 'restaurant-cafe-addon-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1500,
						'step' => 1,
					],
				],
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .narep-separator' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();// end: Section

		// Icon
		$this->start_controls_section(
			'section_icon_style',
			[
				'label' => esc_html__( 'Icon', 'restaurant-cafe-addon-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'separator_type' => array('icon'),
					'separator_style' => array('one'),
				],
			]
		);
		$this->add_control(
			'icon_space',
			[
				'label' => __( 'Icon Space', 'restaurant-cafe-addon-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .narep-sep' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'restaurant-cafe-addon-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .narep-sep' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'icon_bgcolor',
			[
				'label' => esc_html__( 'Background Color', 'restaurant-cafe-addon-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .narep-sep' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'icon_border_radius',
			[
				'label' => __( 'Border Radius', 'restaurant-cafe-addon-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .narep-sep' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'icon_width',
			[
				'label' => esc_html__( 'Icon Width/Height', 'restaurant-cafe-addon-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
						'step' => 1,
					],
				],
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .narep-sep' => 'min-width: {{SIZE}}{{UNIT}};min-height: {{SIZE}}{{UNIT}};line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'icon_size',
			[
				'label' => esc_html__( 'Icon Size', 'restaurant-cafe-addon-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
						'step' => 1,
					],
				],
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .narep-sep i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();// end: Section

		$this->start_controls_section(
			'section_separator_text',
			[
				'label' => esc_html__( 'Separator Text', 'restaurant-cafe-addon-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'separator_type' => array('text'),
					'separator_style' => array('one'),
				],
			]
		);
		$this->add_control(
			'text_space',
			[
				'label' => __( 'Text Space', 'restaurant-cafe-addon-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .narep-sep' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'separator_typography',
				'selector' => '{{WRAPPER}} .narep-sep',
			]
		);
		$this->add_control(
			'separator_color',
			[
				'label' => esc_html__( 'Color', 'restaurant-cafe-addon-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .narep-sep' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();// end: Section

		$this->start_controls_section(
			'section_separator_borders',
			[
				'label' => esc_html__( 'Separator Borders', 'restaurant-cafe-addon-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'separator_style' => array('one'),
					'separator_border_style' => array('one'),
				],
			]
		);
		$this->start_controls_tabs( 'separator_brdr' );
			$this->start_controls_tab(
				'separator_left',
				[
					'label' => esc_html__( 'Left', 'restaurant-cafe-addon-for-elementor' ),
				]
			);
			$this->add_control(
				'left_width',
				[
					'label' => esc_html__( 'Border Height', 'restaurant-cafe-addon-for-elementor' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 500,
							'step' => 1,
						],
					],
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}} .narep-separator .sep-left' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'left_height',
				[
					'label' => esc_html__( 'Border Width', 'restaurant-cafe-addon-for-elementor' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 500,
							'step' => 1,
						],
					],
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}} .narep-separator .sep-left' => 'max-width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'separator_left_color',
				[
					'label' => esc_html__( 'Color', 'restaurant-cafe-addon-for-elementor' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .narep-separator .sep-left' => 'background-color: {{VALUE}};',
					],
				]
			);
			$this->end_controls_tab();  // end:Normal tab

			$this->start_controls_tab(
				'separator_right',
				[
					'label' => esc_html__( 'Right', 'restaurant-cafe-addon-for-elementor' ),
				]
			);
			$this->add_control(
				'right_width',
				[
					'label' => esc_html__( 'Border Height', 'restaurant-cafe-addon-for-elementor' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 500,
							'step' => 1,
						],
					],
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}} .narep-separator .sep-right' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'right_height',
				[
					'label' => esc_html__( 'Border Width', 'restaurant-cafe-addon-for-elementor' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 500,
							'step' => 1,
						],
					],
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}} .narep-separator .sep-right' => 'max-width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'separator_right_color',
				[
					'label' => esc_html__( 'Border Color', 'restaurant-cafe-addon-for-elementor' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .narep-separator .sep-right' => 'background-color: {{VALUE}};',
					],
				]
			);
			$this->end_controls_tab();  // end:Hover tab
		$this->end_controls_tabs(); // end tabs

		$this->end_controls_section();// end: Section

		$this->start_controls_section(
			'section_separator_st_borders',
			[
				'label' => esc_html__( 'Separator Borders', 'restaurant-cafe-addon-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'separator_style' => array('one'),
					'separator_border_style' => array('two'),
				],
			]
		);
		$this->start_controls_tabs( 'separator_st_brdr' );
			$this->start_controls_tab(
				'separator_st_left',
				[
					'label' => esc_html__( 'Left', 'restaurant-cafe-addon-for-elementor' ),
				]
			);
			$this->add_control(
				'left_sec_width',
				[
					'label' => esc_html__( 'Left Side Width', 'restaurant-cafe-addon-for-elementor' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 500,
							'step' => 1,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}} .border-two span.sep-two-left' => 'max-width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'lbt',
				[
					'label' => __( 'Top Border', 'restaurant-cafe-addon-for-elementor' ),
					'type' => Controls_Manager::HEADING,
					'separator' => 'after',
				]
			);
			$this->add_control(
				'lbt_height',
				[
					'label' => esc_html__( 'Border Height', 'restaurant-cafe-addon-for-elementor' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 500,
							'step' => 1,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}} .border-two span.sep-two-left:before' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'lbt_width',
				[
					'label' => esc_html__( 'Border Width', 'restaurant-cafe-addon-for-elementor' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 500,
							'step' => 1,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}} .border-two span.sep-two-left:before' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'lbt_pos',
				[
					'label' => esc_html__( 'Border Position', 'restaurant-cafe-addon-for-elementor' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => -500,
							'max' => 500,
							'step' => 1,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}} .border-two span.sep-two-left:before' => 'top: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'separator_lbt_color',
				[
					'label' => esc_html__( 'Color', 'restaurant-cafe-addon-for-elementor' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .border-two span.sep-two-left:before' => 'background-color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'lbb',
				[
					'label' => __( 'Bottom Border', 'restaurant-cafe-addon-for-elementor' ),
					'type' => Controls_Manager::HEADING,
					'separator' => 'after',
				]
			);
			$this->add_control(
				'lbb_height',
				[
					'label' => esc_html__( 'Border Height', 'restaurant-cafe-addon-for-elementor' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 500,
							'step' => 1,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}} .border-two span.sep-two-left:after' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'lbb_width',
				[
					'label' => esc_html__( 'Border Width', 'restaurant-cafe-addon-for-elementor' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 500,
							'step' => 1,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}} .border-two span.sep-two-left:after' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'lbb_pos',
				[
					'label' => esc_html__( 'Border Position', 'restaurant-cafe-addon-for-elementor' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => -500,
							'max' => 500,
							'step' => 1,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}} .border-two span.sep-two-left:after' => 'top: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'separator_lbb_color',
				[
					'label' => esc_html__( 'Color', 'restaurant-cafe-addon-for-elementor' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .border-two span.sep-two-left:after' => 'background-color: {{VALUE}};',
					],
				]
			);
			$this->end_controls_tab();  // end:Normal tab

			$this->start_controls_tab(
				'separator_st_right',
				[
					'label' => esc_html__( 'Right', 'restaurant-cafe-addon-for-elementor' ),
				]
			);
			$this->add_control(
				'right_sec_width',
				[
					'label' => esc_html__( 'Right Side Width', 'restaurant-cafe-addon-for-elementor' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 500,
							'step' => 1,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}} .border-two span.sep-two-right' => 'max-width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'rbt',
				[
					'label' => __( 'Top Border', 'restaurant-cafe-addon-for-elementor' ),
					'type' => Controls_Manager::HEADING,
					'separator' => 'after',
				]
			);
			$this->add_control(
				'rbt_height',
				[
					'label' => esc_html__( 'Border Height', 'restaurant-cafe-addon-for-elementor' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 500,
							'step' => 1,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}} .border-two span.sep-two-right:before' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'rbt_width',
				[
					'label' => esc_html__( 'Border Width', 'restaurant-cafe-addon-for-elementor' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 500,
							'step' => 1,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}} .border-two span.sep-two-right:before' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'rbt_pos',
				[
					'label' => esc_html__( 'Border Position', 'restaurant-cafe-addon-for-elementor' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => -500,
							'max' => 500,
							'step' => 1,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}} .border-two span.sep-two-right:before' => 'top: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'separator_rbt_color',
				[
					'label' => esc_html__( 'Color', 'restaurant-cafe-addon-for-elementor' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .border-two span.sep-two-right:before' => 'background-color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'rbb',
				[
					'label' => __( 'Bottom Border', 'restaurant-cafe-addon-for-elementor' ),
					'type' => Controls_Manager::HEADING,
					'separator' => 'after',
				]
			);
			$this->add_control(
				'rbb_height',
				[
					'label' => esc_html__( 'Border Height', 'restaurant-cafe-addon-for-elementor' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 500,
							'step' => 1,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}} .border-two span.sep-two-right:after' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'rbb_width',
				[
					'label' => esc_html__( 'Border Width', 'restaurant-cafe-addon-for-elementor' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 500,
							'step' => 1,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}} .border-two span.sep-two-right:after' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'rbb_pos',
				[
					'label' => esc_html__( 'Border Position', 'restaurant-cafe-addon-for-elementor' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => -500,
							'max' => 500,
							'step' => 1,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}} .border-two span.sep-two-right:after' => 'top: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'separator_rbb_color',
				[
					'label' => esc_html__( 'Color', 'restaurant-cafe-addon-for-elementor' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .border-two span.sep-two-right:after' => 'background-color: {{VALUE}};',
					],
				]
			);
			$this->end_controls_tab();  // end:Hover tab
		$this->end_controls_tabs(); // end tabs

		$this->end_controls_section();// end: Section

	}

	/**
	 * Render Separator widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	*/
	protected function render() {
		$settings = $this->get_settings_for_display();
		// Separator
		$separator_style = !empty( $settings['separator_style'] ) ? $settings['separator_style'] : '';
		$separator_border_style = !empty( $settings['separator_border_style'] ) ? $settings['separator_border_style'] : '';
		$separator_type = !empty( $settings['separator_type'] ) ? $settings['separator_type'] : '';
		$separator_text = !empty( $settings['separator_text'] ) ? $settings['separator_text'] : '';
		$separator_icon = !empty( $settings['separator_icon'] ) ? $settings['separator_icon'] : '';
		$icon_alignment = !empty( $settings['icon_alignment'] ) ? $settings['icon_alignment'] : '';
		$icon_position = !empty( $settings['icon_position'] ) ? $settings['icon_position'] : '';
		$section_alignment = !empty( $settings['section_alignment'] ) ? $settings['section_alignment'] : '';
		$choose_image = !empty( $settings['choose_image']['id'] ) ? $settings['choose_image']['id'] : '';

		$image_url = wp_get_attachment_url( $choose_image );
		$separator_image = $image_url ? '<img src="'.esc_url($image_url).'" width="162" alt="'.esc_html( 'Separator', 'restaurant-cafe-addon-for-elementor' ).'">' : '';

		$separator_text = $separator_text ? esc_html($separator_text) : '';
		$separator_icon = $separator_icon ? '<i class="'.esc_attr($separator_icon).'"></i>' : '';

		if ($separator_type === 'text'){
		  $separator = $separator_text;
		} elseif ($separator_type === 'image'){
		  $separator = $separator_image;
		} else {
		  $separator = $separator_icon;
		}

		if ($icon_alignment === 'left') {
			$align_class = ' left-separator';
		} elseif ($icon_alignment === 'right') {
			$align_class = ' right-separator';
		} else {
			$align_class = '';
		}

		if ($icon_position === 'top') {
			$pos_class = ' icon-top';
		} elseif ($icon_position === 'bottom') {
			$pos_class = ' icon-bottom';
		} else {
			$pos_class = '';
		}

		if ($section_alignment === 'left') {
			$salign_class = ' separator-left';
		} elseif ($section_alignment === 'right') {
			$salign_class = ' separator-right';
		} else {
			$salign_class = '';
		}

		if ($separator_border_style === 'two') {
			$border_class = ' border-two';
			$border_lsub_class = 'sep-two-left';
			$border_rsub_class = 'sep-two-right';
		} else {
			$border_class = '';
			$border_lsub_class = 'sep-left';
			$border_rsub_class = 'sep-right';
		}

		$output = '<div class="narep-separator'.esc_attr( $align_class.$salign_class.$pos_class.$border_class ).'">';
							if ($separator_style === 'two') {
							} else {
			          $output .= '<span class="'.esc_attr( $border_lsub_class ).'"></span><div class="narep-sep">'.$separator.'</div><span class="'.esc_attr( $border_rsub_class ).'"></span>';
							}
    	$output .= '</div>';

		echo $output;

	}

}
Plugin::instance()->widgets_manager->register_widget_type( new Restaurant_Elementor_Addon_Separator() );

} // enable & disable
