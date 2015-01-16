<?php

final class WOOF_HELPER {

    public static function get_terms($taxonomy, $hide_empty = true, $get_childs = true, $selected = 0, $category_parent = 0) {
        $cats_objects = get_categories(array(
            'orderby' => 'name',
            'order' => 'ASC',
            'style' => 'list',
            'show_count' => 0,
            'hide_empty' => $hide_empty,
            'use_desc_for_title' => 1,
            'child_of' => 0,
            'hierarchical' => true,
            'title_li' => '',
            'show_option_none' => '',
            'number' => NULL,
            'echo' => 0,
            'depth' => 0,
            'current_category' => $selected,
            'pad_counts' => 0,
            'taxonomy' => $taxonomy,
            'walker' => 'Walker_Category'));

        $cats = array();
        if (!empty($cats_objects)) {
            foreach ($cats_objects as $value) {
                if (is_object($value) AND $value->category_parent == $category_parent) {
                    $cats[$value->term_id] = array();
                    $cats[$value->term_id]['term_id'] = $value->term_id;
                    $cats[$value->term_id]['slug'] = $value->slug;
                    $cats[$value->term_id]['taxonomy'] = $value->taxonomy;
                    $cats[$value->term_id]['name'] = $value->name;
                    $cats[$value->term_id]['count'] = $value->count;
                    if ($get_childs) {
                        $cats[$value->term_id]['childs'] = self::assemble_terms_childs($cats_objects, $value->term_id);
                    }
                }
            }
        }
        return $cats;
    }

    //just for get_terms
    private static function assemble_terms_childs($cats_objects, $parent_id) {
        $res = array();
        foreach ($cats_objects as $value) {
            if ($value->category_parent == $parent_id) {
                $res[$value->term_id]['term_id'] = $value->term_id;
                $res[$value->term_id]['name'] = $value->name;
                $res[$value->term_id]['slug'] = $value->slug;
                $res[$value->term_id]['count'] = $value->count;
                $res[$value->term_id]['taxonomy'] = $value->taxonomy;
                $res[$value->term_id]['childs'] = self::assemble_terms_childs($cats_objects, $value->term_id);
            }
        }

        return $res;
    }

}
