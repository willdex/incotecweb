<?php

function thegem_get_theme_options() {
	$options = array(
		'general' => array(
			'title' => __('General', 'thegem'),
			'subcats' => array(
				'theme_layout' => array(
					'title' => __('Theme Layout', 'thegem'),
					'options' => array(
						'page_layout_style' => array(
							'title' => __('Page Layout Style', 'thegem'),
							'type' => 'select',
							'items' => array(
								'fullwidth' => __('Fullwidth Layout', 'thegem'),
								'boxed' => __('Boxed Layout', 'thegem'),
							),
							'default' => 'fullwidth',
							'description' => __('Select theme layout style', 'thegem'),
						),
						'disable_scroll_top_button' => array(
							'title' => __('Disable "Scroll To Top" Button', 'thegem'),
							'description' => __('Disable on-scroll "to the top" button', 'thegem'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'disable_uppercase_font' => array(
							'title' => __('Disable uppercase font', 'thegem'),
							'description' => __('Disable uppsercase', 'thegem'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'disable_smooth_scroll' => array(
							'title' => __('Disable "Smooth Scroll"', 'thegem'),
							'description' => __('Disable "Smooth Scroll"', 'thegem'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'enable_page_preloader' => array(
							'title' => __('Enable Page Preloader', 'thegem'),
							'description' => __('Enable Page Preloader', 'thegem'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
					),
				),
				'identity' => array(
					'title' => __('Identity', 'thegem'),
					'options' => array(
						'logo_width' => array(
							'title' => __('Desktop Logo Width For Non-Retina Screens', 'thegem'),
							'type' => 'fixed-number',
							'min' => 0,
							'max' => 1200,
							'default' => 100,
							'description' => __('On our demo website we use 164 pix. logo', 'thegem'),
						),
						'small_logo_width' => array(
							'title' => __('Mobile Logo Width For Non-Retina Screens', 'thegem'),
							'type' => 'fixed-number',
							'min' => 0,
							'max' => 1200,
							'default' => 100,
							'description' => __('On our demo website we use 132 pix. logo', 'thegem'),
						),
						'logo' => array(
							'title' => __('Desktop Logo', 'thegem'),
							'type' => 'image',
							'default' => get_template_directory_uri() . '/images/default-logo.png',
							'description' => __('Upload your logo for desktop screens here. Pls note: if you wish to achieve best quality on retina screens, your logo size should be 3 times larger as the size you have set in "Desktop Logo Width For Non-Retina Screens". On our demo website we use 164 x 3 = 492 pix', 'thegem'),
						),
						'small_logo' => array(
							'title' => __('Mobile Logo', 'thegem'),
							'type' => 'image',
							'default' => get_template_directory_uri() . '/images/default-logo-small.png',
							'description' => __('Upload your logo for mobile screens here. Pls note: if you wish to achieve best quality on retina mobile screens, your logo size should be 3 times larger as the size you have set in "Mobile Logo Width For Non-Retina Screens". On our demo website we use 132 x 3 = 396 pix', 'thegem'),
						),
						'logo_light' => array(
							'title' => __('Light Desktop Logo', 'thegem'),
							'type' => 'image',
							'default' => get_template_directory_uri() . '/images/default-logo-light.png',
							'description' => __('Here you can upload a light version of your desktop logo to be used on dark header backgrounds. Pls note: if you wish to achieve best quality on retina screens, your logo size should be 3 times larger as the size you have set in "Desktop Logo Width For Non-Retina Screens". On our demo website we use 164 x 3 = 492 pix', 'thegem'),
						),
						'small_logo_light' => array(
							'title' => __('Light Mobile Logo', 'thegem'),
							'type' => 'image',
							'default' => get_template_directory_uri() . '/images/default-logo.png',
							'description' => __('Here you can upload a light version of your mobile logo to be used on dark header backgrounds. Pls note: if you wish to achieve best quality on retina screens, your logo size should be 3 times larger as the size you have set in "Mobile Logo Width For Non-Retina Screens". On our demo website we use 132 x 3 = 396 pix', 'thegem'),
						),
					),
				),
				'advanced' => array(
					'title' => __('Advanced', 'thegem'),
					'options' => array(
						'preloader_style' => array(
							'title' => __('Preloader Style', 'thegem'),
							'type' => 'select',
							'items' => array(
								'preloader-1' => __('Preloader 1', 'thegem'),
								'preloader-2' => __('Preloader 2', 'thegem'),
								'preloader-3' => __('Preloader 3', 'thegem'),
								'preloader-4' => __('Preloader 4', 'thegem'),
							),
							'default' => 'preloader-1',
							'description' => __('Choose preloader you wish to use on your website', 'thegem'),
						),
						'custom_css' => array(
							'title' => __('Custom CSS', 'thegem'),
							'type' => 'textarea',
							'description' => __('Type your custom css here, which you would like to add to theme\'s css (or overwrite it)', 'thegem'),
						),
						'custom_js' => array(
							'title' => __('Custom JS', 'thegem'),
							'type' => 'textarea',
							'description' => __('Type your custom javascript here, which you would like to add to theme\'s js', 'thegem'),
						),
					),
				),
				'additional' => array(
					'title' => __('Additional Settings', 'thegem'),
					'options' => array(
						'404_page' => array(
							'title' => __('Custom 404 Page', 'thegem'),
							'type' => 'select',
							'items' => thegem_get_pages_list(),
							'default' => '',
						),
						'enable_mobile_lazy_loading' => array(
							'title' => __('Enabe Lazy Loading Animations On Mobiles', 'thegem'),
							'description' => __('Enabe Lazy Loading Animations On Mobiles', 'thegem'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
					),
				),
			),
		),

		'header' => array(
			'title' => __('Header', 'thegem'),
			'subcats' => array(
				'general' => array(
					'title' => __('Main Menu &amp; Header Area', 'thegem'),
					'options' => array(
						'disable_fixed_header' => array(
							'title' => __('Disable Fixed Header', 'thegem'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'sticky_header_on_mobile' => array(
							'title' => __('Sticky Header On Mobile', 'thegem'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'hide_search_icon' => array(
							'title' => __('Hide Search Icon', 'thegem'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'header_layout' => array(
							'title' => __('Main Menu & Header Layout ', 'thegem'),
							'type' => 'select',
							'items' => array(
								'default' => __('Horizontal', 'thegem'),
								'fullwidth' => __('100% Width', 'thegem'),
								'fullwidth_hamburger' => __('100% Width & Hamburger Menu', 'thegem'),
								'vertical' => __('Vertical', 'thegem'),
								'overlay' => __('Overlay', 'thegem'),
							),
							'description' => __('Choose the layout for displaying your main menu and website header.', 'thegem'),
						),
						'mobile_menu_layout' => array(
							'title' => __('Mobile Menu Layout ', 'thegem'),
							'type' => 'select',
							'items' => array(
								'default' => __('Default layout', 'thegem'),
								'overlay' => __('Overlay layout', 'thegem'),
							),
							'description' => __('Choose the layout for displaying your mobile menu.', 'thegem'),
						),
						'header_style' => array(
							'title' => __('Main Menu & Header Style', 'thegem'),
							'type' => 'select',
							'items' => array(
								'1' => __('Light Main Menu & Dark Submenu', 'thegem'),
								'2' => __('Elegant Font Light Menu', 'thegem'),
								'3' => __('Light Main Menu & Light Submenu', 'thegem'),
								'4' => __('Dark Main Menu & Dark Submenu', 'thegem'),
							),
							'description' => __('Choose the style / colors for displaying your main menu and website header.', 'thegem'),
						),
						'logo_position' => array(
							'title' => __('Logo Alignment', 'thegem'),
							'type' => 'select',
							'items' => array(
								'left' => __('Left', 'thegem'),
								'right' => __('Right', 'thegem'),
								'center' => __('Centered Above Main Menu', 'thegem'),
								'menu_center' => __('Centered In Main Menu', 'thegem'),
							),
							'default' => 'left',
							'description' => __('Select position of your logo in website header', 'thegem'),
						),
						'menu_appearance_tablet_portrait' => array(
							'title' => __('Menu appearance on tablets (portrait orientation)', 'thegem'),
							'type' => 'select',
							'items' => array(
								'responsive' => __('Responsive', 'thegem'),
								'centered' => __('Centered', 'thegem'),
								'default' => __('Default', 'thegem'),
							),
							'default' => 'responsive',
							'description' => __('Select the menu appearance style on tablet screens in portrait orientation', 'thegem'),
						),
						'menu_appearance_tablet_landscape' => array(
							'title' => __('Menu appearance on tablets (landscape orientation)', 'thegem'),
							'type' => 'select',
							'items' => array(
								'responsive' => __('Responsive', 'thegem'),
								'centered' => __('Centered', 'thegem'),
								'default' => __('Default', 'thegem'),
							),
							'default' => 'default',
							'description' => __('Select the menu appearance style on tablet screens in landscape orientation', 'thegem'),
						),
					),
				),
				'top_area' => array(
					'title' => __('Top Area', 'thegem'),
					'options' => array(
						'top_area_style' => array(
							'title' => __('Top Area Style', 'thegem'),
							'type' => 'select',
							'items' => array(
								'0' => __('Disabled', 'thegem'),
								'1' => __('Light Background', 'thegem'),
								'2' => __('Dark Background', 'thegem'),
								'3' => __('Anthracite Background', 'thegem'),
							),
							'description' => __('Select the style of top area (contacts & socials bar above main menu and logo) or disable it', 'thegem'),
						),
						'top_area_alignment' => array(
							'title' => __('Top Area Alignment', 'thegem'),
							'type' => 'select',
							'items' => array(
								'left' => __('Left', 'thegem'),
								'right' => __('Right', 'thegem'),
								'center' => __('Centered', 'thegem'),
								'justified' => __('Justified', 'thegem'),
							),
							'description' => __('Select content alignment in the top area of your website', 'thegem'),
						),
						'top_area_contacts' => array(
							'title' => __('Show Contacts', 'thegem'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
							'description' => __('By activating this option your contact data will be displayed in top area of your website. You can edit your contact data in "Contacts & Socials" section of Theme Options', 'thegem'),
						),
						'top_area_socials' => array(
							'title' => __('Show Socials', 'thegem'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
							'description' => __('By activating this option the links to your social profiles will be displayed in top area of your website. You can edit your social profiles in "Contacts & Socials" section of Theme Options', 'thegem'),
						),
						'top_area_button_text' => array(
							'title' => __('Top Area Button Text', 'thegem'),
							'type' => 'input',
							'default' => '',
							'description' => __('Here you can activate and name the button to be displayed in top area. Leave blank if you don\'t wish to use a button in top area.', 'thegem'),
						),
						'top_area_button_link' => array(
							'title' => __('Top Area Button Link', 'thegem'),
							'type' => 'input',
							'default' => '',
							'description' => __('Here you can enter the link for your top area button.', 'thegem'),
						),
						'top_area_disable_fixed' => array(
							'title' => __('Disable Fixed Top Area', 'thegem'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'top_area_disable_mobile' => array(
							'title' => __('Disable Top Area For Mobiles', 'thegem'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
					),
				),
				'header_default_settings' => array(
					'title' => __('Header Default Settings', 'thegem'),
					'options' => array(
						'default_page_title_background_image' => array(
							'title' => __('Page Title Background image', 'thegem'),
							'type' => 'image',
						),
						'default_page_title_background_color' => array(
							'title' => __('Page Title Background Color:', 'thegem'),
							'type' => 'color',
						),
						'default_page_title_top_padding' => array(
							'title' => __('Padding Top:', 'thegem'),
							'type' => 'input',
							'default' => '',
						),
						'default_page_title_bottom_padding' => array(
							'title' => __('Padding Bottom:', 'thegem'),
							'type' => 'input',
							'default' => '',
						),

						'default_page_title_text_color' => array(
							'title' => __('Title Text Color:', 'thegem'),
							'type' => 'color',
						),
						'default_page_title_excerpt_text_color' => array(
							'title' => __('Excerpt Color:', 'thegem'),
							'type' => 'color',
						),
						'default_page_title_max_width' => array(
							'title' => __('Title Max Width:', 'thegem'),
							'type' => 'input',
							'default' => '',
						),
						'default_page_title_excerpt_width' => array(
							'title' => __('Excerpt Max Width:', 'thegem'),
							'type' => 'input',
							'default' => '',
						),
						'default_page_title_top_margin' => array(
							'title' => __('Title Top Margin:', 'thegem'),
							'type' => 'input',
							'default' => '',
						),
						'default_page_title_excerpt_top_margin' => array(
							'title' => __('Excerpt Top Margin:', 'thegem'),
							'type' => 'input',
							'default' => '',
						),
						'default_page_title_alignment' => array(
							'title' => __('Title alignment:', 'thegem'),
							'type' => 'select',
							'items' => array(
								'center' => __('Center', 'thegem'),
								'left' => __('Left', 'thegem'),
								'right' => __('Right', 'thegem'),

							),
						),
					),
				),
			),
		),

		'fonts' => array(
			'title' => __('Fonts', 'thegem'),
			'subcats' => array(
/*				'google_fonts' => array(
					'title' => __('Google Fonts', 'thegem'),
					'options' => array(
						'google_fonts_file' => array(
							'title' => __('Google Fonts File', 'thegem'),
							'type' => 'file',
							'description' => __('Upload or select you own google fonts file if you would like to use a different version than the theme\'s default', 'thegem'),
						),
					),
				),*/
				'main_menu_font' => array(
					'title' => __('Main Menu Font', 'thegem'),
					'options' => array(
						'main_menu_font_family' => array(
							'title' => __('Font Family', 'thegem'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'thegem'),
						),
						'main_menu_font_style' => array(
							'title' => __('Font Style', 'thegem'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'thegem'),
						),
						'main_menu_font_sets' => array(
							'title' => __('Font Sets', 'thegem'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'thegem'),
							'default' => 'latin,latin-ext'
						),
						'main_menu_font_size' => array(
							'title' => __('Font Size', 'thegem'),
							'description' => __('Select the font size', 'thegem'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 18,
						),
						'main_menu_line_height' => array(
							'title' => __('Line Height', 'thegem'),
							'description' => __('Select the line height', 'thegem'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'submenu_font' => array(
					'title' => __('Submenu Font', 'thegem'),
					'options' => array(
						'submenu_font_family' => array(
							'title' => __('Font Family', 'thegem'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'thegem'),
						),
						'submenu_font_style' => array(
							'title' => __('Font Style', 'thegem'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'thegem'),
						),
						'submenu_font_sets' => array(
							'title' => __('Font Sets', 'thegem'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'thegem'),
							'default' => 'latin,latin-ext'
						),
						'submenu_font_size' => array(
							'title' => __('Font Size', 'thegem'),
							'description' => __('Select the font size', 'thegem'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 12,
						),
						'submenu_line_height' => array(
							'title' => __('Line Height', 'thegem'),
							'description' => __('Select the line height', 'thegem'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'overlay_menu_font' => array(
					'title' => __('Overlay Menu Font', 'thegem'),
					'options' => array(
						'overlay_menu_font_family' => array(
							'title' => __('Font Family', 'thegem'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'thegem'),
						),
						'overlay_menu_font_style' => array(
							'title' => __('Font Style', 'thegem'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'thegem'),
						),
						'overlay_menu_font_sets' => array(
							'title' => __('Font Sets', 'thegem'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'thegem'),
							'default' => 'latin,latin-ext'
						),
						'overlay_menu_font_size' => array(
							'title' => __('Font Size', 'thegem'),
							'description' => __('Select the font size', 'thegem'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 12,
						),
						'overlay_menu_line_height' => array(
							'title' => __('Line Height', 'thegem'),
							'description' => __('Select the line height', 'thegem'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'styled_subtitle_font' => array(
					'title' => __('Styled Subtitle Font', 'thegem'),
					'options' => array(
						'styled_subtitle_font_family' => array(
							'title' => __('Font Family', 'thegem'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'thegem'),
						),
						'styled_subtitle_font_style' => array(
							'title' => __('Font Style', 'thegem'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'thegem'),
						),
						'styled_subtitle_font_sets' => array(
							'title' => __('Font Sets', 'thegem'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'thegem'),
							'default' => 'latin,latin-ext'
						),
						'styled_subtitle_font_size' => array(
							'title' => __('Font Size', 'thegem'),
							'description' => __('Select the font size', 'thegem'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 29,
						),
						'styled_subtitle_line_height' => array(
							'title' => __('Line Height', 'thegem'),
							'description' => __('Select the line height', 'thegem'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'h1_font' => array(
					'title' => __('H1 Font', 'thegem'),
					'options' => array(
						'h1_font_family' => array(
							'title' => __('Font Family', 'thegem'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'thegem'),
						),
						'h1_font_style' => array(
							'title' => __('Font Style', 'thegem'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'thegem'),
						),
						'h1_font_sets' => array(
							'title' => __('Font Sets', 'thegem'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'thegem'),
							'default' => 'latin,latin-ext'
						),
						'h1_font_size' => array(
							'title' => __('Font Size', 'thegem'),
							'description' => __('Select the font size', 'thegem'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 29,
						),
						'h1_line_height' => array(
							'title' => __('Line Height', 'thegem'),
							'description' => __('Select the line height', 'thegem'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'h2_font' => array(
					'title' => __('H2 Font', 'thegem'),
					'options' => array(
						'h2_font_family' => array(
							'title' => __('Font Family', 'thegem'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'thegem'),
						),
						'h2_font_style' => array(
							'title' => __('Font Style', 'thegem'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'thegem'),
						),
						'h2_font_sets' => array(
							'title' => __('Font Sets', 'thegem'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'thegem'),
							'default' => 'latin,latin-ext'
						),
						'h2_font_size' => array(
							'title' => __('Font Size', 'thegem'),
							'description' => __('Select the font size', 'thegem'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 25,
						),
						'h2_line_height' => array(
							'title' => __('Line Height', 'thegem'),
							'description' => __('Select the line height', 'thegem'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'h3_font' => array(
					'title' => __('H3 Font', 'thegem'),
					'options' => array(
						'h3_font_family' => array(
							'title' => __('Font Family', 'thegem'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'thegem'),
						),
						'h3_font_style' => array(
							'title' => __('Font Style', 'thegem'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'thegem'),
						),
						'h3_font_sets' => array(
							'title' => __('Font Sets', 'thegem'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'thegem'),
							'default' => 'latin,latin-ext'
						),
						'h3_font_size' => array(
							'title' => __('Font Size', 'thegem'),
							'description' => __('Select the font size', 'thegem'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 23,
						),
						'h3_line_height' => array(
							'title' => __('Line Height', 'thegem'),
							'description' => __('Select the line height', 'thegem'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'h4_font' => array(
					'title' => __('H4 Font', 'thegem'),
					'options' => array(
						'h4_font_family' => array(
							'title' => __('Font Family', 'thegem'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'thegem'),
						),
						'h4_font_style' => array(
							'title' => __('Font Style', 'thegem'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'thegem'),
						),
						'h4_font_sets' => array(
							'title' => __('Font Sets', 'thegem'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'thegem'),
							'default' => 'latin,latin-ext'
						),
						'h4_font_size' => array(
							'title' => __('Font Size', 'thegem'),
							'description' => __('Select the font size', 'thegem'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 21,
						),
						'h4_line_height' => array(
							'title' => __('Line Height', 'thegem'),
							'description' => __('Select the line height', 'thegem'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'h5_font' => array(
					'title' => __('H5 Font', 'thegem'),
					'options' => array(
						'h5_font_family' => array(
							'title' => __('Font Family', 'thegem'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'thegem'),
						),
						'h5_font_style' => array(
							'title' => __('Font Style', 'thegem'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'thegem'),
						),
						'h5_font_sets' => array(
							'title' => __('Font Sets', 'thegem'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'thegem'),
							'default' => 'latin,latin-ext'
						),
						'h5_font_size' => array(
							'title' => __('Font Size', 'thegem'),
							'description' => __('Select the font size', 'thegem'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 19,
						),
						'h5_line_height' => array(
							'title' => __('Line Height', 'thegem'),
							'description' => __('Select the line height', 'thegem'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'h6_font' => array(
					'title' => __('H6 Font', 'thegem'),
					'options' => array(
						'h6_font_family' => array(
							'title' => __('Font Family', 'thegem'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'thegem'),
						),
						'h6_font_style' => array(
							'title' => __('Font Style', 'thegem'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'thegem'),
						),
						'h6_font_sets' => array(
							'title' => __('Font Sets', 'thegem'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'thegem'),
							'default' => 'latin,latin-ext'
						),
						'h6_font_size' => array(
							'title' => __('Font Size', 'thegem'),
							'description' => __('Select the font size', 'thegem'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 17,
						),
						'h6_line_height' => array(
							'title' => __('Line Height', 'thegem'),
							'description' => __('Select the line height', 'thegem'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'xlarge_title_font' => array(
					'title' => __('XLarge Title Font', 'thegem'),
					'options' => array(
						'xlarge_title_font_family' => array(
							'title' => __('Font Family', 'thegem'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'thegem'),
						),
						'xlarge_title_font_style' => array(
							'title' => __('Font Style', 'thegem'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'thegem'),
						),
						'xlarge_title_font_sets' => array(
							'title' => __('Font Sets', 'thegem'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'thegem'),
							'default' => 'latin,latin-ext'
						),
						'xlarge_title_font_size' => array(
							'title' => __('Font Size', 'thegem'),
							'description' => __('Select the font size', 'thegem'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 17,
						),
						'xlarge_title_line_height' => array(
							'title' => __('Line Height', 'thegem'),
							'description' => __('Select the line height', 'thegem'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'light_title_font' => array(
					'title' => __('Light Title Font', 'thegem'),
					'options' => array(
						'light_title_font_family' => array(
							'title' => __('Font Family', 'thegem'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'thegem'),
						),
						'light_title_font_style' => array(
							'title' => __('Font Style', 'thegem'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'thegem'),
						),
						'light_title_font_sets' => array(
							'title' => __('Font Sets', 'thegem'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'thegem'),
							'default' => 'latin,latin-ext'
						),
					),
				),
				'body_font' => array(
					'title' => __('Body Font', 'thegem'),
					'options' => array(
						'body_font_family' => array(
							'title' => __('Font Family', 'thegem'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'thegem'),
						),
						'body_font_style' => array(
							'title' => __('Font Style', 'thegem'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'thegem'),
						),
						'body_font_sets' => array(
							'title' => __('Font Sets', 'thegem'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'thegem'),
							'default' => 'latin,latin-ext'
						),
						'body_font_size' => array(
							'title' => __('Font Size', 'thegem'),
							'description' => __('Select the font size', 'thegem'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 14,
						),
						'body_line_height' => array(
							'title' => __('Line Height', 'thegem'),
							'description' => __('Select the line height', 'thegem'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'widget_title_font' => array(
					'title' => __('Widget Title Font', 'thegem'),
					'options' => array(
						'widget_title_font_family' => array(
							'title' => __('Font Family', 'thegem'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'thegem'),
						),
						'widget_title_font_style' => array(
							'title' => __('Font Style', 'thegem'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'thegem'),
						),
						'widget_title_font_sets' => array(
							'title' => __('Font Sets', 'thegem'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'thegem'),
							'default' => 'latin,latin-ext'
						),
						'widget_title_font_size' => array(
							'title' => __('Font Size', 'thegem'),
							'description' => __('Select the font size', 'thegem'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 14,
						),
						'widget_title_line_height' => array(
							'title' => __('Line Height', 'thegem'),
							'description' => __('Select the line height', 'thegem'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'button_font' => array(
					'title' => __('Button Font', 'thegem'),
					'options' => array(
						'button_font_family' => array(
							'title' => __('Font Family', 'thegem'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'thegem'),
						),
						'button_font_style' => array(
							'title' => __('Font Style', 'thegem'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'thegem'),
						),
						'button_font_sets' => array(
							'title' => __('Font Sets', 'thegem'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'thegem'),
							'default' => 'latin,latin-ext'
						),
					),
				),
				'button_thin_font' => array(
					'title' => __('Button Thin Font', 'thegem'),
					'options' => array(
						'button_thin_font_family' => array(
							'title' => __('Font Family', 'thegem'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'thegem'),
						),
						'button_thin_font_style' => array(
							'title' => __('Font Style', 'thegem'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'thegem'),
						),
						'button_thin_font_sets' => array(
							'title' => __('Font Sets', 'thegem'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'thegem'),
							'default' => 'latin,latin-ext'
						),
					),
				),
				'portfolio_title_font' => array(
					'title' => __('Portfolio Title Font', 'thegem'),
					'options' => array(
						'portfolio_title_font_family' => array(
							'title' => __('Font Family', 'thegem'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'thegem'),
						),
						'portfolio_title_font_style' => array(
							'title' => __('Font Style', 'thegem'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'thegem'),
						),
						'portfolio_title_font_sets' => array(
							'title' => __('Font Sets', 'thegem'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'thegem'),
							'default' => 'latin,latin-ext'
						),
						'portfolio_title_font_size' => array(
							'title' => __('Font Size', 'thegem'),
							'description' => __('Select the font size', 'thegem'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 16,
						),
						'portfolio_title_line_height' => array(
							'title' => __('Line Height', 'thegem'),
							'description' => __('Select the line height', 'thegem'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'portfolio_description_font' => array(
					'title' => __('Portfolio Description Font', 'thegem'),
					'options' => array(
						'portfolio_description_font_family' => array(
							'title' => __('Font Family', 'thegem'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'thegem'),
						),
						'portfolio_description_font_style' => array(
							'title' => __('Font Style', 'thegem'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'thegem'),
						),
						'portfolio_description_font_sets' => array(
							'title' => __('Font Sets', 'thegem'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'thegem'),
							'default' => 'latin,latin-ext'
						),
						'portfolio_description_font_size' => array(
							'title' => __('Font Size', 'thegem'),
							'description' => __('Select the font size', 'thegem'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 16,
						),
						'portfolio_description_line_height' => array(
							'title' => __('Line Height', 'thegem'),
							'description' => __('Select the line height', 'thegem'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'quickfinder_title_font' => array(
					'title' => __('Quickfinder Title Font (Bold Style)', 'thegem'),
					'options' => array(
						'quickfinder_title_font_family' => array(
							'title' => __('Font Family', 'thegem'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'thegem'),
						),
						'quickfinder_title_font_style' => array(
							'title' => __('Font Style', 'thegem'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'thegem'),
						),
						'quickfinder_title_font_sets' => array(
							'title' => __('Font Sets', 'thegem'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'thegem'),
							'default' => 'latin,latin-ext'
						),
						'quickfinder_title_font_size' => array(
							'title' => __('Font Size', 'thegem'),
							'description' => __('Select the font size', 'thegem'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 16,
						),
						'quickfinder_title_line_height' => array(
							'title' => __('Line Height', 'thegem'),
							'description' => __('Select the line height', 'thegem'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'quickfinder_title_thin_font' => array(
					'title' => __('Quickfinder Title Font (Thin Style)', 'thegem'),
					'options' => array(
						'quickfinder_title_thin_font_family' => array(
							'title' => __('Font Family', 'thegem'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'thegem'),
						),
						'quickfinder_title_thin_font_style' => array(
							'title' => __('Font Style', 'thegem'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'thegem'),
						),
						'quickfinder_title_thin_font_sets' => array(
							'title' => __('Font Sets', 'thegem'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'thegem'),
							'default' => 'latin,latin-ext'
						),
						'quickfinder_title_thin_font_size' => array(
							'title' => __('Font Size', 'thegem'),
							'description' => __('Select the font size', 'thegem'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 16,
						),
						'quickfinder_title_thin_line_height' => array(
							'title' => __('Line Height', 'thegem'),
							'description' => __('Select the line height', 'thegem'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'quickfinder_description_font' => array(
					'title' => __('Quickfinder Description Font', 'thegem'),
					'options' => array(
						'quickfinder_description_font_family' => array(
							'title' => __('Font Family', 'thegem'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'thegem'),
						),
						'quickfinder_description_font_style' => array(
							'title' => __('Font Style', 'thegem'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'thegem'),
						),
						'quickfinder_description_font_sets' => array(
							'title' => __('Font Sets', 'thegem'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'thegem'),
							'default' => 'latin,latin-ext'
						),
						'quickfinder_description_font_size' => array(
							'title' => __('Font Size', 'thegem'),
							'description' => __('Select the font size', 'thegem'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 16,
						),
						'quickfinder_description_line_height' => array(
							'title' => __('Line Height', 'thegem'),
							'description' => __('Select the line height', 'thegem'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'gallery_title_font' => array(
					'title' => __('Gallery Title Font', 'thegem'),
					'options' => array(
						'gallery_title_font_family' => array(
							'title' => __('Font Family', 'thegem'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'thegem'),
						),
						'gallery_title_font_style' => array(
							'title' => __('Font Style', 'thegem'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'thegem'),
						),
						'gallery_title_font_sets' => array(
							'title' => __('Font Sets', 'thegem'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'thegem'),
							'default' => 'latin,latin-ext'
						),
						'gallery_title_font_size' => array(
							'title' => __('Font Size', 'thegem'),
							'description' => __('Select the font size', 'thegem'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 16,
						),
						'gallery_title_line_height' => array(
							'title' => __('Line Height', 'thegem'),
							'description' => __('Select the line height', 'thegem'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'gallery_title_bold_font' => array(
					'title' => __('Gallery Title Font (Bold Style)', 'thegem'),
					'options' => array(
						'gallery_title_bold_font_family' => array(
							'title' => __('Font Family', 'thegem'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'thegem'),
						),
						'gallery_title_bold_font_style' => array(
							'title' => __('Font Style', 'thegem'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'thegem'),
						),
						'gallery_title_bold_font_sets' => array(
							'title' => __('Font Sets', 'thegem'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'thegem'),
							'default' => 'latin,latin-ext'
						),
						'gallery_title_bold_font_size' => array(
							'title' => __('Font Size', 'thegem'),
							'description' => __('Select the font size', 'thegem'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 16,
						),
						'gallery_title_bold_line_height' => array(
							'title' => __('Line Height', 'thegem'),
							'description' => __('Select the line height', 'thegem'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'gallery_description_font' => array(
					'title' => __('Gallery Description Font', 'thegem'),
					'options' => array(
						'gallery_description_font_family' => array(
							'title' => __('Font Family', 'thegem'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'thegem'),
						),
						'gallery_description_font_style' => array(
							'title' => __('Font Style', 'thegem'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'thegem'),
						),
						'gallery_description_font_sets' => array(
							'title' => __('Font Sets', 'thegem'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'thegem'),
							'default' => 'latin,latin-ext'
						),
						'gallery_description_font_size' => array(
							'title' => __('Font Size', 'thegem'),
							'description' => __('Select the font size', 'thegem'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 16,
						),
						'gallery_description_line_height' => array(
							'title' => __('Line Height', 'thegem'),
							'description' => __('Select the line height', 'thegem'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'testimonial_font' => array(
					'title' => __('Testimonials Quoted Text', 'thegem'),
					'options' => array(
						'testimonial_font_family' => array(
							'title' => __('Font Family', 'thegem'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'thegem'),
						),
						'testimonial_font_style' => array(
							'title' => __('Font Style', 'thegem'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'thegem'),
						),
						'testimonial_font_sets' => array(
							'title' => __('Font Sets', 'thegem'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'thegem'),
							'default' => 'latin,latin-ext'
						),
						'testimonial_font_size' => array(
							'title' => __('Font Size', 'thegem'),
							'description' => __('Select the font size', 'thegem'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 16,
						),
						'testimonial_line_height' => array(
							'title' => __('Line Height', 'thegem'),
							'description' => __('Select the line height', 'thegem'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'counter_font' => array(
					'title' => __('Counter Numbers', 'thegem'),
					'options' => array(
						'counter_font_family' => array(
							'title' => __('Font Family', 'thegem'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'thegem'),
						),
						'counter_font_style' => array(
							'title' => __('Font Style', 'thegem'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'thegem'),
						),
						'counter_font_sets' => array(
							'title' => __('Font Sets', 'thegem'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'thegem'),
							'default' => 'latin,latin-ext'
						),
						'counter_font_size' => array(
							'title' => __('Font Size', 'thegem'),
							'description' => __('Select the font size', 'thegem'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 16,
						),
						'counter_line_height' => array(
							'title' => __('Line Height', 'thegem'),
							'description' => __('Select the line height', 'thegem'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'woocommerce_price_font' => array(
					'title' => __('WooCommerce Product Category Price', 'thegem'),
					'options' => array(
						'woocommerce_price_font_family' => array(
							'title' => __('Font Family', 'thegem'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'thegem'),
						),
						'woocommerce_price_font_style' => array(
							'title' => __('Font Style', 'thegem'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'thegem'),
						),
						'woocommerce_price_font_sets' => array(
							'title' => __('Font Sets', 'thegem'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'thegem'),
							'default' => 'latin,latin-ext'
						),
						'woocommerce_price_font_size' => array(
							'title' => __('Font Size', 'thegem'),
							'description' => __('Select the font size', 'thegem'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 16,
						),
						'woocommerce_price_line_height' => array(
							'title' => __('Line Height', 'thegem'),
							'description' => __('Select the line height', 'thegem'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'slideshow_title_font' => array(
					'title' => __('NivoSlider Title Font', 'thegem'),
					'options' => array(
						'slideshow_title_font_family' => array(
							'title' => __('Font Family', 'thegem'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'thegem'),
						),
						'slideshow_title_font_style' => array(
							'title' => __('Font Style', 'thegem'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'thegem'),
						),
						'slideshow_title_font_sets' => array(
							'title' => __('Font Sets', 'thegem'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'thegem'),
							'default' => 'latin,latin-ext'
						),
						'slideshow_title_font_size' => array(
							'title' => __('Font Size', 'thegem'),
							'description' => __('Select the font size', 'thegem'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 16,
						),
						'slideshow_title_line_height' => array(
							'title' => __('Line Height', 'thegem'),
							'description' => __('Select the line height', 'thegem'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'slideshow_description_font' => array(
					'title' => __('NivoSlider Description Font', 'thegem'),
					'options' => array(
						'slideshow_description_font_family' => array(
							'title' => __('Font Family', 'thegem'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'thegem'),
						),
						'slideshow_description_font_style' => array(
							'title' => __('Font Style', 'thegem'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'thegem'),
						),
						'slideshow_description_font_sets' => array(
							'title' => __('Font Sets', 'thegem'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'thegem'),
							'default' => 'latin,latin-ext'
						),
						'slideshow_description_font_size' => array(
							'title' => __('Font Size', 'thegem'),
							'description' => __('Select the font size', 'thegem'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 16,
						),
						'slideshow_description_line_height' => array(
							'title' => __('Line Height', 'thegem'),
							'description' => __('Select the line height', 'thegem'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
			),
		),

		'colors' => array(
			'title' => __('Colors', 'thegem'),
			'subcats' => array(
				'background_main_colors' => array(
					'title' => __('Background And Main Colors', 'thegem'),
					'options' => array(
						'basic_outer_background_color' => array(
							'title' => __('Background Color For Boxed Layout', 'thegem'),
							'type' => 'color',
							'description' => __('Select website\'s backround color in boxed layout', 'thegem'),
						),
						'top_background_color' => array(
							'title' => __('Main Menu & Header Area Background', 'thegem'),
							'type' => 'color',
							'description' => __('Background color for the website\'s header area with main menu and logo', 'thegem'),
						),
						'main_background_color' => array(
							'title' => __('Main Content Background Color', 'thegem'),
							'type' => 'color',
							'description' => __('Main background color for pages, blog posts, portfolio & shop items. It is also used as background for certain blog list styles, portfolio overviews, team items and tables. Additionally this color is used as text font color for text elements published on dark backgrounds, like footer on our demo website.', 'thegem'),
						),
						'footer_widget_area_background_color' => array(
							'title' => __('Footer Widgetised Area Background Color', 'thegem'),
							'type' => 'color',
							'description' => __('Background color for widgetised area in footer', 'thegem'),
						),
						'footer_background_color' => array(
							'title' => __('Footer Background Color', 'thegem'),
							'type' => 'color',
							'description' => __('Background color of the footer area with copyrights and socials at the bottom of the website.', 'thegem'),
						),
						'styled_elements_background_color' => array(
							'title' => __('Styled Element Background Color', 'thegem'),
							'type' => 'color',
							'description' => __('After the main content background color this is a second most important background color for the website. It is used as background for following widgets: submenu, diagrams, project info, recent posts & comments, testimonials & teams. Also it is used as item\'s background color in grid overviews of blog posts and portfolio items; in testimonial, team and tables shortcodes as well as in background of sticky posts.', 'thegem'),
						),
						'styled_elements_color_1' => array(
							'title' => __('Styled Element Color 1', 'thegem'),
							'type' => 'color',
							'description' => __('This color is used mainly as font text color of some widget elements, some elements like teams, testimonials, blog items. It is also used as background color for the label of sticky post in blogs', 'thegem'),
						),
						'styled_elements_color_2' => array(
							'title' => __('Styled Element Color 2', 'thegem'),
							'type' => 'color',
							'description' => __('Background color for a few widget elements.', 'thegem'),
						),
						'styled_elements_color_3' => array(
							'title' => __('Styled Element Color 3', 'thegem'),
							'type' => 'color',
							'description' => __('This color is used for following elements: likes icon and markers in widget headings ', 'thegem'),
						),
						'divider_default_color' => array(
							'title' => __('Divider Default Color', 'thegem'),
							'type' => 'color',
							'description' => __('Default color for dividers used in theme: content dividers, widget dividers, blog & news posts dividers etc.', 'thegem'),
						),
						'box_border_color' => array(
							'title' => __('Box Border & Sharing Icons In Blog Posts', 'thegem'),
							'type' => 'color',
							'description' => __('Color used as default border color in box elements in main content and sidebar widgets. Also this color is used as font color for social sharing icons in blog posts.', 'thegem'),
						),
					),
				),
				'menu_colors' => array(
					'title' => __('Menu Colors', 'thegem'),
					'options' => array(
						'main_menu_level1_color' => array(
							'title' => __('Level 1 Text Color', 'thegem'),
							'type' => 'color',
						),
						'main_menu_level1_background_color' => array(
							'title' => __('Level 1 Background Color', 'thegem'),
							'type' => 'color',
						),
						'main_menu_level1_hover_color' => array(
							'title' => __('Level 1 Hover Text Color', 'thegem'),
							'type' => 'color',
						),
						'main_menu_level1_hover_background_color' => array(
							'title' => __('Level 1 Hover Background Color', 'thegem'),
							'type' => 'color',
						),
						'main_menu_level1_active_color' => array(
							'title' => __('Level 1 Active Text Color', 'thegem'),
							'type' => 'color',
						),
						'main_menu_level1_active_background_color' => array(
							'title' => __('Level 1 Active Background Color', 'thegem'),
							'type' => 'color',
						),
						'main_menu_level2_color' => array(
							'title' => __('Level 2 Text Color', 'thegem'),
							'type' => 'color',
						),
						'main_menu_level2_background_color' => array(
							'title' => __('Level 2 Background Color', 'thegem'),
							'type' => 'color',
						),
						'main_menu_level2_hover_color' => array(
							'title' => __('Level 2 Hover Text Color', 'thegem'),
							'type' => 'color',
						),
						'main_menu_level2_hover_background_color' => array(
							'title' => __('Level 2 Hover Background Color', 'thegem'),
							'type' => 'color',
						),
						'main_menu_level2_active_color' => array(
							'title' => __('Level 2 Active Text Color', 'thegem'),
							'type' => 'color',
						),
						'main_menu_level2_active_background_color' => array(
							'title' => __('Level 2 Active Background Color', 'thegem'),
							'type' => 'color',
						),
						'main_menu_mega_column_title_color' => array(
							'title' => __('Mega Menu Column Titles Text Color', 'thegem'),
							'type' => 'color',
						),
						'main_menu_mega_column_title_hover_color' => array(
							'title' => __('Mega Menu Column Titles Hover Text Color', 'thegem'),
							'type' => 'color',
						),
						'main_menu_mega_column_title_active_color' => array(
							'title' => __('Mega Menu Column Titles Active Text Color', 'thegem'),
							'type' => 'color',
						),
						'main_menu_level3_color' => array(
							'title' => __('Level 3+ Text Color', 'thegem'),
							'type' => 'color',
						),
						'main_menu_level3_background_color' => array(
							'title' => __('Level 3+ Background Color', 'thegem'),
							'type' => 'color',
						),
						'main_menu_level3_hover_color' => array(
							'title' => __('Level 3+ Hover Text Color', 'thegem'),
							'type' => 'color',
						),
						'main_menu_level3_hover_background_color' => array(
							'title' => __('Level 3+ Hover Background Color', 'thegem'),
							'type' => 'color',
						),
						'main_menu_level3_active_color' => array(
							'title' => __('Level 3+ Active Text Color', 'thegem'),
							'type' => 'color',
						),
						'main_menu_level3_active_background_color' => array(
							'title' => __('Level 3+ Active Background Color', 'thegem'),
							'type' => 'color',
						),
						'main_menu_level1_light_color' => array(
							'title' => __('Level 1 Light Text Color', 'thegem'),
							'type' => 'color',
						),
						'main_menu_level1_light_hover_color' => array(
							'title' => __('Level 1 Hover Light Text Color', 'thegem'),
							'type' => 'color',
						),
						'main_menu_level1_light_active_color' => array(
							'title' => __('Level 1 Active Light Text Color', 'thegem'),
							'type' => 'color',
						),
						'main_menu_level2_border_color' => array(
							'title' => __('Level 2+ Border Color', 'thegem'),
							'type' => 'color',
						),
						'mega_menu_icons_color' => array(
							'title' => __('Mega Menu Icons Color', 'thegem'),
							'type' => 'color',
						),
						'overlay_menu_color' => array(
							'title' => __('Overlay Menu Text Color', 'thegem'),
							'type' => 'color',
						),
						'overlay_menu_hover_color' => array(
							'title' => __('Overlay Menu Hover Text Color', 'thegem'),
							'type' => 'color',
						),
						'overlay_menu_active_color' => array(
							'title' => __('Overlay Menu Active Text Color', 'thegem'),
							'type' => 'color',
						),
					),
				),
				'top_area_colors' => array(
					'title' => __('Top Area Colors', 'thegem'),
					'options' => array(
						'top_area_background_color' => array(
							'title' => __('Top Area Background Color', 'thegem'),
							'type' => 'color',
							'description' => __('Background color for the selected style of top area (contacts & socials bar above main menu and logo). You can select from different top area styles in "Header -> Top Area"', 'thegem'),
						),
						'top_area_border_color' => array(
							'title' => __('Top Area Border Color', 'thegem'),
							'type' => 'color',
						),
						'top_area_separator_color' => array(
							'title' => __('Top Area Separator Color', 'thegem'),
							'type' => 'color',
						),
						'top_area_text_color' => array(
							'title' => __('Top Area Text Color', 'thegem'),
							'type' => 'color',
							'description' => __('Main font color for text used in top area', 'thegem'),
						),
						'top_area_link_color' => array(
							'title' => __('Top Area Link Text Color', 'thegem'),
							'type' => 'color',
							'description' => __('Color of the links used in top area', 'thegem'),
						),
						'top_area_link_hover_color' => array(
							'title' => __('Top Area Link Hover Text Color', 'thegem'),
							'type' => 'color',
							'description' => __('Color for links hovers used in top area', 'thegem'),
						),
						'top_area_button_text_color' => array(
							'title' => __('Top Area Button Text Color', 'thegem'),
							'type' => 'color',
							'description' => __('Font color for the button in top area (if used)', 'thegem'),
						),
						'top_area_button_background_color' => array(
							'title' => __('Top Area Button Background Color', 'thegem'),
							'type' => 'color',
							'description' => __('Background color for the button in top area (if used)', 'thegem'),
						),
						'top_area_button_hover_text_color' => array(
							'title' => __('Top Area Button Hover Text Color', 'thegem'),
							'type' => 'color',
							'description' => __('Font hover color for the button in top area (if used)', 'thegem'),
						),
						'top_area_button_hover_background_color' => array(
							'title' => __('Top Area Button Hover Background Color', 'thegem'),
							'type' => 'color',
							'description' => __('Background hover color for the button in top area (if used)', 'thegem'),
						),
					),
				),
				'text_colors' => array(
					'title' => __('Text Colors', 'thegem'),
					'options' => array(
						'body_color' => array(
							'title' => __('Body Color', 'thegem'),
							'type' => 'color',
						),
						'h1_color' => array(
							'title' => __('H1 Color', 'thegem'),
							'type' => 'color',
						),
						'h2_color' => array(
							'title' => __('H2 Color', 'thegem'),
							'type' => 'color',
						),
						'h3_color' => array(
							'title' => __('H3 Color', 'thegem'),
							'type' => 'color',
						),
						'h4_color' => array(
							'title' => __('H4 Color', 'thegem'),
							'type' => 'color',
						),
						'h5_color' => array(
							'title' => __('H5 Color', 'thegem'),
							'type' => 'color',
						),
						'h6_color' => array(
							'title' => __('H6 Color', 'thegem'),
							'type' => 'color',
						),
						'link_color' => array(
							'title' => __('Link Color', 'thegem'),
							'type' => 'color',
						),
						'hover_link_color' => array(
							'title' => __('Hover Link Color', 'thegem'),
							'type' => 'color',
						),
						'active_link_color' => array(
							'title' => __('Active Link Color', 'thegem'),
							'type' => 'color',
						),
						'footer_text_color' => array(
							'title' => __('Footer Text Color', 'thegem'),
							'type' => 'color',
						),
						'copyright_text_color' => array(
							'title' => __('Copyright Text Color', 'thegem'),
							'type' => 'color',
						),
						'copyright_link_color' => array(
							'title' => __('Copyright Link Color', 'thegem'),
							'type' => 'color',
						),
						'title_bar_background_color' => array(
							'title' => __('Title Bar Default Background', 'thegem'),
							'type' => 'color',
						),
						'title_bar_text_color' => array(
							'title' => __('Title Bar Default Font', 'thegem'),
							'type' => 'color',
						),
						'date_filter_subtitle_color' => array(
							'title' => __('Date, Filter & Team Subtitle Color', 'thegem'),
							'type' => 'color',
						),
						'system_icons_font' => array(
							'title' => __('System Icons Font', 'thegem'),
							'type' => 'color',
						),
						'system_icons_font_2' => array(
							'title' => __('System Icons Font 2', 'thegem'),
							'type' => 'color',
						),
					),
				),
				'button_colors' => array(
					'title' => __('Button Colors', 'thegem'),
					'options' => array(
						'button_text_basic_color' => array(
							'title' => __('Basic Text Color', 'thegem'),
							'type' => 'color',
							'description' => __('Font color for the text used in default flat buttons. Note: you can freely customise your buttons inside your content using "Button" shortcode in Visual Composer', 'thegem'),
						),
						'button_text_hover_color' => array(
							'title' => __('Hover Text Color', 'thegem'),
							'type' => 'color',
							'description' => __('Hover font color for the text used in default flat buttons. Note: you can freely customise your buttons inside your content using "Button" shortcode in Visual Composer', 'thegem'),
						),
						'button_background_basic_color' => array(
							'title' => __('Basic Background Color', 'thegem'),
							'type' => 'color',
							'description' => __('Background color for default flat buttons. Note: you can freely customise your buttons inside your content using "Button" shortcode in Visual Composer', 'thegem'),
						),
						'button_background_hover_color' => array(
							'title' => __('Hover Background Color', 'thegem'),
							'type' => 'color',
							'description' => __('Hover background color for default flat buttons. Note: you can freely customise your buttons inside your content using "Button" shortcode in Visual Composer', 'thegem'),
						),
						'button_outline_text_basic_color' => array(
							'title' => __('Basic Outline Text Color', 'thegem'),
							'type' => 'color',
							'description' => __('Font color for the text used in default outlined buttons. Note: you can freely customise your buttons inside your content using "Button" shortcode in Visual Composer', 'thegem'),
						),
						'button_outline_text_hover_color' => array(
							'title' => __('Hover Outline Text Color', 'thegem'),
							'type' => 'color',
							'description' => __('Hover font color for the text used in default outlined buttons. Note: you can freely customise your buttons inside your content using "Button" shortcode in Visual Composer', 'thegem'),
						),
						'button_outline_border_basic_color' => array(
							'title' => __('Basic Outline Border Color', 'thegem'),
							'type' => 'color',
							'description' => __('Border color used in default outlined buttons. Note: you can freely customise your buttons inside your content using "Button" shortcode in Visual Composer', 'thegem'),
						),
					),
				),
				'widgets_colors' => array(
					'title' => __('Widgets Colors', 'thegem'),
					'options' => array(
						'widget_title_color' => array(
							'title' => __('Widget Title Color', 'thegem'),
							'type' => 'color',
							'description' => __('Font color of widget titles used in sidebars', 'thegem'),
						),
						'widget_link_color' => array(
							'title' => __('Widget Link Color', 'thegem'),
							'type' => 'color',
							'description' => __('Font color of links in widgets used in sidebars', 'thegem'),
						),
						'widget_hover_link_color' => array(
							'title' => __('Widget Hover Link Color', 'thegem'),
							'type' => 'color',
							'description' => __('Hover color for links used in sidebar widgets', 'thegem'),
						),
						'widget_active_link_color' => array(
							'title' => __('Widget Active Link Color', 'thegem'),
							'type' => 'color',
							'description' => __('Color for active links used in sidebar widgets', 'thegem'),
						),
						'footer_widget_title_color' => array(
							'title' => __('Footer Widget Title Color', 'thegem'),
							'type' => 'color',
							'description' => __('Font color of widget titles used in footer widgetised area', 'thegem'),
						),
						'footer_widget_text_color' => array(
							'title' => __('Footer Widget Text Color', 'thegem'),
							'type' => 'color',
							'description' => __('Font color of text used in widgets in footer widgetised area', 'thegem'),
						),
						'footer_widget_link_color' => array(
							'title' => __('Footer Widget Link Color', 'thegem'),
							'type' => 'color',
							'description' => __('Font color of links in widgets used in footer widgetised area', 'thegem'),
						),
						'footer_widget_hover_link_color' => array(
							'title' => __('Footer Widget Hover Link Color', 'thegem'),
							'type' => 'color',
							'description' => __('Hover color for links used in widgets in footer widgetised area', 'thegem'),
						),
						'footer_widget_active_link_color' => array(
							'title' => __('Footer Widget Active Link Color', 'thegem'),
							'type' => 'color',
							'description' => __('Color for active links used in widgets in footer widgetised area', 'thegem'),
						),
					),
				),
				'portfolio_colors' => array(
					'title' => __('Portfolio Colors', 'thegem'),
					'options' => array(
						'portfolio_title_color' => array(
							'title' => __('Portfolio Overview Title Text', 'thegem'),
							'type' => 'color',
							'description' => __('Select portfolio item\'s title color for grid-style portfolio overviews', 'thegem'),
						),
						'portfolio_description_color' => array(
							'title' => __('Portfolio Overview Description Text', 'thegem'),
							'type' => 'color',
							'description' => __('Choose portfolio item\'s description color for grid-style portfolio overviews', 'thegem'),
						),
						'portfolio_date_color' => array(
							'title' => __('Portfolio Date Color', 'thegem'),
							'type' => 'color',
							'description' => __('Font color for showing the date in portfolio overviews', 'thegem'),
						),
					),
				),
				'gallery_colors' => array(
					'title' => __('Slideshow, Gallery And Image Box Colors', 'thegem'),
					'options' => array(
						'gallery_caption_background_color' => array(
							'title' => __('Gallery Lightbox Caption Background', 'thegem'),
							'type' => 'color',
							'description' => __('Select background color for image description in image lightbox (zoomed view)', 'thegem'),
						),
						'gallery_title_color' => array(
							'title' => __('Gallery Lightbox Title Text', 'thegem'),
							'type' => 'color',
							'description' => __('Choose title color for image description in gallery in image lightbox (zoomed view)', 'thegem'),
						),
						'gallery_description_color' => array(
							'title' => __('Gallery Lightbox Description Text', 'thegem'),
							'type' => 'color',
							'description' => __('Select text color for image description in image lightbox (zoomed view)', 'thegem'),
						),
						'slideshow_arrow_background' => array(
							'title' => __('Slideshow Arrow Background', 'thegem'),
							'type' => 'color',
							'description' => __('Background color for the arrows in Layerslider, Revolution & Nivo Slider slideshows', 'thegem'),
						),
						'slideshow_arrow_hover_background' => array(
							'title' => __('Slideshow Arrow Hover Background', 'thegem'),
							'type' => 'color',
							'description' => __('Hover background color for the arrows in Layerslider, Revolution & Nivo Slider slideshows', 'thegem'),
						),
						'slideshow_arrow_color' => array(
							'title' => __('Slideshow Arrow Font', 'thegem'),
							'type' => 'color',
							'description' => __('Font color for the arrows in Layerslider, Revolution & Nivo Slider slideshows', 'thegem'),
						),
						'sliders_arrow_color' => array(
							'title' => __('Sliders Arrow Font', 'thegem'),
							'type' => 'color',
							'description' => __('Font color for the arrows in content sliders (not in Layeslider, Revolution or Nivo Sliders)', 'thegem'),
						),
						'sliders_arrow_background_color' => array(
							'title' => __('Sliders Arrow Background', 'thegem'),
							'type' => 'color',
							'description' => __('Backround color for the arrows in content sliders (not in Layeslider, Revolution or Nivo Sliders)', 'thegem'),
						),
						'sliders_arrow_hover_color' => array(
							'title' => __('Sliders Arrow Hover Font', 'thegem'),
							'type' => 'color',
							'description' => __('Hover font color for the arrows in content sliders (not in Layeslider, Revolution or Nivo Sliders)', 'thegem'),
						),
						'sliders_arrow_background_hover_color' => array(
							'title' => __('Sliders Arrow Hover Background', 'thegem'),
							'type' => 'color',
							'description' => __('Hover background color for the arrows in content sliders (not in Layeslider, Revolution or Nivo Sliders)', 'thegem'),
						),
						'hover_effect_default_color' => array(
							'title' => __('"Cyan Breeze" Hover Color', 'thegem'),
							'type' => 'color',
						),
						'hover_effect_zooming_blur_color' => array(
							'title' => __('"Zooming White" Hover Color', 'thegem'),
							'type' => 'color',
						),
						'hover_effect_horizontal_sliding_color' => array(
							'title' => __('"Horizontal Sliding" Hover Color', 'thegem'),
							'type' => 'color',
						),
						'hover_effect_vertical_sliding_color' => array(
							'title' => __('"Vertical Sliding" Hover Color', 'thegem'),
							'type' => 'color',
						),
					),
				),
				'quickfinder_colors' => array(
					'title' => __('Quickfinder Colors', 'thegem'),
					'options' => array(
						'quickfinder_title_color' => array(
							'title' => __('Quickfinder Title Text', 'thegem'),
							'type' => 'color',
							'description' => __('Font color for the default quickfinder titles. Note: you can freely customise your quickfinders inside your content using "Quickfinder" shortcode in Visual Composer', 'thegem'),
						),
						'quickfinder_description_color' => array(
							'title' => __('Quickfinder Description Text', 'thegem'),
							'type' => 'color',
							'description' => __('Font color for the default quickfinder description. Note: you can freely customise your quickfinders inside your content using "Quickfinder" shortcode in Visual Composer', 'thegem'),
						),
					),
				),
				'bullets_pager_colors' => array(
					'title' => __('Bullets, Icons, Dropcaps & Pagination', 'thegem'),
					'options' => array(
						'bullets_symbol_color' => array(
							'title' => __('Bullets Symbol', 'thegem'),
							'type' => 'color',
							'description' => __('This color is used in bullets in navigation & menu widgets as well as as font color for icons in contact widget', 'thegem'),
						),
						'icons_symbol_color' => array(
							'title' => __('Icons Font', 'thegem'),
							'type' => 'color',
							'description' => __('Default font color for icons. Note: using icons shortcodes in Visual Composer you can freely customise your icons as you wish', 'thegem'),
						),
						'pagination_basic_color' => array(
							'title' => __('Pagination Basic', 'thegem'),
							'type' => 'color',
							'description' => __('Font color for numbers in classic pagination', 'thegem'),
						),
						'pagination_basic_background_color' => array(
							'title' => __('Pagination Basic Background', 'thegem'),
							'type' => 'color',
							'description' => __('Background color for numbers in classic pagination', 'thegem'),
						),
						'pagination_hover_color' => array(
							'title' => __('Pagination Hover', 'thegem'),
							'type' => 'color',
							'description' => __('Hover color for classic pagination', 'thegem'),
						),
						'pagination_active_color' => array(
							'title' => __('Pagination Active', 'thegem'),
							'type' => 'color',
							'description' => __('Active color  for classic pagination', 'thegem'),
						),
						'mini_pagination_color' => array(
							'title' => __('Slider Mini-Pagination (Not Active)', 'thegem'),
							'type' => 'color',
						),
						'mini_pagination_active_color' => array(
							'title' => __('Slider Mini-Pagination (Active)', 'thegem'),
							'type' => 'color',
						),
					),
				),
				'form_colors' => array(
					'title' => __('Form', 'thegem'),
					'options' => array(
						'form_elements_background_color' => array(
							'title' => __('Background', 'thegem'),
							'type' => 'color',
						),
						'form_elements_text_color' => array(
							'title' => __('Font', 'thegem'),
							'type' => 'color',
						),
						'form_elements_border_color' => array(
							'title' => __('Border', 'thegem'),
							'type' => 'color',
						),
					),
				),
				'breadcrumbs_color' => array(
					'title' => __('Breadcrumbs', 'thegem'),
					'options' => array(
						'breadcrumbs_default_color' => array(
							'title' => __('Breadcrumbs Color', 'thegem'),
							'type' => 'color',
						),
						'breadcrumbs_active_color' => array(
							'title' => __('Breadcrumbs Active Item Color', 'thegem'),
							'type' => 'color',
						),
						'breadcrumbs_hover_color' => array(
							'title' => __('Breadcrumbs Hover Color', 'thegem'),
							'type' => 'color',
						),
					),
				),
			),
		),

		'backgrounds' => array(
			'title' => __('Backgrounds', 'thegem'),
			'subcats' => array(
				'backgrounds_images' => array(
					'title' => __('Background Images', 'thegem'),
					'options' => array(
						'basic_outer_background_image' => array(
							'title' => __('Background for Boxed Layout', 'thegem'),
							'type' => 'image',
							'description' => __('Select or upload image file for website\'s backround in boxed layout', 'thegem'),
						),
						'basic_outer_background_image_select' => array(
							'title' => __('Background Patterns for Boxed Layout', 'thegem'),
							'type' => 'image-select',
							'target' => 'basic_outer_background_image',
							'items' => array(
								0 => 'low_contrast_linen',
								1 => 'mochaGrunge',
								2 => 'bedge_grunge',
								3 => 'solid',
								4 => 'concrete_wall',
								5 => 'dark_circles',
								6 => 'debut_dark',
							),
						),
						'top_background_image' => array(
							'title' => __('Main Menu & Header Area Background', 'thegem'),
							'type' => 'image',
							'description' => __('Select or upload background image file for the website\'s header area with main menu and logo', 'thegem'),
						),
						'top_area_background_image' => array(
							'title' => __('Top Area Background', 'thegem'),
							'type' => 'image',
							'description' => __('Select or upload background image file for the selected style of top area (contacts & socials bar above main menu and logo). You can select from different top area styles in "Header -> Top Area"', 'thegem'),
						),
						'main_background_image' => array(
							'title' => __('Main Content Background', 'thegem'),
							'type' => 'image',
							'description' => __('Select or upload image file for website\'s main content background', 'thegem'),
						),
						'footer_background_image' => array(
							'title' => __('Footer Background', 'thegem'),
							'type' => 'image',
							'description' => __('Select or upload background image file for the footer area with copyrights and socials at the bottom of the website.', 'thegem'),
						),
						'footer_widget_area_background_image' => array(
							'title' => __(' Footer Widgetised Area Background Image', 'thegem'),
							'type' => 'image',
							'description' => __('Select or upload background image file for widgetised area in footer', 'thegem'),
						),
					),
				),
			),
		),

		'slideshow' => array(
			'title' => __('NivoSlider Options', 'thegem'),
			'subcats' => array(
				'slideshow_options' => array(
					'title' => __('NivoSlider Options', 'thegem'),
					'options' => array(
						'slider_effect' => array(
							'title' => __('Effect', 'thegem'),
							'type' => 'select',
							'items' => array(
								'random' => 'random',
								'fold' => 'fold',
								'fade' => 'fade',
								'sliceDown' => 'sliceDown',
								'sliceDownRight' => 'sliceDownRight',
								'sliceDownLeft' => 'sliceDownLeft',
								'sliceUpRight' => 'sliceUpRight',
								'sliceUpLeft' => 'sliceUpLeft',
								'sliceUpDown' => 'sliceUpDown',
								'sliceUpDownLeft' => 'sliceUpDownLeft',
								'fold' => 'fold',
								'fade' => 'fade',
								'boxRandom' => 'boxRandom',
								'boxRain' => 'boxRain',
								'boxRainReverse' => 'boxRainReverse',
								'boxRainGrow' => 'boxRainGrow',
								'boxRainGrowReverse' => 'boxRainGrowReverse',
							),
						),
						'slider_slices' => array(
							'title' => __('Slices', 'thegem'),
							'type' => 'fixed-number',
							'min' => 1,
							'max' => 20,
							'default' => 15,
						),
						'slider_boxCols' => array(
							'title' => __('Box Cols', 'thegem'),
							'type' => 'fixed-number',
							'min' => 1,
							'max' => 10,
							'default' => 8,
						),
						'slider_boxRows' => array(
							'title' => __('Box Rows', 'thegem'),
							'type' => 'fixed-number',
							'min' => 1,
							'max' => 10,
							'default' => 4,
						),
						'slider_animSpeed' => array(
							'title' => __('Animation Speed ( x 100 milliseconds )', 'thegem'),
							'type' => 'fixed-number',
							'min' => 1,
							'max' => 50,
							'default' => 5,
						),
						'slider_pauseTime' => array(
							'title' => __('Pause Time ( x 1000 milliseconds )', 'thegem'),
							'type' => 'fixed-number',
							'min' => 1,
							'max' => 20,
							'default' => 3,
						),
						'slider_directionNav' => array(
							'title' => __('Direction Navigation', 'thegem'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'slider_controlNav' => array(
							'title' => __('Control Navigation', 'thegem'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
					),
				),
			),
		),

		'blog' => array(
			'title' => __('Blog & News', 'thegem'),
			'subcats' => array(
				'blog_options' => array(
					'title' => __('Blog & News Options', 'thegem'),
					'options' => array(
						'show_author' => array(
							'title' => __('Show author', 'thegem'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'excerpt_length' => array(
							'title' => __('Excerpt lenght', 'thegem'),
							'type' => 'fixed-number',
							'min' => 1,
							'max' => 150,
							'default' => 20,
						),
					),
				),
			),
		),

		'footer' => array(
			'title' => __('Footer', 'thegem'),
			'subcats' => array(
				'footer_options' => array(
					'title' => __('Footer Options', 'thegem'),
					'options' => array(
						'footer_active' => array(
							'title' => __('Activate footer', 'thegem'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'footer_html' => array(
							'title' => __('Footer Text', 'thegem'),
							'type' => 'textarea',
						),
					),
				),
			),
		),

		'socials' => array(
			'title' => __('Contacts & Socials', 'thegem'),
			'subcats' => array(
				'contacts' => array(
					'title' => __('Contacts', 'thegem'),
					'options' => array(
						'contacts_address' => array(
							'title' => __('Address', 'thegem'),
							'type' => 'input',
							'default' => '',
						),
						'contacts_phone' => array(
							'title' => __('Phone', 'thegem'),
							'type' => 'input',
							'default' => '',
						),
						'contacts_fax' => array(
							'title' => __('Fax', 'thegem'),
							'type' => 'input',
							'default' => '',
						),
						'contacts_email' => array(
							'title' => __('Email', 'thegem'),
							'type' => 'input',
							'default' => '',
						),
						'contacts_website' => array(
							'title' => __('Website', 'thegem'),
							'type' => 'input',
							'default' => '',
						),
					),
				),
				'top_area_contacts' => array(
					'title' => __('Top Area Contacts', 'thegem'),
					'options' => array(
						'top_area_contacts_address' => array(
							'title' => __('Address', 'thegem'),
							'type' => 'input',
							'default' => '',
						),
						'top_area_contacts_phone' => array(
							'title' => __('Phone', 'thegem'),
							'type' => 'input',
							'default' => '',
						),
						'top_area_contacts_fax' => array(
							'title' => __('Fax', 'thegem'),
							'type' => 'input',
							'default' => '',
						),
						'top_area_contacts_email' => array(
							'title' => __('Email', 'thegem'),
							'type' => 'input',
							'default' => '',
						),
						'top_area_contacts_website' => array(
							'title' => __('Website', 'thegem'),
							'type' => 'input',
							'default' => '',
						),
					),
				),
				'socials_options' => array(
					'title' => __('Socials', 'thegem'),
					'options' => array(
						'twitter_active' => array(
							'title' => __('Activate Twitter Icon', 'thegem'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'facebook_active' => array(
							'title' => __('Activate Facebook Icon', 'thegem'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'linkedin_active' => array(
							'title' => __('Activate LinkedIn Icon', 'thegem'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'googleplus_active' => array(
							'title' => __('Activate Google Plus Icon', 'thegem'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'stumbleupon_active' => array(
							'title' => __('Activate StumbleUpon Icon', 'thegem'),
							'type' => 'checkbox',
							'value' => 1,
						),
						'rss_active' => array(
							'title' => __('Activate RSS Icon', 'thegem'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'vimeo_active' => array(
							'title' => __('Activate Vimeo Icon', 'thegem'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'instagram_active' => array(
							'title' => __('Activate Instagram Icon', 'thegem'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'pinterest_active' => array(
							'title' => __('Activate Pinterest Icon', 'thegem'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'youtube_active' => array(
							'title' => __('Activate YouTube Icon', 'thegem'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'flickr_active' => array(
							'title' => __('Activate Flickr Icon', 'thegem'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'twitter_link' => array(
							'title' => __('Twitter Profile Link', 'thegem'),
							'type' => 'input',
							'default' => '#',
							'description' => __('Enter URL to your twitter profile', 'thegem'),
						),
						'facebook_link' => array(
							'title' => __('Facebook Profile Link', 'thegem'),
							'type' => 'input',
							'default' => '#',
							'description' => __('Enter URL to your facebook profile', 'thegem'),
						),
						'linkedin_link' => array(
							'title' => __('LinkedIn Profile Link', 'thegem'),
							'type' => 'input',
							'default' => '#',
							'description' => __('Enter URL to your linkedin profile', 'thegem'),
						),
						'googleplus_link' => array(
							'title' => __('Google Plus Profile Link', 'thegem'),
							'type' => 'input',
							'default' => '#',
							'description' => __('Enter URL to your google+ profile', 'thegem'),
						),
						'stumbleupon_link' => array(
							'title' => __('StumbleUpon Profile Link', 'thegem'),
							'type' => 'input',
							'default' => '#',
							'description' => __('Enter URL to your stumbleupon profile', 'thegem'),
						),
						'rss_link' => array(
							'title' => __('RSS Link', 'thegem'),
							'type' => 'input',
							'default' => '#',
						),
						'vimeo_link' => array(
							'title' => __('Vimeo Link', 'thegem'),
							'type' => 'input',
							'default' => '#',
						),
						'instagram_link' => array(
							'title' => __('Instagram Link', 'thegem'),
							'type' => 'input',
							'default' => '#',
						),
						'pinterest_link' => array(
							'title' => __('Pinterest Link', 'thegem'),
							'type' => 'input',
							'default' => '#',
						),
						'youtube_link' => array(
							'title' => __('Youtube Link', 'thegem'),
							'type' => 'input',
							'default' => '#',
						),
						'flickr_link' => array(
							'title' => __('Flickr Link', 'thegem'),
							'type' => 'input',
							'default' => '#',
						),
						'show_social_icons' => array(
							'title' => __('Display Links For Sharing Posts On Social Networks', 'thegem'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
					),
				),
			),
		),
	);

	if(thegem_is_plugin_active('woocommerce/woocommerce.php')) {
		$options['general']['subcats']['additional']['options']['size_guide_image'] =array(
			'title' => __('Size Guide Image', 'thegem'),
			'type' => 'image',
			'description' => __('Upload your size guide image here', 'thegem'),
		);
	}

	return $options;
}

if(!function_exists('thegem_get_current_language')) {
function thegem_get_current_language() {
	if(thegem_is_plugin_active('sitepress-multilingual-cms/sitepress.php') && defined('ICL_LANGUAGE_CODE') && ICL_LANGUAGE_CODE) {
		return ICL_LANGUAGE_CODE;
	}
	if(thegem_is_plugin_active('polylang/polylang.php') && pll_current_language('slug')) {
		return pll_current_language('slug');
	}
	return false;
}
}

if(!function_exists('thegem_get_default_language')) {
function thegem_get_default_language() {
	if(thegem_is_plugin_active('sitepress-multilingual-cms/sitepress.php')) {
		global $sitepress;
		if(is_object($sitepress) && $sitepress->get_default_language()) {
			return $sitepress->get_default_language();
		}
	}
	if(thegem_is_plugin_active('polylang/polylang.php') && pll_default_language('slug')) {
		return pll_default_language('slug');
	}
	return false;
}
}

function thegem_get_option_element($oname = '', $option = array(), $default = NULL) {
	if($default !== NULL) {
		$option['default'] = $default;
	}

	if(!isset($option['default'])) {
		$option['default'] = '';
	}

	$ml_options = array('footer_html', 'top_area_button_text', 'contacts_address', 'contacts_phone', 'contacts_fax', 'contacts_email', 'contacts_website');
	if(in_array($oname, $ml_options) && is_array($option['default'])) {
		if(thegem_get_current_language()) {
			if(isset($option['default'][thegem_get_current_language()])) {
				$option['default'] = $option['default'][thegem_get_current_language()];
			} elseif(thegem_get_default_language() && isset($option['default'][thegem_get_default_language()])) {
				$option['default'] = $option['default'][thegem_get_default_language()];
			} else {
				$option['default'] = '';
			}
		}else {
			$option['default'] = reset($option['default']);
		}
	}

	$option['default'] = stripslashes($option['default']);

	$output = '<div class="'.esc_attr('option '.$oname.'_field').'">';

	if(isset($option['type'])) {

		if(isset($option['description'])) {
			$output .= '<div class="description">'.esc_html($option['description']).'</div>';
		}

		$output .= '<div class="label"><label for="'.esc_attr($oname).'">'.esc_html($option['title']).'</label></div><div class="'.esc_attr($option['type']).'">';
		switch ($option['type']) {

		case 'input':
			$output .= '<input id="'.esc_attr($oname).'" name="theme_options['.esc_attr($oname).']"';
			if(isset($option['default'])) {
				$output .= ' value="'.esc_attr($option['default']).'"';
			}
			$output .= '/>';
			break;

		case 'image':
			$output .= '<input id="'.esc_attr($oname).'" name="theme_options['.esc_attr($oname).']"';
			if(isset($option['default'])) {
				$output .= ' value="'.esc_attr($option['default']).'"';
			}
			$output .= '/>';
			break;

		case 'image-select':
			$skins = array('light', 'dark');
			foreach($skins as $skin) {
				foreach($option['items'] as $item) {
					$output .= '<a data-target="'.esc_attr($option['target']).'" href="'.esc_url(get_template_directory_uri().'/images/backgrounds/patterns/'.$skin.'/'.$item.'.jpg').'"><img alt="#" src="'.esc_url(get_template_directory_uri().'/images/backgrounds/patterns/'.$skin.'/'.$item.'-thumb.jpg').'"/></a>';
				}
				$output .= '<span class="clear"></span>';
			}
			break;

		case 'file':
			$output .= '<input id="'.esc_attr($oname).'" name="theme_options['.esc_attr($oname).']"';
			if(isset($option['default'])) {
				$output .= ' value="'.esc_attr($option['default']).'"';
			}
			$output .= '/>';
			break;

		case 'font-select':
			$selected = isset($option['default']) ? $option['default'] : '';
			$fontsList = thegem_fonts_list();
			$output .= '<select id="'.esc_attr($oname).'" name="theme_options['.esc_attr($oname).']">';
			foreach($fontsList as $val => $item) {
				$output .= '<option value="'.esc_attr($val).'"';
				if($val == $selected) {
					$output .= ' selected';
				}
				$output .= '>'.esc_html($item).'</option>';
			}
			$output .= '</select>';
			break;

		case 'font-style':
			$selected = isset($option['default']) ? $option['default'] : '';
			$output .= '<select id="'.esc_attr($oname).'" name="theme_options['.esc_attr($oname).']" data-value="'.esc_attr($selected).'"></select>';
			break;

		case 'font-sets':
			$output .= '<input id="'.esc_attr($oname).'" name="theme_options['.esc_attr($oname).']"';
			if(isset($option['default'])) {
				$output .= ' data-value="'.esc_attr($option['default']).'"';
			}
			$output .= '/>';
			break;

		case 'fixed-number':
			$min = isset($option['min']) ? $option['min'] : 1;
			$max = isset($option['max']) ? $option['max'] : $min+1;
			$default = isset($option['default']) ? $option['default'] : $min;
			$output .= '<input id="'.esc_attr($oname).'" name="theme_options['.esc_attr($oname).']" value="'.esc_attr($default).'" data-min-value="'.esc_attr($min).'" data-max-value="'.esc_attr($max).'"/>';
			break;

		case 'color':
			$output .= '<input id="'.esc_attr($oname).'" name="theme_options['.esc_attr($oname).']"';
			if(isset($option['default'])) {
				$output .= ' value="'.esc_attr($option['default']).'"';
			}
			$output .= ' class="color-select"/>';
			break;

		case 'textarea':
			$output .= '<textarea id="'.esc_attr($oname).'" name="theme_options['.esc_attr($oname).']" cols="100" rows="15">';
			if(isset($option['default'])) {
				$output .= esc_textarea($option['default']);
			}
			$output .= '</textarea>';
			break;

		case 'select':
			$selected = isset($option['default']) ? $option['default'] : '';
			$output .= '<select id="'.esc_attr($oname).'" name="theme_options['.esc_attr($oname).']">';
			foreach($option['items'] as $val => $item) {
				$output .= '<option value="'.$val.'"';
				if($val == $selected) {
					$output .= ' selected';
				}
				$output .= '>'.$item.'</option>';
			}
			$output .= '</select>';
			break;

		default:
			$output .= '<input id="'.esc_attr($oname).'" name="theme_options['.esc_attr($oname).']"';
			if(isset($option['default'])) {
				$output .= ' value="'.esc_attr($option['default']).'"';
			}
			$output .= '/>';
		}

		$output .= '</div>';

		if($option['type'] == 'checkbox') {
			$output = '<div class="option '.esc_attr($oname).'_field"><div class="checkbox"><input id="'.esc_attr($oname).'" name="theme_options['.esc_attr($oname).']" type="checkbox" value="'.esc_attr($option['value']).'"';
			if($option['default'] == $option['value']) {
				$output .= ' checked';
			}
			$output .= '> <label for="'.esc_attr($oname).'">'.esc_html($option['title']).'</label></div>';
		}

		$output .= '<div class="clear"></div></div>';
	}

	return $output;
}

function thegem_get_pages_list() {
	$pages = array('' => __('Default', 'thegem'));
	$pages_list = get_pages();
	foreach ($pages_list as $page) {
		$pages[$page->ID] = $page->post_title . ' (ID = ' . $page->ID . ')';
	}
	return $pages;
}

function thegem_color_skin_defaults($skin = 'light') {
	$skin_defaults = apply_filters('thegem_default_skins_options', array(
		'light' => array(
			'main_menu_font_family' => 'Montserrat',
			'main_menu_font_style' => '700',
			'main_menu_font_sets' => '',
			'main_menu_font_size' => '14',
			'main_menu_line_height' => '25',
			'submenu_font_family' => 'Source Sans Pro',
			'submenu_font_style' => 'regular',
			'submenu_font_sets' => '',
			'submenu_font_size' => '16',
			'submenu_line_height' => '20',
			'styled_subtitle_font_family' => 'Source Sans Pro',
			'styled_subtitle_font_style' => '300',
			'styled_subtitle_font_sets' => '',
			'styled_subtitle_font_size' => '24',
			'styled_subtitle_line_height' => '37',
			'overlay_menu_font_family' => 'Montserrat',
			'overlay_menu_font_style' => '700',
			'overlay_menu_font_sets' => '',
			'overlay_menu_font_size' => '32',
			'overlay_menu_line_height' => '64',
			'h1_font_family' => 'Montserrat',
			'h1_font_style' => '700',
			'h1_font_sets' => '',
			'h1_font_size' => '50',
			'h1_line_height' => '69',
			'h2_font_family' => 'Montserrat',
			'h2_font_style' => '700',
			'h2_font_sets' => '',
			'h2_font_size' => '36',
			'h2_line_height' => '53',
			'h3_font_family' => 'Montserrat',
			'h3_font_style' => '700',
			'h3_font_sets' => '',
			'h3_font_size' => '28',
			'h3_line_height' => '42',
			'h4_font_family' => 'Montserrat',
			'h4_font_style' => '700',
			'h4_font_sets' => '',
			'h4_font_size' => '24',
			'h4_line_height' => '38',
			'h5_font_family' => 'Montserrat',
			'h5_font_style' => '700',
			'h5_font_sets' => '',
			'h5_font_size' => '19',
			'h5_line_height' => '30',
			'h6_font_family' => 'Montserrat',
			'h6_font_style' => '700',
			'h6_font_sets' => '',
			'h6_font_size' => '16',
			'h6_line_height' => '25',
			'xlarge_title_font_family' => 'Montserrat',
			'xlarge_title_font_style' => '700',
			'xlarge_title_font_sets' => 'latin,latin-ext',
			'xlarge_title_font_size' => '80',
			'xlarge_title_line_height' => '90',
			'light_title_font_family' => 'Montserrat UltraLight',
			'light_title_font_style' => 'regular',
			'light_title_font_sets' => '',
			'body_font_family' => 'Source Sans Pro',
			'body_font_style' => 'regular',
			'body_font_sets' => '',
			'body_font_size' => '16',
			'body_line_height' => '25',
			'widget_title_font_family' => 'Montserrat',
			'widget_title_font_style' => '700',
			'widget_title_font_sets' => '',
			'widget_title_font_size' => '19',
			'widget_title_line_height' => '30',
			'button_font_family' => 'Montserrat',
			'button_font_style' => '700',
			'button_font_sets' => 'latin',
			'button_thin_font_family' => 'Montserrat UltraLight',
			'button_thin_font_style' => 'regular',
			'button_thin_font_sets' => '',
			'portfolio_title_font_family' => 'Montserrat',
			'portfolio_title_font_style' => '700',
			'portfolio_title_font_sets' => '',
			'portfolio_title_font_size' => '16',
			'portfolio_title_line_height' => '24',
			'portfolio_description_font_family' => 'Source Sans Pro',
			'portfolio_description_font_style' => 'regular',
			'portfolio_description_font_sets' => '',
			'portfolio_description_font_size' => '16',
			'portfolio_description_line_height' => '24',
			'quickfinder_title_font_family' => 'Montserrat',
			'quickfinder_title_font_style' => '700',
			'quickfinder_title_font_sets' => 'latin',
			'quickfinder_title_font_size' => '24',
			'quickfinder_title_line_height' => '38',
			'quickfinder_title_thin_font_family' => 'Montserrat UltraLight',
			'quickfinder_title_thin_font_style' => 'regular',
			'quickfinder_title_thin_font_sets' => 'latin,latin-ext',
			'quickfinder_title_thin_font_size' => '24',
			'quickfinder_title_thin_line_height' => '38',
			'quickfinder_description_font_family' => 'Source Sans Pro',
			'quickfinder_description_font_style' => 'regular',
			'quickfinder_description_font_sets' => '',
			'quickfinder_description_font_size' => '16',
			'quickfinder_description_line_height' => '25',
			'gallery_title_font_family' => 'Montserrat UltraLight',
			'gallery_title_font_style' => 'regular',
			'gallery_title_font_sets' => '',
			'gallery_title_font_size' => '24',
			'gallery_title_line_height' => '30',
			'gallery_title_bold_font_family' => 'Montserrat',
			'gallery_title_bold_font_style' => '700',
			'gallery_title_bold_font_sets' => 'latin,latin-ext',
			'gallery_title_bold_font_size' => '24',
			'gallery_title_bold_line_height' => '31',
			'gallery_description_font_family' => 'Source Sans Pro',
			'gallery_description_font_style' => '300',
			'gallery_description_font_sets' => '',
			'gallery_description_font_size' => '17',
			'gallery_description_line_height' => '24',
			'testimonial_font_family' => 'Source Sans Pro',
			'testimonial_font_style' => '300',
			'testimonial_font_sets' => '',
			'testimonial_font_size' => '24',
			'testimonial_line_height' => '36',
			'counter_font_family' => 'Montserrat',
			'counter_font_style' => '700',
			'counter_font_sets' => '',
			'counter_font_size' => '50',
			'counter_line_height' => '69',
			'woocommerce_price_font_family' => 'Montserrat',
			'woocommerce_price_font_style' => 'regular',
			'woocommerce_price_font_sets' => '',
			'woocommerce_price_font_size' => '26',
			'woocommerce_price_line_height' => '36',
			'slideshow_title_font_family' => 'Montserrat',
			'slideshow_title_font_style' => '700',
			'slideshow_title_font_sets' => '',
			'slideshow_title_font_size' => '50',
			'slideshow_title_line_height' => '69',
			'slideshow_description_font_family' => 'Source Sans Pro',
			'slideshow_description_font_style' => 'regular',
			'slideshow_description_font_sets' => '',
			'slideshow_description_font_size' => '16',
			'slideshow_description_line_height' => '25',
			'basic_outer_background_color' => '#f0f3f2',
			'top_background_color' => '#ffffff',
			'main_background_color' => '#ffffff',
			'footer_widget_area_background_color' => '#212331',
			'footer_background_color' => '#181828',
			'styled_elements_background_color' => '#f4f6f7',
			'styled_elements_color_1' => '#00bcd4',
			'styled_elements_color_2' => '#99a9b5',
			'styled_elements_color_3' => '#f44336',
			'divider_default_color' => '#dfe5e8',
			'box_border_color' => '#dfe5e8',
			'main_menu_level1_color' => '#3c3950',
			'main_menu_level1_background_color' => '',
			'main_menu_level1_hover_color' => '#00bcd4',
			'main_menu_level1_hover_background_color' => '',
			'main_menu_level1_active_color' => '#3c3950',
			'main_menu_level1_active_background_color' => '#3c3950',
			'main_menu_level2_color' => '#5f727f',
			'main_menu_level2_background_color' => '#f4f6f7',
			'main_menu_level2_hover_color' => '#3c3950',
			'main_menu_level2_hover_background_color' => '#ffffff',
			'main_menu_level2_active_color' => '#3c3950',
			'main_menu_level2_active_background_color' => '#ffffff',
			'main_menu_mega_column_title_color' => '#3c3950',
			'main_menu_mega_column_title_hover_color' => '#00bcd4',
			'main_menu_mega_column_title_active_color' => '#00bcd4',
			'main_menu_level3_color' => '#5f727f',
			'main_menu_level3_background_color' => '#ffffff',
			'main_menu_level3_hover_color' => '#ffffff',
			'main_menu_level3_hover_background_color' => '#494c64',
			'main_menu_level3_active_color' => '#00bcd4',
			'main_menu_level3_active_background_color' => '#ffffff',
			'main_menu_level1_light_color' => '#ffffff',
			'main_menu_level1_light_hover_color' => '#00bcd4',
			'main_menu_level1_light_active_color' => '#ffffff',
			'main_menu_level2_border_color' => '#dfe5e8',
			'mega_menu_icons_color' => '',
			'overlay_menu_color' => '#ffffff',
			'overlay_menu_hover_color' => '#00bcd4',
			'overlay_menu_active_color' => '#00bcd4',
			'top_area_background_color' => '#f4f6f7',
			'top_area_border_color' => '#00bcd4',
			'top_area_separator_color' => '#dfe5e8',
			'top_area_text_color' => '#5f727f',
			'top_area_link_color' => '#5f727f',
			'top_area_link_hover_color' => '#00bcd4',
			'top_area_button_text_color' => '#ffffff',
			'top_area_button_background_color' => '#494c64',
			'top_area_button_hover_text_color' => '#ffffff',
			'top_area_button_hover_background_color' => '#00bcd4',
			'body_color' => '#5f727f',
			'h1_color' => '#3c3950',
			'h2_color' => '#3c3950',
			'h3_color' => '#3c3950',
			'h4_color' => '#3c3950',
			'h5_color' => '#3c3950',
			'h6_color' => '#3c3950',
			'link_color' => '#00bcd4',
			'hover_link_color' => '#384554',
			'active_link_color' => '#00bcd4',
			'footer_text_color' => '#99a9b5',
			'copyright_text_color' => '#99a9b5',
			'copyright_link_color' => '#00bcd4',
			'title_bar_background_color' => '#6c7cd0',
			'title_bar_text_color' => '#ffffff',
			'date_filter_subtitle_color' => '#99a9b5',
			'system_icons_font' => '#99a3b0',
			'system_icons_font_2' => '#b6c6c9',
			'button_text_basic_color' => '#ffffff',
			'button_text_hover_color' => '#ffffff',
			'button_background_basic_color' => '#b6c6c9',
			'button_background_hover_color' => '#3c3950',
			'button_outline_text_basic_color' => '#00bcd4',
			'button_outline_text_hover_color' => '#ffffff',
			'button_outline_border_basic_color' => '#00bcd4',
			'widget_title_color' => '#3c3950',
			'widget_link_color' => '#5f727f',
			'widget_hover_link_color' => '#00bcd4',
			'widget_active_link_color' => '#384554',
			'footer_widget_title_color' => '#feffff',
			'footer_widget_text_color' => '#99a9b5',
			'footer_widget_link_color' => '#99a9b5',
			'footer_widget_hover_link_color' => '#00bcd4',
			'footer_widget_active_link_color' => '#00bcd4',
			'portfolio_title_color' => '#5f727f',
			'portfolio_description_color' => '#5f727f',
			'portfolio_date_color' => '#99a9b5',
			'gallery_caption_background_color' => '#000000',
			'gallery_title_color' => '#ffffff',
			'gallery_description_color' => '#ffffff',
			'slideshow_arrow_background' => '#394050',
			'slideshow_arrow_hover_background' => '#00bcd4',
			'slideshow_arrow_color' => '#ffffff',
			'sliders_arrow_color' => '#3c3950',
			'sliders_arrow_background_color' => '#b6c6c9',
			'sliders_arrow_hover_color' => '#ffffff',
			'sliders_arrow_background_hover_color' => '#00bcd4',
			'hover_effect_default_color' => '#00bcd4',
			'hover_effect_zooming_blur_color' => '#ffffff',
			'hover_effect_horizontal_sliding_color' => '#46485c',
			'hover_effect_vertical_sliding_color' => '#f44336',
			'quickfinder_title_color' => '#4c5867',
			'quickfinder_description_color' => '#5f727f',
			'bullets_symbol_color' => '#5f727f',
			'icons_symbol_color' => '#91a0ac',
			'pagination_basic_color' => '#99a9b5',
			'pagination_basic_background_color' => '#ffffff',
			'pagination_hover_color' => '#00bcd4',
			'pagination_active_color' => '#3c3950',
			'mini_pagination_color' => '#b6c6c9',
			'mini_pagination_active_color' => '#00bcd4',
			'form_elements_background_color' => '#f4f6f7',
			'form_elements_text_color' => '#3c3950',
			'form_elements_border_color' => '#dfe5e8',
			'basic_outer_background_image' => '',
			'top_background_image' => '',
			'top_area_background_image' => '',
			'main_background_image' => '',
			'footer_background_image' => '',
			'footer_widget_area_background_image' => '',
		)
	));
	if($skin) {
		return $skin_defaults[$skin];
	}
	return $skin_defaults;
}

function thegem_first_install_settings() {
	return apply_filters('thegem_default_theme_options', array(
		'page_layout_style' => 'fullwidth',
		'disable_smooth_scroll' => '1',
		'logo_width' => '164',
		'small_logo_width' => '132',
		'logo' => get_template_directory_uri() . '/images/default-logo.png',
		'small_logo' => get_template_directory_uri() . '/images/default-logo-small.png',
		'logo_light' => get_template_directory_uri() . '/images/default-logo-light.png',
		'small_logo_light' => get_template_directory_uri() . '/images/default-logo-light-small.png',
		'favicon' => get_template_directory_uri() . '/images/favicon.ico',
		'preloader_style' => 'preloader-4',
		'custom_css' => '',
		'custom_js' => '',
		'404_page' => '',
		'size_guide_image' => '',
		'header_layout' => 'default',
		'mobile_menu_layout' => 'default',
		'header_style' => '3',
		'logo_position' => 'left',
		'menu_appearance_tablet_portrait' => 'responsive',
		'menu_appearance_tablet_landscape' => 'centered',
		'top_area_style' => '1',
		'top_area_alignment' => 'left',
		'top_area_contacts' => '1',
		'top_area_socials' => '1',
		'top_area_button_text' => 'Join Now',
		'top_area_button_link' => '#',
		'top_area_disable_fixed' => '1',
		'top_area_disable_mobile' => '1',
		'google_fonts_file' => '',
		'main_menu_font_family' => 'Montserrat',
		'main_menu_font_style' => '700',
		'main_menu_font_sets' => '',
		'main_menu_font_size' => '14',
		'main_menu_line_height' => '25',
		'submenu_font_family' => 'Source Sans Pro',
		'submenu_font_style' => 'regular',
		'submenu_font_sets' => '',
		'submenu_font_size' => '16',
		'submenu_line_height' => '20',
		'styled_subtitle_font_family' => 'Source Sans Pro',
		'styled_subtitle_font_style' => '300',
		'styled_subtitle_font_sets' => '',
		'styled_subtitle_font_size' => '24',
		'styled_subtitle_line_height' => '37',
		'overlay_menu_font_family' => 'Montserrat',
		'overlay_menu_font_style' => '700',
		'overlay_menu_font_sets' => '',
		'overlay_menu_font_size' => '32',
		'overlay_menu_line_height' => '64',
		'h1_font_family' => 'Montserrat',
		'h1_font_style' => '700',
		'h1_font_sets' => '',
		'h1_font_size' => '50',
		'h1_line_height' => '69',
		'h2_font_family' => 'Montserrat',
		'h2_font_style' => '700',
		'h2_font_sets' => '',
		'h2_font_size' => '36',
		'h2_line_height' => '53',
		'h3_font_family' => 'Montserrat',
		'h3_font_style' => '700',
		'h3_font_sets' => '',
		'h3_font_size' => '28',
		'h3_line_height' => '42',
		'h4_font_family' => 'Montserrat',
		'h4_font_style' => '700',
		'h4_font_sets' => '',
		'h4_font_size' => '24',
		'h4_line_height' => '38',
		'h5_font_family' => 'Montserrat',
		'h5_font_style' => '700',
		'h5_font_sets' => '',
		'h5_font_size' => '19',
		'h5_line_height' => '30',
		'h6_font_family' => 'Montserrat',
		'h6_font_style' => '700',
		'h6_font_sets' => '',
		'h6_font_size' => '16',
		'h6_line_height' => '25',
		'xlarge_title_font_family' => 'Montserrat',
		'xlarge_title_font_style' => '700',
		'xlarge_title_font_sets' => 'latin,latin-ext',
		'xlarge_title_font_size' => '80',
		'xlarge_title_line_height' => '90',
		'light_title_font_family' => 'Montserrat UltraLight',
		'light_title_font_style' => 'regular',
		'light_title_font_sets' => '',
		'body_font_family' => 'Source Sans Pro',
		'body_font_style' => 'regular',
		'body_font_sets' => '',
		'body_font_size' => '16',
		'body_line_height' => '25',
		'widget_title_font_family' => 'Montserrat',
		'widget_title_font_style' => '700',
		'widget_title_font_sets' => '',
		'widget_title_font_size' => '19',
		'widget_title_line_height' => '30',
		'button_font_family' => 'Montserrat',
		'button_font_style' => '700',
		'button_font_sets' => 'latin',
		'button_thin_font_family' => 'Montserrat UltraLight',
		'button_thin_font_style' => 'regular',
		'button_thin_font_sets' => '',
		'portfolio_title_font_family' => 'Montserrat',
		'portfolio_title_font_style' => '700',
		'portfolio_title_font_sets' => '',
		'portfolio_title_font_size' => '16',
		'portfolio_title_line_height' => '24',
		'portfolio_description_font_family' => 'Source Sans Pro',
		'portfolio_description_font_style' => 'regular',
		'portfolio_description_font_sets' => '',
		'portfolio_description_font_size' => '16',
		'portfolio_description_line_height' => '24',
		'quickfinder_title_font_family' => 'Montserrat',
		'quickfinder_title_font_style' => '700',
		'quickfinder_title_font_sets' => 'latin',
		'quickfinder_title_font_size' => '24',
		'quickfinder_title_line_height' => '38',
		'quickfinder_title_thin_font_family' => 'Montserrat UltraLight',
		'quickfinder_title_thin_font_style' => 'regular',
		'quickfinder_title_thin_font_sets' => 'latin,latin-ext',
		'quickfinder_title_thin_font_size' => '24',
		'quickfinder_title_thin_line_height' => '38',
		'quickfinder_description_font_family' => 'Source Sans Pro',
		'quickfinder_description_font_style' => 'regular',
		'quickfinder_description_font_sets' => '',
		'quickfinder_description_font_size' => '16',
		'quickfinder_description_line_height' => '25',
		'gallery_title_font_family' => 'Montserrat UltraLight',
		'gallery_title_font_style' => 'regular',
		'gallery_title_font_sets' => '',
		'gallery_title_font_size' => '24',
		'gallery_title_line_height' => '30',
		'gallery_title_bold_font_family' => 'Montserrat',
		'gallery_title_bold_font_style' => '700',
		'gallery_title_bold_font_sets' => 'latin,latin-ext',
		'gallery_title_bold_font_size' => '24',
		'gallery_title_bold_line_height' => '31',
		'gallery_description_font_family' => 'Source Sans Pro',
		'gallery_description_font_style' => '300',
		'gallery_description_font_sets' => '',
		'gallery_description_font_size' => '17',
		'gallery_description_line_height' => '24',
		'testimonial_font_family' => 'Source Sans Pro',
		'testimonial_font_style' => '300',
		'testimonial_font_sets' => '',
		'testimonial_font_size' => '24',
		'testimonial_line_height' => '36',
		'counter_font_family' => 'Montserrat',
		'counter_font_style' => '700',
		'counter_font_sets' => '',
		'counter_font_size' => '50',
		'counter_line_height' => '69',
		'woocommerce_price_font_family' => 'Montserrat',
		'woocommerce_price_font_style' => 'regular',
		'woocommerce_price_font_sets' => '',
		'woocommerce_price_font_size' => '26',
		'woocommerce_price_line_height' => '36',
		'slideshow_title_font_family' => 'Montserrat',
		'slideshow_title_font_style' => '700',
		'slideshow_title_font_sets' => '',
		'slideshow_title_font_size' => '50',
		'slideshow_title_line_height' => '69',
		'slideshow_description_font_family' => 'Source Sans Pro',
		'slideshow_description_font_style' => 'regular',
		'slideshow_description_font_sets' => '',
		'slideshow_description_font_size' => '16',
		'slideshow_description_line_height' => '25',
		'basic_outer_background_color' => '#f0f3f2',
		'top_background_color' => '#ffffff',
		'main_background_color' => '#ffffff',
		'footer_widget_area_background_color' => '#212331',
		'footer_background_color' => '#181828',
		'styled_elements_background_color' => '#f4f6f7',
		'styled_elements_color_1' => '#00bcd4',
		'styled_elements_color_2' => '#99a9b5',
		'styled_elements_color_3' => '#f44336',
		'divider_default_color' => '#dfe5e8',
		'box_border_color' => '#dfe5e8',
		'main_menu_level1_color' => '#3c3950',
		'main_menu_level1_background_color' => '',
		'main_menu_level1_hover_color' => '#00bcd4',
		'main_menu_level1_hover_background_color' => '',
		'main_menu_level1_active_color' => '#3c3950',
		'main_menu_level1_active_background_color' => '#3c3950',
		'main_menu_level2_color' => '#5f727f',
		'main_menu_level2_background_color' => '#f4f6f7',
		'main_menu_level2_hover_color' => '#3c3950',
		'main_menu_level2_hover_background_color' => '#ffffff',
		'main_menu_level2_active_color' => '#3c3950',
		'main_menu_level2_active_background_color' => '#ffffff',
		'main_menu_mega_column_title_color' => '#3c3950',
		'main_menu_mega_column_title_hover_color' => '#00bcd4',
		'main_menu_mega_column_title_active_color' => '#00bcd4',
		'main_menu_level3_color' => '#5f727f',
		'main_menu_level3_background_color' => '#ffffff',
		'main_menu_level3_hover_color' => '#ffffff',
		'main_menu_level3_hover_background_color' => '#494c64',
		'main_menu_level3_active_color' => '#00bcd4',
		'main_menu_level3_active_background_color' => '#ffffff',
		'main_menu_level1_light_color' => '#ffffff',
		'main_menu_level1_light_hover_color' => '#00bcd4',
		'main_menu_level1_light_active_color' => '#ffffff',
		'main_menu_level2_border_color' => '#dfe5e8',
		'mega_menu_icons_color' => '',
		'overlay_menu_color' => '#ffffff',
		'overlay_menu_hover_color' => '#00bcd4',
		'overlay_menu_active_color' => '#00bcd4',
		'top_area_background_color' => '#f4f6f7',
		'top_area_border_color' => '#00bcd4',
		'top_area_separator_color' => '#dfe5e8',
		'top_area_text_color' => '#5f727f',
		'top_area_link_color' => '#5f727f',
		'top_area_link_hover_color' => '#00bcd4',
		'top_area_button_text_color' => '#ffffff',
		'top_area_button_background_color' => '#494c64',
		'top_area_button_hover_text_color' => '#ffffff',
		'top_area_button_hover_background_color' => '#00bcd4',
		'body_color' => '#5f727f',
		'h1_color' => '#3c3950',
		'h2_color' => '#3c3950',
		'h3_color' => '#3c3950',
		'h4_color' => '#3c3950',
		'h5_color' => '#3c3950',
		'h6_color' => '#3c3950',
		'link_color' => '#00bcd4',
		'hover_link_color' => '#384554',
		'active_link_color' => '#00bcd4',
		'footer_text_color' => '#99a9b5',
		'copyright_text_color' => '#99a9b5',
		'copyright_link_color' => '#00bcd4',
		'title_bar_background_color' => '#6c7cd0',
		'title_bar_text_color' => '#ffffff',
		'date_filter_subtitle_color' => '#99a9b5',
		'system_icons_font' => '#99a3b0',
		'system_icons_font_2' => '#b6c6c9',
		'button_text_basic_color' => '#ffffff',
		'button_text_hover_color' => '#ffffff',
		'button_background_basic_color' => '#b6c6c9',
		'button_background_hover_color' => '#3c3950',
		'button_outline_text_basic_color' => '#00bcd4',
		'button_outline_text_hover_color' => '#ffffff',
		'button_outline_border_basic_color' => '#00bcd4',
		'widget_title_color' => '#3c3950',
		'widget_link_color' => '#5f727f',
		'widget_hover_link_color' => '#00bcd4',
		'widget_active_link_color' => '#384554',
		'footer_widget_title_color' => '#feffff',
		'footer_widget_text_color' => '#99a9b5',
		'footer_widget_link_color' => '#99a9b5',
		'footer_widget_hover_link_color' => '#00bcd4',
		'footer_widget_active_link_color' => '#00bcd4',
		'portfolio_title_color' => '#5f727f',
		'portfolio_description_color' => '#5f727f',
		'portfolio_date_color' => '#99a9b5',
		'gallery_caption_background_color' => '#000000',
		'gallery_title_color' => '#ffffff',
		'gallery_description_color' => '#ffffff',
		'slideshow_arrow_background' => '#394050',
		'slideshow_arrow_hover_background' => '#00bcd4',
		'slideshow_arrow_color' => '#ffffff',
		'sliders_arrow_color' => '#3c3950',
		'sliders_arrow_background_color' => '#b6c6c9',
		'sliders_arrow_hover_color' => '#ffffff',
		'sliders_arrow_background_hover_color' => '#00bcd4',
		'hover_effect_default_color' => '#00bcd4',
		'hover_effect_zooming_blur_color' => '#ffffff',
		'hover_effect_horizontal_sliding_color' => '#46485c',
		'hover_effect_vertical_sliding_color' => '#f44336',
		'quickfinder_title_color' => '#4c5867',
		'quickfinder_description_color' => '#5f727f',
		'bullets_symbol_color' => '#5f727f',
		'icons_symbol_color' => '#91a0ac',
		'pagination_basic_color' => '#99a9b5',
		'pagination_basic_background_color' => '#ffffff',
		'pagination_hover_color' => '#00bcd4',
		'pagination_active_color' => '#3c3950',
		'mini_pagination_color' => '#b6c6c9',
		'mini_pagination_active_color' => '#00bcd4',
		'form_elements_background_color' => '#f4f6f7',
		'form_elements_text_color' => '#3c3950',
		'form_elements_border_color' => '#dfe5e8',
		'basic_outer_background_image' => '',
		'top_background_image' => '',
		'top_area_background_image' => '',
		'main_background_image' => '',
		'footer_background_image' => '',
		'footer_widget_area_background_image' => '',
		'slider_effect' => 'random',
		'slider_slices' => '15',
		'slider_boxCols' => '8',
		'slider_boxRows' => '4',
		'slider_animSpeed' => '5',
		'slider_pauseTime' => '20',
		'slider_directionNav' => '1',
		'slider_controlNav' => '1',
		'show_author' => '1',
		'excerpt_length' => '20',
		'footer_active' => '1',
		'footer_html' => array(
			'en' => '2016 &copy; Copyrights CodexThemes',
		),
		'contacts_address' => '908 New Hampshire Avenue #100, Washington, DC 20037, United States',
		'contacts_phone' => '+1 916-875-2235',
		'contacts_fax' => '+1 916-875-2235',
		'contacts_email' => 'info@domain.tld',
		'contacts_website' => 'www.codex-themes.com',
		'top_area_contacts_address' => '19th Ave New York, NY 95822, USA',
		'top_area_contacts_phone' => '',
		'top_area_contacts_fax' => '',
		'top_area_contacts_email' => '',
		'top_area_contacts_website' => '',
		'twitter_active' => '1',
		'facebook_active' => '1',
		'linkedin_active' => '1',
		'googleplus_active' => '1',
		'instagram_active' => '1',
		'pinterest_active' => '1',
		'youtube_active' => '1',
		'twitter_link' => '#',
		'facebook_link' => '#',
		'linkedin_link' => '#',
		'googleplus_link' => '#',
		'stumbleupon_link' => '#',
		'rss_link' => '#',
		'vimeo_link' => '#',
		'instagram_link' => '#',
		'pinterest_link' => '#',
		'youtube_link' => '#',
		'flickr_link' => '#',
		'show_social_icons' => '1',
	));
}

/* Create admin theme page */
function thegem_theme_add_page() {
	$page = add_theme_page(esc_html__('TheGem theme options','thegem'), esc_html__('Theme options','thegem'), 'edit_theme_options', 'options-framework', 'thegem_theme_options_page');
}
add_action( 'admin_menu', 'thegem_theme_add_page');

function thegem_activation_google_fonts() {
	$fonts_url = '';
	$fonts = array();
	$subsets = 'latin,latin-ext';
	if ( 'off' !== _x( 'on', 'Montserrat font: on or off', 'thegem' ) ) {
		$fonts[] = 'Montserrat:700';
	}
	if ( 'off' !== _x( 'on', 'Source Sans Pro font: on or off', 'thegem' ) ) {
		$fonts[] = 'Source Sans Pro:300,400';
	}
	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), '//fonts.googleapis.com/css' );
	}

	return $fonts_url;
}

function thegem_theme_options_admin_enqueue_scripts($hook) {
	if($hook != 'appearance_page_options-framework') return;
	wp_enqueue_media();
	wp_enqueue_style('thegem-activation-google-fonts', thegem_activation_google_fonts());
	wp_enqueue_script('thegem-form-elements', get_template_directory_uri() . '/js/thegem-form-elements.js', array('jquery'), false, true);
	wp_enqueue_script('thegem-image-selector', get_template_directory_uri() . '/js/thegem-image-selector.js', array('jquery'));
	wp_enqueue_script('thegem-file-selector', get_template_directory_uri() . '/js/thegem-file-selector.js', array('jquery'));
	wp_enqueue_script('thegem-font-options', get_template_directory_uri() . '/js/thegem-font-options.js', array('jquery'));
	wp_enqueue_script('thegem-theme-options', get_template_directory_uri() . '/js/thegem-theme_options.js', array('jquery-ui-position', 'jquery-ui-tabs', 'jquery-ui-slider', 'jquery-ui-accordion', 'jquery-ui-draggable', 'jquery-ui-droppable', 'jquery-ui-sortable'));
	wp_localize_script('thegem-theme-options', 'theme_options_object',array(
		'ajax_url' => esc_url(admin_url( 'admin-ajax.php' )),
		'security' => wp_create_nonce('ajax_security'),
		'text1' => esc_html__('Get all from font.', 'thegem'),
		'thegem_color_skin_defaults' => json_encode(thegem_color_skin_defaults()),
		'text2' => esc_html__('et colors, backgrounds and fonts options to default?', 'thegem'),
		'text3' => esc_html__('Update backup data?', 'thegem'),
		'text4' => esc_html__('Restore settings from backup data?', 'thegem'),
		'text5' => esc_html__('Import settings?', 'thegem'),
	));
}
add_action('admin_enqueue_scripts', 'thegem_theme_options_admin_enqueue_scripts');

/* Build admin theme page form */
function thegem_theme_options_page(){
	if(isset($_REQUEST['action']) && isset($_REQUEST['theme_options'])) {
		thegem_theme_update_options();
	}
	if(isset($_REQUEST['action']) && in_array($_REQUEST['action'], array('save', 'reset', 'restore', 'import'))) {
		if(thegem_generate_custom_css() === 'generate_css_continue') {
			return ;
		}
	}
	$jQuery_ui_theme = 'ui-no-theme';
	$options = thegem_get_theme_options();
	$options_values = get_option('thegem_theme_options');
?>
<div class="wrap">
	<div class="theme-title">
		<img class="right-part" src="<?php echo esc_url(get_template_directory_uri().'/images/admin-images/theme-options-title-right.png'); ?>" alt="Codex Tuner" />
		<img class="left-part" src="<?php echo esc_url(get_template_directory_uri().'/images/admin-images/theme-options-title-left.png'); ?>" alt="Theme Options. thegem Business." />
		<div style="clear: both;"></div>
	</div>
	<form id="theme-options-form" method="POST">
		<?php wp_nonce_field('thegem-theme-options'); ?>
		<div class="option-wrap <?php echo esc_attr($jQuery_ui_theme); ?>">
			<div class="submit_buttons"><button name="action" value="save"><?php esc_html_e( 'Save Changes', 'thegem' ); ?></button></div>
			<div id="categories">
				<?php if(count($options) > 0) : ?>
					<ul class="styled">
						<?php foreach($options as $name => $category) : ?>
							<?php if(isset($category['subcats']) && count($category['subcats']) > 0) : ?>
								<li><a href="<?php echo esc_url('#'.$name); ?>" style="background-image: url('<?php echo esc_url(get_template_directory_uri().'/images/admin-images/'.$name.'_icon.png'); ?>');"><?php print esc_html($category['title']); ?></a></li>
							<?php endif; ?>
						<?php endforeach; ?>
						<li><a href="#backup" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/admin-images/backup_icon.png');"><?php esc_html_e('Backup', 'thegem'); ?></a></li>
						<li><a href="#activation" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/admin-images/activation_icon.png');"><?php esc_html_e('Theme activation', 'thegem'); ?></a></li>
					</ul>
				<?php endif; ?>

				<?php if(count($options) > 0) : ?>
					<?php foreach($options as $name => $category) : ?>
						<?php if(isset($category['subcats']) && count($category['subcats']) > 0) : ?>
							<div id="<?php echo esc_attr($name); ?>">
								<div class="subcategories">

									<?php foreach($category['subcats'] as $sname => $subcat) : ?>
										<div id="<?php echo esc_attr($sname); ?>">
											<h3><?php echo esc_html($subcat['title']); ?></h3>
											<div class="inside">
												<?php foreach($subcat['options'] as $oname => $option) : ?>
													<?php echo thegem_get_option_element($oname, $option, isset($options_values[$oname]) ? $options_values[$oname] : NULL); ?>
												<?php endforeach; ?>
											</div>
										</div>
									<?php endforeach; ?>

								</div>
							</div>
						<?php endif; ?>
					<?php endforeach; ?>

					<div id="backup">
						<div class="subcategories">
								<div id="backup_theme_options">
									<h3><?php esc_html_e('Backup and Restore Theme Settings', 'thegem'); ?></h3>
									<div class="inside">
										<div class="option backup_restore_settings">
											<p><?php esc_html_e('If you would like to experiment with the settings of your theme and don\'t want to loose your previous settings, use the "Backup Settings"-button to backup your current theme options. You can restore these options later using the button "Restore Settings".', 'thegem'); ?></p>
											<?php if($backup = get_option('thegem_theme_options_backup')) : ?>
												<p><b><?php esc_html_e('Last backup', 'thegem'); ?>: <?php echo date('Y-m-d H:i', $backup['date']) ?></b></p>
											<?php else : ?>
												<p><b><?php esc_html_e('Last backup', 'thegem'); ?>: <?php esc_html_e('No backups yet', 'thegem'); ?></b></p>
											<?php endif; ?>
											<div class="backups-buttons">
												<button name="action" value="backup"><?php esc_html_e( 'Backup Settings', 'thegem' ); ?></button>
												<button name="action" value="restore"><?php esc_html_e( 'Restore Settings', 'thegem' ); ?></button>
											</div>
										</div>
										<div class="option import_settings">
											<p><?php esc_html_e('In order to apply the settings of another thegem theme used in a different install just copy and paste the settings in the text box and click on "Import Settings".', 'thegem'); ?></p>
											<div class="textarea">
												<textarea name="import_settings" cols="100" rows="8"><?php if($settings = get_option('thegem_theme_options')) { echo json_encode($settings); } ?></textarea>
											</div>
											<p>&nbsp;</p>
											<div class="backups-buttons">
												<button name="action" value="import"><?php esc_html_e( 'Import Settings', 'thegem' ); ?></button>
											</div>
										</div>
									</div>
								</div>
						</div>
					</div>

					<div id="activation">
						<div class="activation-header">
							<img src="<?php echo get_template_directory_uri(); ?>/images/admin-images/activation-title.png" alt="TheGem"/>
							<h4><?php esc_html_e( 'Welcome to TheGem - Creative Multi-Purpose WordPress Theme', 'thegem' ); ?></h4>
						</div>
						<div class="activation-container">
							<p class="styled-subtitle"><?php esc_html_e( 'Thank you for purchasing TheGem! Would you like to import our awesome demos and take advantage of our amazing features? Please activate your copy of TheGem:', 'thegem' ); ?></p>
							<div class="activation-field">
								<table><tr>
									<td><input type="text" class="activation-input" name="theme_options[purchase_code]" placeholder="<?php esc_html_e( 'Enter purchase code, e.g. cb0e057f-a05d-4758-b314-024db98eff85', 'thegem' ); ?>" value="<?php echo esc_attr(thegem_get_option('purchase_code')); ?>" /></td>
									<td><button class="activation-submit" name="action" value="activation"><?php esc_html_e( 'Activate', 'thegem' ); ?></button></td>
								</tr></table>
								<?php if(get_option('thegem_activation')) : ?>
									<p class="activation-result activation-result-success"><?php esc_html_e('Thank you, your purchase code is valid. TheGem has been activated.', 'thegem'); ?></p>
								<?php else : ?>
									<p class="activation-result activation-result-hidden"></p>
								<?php endif; ?>
								<script type="text/javascript">
									(function($) {
										$('#activation .activation-submit').click(function(e) {
											e.preventDefault();
											$.ajax({
												url: '<?php echo esc_url(admin_url('admin-ajax.php')); ?>',
												data: { action: 'thegem_submit_activation', purchase_code: $('#activation .activation-input').val()},
												method: 'POST',
												timeout: 30000
											}).done(function(msg) {
												$('#activation .activation-result').html('');
												$('#activation .activation-result').removeClass('activation-result-hidden activation-result-success activation-result-failure');
												msg = jQuery.parseJSON(msg);
												if(msg.status) {
													$('#activation .activation-result').addClass('activation-result-success');
												} else {
													$('#activation .activation-result').addClass('activation-result-failure');
												}
												$('#activation .activation-result').text(msg.message);
											}).fail(function() {
												$('#activation .activation-result').html('');
												$('#activation .activation-result').removeClass('activation-result-hidden');
												$('#activation .activation-result').addClass('activation-result-failure');
												$('#activation .activation-result').text('<?php esc_html_e('Ajax error. Try again...', 'thegem'); ?>');
											});
										});
										$('#activation .activation-input').keydown(function(e) {
											if (e.keyCode == 13) {
												$('#activation .activation-submit').trigger('click');
												e.preventDefault();
											}
										});
									})(jQuery);
								</script>
							</div>
							<div class="activation-purchase-image">
								<a href="https://themeforest.net/downloads"><img src="<?php echo get_template_directory_uri(); ?>/images/admin-images/activation-purchase-image.jpg" alt="TheGem"/></a>
							</div>
							<div class="activation-help-links">
								<a href="http://codex-themes.com/thegem/documentation/"><img src="<?php echo get_template_directory_uri(); ?>/images/admin-images/activation-help-doc.jpg"></a>
								<a href="http://codexthemes.ticksy.com/"><img src="<?php echo get_template_directory_uri(); ?>/images/admin-images/activation-help-support.jpg"></a>
								<a href="http://codex-themes.com/thegem/documentation/video-tutorials/"><img src="<?php echo get_template_directory_uri(); ?>/images/admin-images/activation-help-video.jpg"></a>
							</div>
							<div class="activation-rate-block">
								<h4><?php esc_html_e( 'RATE THEGEM', 'thegem' ); ?></h4>
								<p><?php printf(wp_kses(__( 'Please don’t forget to rate TheGem and leave a nice review, it means a lot for us and our theme.<br />Simply log in into your Themeforest, go to <a href="%s">Downloads section</a> and click 5 stars next to the TheGem WordPress theme as shown on screenshot below:', 'thegem' ), array('br' => array(), 'a' => array('href' => array()))), esc_url('https://themeforest.net/downloads')); ?></p>
								<div class="activation-rate-image">
									<a href="https://themeforest.net/downloads"><img src="<?php echo get_template_directory_uri(); ?>/images/admin-images/activation-rate-image.jpg" alt="TheGem"/></a>
								</div>
							</div>
						</div>
					</div>

				<?php endif; ?>

			</div>
			<div class="submit_buttons"><button name="action" value="reset"><?php esc_html_e( 'Reset Style Settings', 'thegem' ); ?></button><button name="action" value="save"><?php esc_html_e( 'Save Changes', 'thegem' ); ?></button></div>
		</div>
	</form>
	<script type="text/javascript">
(function($) {
	$(function() {
		var options_dependencies = {
			header_layout: {
				default: {},
				fullwidth: {},
				fullwidth_hamburger: {
					main_menu_font_family: 'Montserrat',
					main_menu_font_style: '700',
					top_background_color: '#212331',
					main_menu_level1_color: '#3c3950',
					main_menu_level1_background_color: '',
					main_menu_level1_hover_color: '#00bcd4',
					main_menu_level1_hover_background_color: '',
					main_menu_level1_active_color: '#00bcd4',
					main_menu_level1_active_background_color: '',
					main_menu_level2_color: '#5f727f',
					main_menu_level2_background_color: '#f4f6f7',
					main_menu_level2_hover_color: '#3c3950',
					main_menu_level2_hover_background_color: '#ffffff',
					main_menu_level2_active_color: '#3c3950',
					main_menu_level2_active_background_color: '#ffffff',
					main_menu_mega_column_title_color: '#3c3950',
					main_menu_mega_column_title_hover_color: '#00bcd4',
					main_menu_mega_column_title_active_color: '#00bcd4',
					main_menu_level3_color: '#5f727f',
					main_menu_level3_background_color: '#ffffff',
					main_menu_level3_hover_color: '#ffffff',
					main_menu_level3_hover_background_color: '#494c64',
					main_menu_level3_active_color: '#00bcd4',
					main_menu_level3_active_background_color: '#ffffff',
					main_menu_level2_border_color: '#dfe5e8'
				},
				vertical: {
					main_menu_font_family: 'Montserrat',
					main_menu_font_style: '700',
					top_background_color: '#ffffff',
					main_menu_level1_color: '#3c3950',
					main_menu_level1_background_color: '',
					main_menu_level1_hover_color: '#00bcd4',
					main_menu_level1_hover_background_color: '',
					main_menu_level1_active_color: '#00bcd4',
					main_menu_level1_active_background_color: '#f4f6f7',
					main_menu_level2_color: '#99a9b5',
					main_menu_level2_background_color: '#212331',
					main_menu_level2_hover_color: '#ffffff',
					main_menu_level2_hover_background_color: '#393d4f',
					main_menu_level2_active_color: '#ffffff',
					main_menu_level2_active_background_color: '#393d4f',
					main_menu_mega_column_title_color: '#3c3950',
					main_menu_mega_column_title_hover_color: '#00bcd4',
					main_menu_mega_column_title_active_color: '#00bcd4',
					main_menu_level3_color: '#99a9b5',
					main_menu_level3_background_color: '#393d50',
					main_menu_level3_hover_color: '#ffffff',
					main_menu_level3_hover_background_color: '#494c64',
					main_menu_level3_active_color: '#00bcd4',
					main_menu_level3_active_background_color: '#393d50',
					main_menu_level2_border_color: '#494660'
				}
			},
			header_style: {
				1: {
					main_menu_font_family: 'Montserrat',
					main_menu_font_style: '700',
					top_background_color: '#ffffff',
					main_menu_level1_color: '#3c3950',
					main_menu_level1_background_color: '',
					main_menu_level1_hover_color: '#00bcd4',
					main_menu_level1_hover_background_color: '#',
					main_menu_level1_active_color: '#00bcd4',
					main_menu_level1_active_background_color: '#f4f6f7',
					main_menu_level2_color: '#99a9b5',
					main_menu_level2_background_color: '#212331',
					main_menu_level2_hover_color: '#ffffff',
					main_menu_level2_hover_background_color: '#393d4f',
					main_menu_level2_active_color: '#ffffff',
					main_menu_level2_active_background_color: '#393d4f',
					main_menu_mega_column_title_color: '#ffffff',
					main_menu_mega_column_title_hover_color: '#00bcd4',
					main_menu_mega_column_title_active_color: '#00bcd4',
					main_menu_level3_color: '#99a9b5',
					main_menu_level3_background_color: '#393d50',
					main_menu_level3_hover_color: '#ffffff',
					main_menu_level3_hover_background_color: '#494c64',
					main_menu_level3_active_color: '#00bcd4',
					main_menu_level3_active_background_color: '#393d50',
					main_menu_level2_border_color: '#494660',
					main_menu_level1_light_color: '#ffffff',
					main_menu_level1_light_hover_color: '#00bcd4',
					main_menu_level1_light_active_color: '#00bcd4'
				},
				2: {
					main_menu_font_family: 'Source Sans Pro',
					main_menu_font_style: 'regular',
					top_background_color: '#ffffff',
					main_menu_level1_color: '#5f727f',
					main_menu_level1_background_color: '',
					main_menu_level1_hover_color: '#00bcd4',
					main_menu_level1_hover_background_color: '',
					main_menu_level1_active_color: '#00bcd4',
					main_menu_level1_active_background_color: '',
					main_menu_level2_color: '#5f727f',
					main_menu_level2_background_color: '#f4f6f7',
					main_menu_level2_hover_color: '#3c3950',
					main_menu_level2_hover_background_color: '#ffffff',
					main_menu_level2_active_color: '#3c3950',
					main_menu_level2_active_background_color: '#ffffff',
					main_menu_mega_column_title_color: '#5f727f',
					main_menu_mega_column_title_hover_color: '#00bcd4',
					main_menu_mega_column_title_active_color: '#00bcd4',
					main_menu_level3_color: '#5f727f',
					main_menu_level3_background_color: '#ffffff',
					main_menu_level3_hover_color: '#ffffff',
					main_menu_level3_hover_background_color: '#494c64',
					main_menu_level3_active_color: '#00bcd4',
					main_menu_level3_active_background_color: '#ffffff',
					main_menu_level2_border_color: '#dfe5e8',
					main_menu_level1_light_color: '#ffffff',
					main_menu_level1_light_hover_color: '#00bcd4',
					main_menu_level1_light_active_color: '#00bcd4'
				},
				3: {
					main_menu_font_family: 'Montserrat',
					main_menu_font_style: '700',
					top_background_color: '#ffffff',
					main_menu_level1_color: '#3c3950',
					main_menu_level1_background_color: '',
					main_menu_level1_hover_color: '#00bcd4',
					main_menu_level1_hover_background_color: '',
					main_menu_level1_active_color: '#3c3950',
					main_menu_level1_active_background_color: '#3c3950',
					main_menu_level2_color: '#5f727f',
					main_menu_level2_background_color: '#f4f6f7',
					main_menu_level2_hover_color: '#3c3950',
					main_menu_level2_hover_background_color: '#ffffff',
					main_menu_level2_active_color: '#3c3950',
					main_menu_level2_active_background_color: '#ffffff',
					main_menu_mega_column_title_color: '#3c3950',
					main_menu_mega_column_title_hover_color: '#00bcd4',
					main_menu_mega_column_title_active_color: '#00bcd4',
					main_menu_level3_color: '#5f727f',
					main_menu_level3_background_color: '#ffffff',
					main_menu_level3_hover_color: '#ffffff',
					main_menu_level3_hover_background_color: '#494c64',
					main_menu_level3_active_color: '#00bcd4',
					main_menu_level3_active_background_color: '#ffffff',
					main_menu_level2_border_color: '#dfe5e8',
					main_menu_level1_light_color: '#ffffff',
					main_menu_level1_light_hover_color: '#00bcd4',
					main_menu_level1_light_active_color: '#ffffff'
				},
				4: {
					main_menu_font_family: 'Montserrat',
					main_menu_font_style: '700',
					top_background_color: '#212331',
					main_menu_level1_color: '#99a9b5',
					main_menu_level1_background_color: '',
					main_menu_level1_hover_color: '#00bcd4',
					main_menu_level1_hover_background_color: '',
					main_menu_level1_active_color: '#ffffff',
					main_menu_level1_active_background_color: '#ffffff',
					main_menu_level2_color: '#99a9b5',
					main_menu_level2_background_color: '#393d50',
					main_menu_level2_hover_color: '#ffffff',
					main_menu_level2_hover_background_color: '#212331',
					main_menu_level2_active_color: '#ffffff',
					main_menu_level2_active_background_color: '#212331',
					main_menu_mega_column_title_color: '#ffffff',
					main_menu_mega_column_title_hover_color: '#00bcd4',
					main_menu_mega_column_title_active_color: '#00bcd4',
					main_menu_level3_color: '#99a9b5',
					main_menu_level3_background_color: '#212331',
					main_menu_level3_hover_color: '#ffffff',
					main_menu_level3_hover_background_color: '#131121',
					main_menu_level3_active_color: '#00bcd4',
					main_menu_level3_active_background_color: '#212331',
					main_menu_level2_border_color: '#494c64',
					main_menu_level1_light_color: '#ffffff',
					main_menu_level1_light_hover_color: '#00bcd4',
					main_menu_level1_light_active_color: '#ffffff'
				}
			},
			top_area_style: {
				0 : {},
				1: {
					top_area_background_color: '#f4f6f7',
					top_area_border_color: '#00bcd4',
					top_area_separator_color: '#dfe5e8',
					top_area_text_color: '#5f727f',
					top_area_link_color: '#5f727f',
					top_area_link_hover_color: '#00bcd4',
					top_area_button_text_color: '#ffffff',
					top_area_button_background_color: '#494c64',
					top_area_button_hover_text_color: '#ffffff',
					top_area_button_hover_background_color: '#00bcd4',
					top_area_icons_color: '#5f727f',
				},
				2: {
					top_area_background_color: '#212331',
					top_area_border_color: '#474b61',
					top_area_separator_color: '#51546c',
					top_area_text_color: '#99a9b5',
					top_area_link_color: '#99a9b5',
					top_area_link_hover_color: '#ffffff',
					top_area_button_text_color: '#ffffff',
					top_area_button_background_color: '#00bcd4',
					top_area_button_hover_text_color: '#ffffff',
					top_area_button_hover_background_color: '#46485c',
					top_area_icons_color: '#99a9b5'
				},
				3: {
					top_area_background_color: '#393d50',
					top_area_border_color: '#00bcd4',
					top_area_separator_color: '#494c64',
					top_area_text_color: '#99a9b5',
					top_area_link_color: '#99a9b5',
					top_area_link_hover_color: '#ffffff',
					top_area_button_text_color: '#ffffff',
					top_area_button_background_color: '#99a9b5',
					top_area_button_hover_text_color: '#ffffff',
					top_area_button_hover_background_color: '#00bcd4',
					top_area_icons_color: '#99a9b5'
				}
			}
		}

		$.each(options_dependencies, function(i, obj) {
			$('#'+i).change(function() {
				$.each(obj[$(this).val()], function(item, value) {
					$('#'+item).val(value).trigger('change');
				});
			});
		});
	});
})(jQuery);
</script>
<?php if(!get_option('thegem_print_google_code')) : update_option('thegem_print_google_code', 1); ?>
<!-- Google Code for Remarketing Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 972114099;
var google_conversion_language = "en";
var google_conversion_format = "3";
var google_conversion_color = "ffffff";
var google_conversion_label = "awXFCNfd8GkQs5HFzwM";
var google_remarketing_only = false;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/972114099/?label=awXFCNfd8GkQs5HFzwM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
<?php endif; ?>
</div>
<?php
}

/* Update theme options */
function thegem_theme_update_options() {
	if(check_admin_referer('thegem-theme-options')) {
		if(isset($_REQUEST['action']) && isset($_REQUEST['theme_options'])) {
			if($_REQUEST['action'] == 'save') {
				$theme_options = $_REQUEST['theme_options'];
				if(thegem_get_current_language()) {
					$ml_options = array('footer_html', 'top_area_button_text', 'contacts_address', 'contacts_phone', 'contacts_fax', 'contacts_email', 'contacts_website');
					foreach ($ml_options as $ml_option) {
						$value = thegem_get_option($ml_option, false, true);
						if(!is_array($value)) {
							if(thegem_get_default_language()) {
								$value = array(thegem_get_default_language() => $value);
							}
						}
						$value[thegem_get_current_language()] = $theme_options[$ml_option];
						$theme_options[$ml_option] = $value;
					}
				}
				thegem_check_activation($theme_options);
				update_option('thegem_theme_options', $theme_options);
			} elseif($_REQUEST['action'] == 'reset') {
				if($options = get_option('thegem_theme_options')) {
					if(!($skin = thegem_get_option('page_color_style'))) {
						$skin = 'light';
					}
					$defaults = thegem_color_skin_defaults($skin);
					$newOptions = array();
					foreach($defaults as $key => $val) {
						$newOptions[$key] = $val;
					}
					$options = array_merge($options, $newOptions);
					thegem_check_activation($options);
					update_option('thegem_theme_options', $options);
				}

			} elseif($_REQUEST['action'] == 'backup') {
				if($settings = get_option('thegem_theme_options')) {
					update_option('thegem_theme_options_backup', array('date' => time(), 'settings' => json_encode($settings)));
				}
			} elseif($_REQUEST['action'] == 'restore') {
				if($settings = get_option('thegem_theme_options_backup')) {
					thegem_check_activation($theme_options);
					update_option('thegem_theme_options', json_decode($settings['settings'], true));
				}
			} elseif($_REQUEST['action'] == 'import') {
				thegem_check_activation($theme_options);
				update_option('thegem_theme_options', json_decode(stripslashes($_REQUEST['import_settings']), true));
			} elseif($_REQUEST['action'] == 'activation' && isset($_REQUEST['theme_options']['purchase_code'])) {
				$theme_options = get_option('thegem_theme_options');
				$theme_options['purchase_code'] = $_REQUEST['theme_options']['purchase_code'];
				thegem_check_activation($theme_options);
				update_option('thegem_theme_options', $theme_options);
			}
		}
	}
}

/* Get theme option*/
if(!function_exists('thegem_get_option')) {
function thegem_get_option($name, $default = false, $ml_full = false) {
	$options = get_option('thegem_theme_options');
	if(isset($options[$name])) {
		$ml_options = array('footer_html', 'top_area_button_text', 'contacts_address', 'contacts_phone', 'contacts_fax', 'contacts_email', 'contacts_website');
		if(in_array($name, $ml_options) && is_array($options[$name]) && !$ml_full) {
			if(thegem_get_current_language()) {
				if(isset($options[$name][thegem_get_current_language()])) {
					$options[$name] = $options[$name][thegem_get_current_language()];
				} elseif(thegem_get_default_language() && isset($options[$name][thegem_get_default_language()])) {
					$options[$name] = $options[$name][thegem_get_default_language()];
				} else {
					$options[$name] = '';
				}
			}else {
				$options[$name] = reset($options[$name]);
			}
		}
		return apply_filters('thegem_option_'.$name, $options[$name]);
	}
	return apply_filters('thegem_option_'.$name, $default);
}
}

function thegem_generate_custom_css() {
	ob_start();
	thegem_custom_fonts();
	require get_template_directory() . '/inc/custom-css.php';
	if(file_exists(get_stylesheet_directory() . '/inc/custom-css.php') && get_stylesheet_directory() != get_template_directory()) {
		require get_stylesheet_directory() . '/inc/custom-css.php';
	}
	$custom_css = ob_get_clean();
	$action = array('action');
	$url = wp_nonce_url('themes.php?page=options-framework','thegem-theme-options');
	if (false === ($creds = request_filesystem_credentials($url, '', false, get_stylesheet_directory() . '/css/', $action) ) ) {
		return 'generate_css_continue';
	}
	if(!WP_Filesystem($creds)) {
		request_filesystem_credentials($url, '', true, get_stylesheet_directory() . '/css/', $action);
		return 'generate_css_continue';
	}
	global $wp_filesystem;
	if(!$wp_filesystem->put_contents($wp_filesystem->find_folder(get_stylesheet_directory()) . 'css/custom.css', $custom_css)) {
		update_option('thegem_genearte_css_error', '1');
?>
	<div class="error">
		<p><?php printf(esc_html__('TheGem\'s styles cannot be customized because file "%s" cannot be modified. Please check your server\'s settings. Then click "Save Changes" button.', 'thegem'), get_stylesheet_directory() . '/css/custom.css'); ?></p>
	</div>
<?php
	} else {
		delete_option('thegem_genearte_css_error');
	}
}

function thegem_genearte_css_error() {
	if(isset($_GET['page']) && $_GET['page'] == 'options-framework' && get_option('thegem_genearte_css_error')) {
?>
	<div class="error">
		<p><?php printf(esc_html__('TheGem\'s styles cannot be customized because file "%s" cannot be modified. Please check your server\'s settings. Then click "Save Changes" button.', 'thegem'), get_stylesheet_directory() . '/css/custom.css'); ?></p>
	</div>
<?php
	}
}
add_action('admin_notices', 'thegem_genearte_css_error');

function thegem_activate() {
	global $pagenow;
	if(is_admin() && 'themes.php' == $pagenow && isset($_GET['activated'])) {
		wp_redirect(admin_url('themes.php?page=options-framework#activation'));
		exit;
	}
}
add_action('after_setup_theme', 'thegem_activate', 11);

add_action('wp_ajax_thegem_submit_activation', 'thegem_submit_activation');
function thegem_submit_activation() {
	delete_option('thegem_activation');
	if(!empty($_REQUEST['purchase_code'])) {
		$theme_options = get_option('thegem_theme_options');
		$theme_options['purchase_code'] = $_REQUEST['purchase_code'];
		update_option('thegem_theme_options', $theme_options);
		$response_p = wp_remote_get(add_query_arg(array('code' => $_REQUEST['purchase_code'], 'site_url' => get_site_url()), esc_url('http://democontent.codex-themes.com/av_validate_code.php')), array('timeout' => 20));
		if(is_wp_error($response_p)) {
			echo json_encode(array('status' => 0, 'message' => esc_html__('Some troubles with connecting to TheGem server.', 'thegem')));
		} else {
			$rp_data = json_decode($response_p['body'], true);
			if(is_array($rp_data) && isset($rp_data['result']) && $rp_data['result'] && isset($rp_data['item_id']) && $rp_data['item_id'] === '16061685') {
				echo json_encode(array('status' => 1, 'message' => esc_html__('Thank you, your purchase code is valid. TheGem has been activated.', 'thegem')));
				update_option('thegem_activation', 1);
			} else {
				echo json_encode(array('status' => 0, 'message' => esc_html__('The purchase code you have entered is not valid. TheGem has not been activated.', 'thegem')));
			}
		}
	} else {
		echo json_encode(array('status' => 0, 'message' => esc_html__('Purchase code is empty.', 'thegem')));
	}
	die(-1);
}

function thegem_check_activation($theme_options) {
	if(get_option('thegem_activation')) {
		if(empty($theme_options['purchase_code'])) {
			delete_option('thegem_activation');
		} elseif($theme_options['purchase_code'] !== thegem_get_option('purchase_code')) {
			delete_option('thegem_activation');
			$response_p = wp_remote_get(add_query_arg(array('code' => $theme_options['purchase_code'], 'site_url' => get_site_url()), esc_url('http://democontent.codex-themes.com/av_validate_code.php')), array('timeout' => 20));
			if(!is_wp_error($response_p)) {
				$rp_data = json_decode($response_p['body'], true);
				if(is_array($rp_data) && isset($rp_data['result']) && $rp_data['result'] && isset($rp_data['item_id']) && $rp_data['item_id'] === '16061685') {
					update_option('thegem_activation', 1);
				}
			}
		}
	} elseif(!empty($theme_options['purchase_code'])) {
		$response_p = wp_remote_get(add_query_arg(array('code' => $theme_options['purchase_code'], 'site_url' => get_site_url()), esc_url('http://democontent.codex-themes.com/av_validate_code.php')), array('timeout' => 20));
		if(!is_wp_error($response_p)) {
			$rp_data = json_decode($response_p['body'], true);
			if(is_array($rp_data) && isset($rp_data['result']) && $rp_data['result'] && isset($rp_data['item_id']) && $rp_data['item_id'] === '16061685') {
				update_option('thegem_activation', 1);
			}
		}
	}
}

function thegem_activation_notice() {
	if(get_option('thegem_activation') || !empty( $_COOKIE['thegem_activation'] )) {
		return ;
	}
?>
<style>
	.thegem_license-activation-notice {
		position: relative;
	}
</style>
<script type="text/javascript">
(function ( $ ) {
	var setCookie = function ( c_name, value, exdays ) {
		var exdate = new Date();
		exdate.setDate( exdate.getDate() + exdays );
		var c_value = encodeURIComponent( value ) + ((null === exdays) ? "" : "; expires=" + exdate.toUTCString());
		document.cookie = c_name + "=" + c_value;
	};
	$( document ).on( 'click.thegem-notice-dismiss', '.thegem-notice-dismiss', function ( e ) {
		e.preventDefault();
		var $el = $( this ).closest('#thegem_license-activation-notice' );
		$el.fadeTo( 100, 0, function () {
			$el.slideUp( 100, function () {
				$el.remove();
			} );
		} );
		setCookie( 'thegem_activation', '1', 30 );
	} );
})( window.jQuery );
</script>
<?php
	echo '<div class="updated thegem_license-activation-notice" id="thegem_license-activation-notice"><p>' . sprintf( wp_kses(__( 'Welcome to TheGem! Would you like to import our awesome demos and take advantage of our amazing features? Please <a href="%s">activate</a> your copy of TheGem.', 'thegem' ), array('a' => array('href' => array()))), esc_url(admin_url('themes.php?page=options-framework#activation')) ) . '</p>' . '<button type="button" class="notice-dismiss thegem-notice-dismiss"><span class="screen-reader-text">' . __( 'Dismiss this notice.', 'default' ) . '</span></button></div>';
}
add_action('admin_notices', 'thegem_activation_notice');
