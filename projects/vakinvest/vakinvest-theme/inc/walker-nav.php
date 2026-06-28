<?php
defined('ABSPATH') || exit;

class VakInvest_Walker_Nav extends Walker_Nav_Menu {

    public function start_lvl(&$output, $depth = 0, $args = null) {
        $output .= '<ul class="dropdown-menu">';
    }

    public function end_lvl(&$output, $depth = 0, $args = null) {
        $output .= '</ul>';
    }

    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $classes      = (array) $item->classes;
        $has_children = in_array('menu-item-has-children', $classes, true);
        $is_current   = in_array('current-menu-item', $classes, true)
                     || in_array('current-menu-ancestor', $classes, true);

        $li_classes = implode(' ', array_filter(array_map('trim', $classes)));
        $output    .= '<li class="' . esc_attr($li_classes) . '">';

        $url    = esc_url(!empty($item->url) ? $item->url : '#');
        $title  = apply_filters('the_title', $item->title, $item->ID);
        $target = !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $noopen = ($item->target === '_blank') ? ' rel="noopener noreferrer"' : '';

        $output .= '<a href="' . $url . '"' . $target . $noopen . '>';
        $output .= esc_html($title);
        if ($has_children && $depth === 0) {
            $output .= ' <span class="dropdown-arrow" aria-hidden="true">▾</span>';
        }
        $output .= '</a>';
    }

    public function end_el(&$output, $item, $depth = 0, $args = null) {
        $output .= '</li>';
    }
}
