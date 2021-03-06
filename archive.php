<?php /* Template Name: Courses archive */ ?>
<?php $args = array(
	'post_type' 	=> 'course',
	'post_per_page' => -1,
	'post_status' 	=> 'publish',
	'orderby'       => 'date',
	'order'         => 'DESC',
	);
	// The Query
$the_query = new WP_Query( $args ); ?>
<?php // The Loop
if ( $the_query->have_posts() ) : ?>
		<div class="row courses">
			<?php
			$count = 0;
			while ( $the_query->have_posts() ) {
				if($count !== 0 && $count % 3 == 0)
					echo '</div><div class="row courses">';
				$the_query->the_post();
				$category_display_label = 'primary';
				$category_object = wp_get_post_terms( get_the_ID(), 'course_category' );
				$category_object = $category_object[0];
				if('design' === $category_object->slug)
					$category_display_label = 'danger';
				echo '<div class="col-md-4">';
				echo '<div class="thumbnail">';
				echo '<a href="' . esc_url(get_permalink()) . '"><img src="' . get_post_meta(get_the_ID(), 'featured_url', true) . '" class="img-responsive"></a>';
				echo '<span class="course-category label label-'. $category_display_label .'">' . $category_object->name . '</span>';
				echo '<a class="title" href="' . esc_url(get_permalink()) . '">' . get_the_title() . '</a>';
				echo '<p><i>' . get_the_date() . ' / ' . trim(do_shortcode( '[course_time_estimation course_id="' . get_the_ID() . '"]' ) ) . '</i></p>';
				echo '</div>';
				echo '</div>';
				$count ++;
			}
			?>
		</div>
<?php endif; ?>
<?php wp_reset_postdata(); ?>