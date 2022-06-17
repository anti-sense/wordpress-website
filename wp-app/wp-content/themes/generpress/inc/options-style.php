<?php 

/**
|------------------------------------------------------------------------------
| Custom style options
|------------------------------------------------------------------------------
 */

function generpress_custom_style() {
	?>
	<style type="text/css">

		blockquote,
		.related-title,
		.comment-reply-title {
			border-color: <?php echo esc_html( get_theme_mod('generpress_general_primary_color', '#f16334') ) ?>;
		}
		.related-title,
		.comment-reply-title,
		.main-navigation ul li:hover > a,
		.main-navigation ul li > a:hover,
		.main-navigation ul li.current-menu-parent > a,
		.main-navigation ul li.current-menu-ancestor > a,
		.main-navigation ul li.current_page_ancestor > a,
		.main-navigation ul li.current-menu-item a,
		.entry-content .entry-title a:hover,
		.entry-meta span a,
		.entry-footer span a,
		.entry-meta span a:hover,
		.entry-footer span a:hover,
		.page-numbers.current,
		.pagination a:hover,
		.posts-related ul.related-grid li .related-ptitle:hover,
		.widget ul li a:hover {
			color: <?php echo esc_html( get_theme_mod('generpress_general_primary_color', '#f16334') ) ?>;
		}
		.related-title:after,
		.comment-reply-title:after {
			background-color: <?php echo esc_html( get_theme_mod('generpress_general_primary_color', '#f16334') ) ?>;
		}

		.xgnotification-top a {
			background-color: <?php echo esc_html( get_theme_mod('generpress_general_notify_anchors_text', '#f16334') ) ?>;
		}
		.xgnotification-top a:hover {
			background-color: <?php echo esc_html( get_theme_mod('generpress_general_notify_anchors_text_hover', '#11171a') ) ?>;
		}

	</style>
	<?php
}
add_action('wp_head','generpress_custom_style');