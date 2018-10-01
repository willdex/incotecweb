<?php

function thegem_get_image_regenerated_option_key() {
    return 'thegem_image_regenerated';
}

if(!function_exists('thegem_generate_thumbnail_src')) {

    function thegem_generate_thumbnail_src($attachment_id, $size) {
        $data = thegem_image_cache_get($attachment_id, $size);
        if ($data) {
            return $data;
        }

    	$data = thegem_get_thumbnail_src($attachment_id, $size);
        thegem_image_cache_set($attachment_id, $size, $data);
    	return $data;
    }

    function thegem_get_thumbnail_src($attachment_id, $size) {
    	$thegem_image_sizes = thegem_image_sizes();

        if(isset($thegem_image_sizes[$size])) {
    		$attachment_path = get_attached_file($attachment_id);
    		if (!$attachment_path) {
                return null;
    		}

            $dummy_image_editor = new TheGem_Dummy_WP_Image_Editor($attachment_path);
            $attachment_thumb_path = $dummy_image_editor->generate_filename($size);

    		if (!file_exists($attachment_thumb_path)) {
                $image_editor = wp_get_image_editor($attachment_path);
                if (!is_wp_error($image_editor) && !is_wp_error($image_editor->resize($thegem_image_sizes[$size][0], $thegem_image_sizes[$size][1], $thegem_image_sizes[$size][2]))) {
        			$attachment_resized = $image_editor->save($attachment_thumb_path);
                    if (!is_wp_error($attachment_resized) && $attachment_resized) {
                        do_action('thegem_thumbnail_generated', array('/'._wp_relative_upload_path($attachment_thumb_path)));
                        return thegem_build_image_result($attachment_resized['path'], $attachment_resized['width'], $attachment_resized['height']);
            		} else {
                        return thegem_build_image_data($attachment_path);
                    }
                } else {
                    return thegem_build_image_data($attachment_path);
                }
    		}
            return thegem_build_image_data($attachment_thumb_path);
    	}
    	return wp_get_attachment_image_src($attachment_id, $size);
    }

    function thegem_build_image_data($path) {
        $editor = new TheGem_Dummy_WP_Image_Editor($path);
        $size = $editor->get_size();
        if (!$size) {
            return null;
        }
        return thegem_build_image_result($path, $size['width'], $size['height']);
    }

    function thegem_image_cache_get($attachment_id, $size) {
        global $thegem_image_src_cache, $thegem_image_regenerated;

    	if (!$thegem_image_src_cache) {
    		$thegem_image_src_cache = array();
    	}

        if (isset($thegem_image_regenerated[$attachment_id]) &&
                isset($thegem_image_src_cache[$attachment_id][$size]['time']) &&
                $thegem_image_regenerated[$attachment_id] >= $thegem_image_src_cache[$attachment_id][$size]['time']) {
            return false;
        }

        if (!empty($thegem_image_src_cache[$attachment_id][$size])) {
            $data = $thegem_image_src_cache[$attachment_id][$size];
            unset($data['time']);
    		return $data;
    	}
        return false;
    }

    function thegem_image_cache_set($attachment_id, $size, $data) {
        global $thegem_image_src_cache, $thegem_image_src_cache_changed;

    	if (!$thegem_image_src_cache) {
    		$thegem_image_src_cache = array();
    	}

        $data['time'] = time();
        $thegem_image_src_cache[$attachment_id][$size] = $data;
        $thegem_image_src_cache_changed = true;
    }

    function thegem_build_image_result($file, $width, $height) {
        $uploads = wp_upload_dir();
        $url = trailingslashit( $uploads['baseurl'] . '/' . _wp_get_attachment_relative_path( $file ) ) . basename( $file );
        return array($url, $width, $height);
    }

    function thegem_get_image_cache_option_key() {
        $url = preg_replace('%\?.*$%', '', $_SERVER['REQUEST_URI']);
        return 'thegem_image_cache_' . sha1($url);
    }

    function thegem_image_generator_cache_init() {
        global $thegem_image_src_cache, $thegem_image_src_cache_changed, $thegem_image_regenerated;

        $thegem_image_regenerated = get_option(thegem_get_image_regenerated_option_key());
    	$thegem_image_regenerated = !empty($thegem_image_regenerated) ? (array) $thegem_image_regenerated : array();

        $cache = get_option(thegem_get_image_cache_option_key());
        $thegem_image_src_cache = !empty($cache) ? (array) $cache : array();

        $uploads = wp_upload_dir();

        foreach ($thegem_image_src_cache as $attachment_id => $sizes) {
            if (!is_array($sizes)) {
                continue;
            }
            foreach ($sizes as $size => $size_data) {
                if (!is_array($size_data) || empty($size_data[0])) {
                    continue;
                }
                $thegem_image_src_cache[$attachment_id][$size][0] = $uploads['baseurl'] . $size_data[0];
            }
        }
        $thegem_image_src_cache_changed = false;
    }
    add_action('init', 'thegem_image_generator_cache_init');

    function thegem_image_generator_cache_save() {
        global $thegem_image_src_cache, $thegem_image_src_cache_changed;

        if (is_404() || !isset($thegem_image_src_cache_changed) || !$thegem_image_src_cache_changed) {
            return;
        }

        $uploads = wp_upload_dir();

        foreach ($thegem_image_src_cache as $attachment_id => $sizes) {
            if (!is_array($sizes)) {
                continue;
            }
            foreach ($sizes as $size => $size_data) {
                if (!is_array($size_data) || empty($size_data[0])) {
                    continue;
                }
                $thegem_image_src_cache[$attachment_id][$size][0] = str_replace($uploads['baseurl'], '', $size_data[0]);
            }
        }

        update_option(thegem_get_image_cache_option_key(), $thegem_image_src_cache);
    }
    add_action('wp_footer', 'thegem_image_generator_cache_save', 9999);

}

?>
