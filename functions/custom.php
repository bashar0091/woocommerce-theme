<?php


// Register Custom Post Type
function custom_supplier_post_type() {

    $labels = array(
        'name'                  => _x( 'Suppliers', 'Post Type General Name', 'text_domain' ),
        'singular_name'         => _x( 'Supplier', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'             => __( 'Suppliers', 'text_domain' ),
        'name_admin_bar'        => __( 'Supplier', 'text_domain' ),
        'archives'              => __( 'Supplier Archives', 'text_domain' ),
        'attributes'            => __( 'Supplier Attributes', 'text_domain' ),
        'parent_item_colon'     => __( 'Parent Supplier:', 'text_domain' ),
        'all_items'             => __( 'All Suppliers', 'text_domain' ),
        'add_new_item'          => __( 'Add New Supplier', 'text_domain' ),
        'add_new'               => __( 'Add New', 'text_domain' ),
        'new_item'              => __( 'New Supplier', 'text_domain' ),
        'edit_item'             => __( 'Edit Supplier', 'text_domain' ),
        'update_item'           => __( 'Update Supplier', 'text_domain' ),
        'view_item'             => __( 'View Supplier', 'text_domain' ),
        'view_items'            => __( 'View Suppliers', 'text_domain' ),
        'search_items'          => __( 'Search Supplier', 'text_domain' ),
        'not_found'             => __( 'Supplier Not found', 'text_domain' ),
        'not_found_in_trash'    => __( 'Supplier Not found in Trash', 'text_domain' ),
        'featured_image'        => __( 'Featured Image', 'text_domain' ),
        'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
        'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
        'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
        'insert_into_item'      => __( 'Insert into supplier', 'text_domain' ),
        'uploaded_to_this_item' => __( 'Uploaded to this supplier', 'text_domain' ),
        'items_list'            => __( 'Suppliers list', 'text_domain' ),
        'items_list_navigation' => __( 'Suppliers list navigation', 'text_domain' ),
        'filter_items_list'     => __( 'Filter suppliers list', 'text_domain' ),
    );
    $args = array(
        'label'                 => __( 'Supplier', 'text_domain' ),
        'description'           => __( 'Supplier Description', 'text_domain' ),
        'supports'              => array( 'title', 'thumbnail' ),
        'labels'                => $labels,
        
        // 'taxonomies'            => array( 'category' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
        'show_in_rest'          => true,
    );
    register_post_type( 'supplier', $args );

}
add_action( 'init', 'custom_supplier_post_type', 0 );



// brands taxonomy function  

function create_product_brand_taxonomy()
{
    $labels = array(
        'name'              => _x('Brands', 'taxonomy general name', 'textdomain'),
        'singular_name'     => _x('Brand', 'taxonomy singular name', 'textdomain'),
        'search_items'      => __('Search Brands', 'textdomain'),
        'all_items'         => __('All Brands', 'textdomain'),
        'parent_item'       => __('Parent Brand', 'textdomain'),
        'parent_item_colon' => __('Parent Brand:', 'textdomain'),
        'edit_item'         => __('Edit Brand', 'textdomain'),
        'update_item'       => __('Update Brand', 'textdomain'),
        'add_new_item'      => __('Add New Brand', 'textdomain'),
        'new_item_name'     => __('New Brand Name', 'textdomain'),
        'menu_name'         => __('Brands', 'textdomain'),
    );

    $args = array(
        'labels'            => $labels,
        'hierarchical'      => true,  // Set this to true if you want a hierarchical taxonomy like categories
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'product_brand'),  // Change 'product_brand' to your desired slug
    );

    register_taxonomy('product_brand', 'product', $args);
}

add_action('init', 'create_product_brand_taxonomy');





// Register Custom Post Type
function register_expense_post_type()
{
    $labels = array(
        'name'               => _x('Expenses', 'post type general name', 'textdomain'),
        'singular_name'      => _x('Expense', 'post type singular name', 'textdomain'),
        'menu_name'          => _x('Expenses', 'admin menu', 'textdomain'),
        'name_admin_bar'     => _x('Expense', 'add new on admin bar', 'textdomain'),
        'add_new'            => _x('Add New', 'expense', 'textdomain'),
        'add_new_item'       => __('Add New Expense', 'textdomain'),
        'new_item'           => __('New Expense', 'textdomain'),
        'edit_item'          => __('Edit Expense', 'textdomain'),
        'view_item'          => __('View Expense', 'textdomain'),
        'all_items'          => __('All Expenses', 'textdomain'),
        'search_items'       => __('Search Expenses', 'textdomain'),
        'parent_item_colon'  => __('Parent Expenses:', 'textdomain'),
        'not_found'          => __('No expenses found.', 'textdomain'),
        'not_found_in_trash' => __('No expenses found in Trash.', 'textdomain'),
    );

    $args = array(
        'labels'             => $labels,
        'description'        => __('Description.', 'textdomain'),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'expense'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array('title'),
    );

    register_post_type('expense', $args);
}
add_action('init', 'register_expense_post_type');

// Register Custom Taxonomy
function register_expense_category_taxonomy()
{
    $labels = array(
        'name'                       => _x('Expense Categories', 'taxonomy general name', 'textdomain'),
        'singular_name'              => _x('Expense Category', 'taxonomy singular name', 'textdomain'),
        'search_items'               => __('Search Expense Categories', 'textdomain'),
        'popular_items'              => __('Popular Expense Categories', 'textdomain'),
        'all_items'                  => __('All Expense Categories', 'textdomain'),
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => __('Edit Expense Category', 'textdomain'),
        'update_item'                => __('Update Expense Category', 'textdomain'),
        'add_new_item'               => __('Add New Expense Category', 'textdomain'),
        'new_item_name'              => __('New Expense Category Name', 'textdomain'),
        'separate_items_with_commas' => __('Separate expense categories with commas', 'textdomain'),
        'add_or_remove_items'        => __('Add or remove expense categories', 'textdomain'),
        'choose_from_most_used'      => __('Choose from the most used expense categories', 'textdomain'),
        'not_found'                  => __('No expense categories found.', 'textdomain'),
        'menu_name'                  => __('Expense Categories', 'textdomain'),
    );

    $args = array(
        'hierarchical'          => true,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'query_var'             => true,
        'rewrite'               => array('slug' => 'expense-category'),
    );

    register_taxonomy('expense_category', 'expense', $args);
}
add_action('init', 'register_expense_category_taxonomy');


