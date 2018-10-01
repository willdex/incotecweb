<?php
	$thegem_item_data = thegem_get_sanitize_team_person_data(get_the_ID());
	$thegem_link_start = '';
	$thegem_link_end = '';
	if($thegem_link = thegem_get_data($thegem_item_data, 'link')) {
		$thegem_link_start = '<a href="'.esc_url($thegem_link).'" target="'.esc_attr(thegem_get_data($thegem_item_data, 'link_target')).'">';
		$thegem_link_end = '</a>';
	}
	$thegem_grid_class = '';
	if($params['columns'] == '1') {
		$thegem_grid_class = 'col-xs-12';
	} elseif($params['columns'] == '2') {
		$thegem_grid_class = 'col-sm-6 col-xs-12';
	} elseif($params['columns'] == '3') {
		$thegem_grid_class = 'col-md-4 col-sm-6 col-xs-12';
	} else {
		$thegem_grid_class = 'col-md-3 col-sm-6 col-xs-12';
	}
	$thegem_email_link = thegem_get_data($thegem_item_data, 'email', '', '<div class="team-person-email date-color"><a class="date-color" href="mailto:', '"></a></div>');
	if($thegem_item_data['hide_email']) {
		$thegem_email = explode('@', $thegem_item_data['email']);
		if(count($thegem_email) == 2) {
			$thegem_email_link = '<div class="team-person-email"><a href="#" class="hidden-email date-color" data-name="'.$thegem_email[0].'" data-domain="'.$thegem_email[1].'"></a></div>';
		}
	}
	$thegem_socials_block = '';
	foreach(thegem_team_person_socials_list() as $thegem_key => $thegem_value) {
		if($thegem_item_data['social_link_'.$thegem_key]) {
			$thegem_socials_block .= '<a title="'.esc_attr($thegem_value).'" target="_blank" href="'.esc_url($thegem_item_data['social_link_'.$thegem_key]).'" class="socials-item"><i class="socials-item-icon social-item-rounded '.esc_attr($thegem_key).'"></i></a>';
		}
	}
?>

<div class="<?php echo esc_attr($thegem_grid_class); ?> inline-column">
	<div id="post-<?php the_ID(); ?>" <?php post_class(array('team-person', 'bordered-box')); ?>>
		<?php if(has_post_thumbnail()) : ?><div class="team-person-image"><?php echo $thegem_link_start; thegem_post_thumbnail('thegem-person-160', false, 'img-responsive', array('srcset' => array('2x' => 'thegem-person'))); echo $thegem_link_end; ?></div><?php endif; ?>
		<div class="team-person-info clearfix">
			<?php echo thegem_get_data($thegem_item_data, 'name', '', '<div class="team-person-name styled-subtitle">', '</div>'); ?>
			<?php echo thegem_get_data($thegem_item_data, 'position', '', '<div class="team-person-position date-color">', '</div>'); ?>
			<?php echo thegem_get_data($thegem_item_data, 'phone', '', '<div class="gem-styled-color-1"><div class="team-person-phone title-h5">', '</div></div>'); ?>
			<?php if($thegem_socials_block) : ?><div class="socials team-person-socials socials-colored-hover"><?php echo $thegem_socials_block; ?></div><?php endif; ?>
			<?php echo $thegem_email_link; ?>
		</div>
	</div>
</div>
