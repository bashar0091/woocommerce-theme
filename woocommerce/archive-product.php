<?php
defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

$banner_img = get_template_directory_uri().'/images/shop/shop_banner_2.png';

$get_cat =  get_queried_object();

$product_categories = get_terms(array(
  'taxonomy'   => 'product_cat',
  'hide_empty' => false,
));

function page_heading() {
  if ( apply_filters( 'woocommerce_show_page_title', true ) ) {
    return woocommerce_page_title();
  }
}
?>
<main style="padding-top: 90px;">
    <section class="full-width_padding">
        <div class="full-width_border border-2" style="border-color: #f5e6e0;">
            <div class="shop-banner position-relative">
                <div class="background-img" style="background-color: #f5e6e0;">
                    <img loading="lazy" src="<?= $banner_img;?>" width="1759" height="420" alt="Pattern" class="slideshow-bg__img object-fit-cover" />
                </div>

                <div class="shop-banner__content container position-absolute start-50 top-50 translate-middle">
                  <h2 class="h1 text-uppercase text-center fw-bold mb-3 mb-xl-4 mb-xl-5">
                    <?php 
                      page_heading();
                    ?>
                  </h2>
                  
                  <?php 
                  if (!empty($product_categories) && !is_wp_error($product_categories)) {
                    ?>
                    <ul class="d-flex justify-content-center flex-wrap list-unstyled text-uppercase h6">
                      <?php
                      foreach ($product_categories as $key=>$category) {
                        $category_link = get_term_link($category);
                        if($category->slug == 'uncategorized') {
                          continue;
                        }

                        $is_active = '';
                        if( !empty($get_cat->slug) && $get_cat->slug == $category->slug ) {
                          $is_active = 'menu-link_active';
                        }
                        ?>
                          <li class="me-3 me-xl-4 pe-1"><a href="<?= esc_url($category_link);?>" class="menu-link menu-link_us-s <?= $is_active;?>"><?= esc_html($category->name);?></a></li>
                        <?php
                      }
                      ?>
                    </ul>
                    <?php
                  } else {
                    ?>
                    <p class="text-center">No product categories found.</p>
                    <?php
                  }
                  ?>
                    
                </div>
                <!-- /.shop-banner__content -->
            </div>
            <!-- /.shop-banner position-relative -->
        </div>
        <!-- /.full-width_border -->
    </section>
    <!-- /.full-width_padding-->

    <div class="mb-4 pb-lg-3"></div>

    <section class="shop-main container d-flex">
        <div class="shop-sidebar side-sticky bg-body" id="shopFilter" style="top: -0.444458px;">
            <div class="aside-header d-flex d-lg-none align-items-center">
                <h3 class="text-uppercase fs-6 mb-0">Filter By</h3>
                <button class="btn-close-lg js-close-aside btn-close-aside ms-auto"></button>
            </div>
            <!-- /.aside-header -->

            <div class="pt-4 pt-lg-0"></div>

            <?php 
            if (!empty($product_categories) && !is_wp_error($product_categories)) {
                ?>
                <div class="accordion" id="categories-list">
                    <div class="accordion-item mb-4 pb-3">
                        <h5 class="accordion-header" id="accordion-heading-11">
                            <button class="accordion-button p-0 border-0 fs-5 text-uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-filter-1" aria-expanded="true" aria-controls="accordion-filter-1">
                                Product Categories
                                <svg class="accordion-button__icon type2" viewBox="0 0 10 6" xmlns="http://www.w3.org/2000/svg">
                                    <g aria-hidden="true" stroke="none" fill-rule="evenodd">
                                        <path
                                            d="M5.35668 0.159286C5.16235 -0.053094 4.83769 -0.0530941 4.64287 0.159286L0.147611 5.05963C-0.0492049 5.27473 -0.049205 5.62357 0.147611 5.83813C0.344427 6.05323 0.664108 6.05323 0.860924 5.83813L5 1.32706L9.13858 5.83867C9.33589 6.05378 9.65507 6.05378 9.85239 5.83867C10.0492 5.62357 10.0492 5.27473 9.85239 5.06018L5.35668 0.159286Z"
                                        ></path>
                                    </g>
                                </svg>
                            </button>
                        </h5>
                        <div id="accordion-filter-1" class="accordion-collapse collapse show border-0" aria-labelledby="accordion-heading-11" data-bs-parent="#categories-list">
                            <div class="accordion-body px-0 pb-0 pt-3">
                                <ul class="list list-inline mb-0">
                                    <?php 
                                    foreach ($product_categories as $key=>$category) {

                                        $category_link = get_term_link($category);
                                        if($category->slug == 'uncategorized') {
                                            continue;
                                        }

                                        $is_active = '';
                                        if( !empty($get_cat->slug) && $get_cat->slug == $category->slug ) {
                                        $is_active = 'menu-link_active';
                                        }
                                        ?>
                                        <li class="list-item active">
                                            <a href="<?= $category_link;?>" class="menu-link py-1 menu-link_us-s <?= $is_active;?>"><?= esc_html($category->name);?></a>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /.accordion-item -->
                </div>
                <?php
            }
            ?>
            <!-- /.accordion-item -->

            <div class="accordion" id="color-filters">
                <div class="accordion-item mb-4 pb-3">
                    <h5 class="accordion-header" id="accordion-heading-1">
                        <button class="accordion-button p-0 border-0 fs-5 text-uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-filter-2" aria-expanded="true" aria-controls="accordion-filter-2">
                            Color
                            <svg class="accordion-button__icon type2" viewBox="0 0 10 6" xmlns="http://www.w3.org/2000/svg">
                                <g aria-hidden="true" stroke="none" fill-rule="evenodd">
                                    <path
                                        d="M5.35668 0.159286C5.16235 -0.053094 4.83769 -0.0530941 4.64287 0.159286L0.147611 5.05963C-0.0492049 5.27473 -0.049205 5.62357 0.147611 5.83813C0.344427 6.05323 0.664108 6.05323 0.860924 5.83813L5 1.32706L9.13858 5.83867C9.33589 6.05378 9.65507 6.05378 9.85239 5.83867C10.0492 5.62357 10.0492 5.27473 9.85239 5.06018L5.35668 0.159286Z"
                                    ></path>
                                </g>
                            </svg>
                        </button>
                    </h5>
                    <div id="accordion-filter-2" class="accordion-collapse collapse show border-0" aria-labelledby="accordion-heading-1" data-bs-parent="#color-filters">
                        <div class="accordion-body px-0 pb-0">
                            <div class="d-flex flex-wrap">
                                <a href="#" class="swatch-color js-filter" style="color: #0a2472;"></a>
                                <a href="#" class="swatch-color js-filter" style="color: #d7bb4f;"></a>
                                <a href="#" class="swatch-color js-filter" style="color: #282828;"></a>
                                <a href="#" class="swatch-color js-filter" style="color: #b1d6e8;"></a>
                                <a href="#" class="swatch-color js-filter" style="color: #9c7539;"></a>
                                <a href="#" class="swatch-color js-filter" style="color: #d29b48;"></a>
                                <a href="#" class="swatch-color js-filter" style="color: #e6ae95;"></a>
                                <a href="#" class="swatch-color js-filter" style="color: #d76b67;"></a>
                                <a href="#" class="swatch-color swatch_active js-filter" style="color: #bababa;"></a>
                                <a href="#" class="swatch-color js-filter" style="color: #bfdcc4;"></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.accordion-item -->
            </div>
            <!-- /.accordion -->

            <div class="accordion" id="size-filters">
                <div class="accordion-item mb-4 pb-3">
                    <h5 class="accordion-header" id="accordion-heading-size">
                        <button class="accordion-button p-0 border-0 fs-5 text-uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-filter-size" aria-expanded="true" aria-controls="accordion-filter-size">
                            Sizes
                            <svg class="accordion-button__icon type2" viewBox="0 0 10 6" xmlns="http://www.w3.org/2000/svg">
                                <g aria-hidden="true" stroke="none" fill-rule="evenodd">
                                    <path
                                        d="M5.35668 0.159286C5.16235 -0.053094 4.83769 -0.0530941 4.64287 0.159286L0.147611 5.05963C-0.0492049 5.27473 -0.049205 5.62357 0.147611 5.83813C0.344427 6.05323 0.664108 6.05323 0.860924 5.83813L5 1.32706L9.13858 5.83867C9.33589 6.05378 9.65507 6.05378 9.85239 5.83867C10.0492 5.62357 10.0492 5.27473 9.85239 5.06018L5.35668 0.159286Z"
                                    ></path>
                                </g>
                            </svg>
                        </button>
                    </h5>
                    <div id="accordion-filter-size" class="accordion-collapse collapse show border-0" aria-labelledby="accordion-heading-size" data-bs-parent="#size-filters">
                        <div class="accordion-body px-0 pb-0">
                            <div class="d-flex flex-wrap">
                                <a href="#" class="swatch-size btn btn-sm btn-outline-light mb-3 me-3 js-filter">XS</a>
                                <a href="#" class="swatch-size btn btn-sm btn-outline-light mb-3 me-3 js-filter">S</a>
                                <a href="#" class="swatch-size btn btn-sm btn-outline-light mb-3 me-3 js-filter">M</a>
                                <a href="#" class="swatch-size btn btn-sm btn-outline-light mb-3 me-3 js-filter">L</a>
                                <a href="#" class="swatch-size btn btn-sm btn-outline-light mb-3 me-3 js-filter">XL</a>
                                <a href="#" class="swatch-size btn btn-sm btn-outline-light mb-3 me-3 js-filter">XXL</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.accordion-item -->
            </div>
            <!-- /.accordion -->

            <div class="accordion" id="brand-filters">
                <div class="accordion-item mb-4 pb-3">
                    <h5 class="accordion-header" id="accordion-heading-brand">
                        <button class="accordion-button p-0 border-0 fs-5 text-uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-filter-brand" aria-expanded="true" aria-controls="accordion-filter-brand">
                            Brands
                            <svg class="accordion-button__icon type2" viewBox="0 0 10 6" xmlns="http://www.w3.org/2000/svg">
                                <g aria-hidden="true" stroke="none" fill-rule="evenodd">
                                    <path
                                        d="M5.35668 0.159286C5.16235 -0.053094 4.83769 -0.0530941 4.64287 0.159286L0.147611 5.05963C-0.0492049 5.27473 -0.049205 5.62357 0.147611 5.83813C0.344427 6.05323 0.664108 6.05323 0.860924 5.83813L5 1.32706L9.13858 5.83867C9.33589 6.05378 9.65507 6.05378 9.85239 5.83867C10.0492 5.62357 10.0492 5.27473 9.85239 5.06018L5.35668 0.159286Z"
                                    ></path>
                                </g>
                            </svg>
                        </button>
                    </h5>
                    <div id="accordion-filter-brand" class="accordion-collapse collapse show border-0" aria-labelledby="accordion-heading-brand" data-bs-parent="#brand-filters">
                        <div class="search-field multi-select accordion-body px-0 pb-0">
                            <select class="d-none" multiple="" name="total-numbers-list">
                                <option value="1">Adidas</option>
                                <option value="2">Balmain</option>
                                <option value="3">Balenciaga</option>
                                <option value="4">Burberry</option>
                                <option value="5">Kenzo</option>
                                <option value="5">Givenchy</option>
                                <option value="5">Zara</option>
                            </select>
                            <div class="search-field__input-wrapper mb-3">
                                <input type="text" name="search_text" class="search-field__input form-control form-control-sm border-light border-2" placeholder="SEARCH" />
                            </div>
                            <ul class="multi-select__list list-unstyled">
                                <li class="search-suggestion__item multi-select__item text-primary js-search-select js-multi-select">
                                    <span class="me-auto">Adidas</span>
                                    <span class="text-secondary">2</span>
                                </li>
                                <li class="search-suggestion__item multi-select__item text-primary js-search-select js-multi-select">
                                    <span class="me-auto">Balmain</span>
                                    <span class="text-secondary">7</span>
                                </li>
                                <li class="search-suggestion__item multi-select__item text-primary js-search-select js-multi-select">
                                    <span class="me-auto">Balenciaga</span>
                                    <span class="text-secondary">10</span>
                                </li>
                                <li class="search-suggestion__item multi-select__item text-primary js-search-select js-multi-select">
                                    <span class="me-auto">Burberry</span>
                                    <span class="text-secondary">39</span>
                                </li>
                                <li class="search-suggestion__item multi-select__item text-primary js-search-select js-multi-select">
                                    <span class="me-auto">Kenzo</span>
                                    <span class="text-secondary">95</span>
                                </li>
                                <li class="search-suggestion__item multi-select__item text-primary js-search-select js-multi-select">
                                    <span class="me-auto">Givenchy</span>
                                    <span class="text-secondary">1092</span>
                                </li>
                                <li class="search-suggestion__item multi-select__item text-primary js-search-select js-multi-select">
                                    <span class="me-auto">Zara</span>
                                    <span class="text-secondary">48</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /.accordion-item -->
            </div>
            <!-- /.accordion -->

            <div class="accordion" id="price-filters">
                <div class="accordion-item mb-4">
                    <h5 class="accordion-header mb-2" id="accordion-heading-price">
                        <button class="accordion-button p-0 border-0 fs-5 text-uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-filter-price" aria-expanded="true" aria-controls="accordion-filter-price">
                            Price
                            <svg class="accordion-button__icon type2" viewBox="0 0 10 6" xmlns="http://www.w3.org/2000/svg">
                                <g aria-hidden="true" stroke="none" fill-rule="evenodd">
                                    <path
                                        d="M5.35668 0.159286C5.16235 -0.053094 4.83769 -0.0530941 4.64287 0.159286L0.147611 5.05963C-0.0492049 5.27473 -0.049205 5.62357 0.147611 5.83813C0.344427 6.05323 0.664108 6.05323 0.860924 5.83813L5 1.32706L9.13858 5.83867C9.33589 6.05378 9.65507 6.05378 9.85239 5.83867C10.0492 5.62357 10.0492 5.27473 9.85239 5.06018L5.35668 0.159286Z"
                                    ></path>
                                </g>
                            </svg>
                        </button>
                    </h5>
                    <div id="accordion-filter-price" class="accordion-collapse collapse show border-0" aria-labelledby="accordion-heading-price" data-bs-parent="#price-filters">
                        <div class="slider slider-horizontal" id="">
                            <div class="slider-track">
                                <div class="slider-track-low" style="left: 0px; width: 24.2424%;"></div>
                                <div class="slider-selection" style="left: 24.2424%; width: 20.202%;"></div>
                                <div class="slider-track-high" style="right: 0px; width: 55.5556%;"></div>
                            </div>
                            <div class="tooltip tooltip-main bs-tooltip-top" role="presentation" style="left: 34.3434%;">
                                <div class="arrow"></div>
                                <div class="tooltip-inner">$250,450</div>
                            </div>
                            <div class="tooltip tooltip-min bs-tooltip-top" role="presentation" style="left: 24.2424%;">
                                <div class="arrow"></div>
                                <div class="tooltip-inner">$250</div>
                            </div>
                            <div class="tooltip tooltip-max bs-tooltip-bottom" role="presentation" style="left: 44.4444%; top: 18px;">
                                <div class="arrow"></div>
                                <div class="tooltip-inner">$450</div>
                            </div>
                            <div class="slider-handle min-slider-handle round" role="slider" aria-valuemin="10" aria-valuemax="1000" aria-valuenow="250" aria-valuetext="$250" style="left: 24.2424%;" tabindex="0"></div>
                            <div class="slider-handle max-slider-handle round" role="slider" aria-valuemin="10" aria-valuemax="1000" aria-valuenow="450" aria-valuetext="$450" style="left: 44.4444%;" tabindex="0"></div>
                        </div>
                        <input
                            class="price-range-slider"
                            type="text"
                            name="price_range"
                            value="250,450"
                            data-slider-min="10"
                            data-slider-max="1000"
                            data-slider-step="5"
                            data-slider-value="[250,450]"
                            data-currency="$"
                            style="display: none;"
                            data-value="250,450"
                        />
                        <div class="price-range__info d-flex align-items-center mt-2">
                            <div class="me-auto">
                                <span class="text-secondary">Min Price: </span>
                                <span class="price-range__min">$250</span>
                            </div>
                            <div>
                                <span class="text-secondary">Max Price: </span>
                                <span class="price-range__max">$450</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.accordion-item -->
            </div>
            <!-- /.accordion -->
        </div>
        <!-- /.shop-sidebar -->

        <div class="shop-list flex-grow-1">
            <div class="d-flex justify-content-between mb-4 pb-md-2">
                <div class="breadcrumb mb-0 d-none d-md-block flex-grow-1">
                    <a href="<?= home_url();?>" class="menu-link menu-link_us-s text-uppercase fw-medium">Home</a>
                    <span class="breadcrumb-separator menu-link fw-medium ps-1 pe-1">/</span>
                    <span class="menu-link menu-link_us-s text-uppercase fw-medium">
                      <?php 
                        page_heading();
                      ?>
                    </span>
                </div>
                <!-- /.breadcrumb -->

            </div>
            <!-- /.d-flex justify-content-between -->

            <?php 
            if ( have_posts() ) {
              ?>
              <div class="products-grid row row-cols-2 row-cols-md-3" id="products-grid">
                <?php 
                while ( have_posts() ) {
                    the_post();

                    $product_id = get_the_id();
                    $product = wc_get_product( $product_id );

                    $gallery_image_id = $product->get_gallery_image_ids()[0];
                    $gallery_image_url = wp_get_attachment_url($gallery_image_id);
                  ?>
                  <div class="product-card-wrapper">
                    <div class="product-card mb-3 mb-md-4 mb-xxl-5">
                        <div class="pc__img-wrapper">
                            <a href="<?= get_the_permalink();?>">
                                <img loading="lazy" src="<?= get_the_post_thumbnail_url();?>" alt="product_img" class="pc__img" style="height:100%;">
                                <img loading="lazy" src="<?= $gallery_image_url;?>" alt="product_img" class="pc__img pc__img-second" style="height:100%;">
                            </a>
                            
                            <form action="" method="post" class="add_cart_handler">
                                <input type="hidden" name="product_id" value="<?= $product_id;?>">
                                <input type="number" name="quantity" value="1">
                                <button class="pc__atc btn anim_appear-bottom btn position-absolute border-0 text-uppercase fw-medium" title="Add To Cart">
                                    <span class="cart_text">Add To Cart</span>
                                    <span class="spinner"></span>
                                </button>
                            </form>
                        </div>

                        <div class="pc__info position-relative">
                            <h6 class="pc__title"><a href="<?= get_the_permalink();?>"><?= get_the_title();?></a></h6>
                            <div class="product-card__price d-flex">
                                <span class="money price price-sale"><?= wc_price($product->get_price());?></span>
                            </div>

                            <div class="wishlist_wrapper">
                                <?php 
                                $user_id = '';
                                $wishlist_id = '';
                                $has_wishlisted = false;
                                if(is_user_logged_in()) {
                                    $user_id = get_current_user_id();
                                    $wishlist_args = array(
                                        'post_type' => 'wishlists',
                                        'posts_per_page' => -1,
                                        'author' => $user_id,
                                    );
                                    $wishlist_query = new WP_Query($wishlist_args);
                                    if ($wishlist_query->have_posts()) {
                                        while ($wishlist_query->have_posts()) {
                                            $wishlist_query->the_post();
                                            $wishlisted_product_id = get_field('product_id');
                                            if($wishlisted_product_id == $product_id) {
                                                $has_wishlisted = true;
                                                $wishlist_id = get_the_id();
                                            }
                                        }
                                    }
                                    wp_reset_postdata();
                                }
                                ?>
                                <form action="" class="add_wishlist <?= $has_wishlisted ? 'd-none' : '' ?>">
                                    <input type="hidden" name="w_product_id" value="<?= $product_id;?>">
                                    <input type="hidden" name="user_id" value="<?= $user_id;?>">
                                    <button type="submit" class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0">
                                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_heart" /></svg>
                                    </button>
                                    <span class="spinner spinner2"></span>
                                </form>
                                <form action="" class="remove_wishlist <?= $has_wishlisted ? '' : 'd-none' ?>">
                                    <input type="hidden" name="wishlist_id" value="<?= $wishlist_id;?>">
                                    <button type="submit" class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 active">
                                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_heart" /></svg>
                                    </button>
                                    <span class="spinner spinner2"></span>
                                </form>
                            </div>
                        </div>
                    </div>
                  </div>
                  <?php
                }
                ?>
              </div>
              <?php
            } else {
              ?>
              <p>No Products found.</p>
              <?php
            }
            ?>
            <!-- /.products-grid row -->
            
        </div>
    </section>
    <!-- /.shop-main container -->
</main>
<div class="mb-5 pb-xl-5"></div>
<?php
get_footer( 'shop' );
