<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
<style>
    /* Add your custom styles here */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    .admin_stock_page img {
        height: 50px;
        width: 50px;
    }

    @media screen and (max-width: 600px) {
        table {
            border: 1px solid #ddd;
        }

        th,
        td {
            display: block;
            width: 100%;
            box-sizing: border-box;
        }

        th {
            text-align: left;
        }
    }
</style>
<!-- </head>
<body> -->

<h2>Stock Information</h2>
<table class="admin_stock_page">
    <thead>
        <tr>
            <th>No</th>
            <th>Image</th>
            <th>Product Name</th>
            <th>Category</th>
            <th>Available Stock</th>
            <th>Price</th>
            <th>Purchased Price</th>
            <th>Sold</th>
            <th>Damage</th>
            <th>Sell Value</th>
        </tr>
    </thead>
    <tbody>

        <?php
        $paged = isset($_GET['paged']) ? $_GET['paged'] : 1;
        $args = array(
            'post_type'      => 'product',
            'posts_per_page' => 10,
            'paged'          => $paged, // Get the current page number

        );

        $products = new WP_Query($args);

        if ($products->have_posts()) :

            $counter = 1;
            while ($products->have_posts()) : $products->the_post();
                $product_id = get_the_ID();
                $categories = get_the_terms(get_the_ID(), 'product_cat');
                $available_stock = get_post_meta(get_the_ID(), '_stock', true);
                $total_sales = get_post_meta(get_the_ID(), 'total_sales', true);
                $product_price = get_post_meta($product_id, '_price', true);
             
             
                $available_stock = isset($available_stock) ? intval($available_stock) : 0; // Convert to integer and set to 0 if not set
                $product_price = isset($product_price) ? floatval($product_price) : 0.0; // Convert to float and set to 0.0 if not set

                // Perform the calculation
                $total_sale_value = $available_stock * $product_price;

                // total damage 
                global $wpdb;
                $table_name = $wpdb->prefix . 'product_damage';
                $query = $wpdb->prepare("SELECT SUM(number) as total_amount FROM $table_name WHERE product_id = %d", $product_id);
                $total_damage = $wpdb->get_var($query);

        ?>

                <tr>
                    <td><?php echo $counter; ?></td>
                    <td><img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title() ?>"></td>
                    <td><?php the_title() ?></td>

                    <td>

                        <?php
                        $categoryNames = [];

                        if ($categories) {
                            foreach ($categories as $category) {
                                if ($category->name !== 'Uncategorized') {
                                    $categoryNames[] = $category->name;
                                }
                            }
                        }

                        echo implode(' | ', $categoryNames);
                        ?>
                    </td>
                
                    <td><?php echo $available_stock; ?> </td>
                    <td> 
                        <?php echo get_woocommerce_currency_symbol();  ?>
                        <?php echo get_post_meta(get_the_ID(), '_price', true); ?>
                    </td>
                    <td>
                        <?php echo get_woocommerce_currency_symbol();  ?>
                        <?php echo get_post_meta(get_the_ID(), '_purchase_price', true) ?>
                   </td>
                    <td><?php echo $total_sales; ?></td>
                    <td><?php echo $total_damage; ?></td>
                    <td>
                       <?php echo get_woocommerce_currency_symbol();  ?>
                        <?php echo $total_sale_value; ?>
                    </td>
                </tr>


        <?php
                $counter++;
            endwhile;



            wp_reset_postdata();
        else :
            echo 'No products found';
        endif;
        ?>

    </tbody>
</table>


<?php 

    // Pagination start
    $pagination_args = array(
        'base' => add_query_arg('paged', '%#%'),
        'format' => '',
        'current' => max(1, $paged),
        'total' => $products->max_num_pages,
      );
  
      echo paginate_links($pagination_args);
    // Pagination end
    
    
?>


