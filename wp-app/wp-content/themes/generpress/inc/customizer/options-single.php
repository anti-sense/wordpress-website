<?php
/**
|------------------------------------------------------------------------------
| OPTIONS
|------------------------------------------------------------------------------
*/
	$wp_customize->add_panel( 'tc_panel_single', array(
		'priority'			=> 33,
		'capability'		=> 'edit_theme_options',
		'theme_supports'	=> '',
		'title'				=> __( 'Options Single', 'generpress' )
	));

	/**************************
	* Section: Post Navigation *
	**************************/
	$wp_customize->add_section( 'generpress_post_navigation_section' , array(
		'title'				=> __( 'Post Navigation', 'generpress' ),
		'priority'			=> 1,
		'panel'				=> 'tc_panel_single'
	));

	/* Post Navigation Options */
	$wp_customize->add_setting('generpress_post_navigation_options', array('sanitize_callback' => 'generpress_sanitize_select', 'default'=> 'navigation_enable'));
	$wp_customize->add_control('generpress_post_navigation_options', array(
		'label'				=> __('Post Navigation', 'generpress'),
		'section'			=> 'generpress_post_navigation_section',
		'type'				=> 'radio',
		'priority'			=> 2,
		'choices'			=> array(
			'navigation_enable'				=> __('Enable', 'generpress'),
			'navigation_disable'			=> __('Disable', 'generpress'),
		),
	));

	/**************************
	* Section: Related Posts *
	**************************/
	$wp_customize->add_section( 'generpress_related_post_section' , array(
		'title'				=> __( 'Related Posts', 'generpress' ),
		'priority'			=> 2,
		'panel'				=> 'tc_panel_single'
	));

	/* Related Posts Options */
	$wp_customize->add_setting('generpress_related_post_options', array('sanitize_callback' => 'generpress_sanitize_select', 'default'=> 'related_post_enable'));
	$wp_customize->add_control('generpress_related_post_options', array(
		'label'				=> __('Related Posts', 'generpress'),
		'section'			=> 'generpress_related_post_section',
		'type'				=> 'radio',
		'priority'			=> 1,
		'choices'			=> array(
			'related_post_enable'			=> __('Enable', 'generpress'),
			'related_post_disable'			=> __('Disable', 'generpress'),
		),
	));

	/* Taxonmy of Related Posts */
	$wp_customize->add_setting('generpress_related_post_taxonomy', array('sanitize_callback' => 'generpress_sanitize_select', 'default'=> 'category'));
	$wp_customize->add_control('generpress_related_post_taxonomy', array(
		'label'				=> __('Related Posts Taxonomy', 'generpress'),
		'section'			=> 'generpress_related_post_section',
		'type'				=> 'radio',
		'priority'			=> 2,
		'choices'			=> array(
			'category'				=> __('Categories', 'generpress'),
			'tag'					=> __('Tags', 'generpress'),
		),
	));

	/* Number of Related Posts */
	$wp_customize->add_setting('generpress_number_related_posts', array('sanitize_callback' => 'generpress_sanitize_number_absint', 'default' => '6'));
	$wp_customize->add_control( 'generpress_number_related_posts', array(
		'type'				=> 'number',
		'section'			=> 'generpress_related_post_section',
		'label'				=> __( 'Number of Related Posts', 'generpress' ),
		'priority'			=> 3,
	));