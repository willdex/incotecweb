<?php
$block = $block_data[0];
$settings = $block_data[1];
$link_setting = empty($settings[0]) ? '' : $settings[0];
?>
<?php if($block === 'title'): ?>
<div class="gem-post-title " xmlns="http://www.w3.org/1999/html">
	<?php echo empty($link_setting) || $link_setting!='no_link' ? $this->getLinked($post, $post->title, $link_setting, 'link_title') : $post->title ?>
</div>
<?php elseif($block === 'image'):
	if(empty($post->thumbnail)) {
		echo '<div class="gem-dummy gem-post-thumb-gem-dummy"></div>';
	} else {
?>
<div class="gem-post-thumb">
	<?php echo empty($link_setting) || $link_setting!='no_link' ? $this->getLinked($post, $post->thumbnail, $link_setting, 'link_image') : $post->thumbnail ?>
</div>
<?php
	}
?>
<?php elseif($block === 'link'): ?>
	<a href="<?php echo esc_url($post->link); ?>" class="vc_read_more" title="<?php echo esc_attr( sprintf( esc_html__( 'Permalink to %s', "thegem" ), $post->title_attribute ) ); ?>"<?php echo $this->link_target ?>><?php esc_html_e( 'Read more...', 'thegem' ) ?></a>
<?php endif; ?>