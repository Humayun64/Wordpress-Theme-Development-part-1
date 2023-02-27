
<?php

class Walker_Megamenu extends Walker {

	public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
		
		$id_field = $this->db_fields['id'];
		$id       = $element->$id_field;

		// display this element
		if ( is_object( $args[0] ) ) {
			$args[0]->has_children = $children_elements[$id]; 
		}	
		return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}

	/**
	 * What the class handles.
	 *
	 * @see Walker::$tree_type
	 * @since 3.0.0
	 * @var string
	 */
	public $tree_type = array( 'post_type', 'taxonomy', 'custom' );
	public $megamenu;

	/**
	 * Database fields to use.
	 *
	 * @see Walker::$db_fields
	 * @since 3.0.0
	 * @todo Decouple this.
	 * @var array
	 */
	public $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );

	/**
	 * Starts the list before the elements are added.
	 *
	 * @see Walker::start_lvl()
	 *
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"submenu ".$this->megamenu."\">\n";
	}

	/**
	 * Ends the list of after the elements are added.
	 *
	 * @see Walker::end_lvl()
	 *
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 */
	public function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul>\n";
	}

	/**
	 * Start the element output.
	 *
	 * @see Walker::start_el()
	 *
	 * @since 3.0.0
	 * @since 4.4.0 'nav_menu_item_args' filter was added.
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item   Menu item data object.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 * @param int    $id     Current item ID.
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		/**
		 * Filter the arguments for a single nav menu item.
		 *
		 * @since 4.4.0
		 *
		 * @param array  $args  An array of arguments.
		 * @param object $item  Menu item data object.
		 * @param int    $depth Depth of menu item. Used for padding.
		 */
		$args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );

		/**
		 * Filter the CSS class(es) applied to a menu item's list item element.
		 *
		 * @since 3.0.0
		 * @since 4.1.0 The `$depth` parameter was added.
		 *
		 * @param array  $classes The CSS classes that are applied to the menu item's `<li>` element.
		 * @param object $item    The current menu item.
		 * @param array  $args    An array of {@see wp_nav_menu()} arguments.
		 * @param int    $depth   Depth of menu item. Used for padding.
		 */

		if ($item->megamenu == 'Megamenu Columns') {
			$this->megamenu = 'megamenu';
		}
		
		if ($args->has_children) {
			$class_names = 'has-submenu';
		}
		

		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		/**
		 * Filter the ID applied to a menu item's list item element.
		 *
		 * @since 3.0.1
		 * @since 4.1.0 The `$depth` parameter was added.
		 *
		 * @param string $menu_id The ID that is applied to the menu item's `<li>` element.
		 * @param object $item    The current menu item.
		 * @param array  $args    An array of {@see wp_nav_menu()} arguments.
		 * @param int    $depth   Depth of menu item. Used for padding.
		 */
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $class_names .'>';

		$atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
		$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
		$atts['href']   = ! empty( $item->url )        ? $item->url        : '';

		/**
		 * Filter the HTML attributes applied to a menu item's anchor element.
		 *
		 * @since 3.6.0
		 * @since 4.1.0 The `$depth` parameter was added.
		 *
		 * @param array $atts {
		 *     The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
		 *
		 *     @type string $title  Title attribute.
		 *     @type string $target Target attribute.
		 *     @type string $rel    The rel attribute.
		 *     @type string $href   The href attribute.
		 * }
		 * @param object $item  The current menu item.
		 * @param array  $args  An array of {@see wp_nav_menu()} arguments.
		 * @param int    $depth Depth of menu item. Used for padding.
		 */
		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		/** This filter is documented in wp-includes/post-template.php */
		$title = apply_filters( 'the_title', $item->title, $item->ID );

		/**
		 * Filter a menu item's title.
		 *
		 * @since 4.4.0
		 *
		 * @param string $title The menu item's title.
		 * @param object $item  The current menu item.
		 * @param array  $args  An array of {@see wp_nav_menu()} arguments.
		 * @param int    $depth Depth of menu item. Used for padding.
		 */
		$title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . $title . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		/**
		 * Filter a menu item's starting output.
		 *
		 * The menu item's starting output only includes `$args->before`, the opening `<a>`,
		 * the menu item's title, the closing `</a>`, and `$args->after`. Currently, there is
		 * no filter for modifying the opening and closing `<li>` for a menu item.
		 *
		 * @since 3.0.0
		 *
		 * @param string $item_output The menu item's starting HTML output.
		 * @param object $item        Menu item data object.
		 * @param int    $depth       Depth of menu item. Used for padding.
		 * @param array  $args        An array of {@see wp_nav_menu()} arguments.
		 */
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	/**
	 * Ends the element output, if needed.
	 *
	 * @see Walker::end_el()
	 *
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item   Page data object. Not used.
	 * @param int    $depth  Depth of page. Not Used.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 */
	public function end_el( &$output, $item, $depth = 0, $args = array() ) {
		$output .= '</li>';
	}

} // Walker_Nav_Menu


