<?php
/*
|
|	Plugin Name: GenerPress Taps Widget
|	Description: A widget to display taps widget.
|	Version: 1.0
|
*/

function generpress_latest_tabs( $posts = 5 ) {
	$the_query = new WP_Query('showposts='. $posts .'&orderby=post_date&order=desc');
	$recent_post_num = 1;
	while ($the_query->have_posts()) : $the_query->the_post();
?>

<li>
	<div class="left-widget">
		<?php if( has_post_thumbnail() ): ?>

			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail('generpress-widget', array('title' => '')); ?>
			</a>

		<?php else: ?>

			<a href='<?php the_permalink(); ?>'><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/default-xsmall.jpg" alt="<?php the_title(); ?>"  class="widget-thumb" /></a>

		<?php endif; ?>

		<div class="clear"></div>

	</div>

	<div class="info">
		<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink() ?>"><?php the_title(); ?></a>
		
		<div class="entry-meta">
			<?php echo get_the_date(); ?> &middot; <?php echo comments_number();?>
		</div> <!--end .entry-meta-->
		
	</div> <!--end .info-->
	<div class="clear"></div>
</li>

<?php
$recent_post_num++; endwhile;
wp_reset_postdata();
}

function generpress_popular_tabs( $posts = 5 ) {
	$popular = new WP_Query('showposts='. $posts .'&orderby=comment_count&order=desc');
	$popular_post_num = 1;
	while ($popular->have_posts()) : $popular->the_post();
?>

<?php
if( $popular_post_num != 1 ) {
	echo '';
}
?>

<li>
	<div class="left-widget">
		<?php if( has_post_thumbnail() ): ?>
			
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail('generpress-widget', array('title' => '')); ?>
			</a>

		<?php else: ?>

			<a href='<?php the_permalink(); ?>'><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/default-xsmall.jpg" alt="<?php the_title(); ?>"  class="widget-thumb" /></a>

		<?php endif; ?>

		<div class="clear"></div>
	</div>

	<div class="info">
		<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink() ?>"><?php the_title(); ?></a>

		<div class="entry-meta">
			<?php echo get_the_date(); ?> &middot; <?php echo comments_number();?>	
		</div> <!--end .entry-meta-->

	</div> <!--end .info-->

	<div class="clear"></div>
</li>

<?php
$popular_post_num++; endwhile;
wp_reset_postdata();
}

class generpress_Widget_Tabs extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'widget_tab', 'description' => __( 'Your most recent posts & popular posts.', 'generpress' ) );
		$control_ops = array('width' => 400, 'height' => 350);
		parent::__construct('tab', __('GenerPress Tab Posts', 'generpress'), $widget_ops, $control_ops);
	}

	function widget( $args, $instance ) {
		extract( $args );
		$recent_post_num = sanitize_text_field($instance['recent_post_num']);
		$popular_post_num = sanitize_text_field($instance['popular_post_num']);
	?>

<?php
echo $before_widget;
?>

	<div id="tabwrap">

		<ul class="tabs">
			<li><h3 class="widget-title"><a href="#" class="recent-post-title current-tap"><?php esc_html_e('Recent', 'generpress'); ?></a></h3></li>
			<li><h3 class="widget-title"><a href="#" class="popular-post-title"><?php esc_html_e('Popular', 'generpress'); ?></a></h3></li>
		</ul> <!--end .tabs-->

		<div class="clear"></div>
		
		<div class="inside">

			<div id="recent-posts" class="data-list current-data"> 
				<ul>
					<?php generpress_latest_tabs($recent_post_num); ?>
				</ul>
			</div> <!--end #recent-posts-->
		
			<div id="popular-posts" class="data-list">
				<ul>
					<?php rewind_posts(); ?>
					<?php generpress_popular_tabs( $popular_post_num ); ?>
				</ul>
			</div> <!--end #popular-posts-->

			<div class="clear"></div>
			
		</div> <!--end .inside -->
		
		<div class="clear"></div>
		
	</div><!--end #tabwrap -->

<?php echo $after_widget; ?>
		<?php
	}


	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['popular_post_num'] = sanitize_text_field($new_instance['popular_post_num']);
		$instance['recent_post_num'] =  sanitize_text_field($new_instance['recent_post_num']);
		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'popular_post_num' => '5', 'recent_post_num' => '5') );
		$popular_post_num = sanitize_text_field($instance['popular_post_num']);
		$recent_post_num = sanitize_text_field($instance['recent_post_num']);
	?>
		<p><label for="<?php echo $this->get_field_id('recent_post_num'); ?>"><?php esc_html_e('Number of latest posts to show:', 'generpress'); ?></label>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id('recent_post_num'); ?>" name="<?php echo $this->get_field_name('recent_post_num'); ?>" value="<?php echo wp_kses_post( $recent_post_num ); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('popular_post_num'); ?>"><?php esc_html_e('Number of popular posts to show:', 'generpress'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('popular_post_num'); ?>" name="<?php echo $this->get_field_name('popular_post_num'); ?>" type="text" value="<?php echo wp_kses_post( $popular_post_num ); ?>" /></p>

	<?php }
}

register_widget('generpress_Widget_Tabs');

?>