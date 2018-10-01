<?php

get_header(); ?>

<div id="main-content" class="main-content">

<?php
	while ( have_posts() ) : the_post();
		if(get_post_type() == 'post' || get_post_type() == 'thegem_pf_item' || get_post_type() == 'thegem_news') {
			get_template_part( 'content', 'page' );
		} else {
			get_template_part( 'content', get_post_format() );
		}
	endwhile;
?>

</div><!-- #main-content -->

<?php
get_footer();
