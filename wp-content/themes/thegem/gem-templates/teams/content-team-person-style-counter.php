<?php
	$thegem_item_data = thegem_get_sanitize_team_person_data(get_the_ID());
	$thegem_link_start = '';
	$thegem_link_end = '';
	if($thegem_link = thegem_get_data($thegem_item_data, 'link')) {
		$thegem_link_start = '<a href="'.esc_url($thegem_link).'" target="'.esc_attr(thegem_get_data($thegem_item_data, 'link_target')).'">';
		$thegem_link_end = '</a>';
	}
	$thegem_grid_class = 'col-xs-12';

	$thegem_email_link = thegem_get_data($thegem_item_data, 'email', '', '<div class="team-person-email"><a href="mailto:', '">'.$thegem_item_data['email'].'</a></div>');
	if($thegem_item_data['hide_email']) {
		$thegem_email = explode('@', $thegem_item_data['email']);
		if(count($thegem_email) == 2) {
			$thegem_email_link = '<div class="team-person-email"><a href="#" class="hidden-email" data-name="'.esc_attr($thegem_email[0]).'" data-domain="'.esc_attr($thegem_email[1]).'">'.esc_html__('Send Message', 'thegem').'</a></div>';
		}
	}
	$thegem_socials_block = '';
	foreach(thegem_team_person_socials_list() as $thegem_key => $thegem_value) {
		if($thegem_item_data['social_link_'.$thegem_key]) {
			$thegem_socials_block .= '<a title="'.esc_attr($thegem_value).'" target="_blank" href="'.esc_url($thegem_item_data['social_link_'.$thegem_key]).'" class="socials-item"><i class="socials-item-icon social-item-rounded '.esc_attr($thegem_key).'"></i></a>';
		}
	}

	$scrset = '';
	if (!empty($params['team_image_size'])) {
		$scrset = array();

		switch ($params['team_image_size']) {
			case 'small':
			case 'medium':
				$scrset = array('srcset' => array('1x' => 'thegem-person-80', '2x' => 'thegem-person-160'));
				break;

			case 'large':
				$scrset = array('srcset' => array('1x' => 'thegem-person-160', '2x' => 'thegem-person'));
				break;

			case 'xlarge':
				$scrset = array('srcset' => array('1x' => 'thegem-person-240', '2x' => 'thegem-person'));
				break;
		}
	}
?>

<div class="<?php echo esc_attr($thegem_grid_class); ?> inline-column">
	<div id="post-<?php the_ID(); ?>" <?php post_class(array('team-person', 'centered-box', 'default-background')); ?>>
		<?php if(has_post_thumbnail()) : ?><div class="team-person-image"><?php echo $thegem_link_start; thegem_post_thumbnail('thegem-person', false, 'img-responsive', $scrset); echo $thegem_link_end; ?></div><?php endif; ?>
		<div class="team-person-info">
			<?php echo thegem_get_data($thegem_item_data, 'name', '', '<div class="team-person-name title-h2"><span class="light">', '</span></div>'); ?>
			<?php echo thegem_get_data($thegem_item_data, 'position', '', '<div class="team-person-position date-color styled-subtitle">', '</div>'); ?>
			<?php echo thegem_get_data($thegem_item_data, 'phone', '', '<div class="gem-styled-color-1"><div class="team-person-phone title-h4">', '</div></div>'); ?>
			<?php echo $thegem_email_link; ?>
		</div>
		<?php if($thegem_socials_block) : ?><div class="socials team-person-socials socials-colored-hover"><?php echo $thegem_socials_block; ?></div><?php endif; ?>
	</div>
</div>
