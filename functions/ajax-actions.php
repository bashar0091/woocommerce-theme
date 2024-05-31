<?php


add_action('wp_ajax_filter_products', 'filter_products');
add_action('wp_ajax_nopriv_filter_products', 'filter_products');


function filter_products()
{
    $args = [
        'post_type'      => 'product',
        'posts_per_page' => -1,
    ];

    $cat_type = isset($_REQUEST['cat']) ? $_REQUEST['cat'] : '';


    if (!empty($cat_type)) {
        $args['tax_query'][] = [
            'taxonomy' => 'product_cat',
            'field'    => 'slug',
            'terms'    => $cat_type,
        ];
    }

    $products = new WP_Query($args);


    if ($products->have_posts()) {
        while ($products->have_posts()) {
            $products->the_post();

            $product = wc_get_product();

?>
            <div class="product-item">
                <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">

                <p class="product-name"><?php the_title(); ?></p>
                <p class="product-sku">SKU: <?php echo esc_html($product->get_sku()); ?></p>
                <p class="product-price"><?php echo get_post_meta(get_the_ID(), '_price', true) . ' $'; ?></p>
            </div>

        <?php


        }
        wp_reset_postdata();
    } else {
        echo "Product Not Found";
    }


    wp_die();
}




add_action('wp_ajax_add_products', 'add_products');
add_action('wp_ajax_nopriv_add_products', 'add_products');

function add_products()
{

    $productSku = isset($_REQUEST['productSku']) ? sanitize_text_field($_REQUEST['productSku']) : '';
    $customarName = isset($_REQUEST['customarName']) ? sanitize_text_field($_REQUEST['customarName']) : '';
    $orderDate = isset($_REQUEST['orderDate']) ? sanitize_text_field($_REQUEST['orderDate']) : '';


    $productId = wc_get_product_id_by_sku($productSku);
    $product = wc_get_product($productId);

    if ($product) {
        ?>

        <tr class="product-row" data-product-id="<?php echo $productId; ?>">
            <td>1</td>
            <td> <img src="<?php echo get_the_post_thumbnail_url($productId); ?>" alt="<?php echo get_the_title($productId); ?>"></td>
            <td><?php echo get_the_title($productId); ?></td>

            <td>
                <input type="number" name="product_quantity" class="product-quantity" value="1" min="1" data-product-price="<?php echo $product->get_price(); ?>">
            </td>


            <td><?php echo wc_price($product->get_price()); ?></td>

            <td class="total_price"><?php echo wc_price($product->get_price() * 1); ?></td>
        </tr>

<?php
    }

    wp_die();
}


add_action('wp_ajax_update_total_price', 'update_total_price');
add_action('wp_ajax_nopriv_update_total_price', 'update_total_price');

function update_total_price() {
    $productId = isset($_REQUEST['productId']) ? sanitize_text_field($_REQUEST['productId']) : '';
    $totalPrice = isset($_REQUEST['totalPrice']) ? sanitize_text_field($_REQUEST['totalPrice']) : '';

    echo wc_price($totalPrice);

    wp_die();
}




add_action('wp_ajax_search_product_for_purchase', 'search_product_for_purchase');
add_action('wp_ajax_nopriv_search_product_for_purchase', 'search_product_for_purchase');

function search_product_for_purchase() {
    $product_sku = isset($_REQUEST['product_sku']) ? sanitize_text_field($_REQUEST['product_sku']) : '';

    $product_id = wc_get_product_id_by_sku($product_sku);
    $product_name = get_the_title($product_id);
    $purchase_price = get_post_meta($product_id, '_purchase_price', true);

    $response = array();

    if ($product_name) {
        $response['product_name'] = $product_name;
        $response['purchase_price'] = $purchase_price;
        $response['product_id'] = $product_id;
        wp_send_json($response);
    } else {
        wp_send_json(array('error' => 'No Product Found'));
    }

    wp_die();
}






add_action('wp_ajax_purchase_product', 'purchase_product');
add_action('wp_ajax_nopriv_purchase_product', 'purchase_product');


function purchase_product()
{




    $formFields = [];
    wp_parse_str($_POST['purchase_product'], $formFields); 



    $originalArray = $formFields ;
    require_once(ABSPATH . 'wp-load.php');

    global $wpdb;
    


$last_bill_no = $wpdb->get_var("SELECT MAX(CAST(bill_no AS UNSIGNED)) FROM {$wpdb->prefix}woo_purchase_orders");
if(!empty($last_bill_no)){
    $new_bill_no = $last_bill_no + 1;
}else{
    $new_bill_no = '00000001';
}
// Increment the last bill_no by 1






    // Table name
    $table_name = $wpdb->prefix . 'woo_purchase_order_items';
    $data_to_insert = array();
    for ($i = 0; $i < count($originalArray['productid']); $i++) {
        $data_to_insert[] = array(
            'product_id' => $originalArray['productid'][$i],
            'rate' => $originalArray['rate'][$i],
            'quantity' => $originalArray['quantity'][$i],
            'subtotal' => $originalArray['subtotal'][$i],
            'date' => $originalArray['purchase_date'],
            'bill_no' => $new_bill_no ,
            // Assuming same purchase date for all products
            // 'note' => $originalArray['note'], // You can set note if needed
            // 'supplier_id' => $originalArray['supplier'], 
            // 'payable' => $originalArray['payable'], 
            // 'paid' => $originalArray['paid'], 
            // 'due' => $originalArray['due'], 
        );
    }
    
    // Insert data into the database
    foreach ($data_to_insert as $data) {

        $wpdb->insert($table_name, $data);
        $product_id = $data['product_id'] ;
        $quantity_to_add = $data['quantity'] ;
        $product = wc_get_product($product_id);
        $current_stock = $product->get_stock_quantity();
        $new_stock = $current_stock + $quantity_to_add;   
        
        // $current_stock = get_post_meta($product_id, '_stock', true);

        // // Calculate the new stock quantity
        // $new_stock = $current_stock + $quantity_to_add;
    
        // Update the stock quantity meta field
        update_post_meta($product_id, '_stock', $new_stock);

    }

        $table_name_2 =  $wpdb->prefix . 'woo_purchase_orders';  
        $purchase_order_data = array( 
            'bill_no' => $new_bill_no,
            'payable' => $originalArray['payable'], 
            'paid' => $originalArray['paid'], 
            'due' => $originalArray['due'], 
            'note' => $originalArray['note'], // You can set note if needed
            'supplier_id' => $originalArray['supplier'], 
            'date' => $originalArray['purchase_date'], // Assuming same purchase date for all products
            
        );
    

    $wpdb->insert($table_name_2, $purchase_order_data); 
    if ($wpdb->last_error) {
        echo "Error: " . $wpdb->last_error;
    } 

    wp_die() ; 



}
