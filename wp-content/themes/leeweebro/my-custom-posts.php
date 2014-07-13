<?php 
	function add_post_type($name, $args = array()){
		add_action('init', function() use($name, $args) {
			$upper = ucwords($name);
			$name = strtolower($name);

			$category = array();


			$args = array_merge(array(
				'public' => true,
				'label' => "$upper",
				'labels' => array('add_new_item' => "Add New $upper"), #learn more at codex
				'supports' => array('title','editor','comments'), #learn more about thumbnail
				'taxonomies' => $category
			), $args);

			register_post_type($name, $args);
		});
	}

	# create new taxonomy #
	function add_taxonomy($name, $post_type, $args = array()){
		$name = strtolower(str_replace(' ', '_', $name));

		add_action('init', function() use($name, $post_type, $args) {# name of taxonomy, associated post type, options
			$args = array_merge(array(
				'label' => ucwords($name)
			), $args);

			register_taxonomy($name, $post_type, $args);
		});
	}
?>