//	Start Megamenu Scripts		//	Process For Mega Menu,

add_filter('wp_edit_nav_menu_walker', 'megamenu_edit');

add_filter('wp_setup_nav_menu_item', 'setup_field_data');
function setup_field_data($menu_item) {
	$menu_item->megamenu = get_post_meta($menu_item->ID, 'menu-item-megamenu', true);
	return $menu_item;
}

add_filter('wp_update_nav_menu_item', 'update_field_data', 10, 3);
function update_field_data($menu_id, $menu_db_id, $arg) {
	if (is_array($_REQUEST['menu-item-megamenu'])) {
		$idvalue = $_REQUEST['menu-item-megamenu'][$menu_db_id];
		update_post_meta($menu_db_id, 'menu-item-megamenu', $idvalue);
	}
}

function megamenu_edit() {
	return 'mega_menu_edit';
}

class mega_menu_edit extends Walker_Nav_Menu {

	public function start_lvl( &$output, $depth = 0, $args = array() ) {}
	public function end_lvl( &$output, $depth = 0, $args = array() ) {}

	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
	$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

	ob_start(); 

	$item_id = esc_attr($item->ID);
	$removed_args = array(
		'action',
		'customlink-tab',
		'edit-menu-item',
		'menu-item',
		'page-tab',
		'_wpnonce',
	);

	$original_title = '';
	if ('taxonomy' == $item->type) {
		$original_title = get_term_field('name', $item->object_id, $item->object, 'raw');
		if (is_wp_error($original_title))
			$original_title = false;
		}elseif ('post_type' == $item->type) {
			$original_object = get_post($item->object_id);
			$original_title = $original_object->post_title;
		}

		$classes = array(
			'menu-item menu-item-depth-' . $depth,
			'menu-item-' . esc_attr($item->object),
			'menu-item-edit-' . ((isset($_GET['edit-menu-item']) && $item_id == $_GET['edit-menu-item']) ? 'active' : 'inactive'),
		);

		$title = $item->title;

		if (! empty($item->_invalid)) {
			$classes[] = 'menu-item-invalid';
			/* translators: %s: title of menu item which is invalid */
			$title = sprintf(__('%s (Invalid)'), $item->title);
		}elseif (isset($item->post_status) && 'draft' == $item->post_status) {
			$classes[] = 'pending';
			/* translators: %s: title of menu item in draft status */
			$title = sprintf(__('%s (Pending)'), $item->title);
		}

		$title = empty($item->label) ? $title : $item->label;

	?>



		<li id="menu-item-<?php echo $item_id; ?>" class="<?php echo implode(' ', $classes ); ?>">
			<div class="menu-item-bar">
				<div class="menu-item-handle">
					<span class="item-title"><?php echo esc_html( $title ); ?></span>
					<span class="item-controls">
						<span class="item-type"><?php echo esc_html( $item->type_label); ?></span>
						<span class="item-order hide-if-js">
							<a href="<?php 
								echo wp_nonce_url(
									add_query_arg(
										array(
											'action'	=> 'move-up-menu-item',
											'menu-item'	=>	$item_id,
										),
										remove_query_arg($removed_args, admin_url('nav-menus.php'))
									),
									'move-menu_item'
								);

