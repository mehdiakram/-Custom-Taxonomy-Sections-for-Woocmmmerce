// Custom Taxonomy Sections for Woocmmmerce
add_action( 'init', 'product_taxonomy_section', 0 );
function product_taxonomy_section()  {
$labels = array(
    'name'                       => 'Sections',
    'singular_name'              => 'Section',
    'menu_name'                  => 'Sections',
    'all_items'                  => 'All Sections',
    'parent_item'                => 'Parent Section',
    'parent_item_colon'          => 'Parent Section:',
    'new_item_name'              => 'New Section Name',
    'add_new_item'               => 'Add New Section',
    'edit_item'                  => 'Edit Section',
    'update_item'                => 'Update Section',
    'separate_items_with_commas' => 'Separate Section with commas',
    'search_items'               => 'Search Sections',
    'add_or_remove_items'        => 'Add or remove Sections',
    'choose_from_most_used'      => 'Choose from the most used Sections',
);
$args = array(
    'labels'                     => $labels,
    'hierarchical'               => true,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => true,
);
register_taxonomy( 'product_section', 'product', $args );
register_taxonomy_for_object_type( 'product_section', 'product' );

}





add_filter( 'manage_product_posts_columns', 'set_custom_edit_product_columns' );
function set_custom_edit_product_columns( $columns ) {
  unset($columns['taxonomy-product_section']);
  $columns['product_section'] = 'Sections';
  return $columns;
}


add_action( 'manage_product_posts_custom_column' , 'custom_product_column', 10, 2 );
function custom_product_column( $column, $post_id ) {
  switch ( $column ) {
    // display a list of the custom taxonomy terms assigned to the post 
    case 'product_section' :
      $terms = get_the_term_list( $post_id , 'product_section' , '' , ', ' , '' );
      echo is_string( $terms ) ? $terms : '—';
      break;

  }
}


add_filter( 'manage_edit-product_sortable_columns', 'section_sortable_columns' );
function section_sortable_columns( $columns ) {
  $columns['product_section'] = 'product_section';
  return $columns;
}
// Custom Taxonomy Sections for Woocmmmerce
