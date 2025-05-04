<div class="theme-offer">
	<?php 
        // Check if the demo import has been completed
        $shoes_store_demo_import_completed = get_option('shoes_store_demo_import_completed', false);

        // If the demo import is completed, display the "View Site" button
        if ($shoes_store_demo_import_completed) {
        echo '<p class="notice-text">' . esc_html__('Your demo import has been completed successfully.', 'shoes-store') . '</p>';
        echo '<span><a href="' . esc_url(home_url()) . '" class="button button-primary site-btn" target="_blank">' . esc_html__('VIEW SITE', 'shoes-store') . '</a></span>';
        }

		// POST and update the customizer and other related data of THE COURIER SERVICESPRO
        if (isset($_POST['submit'])) {

        // Check if woocommerce is installed and activated
        if (!is_plugin_active('woocommerce/woocommerce.php')) {
          // Install the plugin if it doesn't exist
          $shoes_store_plugin_slug = 'woocommerce';
          $shoes_store_plugin_file = 'woocommerce/woocommerce.php';

          // Check if plugin is installed
          $shoes_store_installed_plugins = get_plugins();
          if (!isset($shoes_store_installed_plugins[$shoes_store_plugin_file])) {
              include_once(ABSPATH . 'wp-admin/includes/plugin-install.php');
              include_once(ABSPATH . 'wp-admin/includes/file.php');
              include_once(ABSPATH . 'wp-admin/includes/misc.php');
              include_once(ABSPATH . 'wp-admin/includes/class-wp-upgrader.php');

              // Install the plugin
              $shoes_store_upgrader = new Plugin_Upgrader();
              $shoes_store_upgrader->install('https://downloads.wordpress.org/plugin/woocommerce.latest-stable.zip');
          }
          // Activate the plugin
          activate_plugin($shoes_store_plugin_file);
        }


        // ------- Create Nav Menu --------
        $shoes_store_menuname = 'Main Menus';
        $shoes_store_bpmenulocation = 'primary';
        $shoes_store_menu_exists = wp_get_nav_menu_object($shoes_store_menuname);

        if (!$shoes_store_menu_exists) {
            $shoes_store_menu_id = wp_create_nav_menu($shoes_store_menuname);

            // Create Home Page
            $shoes_store_home_title = 'Home';
            $shoes_store_home = array(
                'post_type' => 'page',
                'post_title' => $shoes_store_home_title,
                'post_content' => '',
                'post_status' => 'publish',
                'post_author' => 1,
                'post_slug' => 'home'
            );
            $shoes_store_home_id = wp_insert_post($shoes_store_home);
            // Assign Home Page Template
            add_post_meta($shoes_store_home_id, '_wp_page_template', 'page-template/custom-home-page.php');
            // Update options to set Home Page as the front page
            update_option('page_on_front', $shoes_store_home_id);
            update_option('show_on_front', 'page');
            // Add Home Page to Menu
            wp_update_nav_menu_item($shoes_store_menu_id, 0, array(
                'menu-item-title' => __('Home', 'shoes-store'),
                'menu-item-classes' => 'home',
                'menu-item-url' => home_url('/'),
                'menu-item-status' => 'publish',
                'menu-item-object-id' => $shoes_store_home_id,
                'menu-item-object' => 'page',
                'menu-item-type' => 'post_type'
            ));

            // Create Pages Page with Dummy Content
            $shoes_store_pages_title = 'Pages';
            $shoes_store_pages_content = '
            Explore all the pages we have on our website. Find information about our services, company, and more.
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960 with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br>
            All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.';
            $shoes_store_pages = array(
                'post_type' => 'page',
                'post_title' => $shoes_store_pages_title,
                'post_content' => $shoes_store_pages_content,
                'post_status' => 'publish',
                'post_author' => 1,
                'post_slug' => 'pages'
            );
            $shoes_store_pages_id = wp_insert_post($shoes_store_pages);
            // Add Pages Page to Menu
            wp_update_nav_menu_item($shoes_store_menu_id, 0, array(
                'menu-item-title' => __('Pages', 'shoes-store'),
                'menu-item-classes' => 'pages',
                'menu-item-url' => home_url('/pages/'),
                'menu-item-status' => 'publish',
                'menu-item-object-id' => $shoes_store_pages_id,
                'menu-item-object' => 'page',
                'menu-item-type' => 'post_type'
            ));

            // Create About Us Page with Dummy Content
            $shoes_store_about_title = 'About Us';
            $shoes_store_about_content = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam...<br>
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960 with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br>
            There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isnt anything embarrassing hidden in the middle of text.<br>
            All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.';
            $shoes_store_about = array(
                'post_type' => 'page',
                'post_title' => $shoes_store_about_title,
                'post_content' => $shoes_store_about_content,
                'post_status' => 'publish',
                'post_author' => 1,
                'post_slug' => 'about-us'
            );
            $shoes_store_about_id = wp_insert_post($shoes_store_about);
            // Add About Us Page to Menu
            wp_update_nav_menu_item($shoes_store_menu_id, 0, array(
                'menu-item-title' => __('About Us', 'shoes-store'),
                'menu-item-classes' => 'about-us',
                'menu-item-url' => home_url('/about-us/'),
                'menu-item-status' => 'publish',
                'menu-item-object-id' => $shoes_store_about_id,
                'menu-item-object' => 'page',
                'menu-item-type' => 'post_type'
            ));

            // Set the menu location if it's not already set
            if (!has_nav_menu($shoes_store_bpmenulocation)) {
                $shoes_store_locations = get_theme_mod('nav_menu_locations'); // Use 'nav_menu_locations' to get locations array
                if (empty($shoes_store_locations)) {
                    $shoes_store_locations = array();
                }
                $shoes_store_locations[$shoes_store_bpmenulocation] = $shoes_store_menu_id;
                set_theme_mod('nav_menu_locations', $shoes_store_locations);
            }
        }

        // Set the demo import completion flag
		update_option('shoes_store_demo_import_completed', true);
		// Display success message and "View Site" button
		echo '<p class="notice-text">' . esc_html__('Your demo import has been completed successfully.', 'shoes-store') . '</p>';
		echo '<span><a href="' . esc_url(home_url()) . '" class="button button-primary site-btn" target="_blank">' . esc_html__('VIEW SITE', 'shoes-store') . '</a></span>';
        //end 

        // Top Bar
        set_theme_mod( 'shoes_store_topbar_text', 'FREE WORLDWIDE SHIPPING ON ORDER FROM $200' );

        // Slider Settings
        set_theme_mod( 'shoes_store_slide_number', '3' );
        for($shoes_store_i=1; $shoes_store_i<=3; $shoes_store_i++) {   
            set_theme_mod( 'shoes_store_slider_title'.$shoes_store_i, 'Step into Style: Comfort, Performance, and Innovation.' );
            set_theme_mod( 'shoes_store_slider_text'.$shoes_store_i, 'Discover the latest sneaker trends crafted for style, performance, and all-day comfort, wherever you go.' );
            set_theme_mod( 'shoes_store_side_img'.$shoes_store_i, get_template_directory_uri().'/assets/images/slider' . ($shoes_store_i + 1) . '.png' );
        }

        // New Product Section
        set_theme_mod( 'shoes_store_product_section_heading', 'New Product' );
        
        set_theme_mod('shoes_store_best_product_category', 'Gender');

            // Define product category names, product titles, and tags
            $shoes_store_category_names = array('Gender', 'Category', 'Brand', 'Material', 'Price');
            $shoes_store_title_array = array(
                array("Nike Pegasus 41 Men's", "Air Max Solo Sneakers For Men", "Puma Duplex OG Star White", "Chuck Taylor All Star Lift Platform"),
                array("Nike Pegasus 41 Men's", "Air Max Solo Sneakers For Men", "Puma Duplex OG Star White", "Chuck Taylor All Star Lift Platform"),
                array("Nike Pegasus 41 Men's", "Air Max Solo Sneakers For Men", "Puma Duplex OG Star White", "Chuck Taylor All Star Lift Platform"),
                array("Nike Pegasus 41 Men's", "Air Max Solo Sneakers For Men", "Puma Duplex OG Star White", "Chuck Taylor All Star Lift Platform"),
                array("Nike Pegasus 41 Men's", "Air Max Solo Sneakers For Men", "Puma Duplex OG Star White", "Chuck Taylor All Star Lift Platform")
            );

            foreach ($shoes_store_category_names as $shoes_store_index => $shoes_store_category_name) {
                // Create or retrieve the product category term ID
                $shoes_store_term = term_exists($shoes_store_category_name, 'product_cat');
                if ($shoes_store_term === 0 || $shoes_store_term === null) {
                    // If the term does not exist, create it
                    $shoes_store_term = wp_insert_term($shoes_store_category_name, 'product_cat');
                }

                if (is_wp_error($shoes_store_term)) {
                    error_log('Error creating category: ' . $shoes_store_term->get_error_message());
                    continue; // Skip to the next iteration if category creation fails
                }

                // Loop to create 4 products for each category
                for ($shoes_store_i = 0; $shoes_store_i < 4; $shoes_store_i++) {
                    // Create product content
                    $shoes_store_title = $shoes_store_title_array[$shoes_store_index][$shoes_store_i];
                    $shoes_store_content = 'Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s.';

                    // Create product post object
                    $shoes_store_my_post = array(
                        'post_title'    => wp_strip_all_tags($shoes_store_title),
                        'post_content'  => $shoes_store_content,
                        'post_status'   => 'publish',
                        'post_type'     => 'product', // Post type set to 'product'
                    );

                    // Insert the product into the database
                    $shoes_store_post_id = wp_insert_post($shoes_store_my_post);

                    if (is_wp_error($shoes_store_post_id)) {
                        error_log('Error creating product: ' . $shoes_store_post_id->get_error_message());
                        continue; // Skip to the next product if creation fails
                    }

                    // Assign the category to the product
                    wp_set_object_terms($shoes_store_post_id, (int)$shoes_store_term['term_id'], 'product_cat');

                    // Set product as simple product and assign prices
                    update_post_meta($shoes_store_post_id, '_price', '480'); // Set the active price (sale price if applicable)
                    update_post_meta($shoes_store_post_id, '_regular_price', '600'); // Set the regular price
                    update_post_meta($shoes_store_post_id, '_sale_price', '480'); // Set the sale price
                    update_post_meta($shoes_store_post_id, '_stock_status', 'instock'); // Set stock status to 'in stock'
                    update_post_meta($shoes_store_post_id, '_manage_stock', 'no'); // Not managing stock
                    update_post_meta($shoes_store_post_id, '_product_type', 'simple'); // Set product type to 'simple'


                    // Handle the featured image using media_sideload_image
                    $shoes_store_image_url = get_template_directory_uri() . '/assets/images/Product' . ($shoes_store_i + 1) . '.png';
                    $shoes_store_image_id = media_sideload_image($shoes_store_image_url, $shoes_store_post_id, null, 'id');

                    if (is_wp_error($shoes_store_image_id)) {
                        error_log('Error downloading image: ' . $shoes_store_image_id->get_error_message());
                        continue; // Skip to the next product if image download fails
                    }

                    // Assign featured image to product
                    set_post_thumbnail($shoes_store_post_id, $shoes_store_image_id);
                }
            }

        //Copyright Text
        set_theme_mod( 'shoes_store_footer_text', 'By VWThemes' );  
     
        }
    ?>
  
	<p><?php esc_html_e('Please back up your website if it’s already live with data. This importer will overwrite your existing settings with the new customizer values for Shoes Store', 'shoes-store'); ?></p>
    <form action="<?php echo esc_url(home_url()); ?>/wp-admin/themes.php?page=shoes_store_guide" method="POST" onsubmit="return validate(this);">
        <?php if (!get_option('shoes_store_demo_import_completed')) : ?>
            <input class="run-import" type="submit" name="submit" value="<?php esc_attr_e('Run Importer', 'shoes-store'); ?>" class="button button-primary button-large">
        <?php endif; ?>
        <div id="spinner" style="display:none;">         
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/spinner.png" alt="" />
        </div>
    </form>
    <script type="text/javascript">
        function validate(form) {
            if (confirm("Do you really want to import the theme demo content?")) {
                // Show the spinner
                document.getElementById('spinner').style.display = 'block';
                // Allow the form to be submitted
                return true;
            } 
            else {
                return false;
            }
        }
    </script>
</div>