								 ?>" class="item-move-up" <abbr title="<?php esc_attr_e('Move up'); ?>">&#8593;</abbr></a>							|
							<a href="<?php 
								echo wp_nonce_url(
									add_query_arg(
										array(
											'action'	=> 'move-down-menu-item',
											'menu-item'	=>	$item_id,
										),
										remove_query_arg($removed_args, admin_url('nav-menus.php'))
									),
									'move-menu_item'
								);

								 ?>" class="item-move-down" <abbr title="<?php esc_attr_e('Move down'); ?>">&#8595;</abbr></a>						</span>
						<a class="item-edit" id="edit-<?php echo $item_id; ?>" title="<?php esc_attr_e('Edit Menu Item'); ?>" href="<?php 
							echo ( isset($_GET['edit-menu-item']) && $item_id == $_GET['edit-menu-item']) ? admin_url( 'nav-mnus.php' ) : add_query_arg('edit-menu-item', $item_id, remove_query_arg($removed_args, admin_url('nav-menus.php#menu-item-settings-' . $item_id)));
						 ?>"><span class="screen-reader-text"><?php _e('Edit Menu Item'); ?></span></a></span>
				</div>
			</div>

			<div class="menu-item-settings wp-clearfix" id="menu-item-settings-<?php echo $item_id; ?>">
				<?php if('custom' == $item->type) : ?>
					<p class="field-url description description-wide">
						<label for="edit-menu-item-url-<?php echo $item_id; ?>">
							<?php _e('URL'); ?><br>
							<input type="text" id="edit-menu-item-url-<?php echo $item_id; ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo $item_id; ?>]" value="<?php echo esc_attr($item->url); ?>">
						</label>
					</p>
				<?php endif; ?>
								<p class="description description-wide description-thin">
					<label for="edit-menu-item-title-<?php echo $item_id; ?>">
						<?php _e('Navigation Label'); ?><br>
						<input type="text" id="edit-menu-item-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr($item->title); ?>">
					</label>
				</p>
				<p class="field-title-attribute field-attr-title description description-wide description-thin hidden-field">
					<label for="edit-menu-item-attr-title-<?php echo $item_id; ?>">
						<?php _e('Title Attribute'); ?><br>
						<input type="text" id="edit-menu-item-attr-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr($item->post_excerpt); ?>" >
					</label>
				</p>
				<p class="field-link-target description hidden-field">
					<label for="edit-menu-item-target-<?php echo $item_id; ?>">
						<input type="checkbox" id="edit-menu-item-target-<?php echo $item_id; ?>" value="_blank" name="menu-item-target[<?php echo $item_id; ?>]"<?php checked($item->target, '_blank'); ?> >
						<?php _e('Open link in a new window/tab'); ?> </label>
				</p>
				<p class="field-css-classes description description-thin hidden-field">
					<label for="edit-menu-item-classes-<?php echo $item_id; ?>">
						<?php _e('CSS Classes (optional)'); ?><br>
						<input type="text" id="edit-menu-item-classes-<?php echo $item_id; ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo $item_id; ?>]" value="<?php echo esc_attr(implode(' ', $item->classes)); ?>">
					</label>
				</p>
				<p class="field-xfn description description-thin hidden-field">
					<label for="edit-menu-item-xfn-<?php echo $item_id; ?>"><?php _e('Link Relationship (XFN)'); ?><br>
						<input type="text" id="edit-menu-item-xfn-<?php echo $item_id; ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo $item_id; ?>]" value="<?php echo esc_attr($item->xfn); ?>">
					</label>
				</p>
				<p class="field-description description description-wide hidden-field">
					<label for="edit-menu-item-description-<?php echo $item_id; ?>">
						<?php _e('Description'); ?><br>
						<textarea id="edit-menu-item-description-<?php echo $item_id; ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo $item_id; ?>]"><?php echo esc_html($item->description); //textarea_escaped ?></textarea>
						<span class="description"><?php _e('The description will be displayed in the menu if the current theme supports it.'); ?></span>
					</label>
				</p>
				<?php 
					/* New fields insertion starts here */
				 ?>

