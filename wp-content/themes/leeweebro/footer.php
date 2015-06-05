    <div id="footer-wrapper" class="container-fluid">
      <footer id="main-footer" class="container">
          <div class="row">
            <div class="footer-col col-xs-6 col-xs-offset-0 col-sm-6 col-sm-offset-0 col-md-2 col-md-offset-1">
              <h3>INFORMATION</h3>
              <?php
                $args = array(
                'order'                  => 'ASC',
                'orderby'                => 'menu_order',
                'post_type'              => 'nav_menu_item',
                'post_status'            => 'publish',
                'output'                 => ARRAY_A,
                'output_key'             => 'menu_order',
                'nopaging'               => true,
                'update_post_term_cache' => false );
                $menu_items = wp_get_nav_menu_items( 'Footer Menu', $args );
              ?>
              <ul>
                <?php 
                foreach ( (array) $menu_items as $key => $menu_item ) {
                    if ( $menu_item->menu_item_parent == 217 ) :
                        $title = $menu_item->title;
                        $url = $menu_item->url; 
                ?>
                        <li>                          
                          <a href="<?php echo $url; ?>"><?php echo $title; ?></a>
                        </li>
                <?php
                    endif;
                }
                ?>
                <!-- <li>
                  <?php $about_us_page = get_page_by_title( 'About Us' ); ?>
                  <a href="<?php echo get_permalink($about_us_page->ID); ?>">About Us</a>
                </li> -->
                <!-- <li>
                  <?php $delivery_page = get_page_by_title( 'Delivery' ); ?>
                  <a href="<?php echo get_permalink($delivery_page->ID); ?>">Delivery Information</a>
                </li> -->
                <!-- <li>
                  <?php $faq_page = get_page_by_title( 'Faqs' ); ?>
                  <a href="<?php echo get_permalink($faq_page->ID); ?>">FAQs</a>
                </li>
                <li>
                  <?php $timeslot_page = get_page_by_title( 'Time Slots' ); ?>
                  <a href="<?php echo get_permalink($timeslot_page->ID); ?>">Delivery Time Slots</a>
                </li>
                <li>
                  <?php $term_page = get_page_by_title( 'Terms & Conditions' ); ?>
                  <a href="<?php echo get_permalink($term_page->ID); ?>">Terms & Conditions</a>
                </li> -->
              </ul>
            </div>
            <div class="footer-col col-xs-6 col-xs-offset-0 col-sm-6 col-sm-offset-0 col-md-2">
              <h3>SERVICES</h3>
              <ul>
                <?php 
                foreach ( (array) $menu_items as $key => $menu_item ) {
                    if ( $menu_item->menu_item_parent == 222 ) :
                        $title = $menu_item->title;
                        $url = $menu_item->url; 
                ?>
                        <li>                          
                          <a href="<?php echo $url; ?>"><?php echo $title; ?></a>
                        </li>
                <?php
                    endif;
                }
                ?>
                <!-- <li>
                  <?php $ourfood_page = get_page_by_title( 'Our Food' ); ?>
                  <a href="<?php echo get_permalink($ourfood_page->ID); ?>">Our Food</a>
                </li> -->
                <!-- <li>
                  <?php $catering_page = get_page_by_title( 'Catering' ); ?>
                  <a href="<?php echo get_permalink($catering_page->ID); ?>">Catering</a>
                </li> -->
                <!-- <li>
                  <?php $delivery_page = get_page_by_title( 'Delivery' ); ?>
                  <a href="<?php echo get_permalink($delivery_page->ID); ?>">Delivery</a>
                </li> -->
                <!-- <li>
                  <?php $order_page = get_page_by_title( 'Order Online' ); ?>
                  <a href="<?php echo get_permalink($order_page->ID); ?>">Order Online</a>
                </li> -->
              </ul>
            </div>
            <div class="footer-col col-xs-6 col-xs-offset-0 col-sm-6 col-sm-offset-0 col-md-2">
              <h3>EXTRAS</h3>
              <ul>
                <?php 
                foreach ( (array) $menu_items as $key => $menu_item ) {
                    if ( $menu_item->menu_item_parent == 227 ) :
                        $title = $menu_item->title;
                        $url = $menu_item->url; 
                ?>
                        <li>                          
                          <a href="<?php echo $url; ?>"><?php echo $title; ?></a>
                        </li>
                <?php
                    endif;
                }
                ?>
                <!-- <li>
                  <?php $promotion_page = get_page_by_title( 'Promotions' ); ?>
                  <a href="<?php echo get_permalink($promotion_page->ID); ?>">Promotions</a>
                </li> -->
                <!-- <li>
                  <?php //$special_page = get_page_by_title( 'Specials' ); ?>
                  <a href="#<?php //echo get_permalink($special_page->ID); ?>">Specials</a>
                </li> -->
                <!-- <li>
                  <?php $careers_page = get_page_by_title( 'Careers' ); ?>
                  <a href="<?php echo get_permalink($careers_page->ID); ?>">Careers</a>
                </li> -->
              </ul>
            </div>
            <div class="footer-col col-xs-6 col-xs-offset-0 col-sm-6 col-sm-offset-0 col-md-2">
              <h3>CONTACT</h3>
              <ul>
                <li>
                  <p>Delivery Hotline:</p>
                  <p>6535 6535</p>
                  <?php $outlets_page = get_page_by_title( 'Our Outlets' ); ?>
                  <a href="<?php echo get_permalink($outlets_page->ID); ?>">Outlets</a>
                </li>
              </ul>
            </div>
            <div class="footer-col col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-3">
              <h3>SHARE WITH US</h3>
              <img src="<?php echo IMAGES ?>/logo/halal.png" alt="" class="halal">
              <ul>
                <li>
                  <a class="facebook" href="https://www.facebook.com/leeweebrothers" target="_blank"></a>
                  <!-- <a class="twitter" href="#"></a> -->
                  <a class="instagram" href="https://instagram.com/leeweebrothers" target="_blank"></a>
                </li>
                <li><p class="copy-right">&copy; LEE WEE & BROTHERS' FOODSTUFF PTE LTD.</p></li>
              </ul>
            </div>
          </div>
      </footer>
    </div>
  </div>
  <script>
  var templateUrl = '<?php echo esc_url( home_url( '/' ) ); ?>';
  </script>
<?php wp_footer(); ?>
</body>
</html>