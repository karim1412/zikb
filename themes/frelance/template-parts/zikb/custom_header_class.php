<?php
  class custom_header_class extends Walker_Nav_Menu
  {
    function start_el(&$output, $item, $depth, $args)
    {
      global $wp_query;
      $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

      $output .= $indent . '<li>';

      $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
      $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
      $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
    // if is home link
      if (is_front_page())
        $attributes .= ! empty( $item->url )        ? ' href="#'   . esc_attr( strtolower($item->title)        ) .'"' : '';
      else
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( home_url().'/#'.strtolower($item->title)        ) .'"' : '';

      $prepend = '<strong>';
      $append = '</strong>';
      $description  = ! empty( $item->description ) ? '<span>'.esc_attr( $item->description ).'</span>' : '';

      if($depth != 0)
      {
               $description = $append = $prepend = "";
      }

      $item_output = $args->before;
      $item_output .= '<a'. $attributes .'>';
      $item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
      $item_output .= $description.$args->link_after;
      $item_output .= '</a>';
      $item_output .= $args->after;

      $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
  }