				 <p class="field-custom description description-wide">
				 	<label for="edit-menu-item-megamenu-<?php echo $item_id; ?>">
				 		<?php _e('Submenu type:'); ?><br>
				 		<?php $options = array();
				 			$options['standard'] = 'Standard';
				 			$options['mega-menu-columns'] = 'Megamenu Columns';
				 			// $options['mega-menu_posts'] = 'Latest 4 post from Category';
				 		 ?>
				 	<select style="width:100%;" name="menu-item-megamenu[<?php echo $item_id; ?>]" id="edit-menu-item-megamenu-<?php echo $item_id; ?>" class="widefat code edit-menu-item-custom">
				 		
				 		<?php foreach($options as $option) : 
				 			$current = $item->megamenu;
				 		 ?>
					 		<option <?php if(htmlentities($current, ENT_QUOTES) == $option) echo 'selected="selected"'; ?>>
					 			<?php echo $option; ?>
					 		</option>
				 		<?php endforeach; ?>
				 	</select>
				 	</label>
				 </p>

				<fieldset class="field-move hide-if-no-js description description-wide" style="display: none;">
					<span class="field-move-visual-label" aria-hidden="true">Move</span>
					<button type="button" class="button-link menus-move menus-move-up" data-dir="up" style="display: none;">Up one</button>
					<button type="button" class="button-link menus-move menus-move-down" data-dir="down" style="display: none;" aria-label="Move down one">Down one</button>
					<button type="button" class="button-link menus-move menus-move-left" data-dir="left" style="display: none;"></button>
					<button type="button" class="button-link menus-move menus-move-right" data-dir="right" style="display: none;"></button>
					<button type="button" class="button-link menus-move menus-move-top" data-dir="top" style="display: none;">To the top</button>
				</fieldset>

				<?php 
					/* New fields insertion ends here */
				 ?>

				<div class="menu-item-actions description-wide submitbox">
					<?php if( 'custom' != $item->type && $original_title !== false) : ?>
						<p class="link-to-original">
							<?php 
								printf( __('Original: %s'), '<a href="' . esc_attr($item->url) . '">' . esc_html($original_title) . '</a>' );
							 ?>
						</p>
					<?php endif; ?>
					<a class="item-delete submitdelete deletion" id="delete-<?php echo $item_id; ?>" href="<?php 
						echo wp_nonce_url(
							add_query_arg(
								array(
									'action'	=> 'delete-menu-item',
									'menu-item'	=>	$item_id,
								),
								remove_query_arg($removed_args, admin_url('nav-menus.php'))
							),
							'delete-menu_item_' . $item_id
						);

					 ?>"><?php _e('Remove'); ?></a>					<span class="meta-sep"> | </span>
					<a class="item-cancel submitcancel" id="cancel-<?php echo $item_id; ?>" href="<?php 
						echo esc_url( add_query_arg(array(
							'edit-menu-item' => $item_id, 
							'cancel' 		 => time()),
						remove_query_arg( $removed_args, admin_url('nav-menus.php'))
					)); ?>#menu-item-settings-<?php echo $item_id; ?>"><?php _e('Cancel'); ?></a>				</div>

				<input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo $item_id; ?>]" value="<?php echo $item_id; ?>">
				<input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo $item_id; ?>]" value="<?php echo esc_attr($item->object_id); ?>">
				<input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo $item_id; ?>]" value="<?php echo esc_attr($item->object); ?>">
				<input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo $item_id; ?>]" value="<?php echo esc_attr($item->menu_item_parent); ?>">
				<input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo $item_id; ?>]" value="<?php echo esc_attr($item->menu_order); ?>">
				<input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo $item_id; ?>]" value="<?php echo esc_attr($item->type); ?>">
			</div><!-- .menu-item-settings-->
			<ul class="menu-item-transport"></ul>
	<?php 
		$output .= ob_get_clean();
	}
}

//	End Megamenu Scripts