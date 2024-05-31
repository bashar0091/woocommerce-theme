<?php 



// Remove admin menu 
function remove_tools_menu()
{
    remove_menu_page('tools.php');
    remove_menu_page('edit-comments.php'); // Remove Comments menu
}
add_action('admin_menu', 'remove_tools_menu');


// Add Stocks menu to the dashboard
function add_stocks_menu()
{
    add_menu_page(
        'Stocks',           // Page title
        'Stocks',           // Menu title
        'manage_options',   // Capability required to access the menu
        'stocks_page',      // Menu slug
        'stocks_page_content', // Callback function to display page content
        'dashicons-chart-bar', // Icon for the menu (optional)
        20                  // Menu position (adjust as needed)
    );
}
add_action('admin_menu', 'add_stocks_menu');


// Add Stocks menu to the dashboard
function add_purchase_menu()
{
    add_menu_page(
        'Purchase',           // Page title
        'Purchase',           // Menu title
        'manage_options',   // Capability required to access the menu
        'purchase_page',      // Menu slug
        'purchase_page_content', // Callback function to display page content
        'dashicons-chart-bar', // Icon for the menu (optional)
        21                  // Menu position (adjust as needed)
    );

    // Add submenu
    add_submenu_page(
        'purchase_page',     // Parent menu slug
        'Add New Purchase',   // Page title
        'Add New Purchase',   // Menu title
        'manage_options',   // Capability required to access the submenu
        'add_new_purchase',   // Submenu slug
        'add_new_purchase_content' // Callback function to display submenu content
    );
}
add_action('admin_menu', 'add_purchase_menu');




// Add return menu to the dashboard
function add_return_menu()
{
    add_menu_page(
        'Return',           // Page title
        'Return',           // Menu title
        'manage_options',   // Capability required to access the menu
        'return_page',      // Menu slug
        'return_page_content', // Callback function to display page content
        'dashicons-chart-bar', // Icon for the menu (optional)
        21                  // Menu position (adjust as needed)
    );
}
add_action('admin_menu', 'add_return_menu');



// Add return menu to the dashboard
function add_damage_menu()
{
    add_menu_page(
        'Damage',           // Page title
        'Damage',           // Menu title
        'manage_options',   // Capability required to access the menu
        'damage_page',      // Menu slug
        'damage_page_content', // Callback function to display page content
        'dashicons-chart-bar', // Icon for the menu (optional)
        23                // Menu position (adjust as needed)
    );

    // Add submenu
    add_submenu_page(
        'damage_page',     // Parent menu slug
        'Add New Damage',   // Page title
        'Add New Damage',   // Menu title
        'manage_options',   // Capability required to access the submenu
        'add_new_damage',   // Submenu slug
        'add_new_damage_content' // Callback function to display submenu content
    );
}
add_action('admin_menu', 'add_damage_menu');


// Add return menu to the dashboard
function add_pos_menu()
{
    add_menu_page(
        'Pos',           // Page title
        'Pos',           // Menu title
        'manage_options',   // Capability required to access the menu
        'pos_page',      // Menu slug
        'pos_page_content', // Callback function to display page content
        'dashicons-chart-bar', // Icon for the menu (optional)
        21                  // Menu position (adjust as needed)
    );
}
add_action('admin_menu', 'add_pos_menu');

// Current month report 
function add_current_report_menu()
{
    add_menu_page(
        'Report',           // Page title
        'Report',           // Menu title
        'manage_options',   // Capability required to access the menu
        'todays_report',      // Menu slug
        'todays_report_content', // Callback function to display page content
        'dashicons-chart-bar', // Icon for the menu (optional)
        28                 // Menu position (adjust as needed)
    );

    // Add submenu
    add_submenu_page(
        'todays_report',     // Parent menu slug
        'Current Month Report',   // Page title
        'Current Month Report',   // Menu title
        'manage_options',   // Capability required to access the submenu
        'current_month_report',   // Submenu slug
        'current_month_report_content' // Callback function to display submenu content
    );

       // Add submenu
       add_submenu_page(
        'todays_report',     // Parent menu slug
        'Summary Report',   // Page title
        'Summary Report',   // Menu title
        'manage_options',   // Capability required to access the submenu
        'summary_report',   // Submenu slug
        'summary_report_content' // Callback function to display submenu content
    );


}
add_action('admin_menu', 'add_current_report_menu');




// Add return menu to the dashboard
function add_test_menu()
{
    add_menu_page(
        'Test Menu',           // Page title
        'Test Menu',           // Menu title
        'manage_options',   // Capability required to access the menu
        'test_menu',      // Menu slug
        'test_page_content', // Callback function to display page content
        'dashicons-chart-bar', // Icon for the menu (optional)
        21                  // Menu position (adjust as needed)
    );
}
add_action('admin_menu', 'add_test_menu');




// Callback function for Stocks page content
function stocks_page_content()
{
    include(get_template_directory() . '/templates/product-stock.php');
}

// Callback function for Stocks page content
function purchase_page_content()
{
    include(get_template_directory() . '/templates/product-purchase.php');
}


// Callback function for Stocks page content
function return_page_content()
{
    include(get_template_directory() . '/templates/product-return.php');
}

// Callback function for damage page content
function damage_page_content()
{
    include(get_template_directory() . '/templates/product-damage.php');
}

// Callback function for damage page content
function add_new_damage_content()
{
    include(get_template_directory() . '/templates/product-add-damage.php');
}

// Callback function for purchase page content
function add_new_purchase_content()
{
    include(get_template_directory() . '/templates/product-add-purchase.php');
}

// Callback function for purchase page content
function customers_page_content()
{
    include(get_template_directory() . '/templates/customer-page.php');
}

// Callback function for purchase page content
function add_new_customer_content()
{
    include(get_template_directory() . '/templates/add-customer.php');
}


// Callback function for purchase page content
function add_new_supplier_content()
{
    include(get_template_directory() . '/templates/add-supplier.php');
}

// Callback function for purchase page content
function pos_page_content()
{
    include(get_template_directory() . '/templates/add-pos.php');
}



// Callback function for todays report 
function todays_report_content()
{
    include(get_template_directory() . '/templates/reports/today-report.php');
}


// Callback function for Current month report 
function current_month_report_content()
{
    include(get_template_directory() . '/templates/reports/current-month-report.php');
}


// Callback function for Summary report 
function summary_report_content()
{
    include(get_template_directory() . '/templates/reports/summary-report.php');
}



// Callback function for Summary report 
function test_page_content()
{
    include(get_template_directory() . '/templates/test-page.php');
}

