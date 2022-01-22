<?php
/**
 * Handle custom post types registration.
 *
 * @package APcom-CPT
 * @link    https://github.com/ArmandPhilippot/apcom-cpt
 * @since   0.1.0
 */

namespace APcom_CPT;

/**
 * The class responsible of Custom Post Types registration.
 *
 * @since 0.1.0
 */
class CPT {
	/**
	 * The custom post type ID.
	 *
	 * @var string
	 */
	private $id;

	/**
	 * Custom post type name.
	 *
	 * @var string
	 */
	private $name;

	/**
	 * Custom post type singular name.
	 *
	 * @var string
	 */
	private $singular_name;

	/**
	 * Custom post type description.
	 *
	 * @var string
	 */
	private $description;

	/**
	 * Custom post type icon.
	 *
	 * @var string
	 */
	private $icon;

	/**
	 * Custom post type menu position.
	 *
	 * @var string
	 */
	private $position;

	/**
	 * Enable Archives of Custom post type.
	 *
	 * @var bool
	 */
	private $enable_archives;

	/**
	 * Enable custom post type comments.
	 *
	 * @var bool
	 */
	private $enable_comments;

	/**
	 * Create a new custom post type.
	 *
	 * @since 0.1.0
	 *
	 * @param string  $singular The singular post type name: a single word.
	 * @param string  $plural The plural post type name: a single word.
	 * @param string  $icon Dashicons helper class or base64-encoded SVG using a data URI.
	 * @param int     $position The position in the menu.
	 * @param boolean $enable_archives Whether there should be post type archives.
	 * @param boolean $enable_comments Whether the post type should support comments.
	 */
	public function __construct( $singular, $plural, $icon, $position, $enable_archives = false, $enable_comments = false ) {
		$this->id            = strtolower( $singular );
		$this->singular_name = $singular;
		$this->name          = $plural;
		// translators: %s custom post type singular name.
		$this->description     = sprintf( __( 'Custom Post Type: %s', 'APComCPT' ), $singular );
		$this->icon            = $icon;
		$this->position        = $position;
		$this->enable_archives = $enable_archives;
		$this->enable_comments = $enable_comments;
	}

	/**
	 * Add a hook to register the CPT.
	 *
	 * @since 0.1.0
	 */
	public function init() {
		add_action( 'init', array( $this, 'register' ) );
	}

	/**
	 * Register a new custom post type.
	 *
	 * @see get_post_type_labels() for label keys.
	 * @see register_post_type() for args.
	 * @since 0.1.0
	 */
	public function register() {
		$labels = array(
			'name'                  => $this->name,
			'singular_name'         => $this->singular_name,
			'menu_name'             => $this->name,
			'name_admin_bar'        => $this->singular_name,
			'add_new'               => __( 'Add New', 'APComCPT' ),
			'add_new_item'          => sprintf(
				// translators: %s Custom post type singular name.
				__( 'Add New %s', 'APComCPT' ),
				$this->singular_name
			),
			'new_item'              => sprintf(
				// translators: %s Custom post type singular name.
				__( 'New %s', 'APComCPT' ),
				$this->singular_name
			),
			'edit_item'             => sprintf(
				// translators: %s Custom post type singular name.
				__( 'Edit %s', 'APComCPT' ),
				$this->singular_name
			),
			'view_item'             => sprintf(
				// translators: %s Custom post type singular name.
				__( 'View %s', 'APComCPT' ),
				$this->singular_name
			),
			'all_items'             => sprintf(
				// translators: %s Custom post type name.
				__( 'All %s', 'APComCPT' ),
				$this->name
			),
			'search_items'          => sprintf(
				// translators: %s Custom post type name.
				__( 'Search %s', 'APComCPT' ),
				$this->name
			),
			'parent_item_colon'     => sprintf(
				// translators: %s Custom post type name.
				__( 'Parent %s', 'APComCPT' ),
				$this->name
			),
			'not_found'             => sprintf(
				// translators: %s Custom post type name.
				__( 'No %s found', 'APComCPT' ),
				strtolower( $this->name )
			),
			'not_found_in_trash'    => sprintf(
				// translators: %s Custom post type name.
				__( 'No %s found in trash', 'APComCPT' ),
				strtolower( $this->name )
			),
			'featured_image'        => sprintf(
				// translators: %s Custom post type singular name.
				__( '%s Featured Image', 'APComCPT' ),
				$this->singular_name
			),
			'set_featured_image'    => __( 'Set featured image', 'APComCPT' ),
			'remove_featured_image' => __( 'Remove featured image', 'APComCPT' ),
			'use_featured_image'    => __( 'Use as featured image', 'APComCPT' ),
			'archives'              => sprintf(
				// translators: %s Custom post type singular name.
				__( '%s Archives', 'APComCPT' ),
				$this->singular_name
			),
			'insert_into_item'      => sprintf(
				// translators: %s Custom post type singular name.
				__( 'Insert into %s', 'APComCPT' ),
				strtolower( $this->singular_name )
			),
			'uploaded_to_this_item' => sprintf(
				// translators: %s Custom post type singular name.
				__( 'Upload to this %s', 'APComCPT' ),
				strtolower( $this->singular_name )
			),
			'filter_items_list'     => sprintf(
				// translators: %s Custom post type name.
				__( 'Filter %s list', 'APComCPT' ),
				strtolower( $this->name )
			),
			'items_list_navigation' => sprintf(
				// translators: %s Custom post type name.
				__( '%s list navigation', 'APComCPT' ),
				$this->name
			),
			'items_list'            => sprintf(
				// translators: %s Custom post type name.
				__( '%s list', 'APComCPT' ),
				$this->name
			),
		);

		$supports = array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'revisions', 'page-attributes', 'custom-fields' );

		if ( $this->enable_comments ) {
			$supports[] = 'comments';
		}

		$args = array(
			'labels'              => $labels,
			'description'         => $this->description,
			'public'              => true,
			'publicly_queryable'  => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'query_var'           => true,
			'rewrite'             => array( 'slug' => $this->id ),
			'capability_type'     => 'post',
			'has_archive'         => $this->enable_archives,
			'hierarchical'        => false,
			'menu_position'       => $this->position,
			'menu_icon'           => $this->icon,
			'supports'            => $supports,
			'show_in_rest'        => true,
			'show_in_graphql'     => true,
			'graphql_single_name' => strtolower( $this->singular_name ),
			'graphql_plural_name' => strtolower( $this->name ),
		);

		register_post_type( $this->id, $args );
	}
}
