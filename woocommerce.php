<?php
  /**
   * WooCommerce content
   *
   * This template is used to display the main content of various WooCommerce pages
   */
  get_header(); // Include header template
?>
<section class="page-title parallax">
      <div data-parallax="scroll" data-image-src="<?php echo get_template_directory_uri();?>/images/bg/18.jpg" class="parallax-bg"></div>
      <div class="parallax-overlay">
        <div class="centrize">
          <div class="v-center">
            <div class="container">
              <div class="title center">
                <h1 class="upper"><?php wp_title('');?><span class="red-dot"></span></h1>
                <h4><?php global $dp1F; echo $dp1F['blog-subtitle'];?></h4>
                <hr>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    
    <section>
      <div class="container">
        <div class="shop-menu">
          <div class="col-md-8 col-sm-8">
            <div class="row">
              <h6 class="upper">Displaying 12 of 18 results</h6>
            </div>
          </div>
          <div class="col-md-4 col-sm-4">
            <div class="row">
              <div class="form-select">
                <select name="type" class="form-control">
                  <option selected="selected" value="">Sort By</option>
                  <option value="">What's new</option>
                  <option value="">Price high to low</option>
                  <option value="">Price low to high</option>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6">
          <div class="shop-product">
            <div class="product-thumb"><a href="#"><img src="<?php echo get_template_directory_uri();?>/images/shop/1.jpg" alt=""></a>
              <div class="product-overlay"><a href="#" class="btn btn-color-out btn-sm">Add To Cart<i class="ti-bag"></i></a></div>
            </div>
            <div class="product-info">
              <h4 class="upper"><a href="#">Premium Notch Blazer</a></h4><span>$79.99</span>
              <div class="save-product"><a href="#"><i class="icon-heart"></i></a></div>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6">
          <div class="shop-product">
            <div class="product-thumb"><a href="#"><img src="<?php echo get_template_directory_uri();?>/images/shop/2.jpg" alt=""></a>
              <div class="product-overlay"><a href="#" class="btn btn-color-out btn-sm">Add To Cart<i class="ti-bag"></i></a></div>
            </div>
            <div class="product-info">
              <h4 class="upper"><a href="#">Premium Suit Blazer</a></h4><span>$199.99</span>
              <div class="save-product"><a href="#"><i class="icon-heart"></i></a></div>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6">
          <div class="shop-product">
            <div class="product-thumb"><a href="#"><img src="<?php echo get_template_directory_uri();?>/images/shop/3.jpg" alt=""></a>
              <div class="product-overlay"><a href="#" class="btn btn-color-out btn-sm">Add To Cart<i class="ti-bag"></i></a></div>
            </div>
            <div class="product-info">
              <h4 class="upper"><a href="#">Vintage Sweatshirt</a></h4><span>$99.99</span>
              <div class="save-product"><a href="#"><i class="icon-heart"></i></a></div>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6">
          <div class="shop-product">
            <div class="product-thumb"><a href="#"><img src="<?php echo get_template_directory_uri();?>/images/shop/4.jpg" alt=""></a>
              <div class="product-overlay"><a href="#" class="btn btn-color-out btn-sm">Add To Cart<i class="ti-bag"></i></a></div>
            </div>
            <div class="product-info">
              <h4 class="upper"><a href="#">Longline Jersey Jacket</a></h4><span>$19.99</span>
              <div class="save-product"><a href="#"><i class="icon-heart"></i></a></div>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6">
          <div class="shop-product">
            <div class="product-thumb"><a href="#"><img src="<?php echo get_template_directory_uri();?>/images/shop/5.jpg" alt=""></a>
              <div class="product-overlay"><a href="#" class="btn btn-color-out btn-sm">Add To Cart<i class="ti-bag"></i></a></div>
            </div>
            <div class="product-info">
              <h4 class="upper"><a href="#">Tailored Blazer</a></h4><span>$119.99</span>
              <div class="save-product"><a href="#"><i class="icon-heart"></i></a></div>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6">
          <div class="shop-product">
            <div class="product-thumb"><a href="#"><img src="<?php echo get_template_directory_uri();?>/images/shop/6.jpg" alt=""></a>
              <div class="product-overlay"><a href="#" class="btn btn-color-out btn-sm">Add To Cart<i class="ti-bag"></i></a></div>
            </div>
            <div class="product-info">
              <h4 class="upper"><a href="#">Overcoat In Camel</a></h4><span>$99.99</span>
              <div class="save-product"><a href="#"><i class="icon-heart"></i></a></div>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6">
          <div class="shop-product">
            <div class="product-thumb"><a href="#"><img src="<?php echo get_template_directory_uri();?>/images/shop/7.jpg" alt=""></a>
              <div class="product-overlay"><a href="#" class="btn btn-color-out btn-sm">Add To Cart<i class="ti-bag"></i></a></div>
            </div>
            <div class="product-info">
              <h4 class="upper"><a href="#">Jacket with Fringe</a></h4><span>$35.99</span>
              <div class="save-product"><a href="#"><i class="icon-heart"></i></a></div>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6">
          <div class="shop-product">
            <div class="product-thumb"><a href="#"><img src="<?php echo get_template_directory_uri();?>/images/shop/8.jpg" alt=""></a>
              <div class="product-overlay"><a href="#" class="btn btn-color-out btn-sm">Add To Cart<i class="ti-bag"></i></a></div>
            </div>
            <div class="product-info">
              <h4 class="upper"><a href="#">Notch Blazer in Longline</a></h4><span>$135.99</span>
              <div class="save-product"><a href="#"><i class="icon-heart"></i></a></div>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6">
          <div class="shop-product">
            <div class="product-thumb"><a href="#"><img src="<?php echo get_template_directory_uri();?>/images/shop/9.jpg" alt=""></a>
              <div class="product-overlay"><a href="#" class="btn btn-color-out btn-sm">Add To Cart<i class="ti-bag"></i></a></div>
            </div>
            <div class="product-info">
              <h4 class="upper"><a href="#">Waistcoat In Navy</a></h4><span>$299.99</span>
              <div class="save-product"><a href="#"><i class="icon-heart"></i></a></div>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6">
          <div class="shop-product">
            <div class="product-thumb"><a href="#"><img src="<?php echo get_template_directory_uri();?>/images/shop/10.jpg" alt=""></a>
              <div class="product-overlay"><a href="#" class="btn btn-color-out btn-sm">Add To Cart<i class="ti-bag"></i></a></div>
            </div>
            <div class="product-info">
              <h4 class="upper"><a href="#">Mini Check Co-ord</a></h4><span>$99.99</span>
              <div class="save-product"><a href="#"><i class="icon-heart"></i></a></div>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6">
          <div class="shop-product">
            <div class="product-thumb"><a href="#"><img src="<?php echo get_template_directory_uri();?>/images/shop/11.jpg" alt=""></a>
              <div class="product-overlay"><a href="#" class="btn btn-color-out btn-sm">Add To Cart<i class="ti-bag"></i></a></div>
            </div>
            <div class="product-info">
              <h4 class="upper"><a href="#">Super Skinny Suit</a></h4><span>$105.99</span>
              <div class="save-product"><a href="#"><i class="icon-heart"></i></a></div>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6">
          <div class="shop-product">
            <div class="product-thumb"><a href="#"><img src="<?php echo get_template_directory_uri();?>/images/shop/12.jpg" alt=""></a>
              <div class="product-overlay"><a href="#" class="btn btn-color-out btn-sm">Add To Cart<i class="ti-bag"></i></a></div>
            </div>
            <div class="product-info">
              <h4 class="upper"><a href="#">Blazer in Medieval Blue</a></h4><span>$45.99</span>
              <div class="save-product"><a href="#"><i class="icon-heart"></i></a></div>
            </div>
          </div>
        </div>
        <ul class="pagination">
          <li><a href="#" aria-label="Previous"><span aria-hidden="true"><i class="ti-arrow-left"></i></span></a></li>
          <li class="active"><a href="#">1</a></li>
          <li><a href="#">2</a></li>
          <li><a href="#">3</a></li>
          <li><a href="#">4</a></li>
          <li><a href="#">5</a></li>
          <li><a href="#" aria-label="Next"><span aria-hidden="true"><i class="ti-arrow-right"></i></span></a></li>
        </ul>
      </div>
    </section>


   
    
<?php woocommerce_content(); ?>

<?php get_footer(); // Include footer template ?>