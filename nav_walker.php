<?php 


class Custom_Nav_Walker extends Walker {


	public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
		
		$id_field = $this->db_fields['id'];
		$id       = $element->$id_field;

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
		$output .= "\n$indent<ul class=\"submenu\">\n";
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
		
		if( $args->has_children ){
			$class_names = " has-submenu";
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






// extra 



add_filter('wp_edit_nav_menu_walker', 'backend_menu');

function backend_menu(){
	return 'notun_akta_class_return_korbo';
}



class notun_akta_class_return_korbo extends Walker_Nav_Menu{

	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		
		ob_start(); ?>

		<li id="menu-item-<?php echo $item->ID; ?>" class="menu-item menu-item-depth-0 menu-item-custom menu-item-edit-inactive">
			<div class="menu-item-bar">
				<div class="menu-item-handle ui-sortable-handle">
					<span class="item-title"><?php echo $item->title; ?></span> 
					<span class="item-controls">
						<span class="item-type"><?php echo $item->type_label; ?></span>
						<span class="item-order hide-if-js">
							<a href="http://localhost/comet/wp-admin/nav-menus.php?action=move-up-menu-item&amp;menu-item=63&amp;_wpnonce=bfe2c39e34" class="item-move-up"><abbr title="Move up">↑</abbr></a>
							|
							<a href="http://localhost/comet/wp-admin/nav-menus.php?action=move-down-menu-item&amp;menu-item=63&amp;_wpnonce=bfe2c39e34" class="item-move-down"><abbr title="Move down">↓</abbr></a>
						</span>
						<a class="item-edit" id="edit-63" title="Home. Menu item 1 of 6." href="http://localhost/comet/wp-admin/nav-menus.php?edit-menu-item=63#menu-item-settings-63">Home. Menu item 1 of 6.</a>
					</span>
				</div>
			</div>

			<div class="menu-item-settings" id="menu-item-settings-63">
									<p class="field-url description description-wide">
						<label for="edit-menu-item-url-63">
							URL<br>
							<input id="edit-menu-item-url-63" class="widefat code edit-menu-item-url" name="menu-item-url[63]" value="http://localhost/comet/" type="text">
						</label>
					</p>
								<p class="description description-wide">
					<label for="edit-menu-item-title-63">
						Navigation Label<br>
						<input id="edit-menu-item-title-63" class="widefat edit-menu-item-title" name="menu-item-title[63]" value="Home" type="text">
					</label>
				</p>
				<p class="field-title-attribute description description-wide hidden-field">
					<label for="edit-menu-item-attr-title-63">
						Title Attribute<br>
						<input id="edit-menu-item-attr-title-63" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[63]" value="" type="text">
					</label>
				</p>
				<p class="field-link-target description hidden-field">
					<label for="edit-menu-item-target-63">
						<input id="edit-menu-item-target-63" value="_blank" name="menu-item-target[63]" type="checkbox">
						Open link in a new tab					</label>
				</p>
				<p class="field-css-classes description description-thin hidden-field">
					<label for="edit-menu-item-classes-63">
						CSS Classes (optional)<br>
						<input id="edit-menu-item-classes-63" class="widefat code edit-menu-item-classes" name="menu-item-classes[63]" value="" type="text">
					</label>
				</p>
				<p class="field-xfn description description-thin hidden-field">
					<label for="edit-menu-item-xfn-63">
						Link Relationship (XFN)<br>
						<input id="edit-menu-item-xfn-63" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[63]" value="" type="text">
					</label>
				</p>
				<p class="field-description description description-wide hidden-field">
					<label for="edit-menu-item-description-63">
						Description<br>
						<textarea id="edit-menu-item-description-63" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[63]"></textarea>
						<span class="description">The description will be displayed in the menu if the current theme supports it.</span>
					</label>
				</p>

				<p class="field-move hide-if-no-js description description-wide">
					<label>
						<span>Move</span>
						<a style="display: none;" href="#" class="menus-move menus-move-up" data-dir="up">Up one</a>
						<a title="Move down one" style="display: inline;" href="#" class="menus-move menus-move-down" data-dir="down">Down one</a>
						<a style="display: none;" href="#" class="menus-move menus-move-left" data-dir="left"></a>
						<a style="display: none;" href="#" class="menus-move menus-move-right" data-dir="right"></a>
						<a style="display: none;" href="#" class="menus-move menus-move-top" data-dir="top">To the top</a>
					</label>
				</p>

				<div class="menu-item-actions description-wide submitbox">
										<a class="item-delete submitdelete deletion" id="delete-63" href="http://localhost/comet/wp-admin/nav-menus.php?action=delete-menu-item&amp;menu-item=63&amp;_wpnonce=62e59c84cf">Remove</a> <span class="meta-sep hide-if-no-js"> | </span> <a class="item-cancel submitcancel hide-if-no-js" id="cancel-63" href="http://localhost/comet/wp-admin/nav-menus.php?edit-menu-item=63&amp;cancel=1452512697#menu-item-settings-63">Cancel</a>
				</div>

				<input class="menu-item-data-db-id" name="menu-item-db-id[63]" value="63" type="hidden">
				<input class="menu-item-data-object-id" name="menu-item-object-id[63]" value="63" type="hidden">
				<input class="menu-item-data-object" name="menu-item-object[63]" value="custom" type="hidden">
				<input class="menu-item-data-parent-id" name="menu-item-parent-id[63]" value="0" type="hidden">
				<input class="menu-item-data-position" name="menu-item-position[63]" value="1" type="hidden">
				<input class="menu-item-data-type" name="menu-item-type[63]" value="custom" type="hidden">
			</div><!-- .menu-item-settings-->
			<ul class="menu-item-transport"></ul>
		</li>

		<?php $output .= ob_get_clean();
	}

}