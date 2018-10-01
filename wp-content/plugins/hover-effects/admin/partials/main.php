<?php if ( ! defined( 'ABSPATH' ) ) exit;?>
<div class="wow">
	 <span class="wow-plugin-title"><?php echo $name; ?></span> <span class="wow-plugin-version">(version <?php echo $version; ?>)</span>
	<ul class="wow-admin-menu">
		<li><a href='admin.php?page=<?php echo $pluginname;?>' title="Examples">Examples <i class="fa fa-hand-pointer-o"></i></a></li>
		<li><a href='admin.php?page=<?php echo $pluginname;?>&tool=faq' title="FAQ">FAQ <i class="fa fa-question"></i></a></li>				
		<li><a href='https://wordpress.org/support/plugin/hover-effects' target="_blank" title="Support page">Support <i class="fa fa-life-ring"></i></a></li>
		<li><a href='https://wordpress.org/plugins/hover-effects/#reviews' target="_blank" title="Rate this plugin">Rate Us <i class="fa fa-star"></i></a></li>
		<li><a href='https://www.facebook.com/wowaffect/' target="_blank" title="Join Us on Facebook">Join Us <i class="fa fa-facebook"></i></a></li>	
	</ul>
		
	<?php
		$tool= (isset($_REQUEST["tool"])) ? sanitize_text_field($_REQUEST["tool"]) : '';
		
		if ($tool == ""){
			include_once( 'list.php' );
			return;
		}		
		if ($tool == "items"){
			include_once( 'items.php' );	
			return;
		}
		if ($tool == "faq"){
			include_once( 'faq.php' );	
			return;
		}
		
	?>
</div>