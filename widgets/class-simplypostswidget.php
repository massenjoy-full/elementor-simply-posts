<?php
/**
 * Plugin Name: Elementor Simply Posts
 * Plugin URI: https://github.com/massenjoy-full/elementor-simply-posts
 * Description: Simply posts for Elementor.
 * Author: Maxim Bryk
 * Author URI: https://github.com/massenjoy-full/
 * Version: 1.0.0
 * Requires at least: 5.6
 * Text Domain: elementor-simply-posts
 * Domain Path: /languages
 * Tested up to: 6.5
 * Elementor tested up to: 3.20.4
 * Elementor Pro tested up to: 3.20.0
 * License: GPL2
 *
 * @package Elementor_Simply_Posts
 */

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( '\Elementor\Widget_Base' ) ) {
	return;
}

/**
 * Registers a Dock Block for the widget.
 *
 * This function is called at the end of the constructor.
 * It registers the Dock Block for the widget.
 *
 * @since 1.0.0
 */
class SimplyPostsWidget extends Elementor\Widget_Base {
	/**
	 * Retrieves the name of the widget.
	 *
	 * This function is used by Elementor to register the widget.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string The name of the widget.
	 */
	public function get_name() {
		// The get_name() function retrieves the name of the widget.
		// This name is used by Elementor to register the widget.
		// It's also used in the editor to identify the widget.
		return 'simplyposts';
	}

	/**
	 * Get the widget title.
	 *
	 * Retrieves the title of the widget.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string The widget title.
	 */
	public function get_title() {
		// The title of the widget.
		return esc_html__( 'Simply Posts', 'elementor-simply-posts' );
	}

	/**
	 * Retrieve the icon for the widget.
	 *
	 * This function is used by Elementor to display the widget icon in the editor.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string The icon class name.
	 */
	public function get_icon() {
		// The icon class name for the widget, used by Elementor to display the widget icon in the editor.
		return 'eicon-post-list';
	}

	/**
	 * Get the categories for the widget.
	 *
	 * This function retrieves the categories the widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array The categories the widget belongs to.
	 */
	public function get_categories() {
		// The get_categories() function retrieves the categories the widget belongs to.
		// In this case, the widget belongs to the 'general' category.
		// This category name is used by Elementor to group the widget in the editor.
		return array( 'general' );
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the oEmbed widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return array( 'posts', 'post', 'simply', 'simple' );
	}

	/**
	 * Registers controls for the widget.
	 *
	 * This function is called at the beginning of the constructor.
	 * It registers the necessary controls for the widget.
	 *
	 * @since 1.0.0
	 * @access protected
	 * @return void
	 */
	protected function register_controls() {
		// Register section title.
		$this->section_title();

		// Register section content.
		$this->section_content();

		// Register section layout.
		$this->section_layout();

		// Register section styling.
		$this->section_styling();
	}

	/**
	 * Registers the title section of the widget controls.
	 *
	 * This function starts the title section, adds controls for showing and
	 * setting the title, and adds a control for selecting the title tag.
	 *
	 * @since 1.0.0
	 * @access protected
	 * @return void
	 */
	protected function section_title() {
		// Start the title section.
		$this->start_controls_section(
			'section_title',
			array(
				'label' => esc_html__( 'Title', 'elementor' ),
			)
		);

		// Add a control for showing the title.
		$this->add_control(
			'show_title',
			array(
				'label'        => esc_html__( 'Show Title', 'elementor-simply-posts' ),
				'type'         => Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'elementor' ),
				'label_off'    => esc_html__( 'Hide', 'elementor' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		// Add a control for the title.
		$this->add_control(
			'title',
			array(
				'label'     => esc_html__( 'Title', 'elementor' ),
				'type'      => Elementor\Controls_Manager::TEXT,
				'default'   => esc_html__( 'Default title', 'elementor' ),
				'dynamic'   => array(
					'active' => true,
				),
				'condition' => array(
					'show_title' => 'yes',
				),
			)
		);

		// Add a control for selecting the title tag.
		$this->add_control(
			'title_tag',
			array(
				'label'     => esc_html__( 'Title HTML Tag', 'elementor' ),
				'type'      => Elementor\Controls_Manager::SELECT,
				'default'   => 'h2',
				'options'   => array(
					'h1'     => esc_html__( 'H1', 'elementor' ),
					'h2'     => esc_html__( 'H2', 'elementor' ),
					'h3'     => esc_html__( 'H3', 'elementor' ),
					'h4'     => esc_html__( 'H4', 'elementor' ),
					'h5'     => esc_html__( 'H5', 'elementor' ),
					'p'      => esc_html__( 'P', 'elementor' ),
					'strong' => esc_html__( 'Strong', 'elementor' ),
				),
				'condition' => array(
					'show_title' => 'yes',
				),
			)
		);

		// End the title section.
		$this->end_controls_section();
	}

	/**
	 * Registers the content section of the widget controls.
	 *
	 * This function starts the content section and registers various controls
	 * for the widget, such as post type, status, count, offset, order by,
	 * order, and pagination.
	 *
	 * @since 1.0.0
	 * @access protected
	 * @return void
	 */
	protected function section_content() {
		// Start the content section.
		$this->start_controls_section(
			'section_content',
			array(
				'label' => esc_html__( 'Content', 'elementor' ),
			)
		);

		// Register the "Post Type" control.
		$this->add_control(
			'posts_type',
			array(
				'label'   => esc_html__( 'Post Type', 'elementor-simply-posts' ),
				'type'    => Elementor\Controls_Manager::SELECT,
				'options' => get_post_types( array(), 'names' ), // Get all post types.
				'default' => 'post', // Default post type.
			)
		);

		// Register the "Post Status" control.
		$this->add_control(
			'posts_status',
			array(
				'label'   => esc_html__( 'Post Status', 'elementor-simply-posts' ),
				'type'    => Elementor\Controls_Manager::SELECT,
				'options' => array(
					'publish' => esc_html__( 'Publish', 'elementor' ),
					'draft'   => esc_html__( 'Draft', 'elementor' ),
					'pending' => esc_html__( 'Pending', 'elementor' ),
				),
				'default' => 'publish', // Default post status.
			)
		);

		// Register the "Post Per Page" control.
		$this->add_control(
			'posts_count',
			array(
				'label'   => esc_html__( 'Posts Per Page', 'elementor-simply-posts' ),
				'type'    => Elementor\Controls_Manager::NUMBER,
				'default' => 10, // Default number of posts per page.
			)
		);

		// Register the "Post Offset" control.
		$this->add_control(
			'posts_offset',
			array(
				'label'   => esc_html__( 'Offset', 'elementor' ),
				'type'    => Elementor\Controls_Manager::NUMBER,
				'default' => 0, // Default offset.
			)
		);

		// Register the "Order By" control.
		$this->add_control(
			'posts_order_by',
			array(
				'label'   => esc_html__( 'Order By', 'elementor' ),
				'type'    => Elementor\Controls_Manager::SELECT,
				'options' => array(
					'post_id'     => esc_html__( 'Post ID', 'elementor-simply-posts' ),
					'post_author' => esc_html__( 'Post Author', 'elementor-simply-posts' ),
					'title'       => esc_html__( 'Title' ),
					'date'        => esc_html__( 'Date' ),
				),
				'default' => 'date', // Default order by.
			)
		);

		// Register the "Order" control.
		$this->add_control(
			'posts_order',
			array(
				'label'   => esc_html__( 'Order', 'elementor' ),
				'type'    => Elementor\Controls_Manager::SELECT,
				'options' => array(
					'asc'  => esc_html__( 'Ascending' ),
					'desc' => esc_html__( 'Descending' ),
				),
				'default' => 'desc', // Default order.
			)
		);

		// Register the "Show Pagination" control.
		$this->add_control(
			'show_pagination',
			array(
				'label'   => esc_html__( 'Show Pagination', 'elementor-simply-posts' ),
				'type'    => Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes', // Default value.
			)
		);

		// End the content section.
		$this->end_controls_section();
	}

	/**
	 * Register the section layout controls.
	 *
	 * This function registers the controls for the section layout section in the widget.
	 *
	 * @since 1.0.0
	 * @access protected
	 * @return void
	 */
	protected function section_layout() {
		// Start the layout section.
		$this->start_controls_section(
			'section_layout',
			array(
				'label' => esc_html__( 'Layout', 'elementor' ),
			)
		);

		// Register the "Template Type" control.
		$this->add_control(
			'template_type',
			array(
				'label'   => esc_html__( 'Type' ),
				'type'    => Elementor\Controls_Manager::SELECT,
				'options' => array(
					'list' => esc_html__( 'List', 'elementor' ),
					'grid' => esc_html__( 'Grid', 'elementor' ),
				),
				'default' => 'list',
			)
		);

		// Register the "Columns" control.
		$this->add_responsive_control(
			'columns',
			array(
				'label'     => esc_html__( 'Columns', 'elementor' ),
				'type'      => Elementor\Controls_Manager::SELECT,
				'separator' => 'before',
				'options'   => array(
					''  => esc_html__( 'Default', 'elementor' ),
					'1' => esc_html__( '1', 'elementor' ),
					'2' => esc_html__( '2', 'elementor' ),
					'3' => esc_html__( '3', 'elementor' ),
					'4' => esc_html__( '4', 'elementor' ),
					'5' => esc_html__( '5', 'elementor' ),
					'6' => esc_html__( '6', 'elementor' ),
				),
				'default'   => 3,
				'selectors' => array(
					'{{WRAPPER}} .simplyposts-cards' => 'grid-template-columns: repeat({{VALUE}},1fr);',
				),
			)
		);

		// Register the "Show Image" control.
		$this->add_control(
			'show_image',
			array(
				'label'     => esc_html__( 'Show Image', 'elementor-simply-posts' ),
				'type'      => Elementor\Controls_Manager::SELECT,
				'options'   => array(
					'yes' => esc_html__( 'Yes', 'elementor' ),
					'no'  => esc_html__( 'No', 'elementor' ),
				),
				'default'   => 'yes',
				'condition' => array(
					'template_type' => 'grid',
				),
				'separator' => 'after',
			)
		);

		// Register the "Show Title" control.
		$this->add_control(
			'post_show_title',
			array(
				'label'        => esc_html__( 'Show Title', 'elementor-simply-posts' ),
				'type'         => Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'elementor' ),
				'label_off'    => esc_html__( 'Hide', 'elementor' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => array(
					'template_type' => 'grid',
				),
			)
		);

		// Register the "Title Alignment" control.
		$this->add_control(
			'post_title_text_align',
			array(
				'label'     => esc_html__( 'Alignment', 'elementor' ),
				'type'      => Elementor\Controls_Manager::CHOOSE,
				'options'   => array(
					'left'   => array(
						'title' => esc_html__( 'Left', 'elementor' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'elementor' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'  => array(
						'title' => esc_html__( 'Right', 'elementor' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'default'   => 'left',
				'toggle'    => true,
				'selectors' => array(
					'{{WRAPPER}} .simplyposts-title' => 'text-align: {{VALUE}};',
				),
				'condition' => array(
					'post_show_title' => 'yes',
				),
			)
		);

		// Register the "Title Tag" control.
		$this->add_control(
			'post_title_tag',
			array(
				'label'     => esc_html__( 'Title HTML Tag', 'elementor' ),
				'type'      => Elementor\Controls_Manager::SELECT,
				'options'   => array(
					'h1'   => 'H1',
					'h2'   => 'H2',
					'h3'   => 'H3',
					'h4'   => 'H4',
					'h5'   => 'H5',
					'h6'   => 'H6',
					'div'  => 'div',
					'span' => 'span',
					'p'    => 'p',
				),
				'default'   => 'h3',
				'condition' => array(
					'post_show_title' => 'yes',
				),
				'separator' => 'after',
			)
		);

		// Register the "Show Excerpt" control.
		$this->add_control(
			'post_show_excerpt',
			array(
				'label'        => esc_html__( 'Show Excerpt', 'elementor-simply-posts' ),
				'type'         => Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'elementor' ),
				'label_off'    => esc_html__( 'Hide', 'elementor' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => array(
					'template_type' => 'grid',
				),
			)
		);

		// Register the "Excerpt Length" control.
		$this->add_control(
			'post_excerpt_length',
			array(
				'label'     => esc_html__( 'Excerpt Length', 'elementor-simply-posts' ),
				'type'      => Elementor\Controls_Manager::NUMBER,
				'default'   => 100,
				'condition' => array(
					'post_show_excerpt' => 'yes',
				),
				'separator' => 'after',
			)
		);

		// Register the "Show Read More" control.
		$this->add_control(
			'post_read_more',
			array(
				'label'        => esc_html__( 'Read More', 'elementor' ),
				'type'         => Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'elementor' ),
				'label_off'    => esc_html__( 'Hide', 'elementor' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => array(
					'template_type' => 'grid',
				),
			)
		);

		// Register the "Read More Text" control.
		$this->add_control(
			'post_read_more_text',
			array(
				'label'     => esc_html__( 'Read More Text', 'elementor' ),
				'type'      => Elementor\Controls_Manager::TEXT,
				'default'   => esc_html__( 'Read More', 'elementor' ),
				'dynamic'   => array(
					'active' => true,
				),
				'condition' => array(
					'post_read_more' => 'yes',
				),
			)
		);

		// Register the "Open in New Tab" control.
		$this->add_control(
			'post_read_more_blank',
			array(
				'label'        => esc_html__( 'Open in New Tab', 'elementor-simply-posts' ),
				'type'         => Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'elementor' ),
				'label_off'    => esc_html__( 'No', 'elementor' ),
				'return_value' => 'yes',
				'default'      => '',
				'condition'    => array(
					'post_read_more' => 'yes',
				),
				'separator'    => 'after',
			)
		);

		// Register the "Show Date" control.
		$this->add_control(
			'post_show_date',
			array(
				'label'        => esc_html__( 'Show Date', 'elementor-simply-posts' ),
				'type'         => Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'elementor' ),
				'label_off'    => esc_html__( 'Hide', 'elementor' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => array(
					'template_type' => 'grid',
				),
			)
		);

		// Register the "Date Text Color" control.
		$this->add_control(
			'text_color',
			array(
				'label'     => esc_html__( 'Date Text Color', 'elementor-simply-posts' ),
				'type'      => Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .post-date' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'post_show_date' => 'yes',
				),
			)
		);

		// End the content section.
		$this->end_controls_section();
	}

	/**
	 * Register the Styling section in the Elementor editor.
	 *
	 * This function adds a new section to the Elementor editor that
	 * allows the user to customize the styling of the widget.
	 *
	 * @since 1.0.0
	 * @access protected
	 * @return void
	 */
	protected function section_styling() {
		// Start the styling section.
		$this->start_controls_section(
			'section_styling',
			array(
				'label' => esc_html__( 'Styling', 'elementor' ),
				'tab'   => Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		// Register the "Background" control.
		$this->add_control(
			'background',
			array(
				'label'     => esc_html__( 'Background', 'elementor' ),
				'type'      => Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}}' => 'background-color: {{VALUE}};',
				),
			)
		);

		// Register the "Alignment" control.
		$this->add_responsive_control(
			'alignment',
			array(
				'label'     => esc_html__( 'Alignment', 'elementor' ),
				'type'      => Elementor\Controls_Manager::CHOOSE,
				'options'   => array(
					'left'   => array(
						'title' => esc_html__( 'Left', 'elementor' ),
						'icon'  => 'fa fa-align-left',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'elementor' ),
						'icon'  => 'fa fa-align-center',
					),
					'right'  => array(
						'title' => esc_html__( 'Right', 'elementor' ),
						'icon'  => 'fa fa-align-right',
					),
				),
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				),
			)
		);

		// Register the "Border" group control.
		$this->add_group_control(
			Elementor\Group_Control_Border::get_type(),
			array(
				'name'     => 'border',
				'selector' => '{{WRAPPER}}',
			)
		);

		// Register the "Padding" control.
		$this->add_responsive_control(
			'padding',
			array(
				'label'      => esc_html__( 'Padding', 'elementor' ),
				'type'       => Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}}' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		// Register the "Margin" control.
		$this->add_responsive_control(
			'margin',
			array(
				'label'      => esc_html__( 'Margin', 'elementor' ),
				'type'       => Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}}' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		// End the styling section.
		$this->end_controls_section();
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * This function is called by the WordPress template engine to display
	 * the widget on the front-end.
	 *
	 * @since 1.0.0
	 * @access protected
	 * @return void
	 */
	protected function render() {
		// Get the settings for the current instance of the widget.
		$settings = $this->get_settings_for_display();

		// Get the settings for template type.
		$template_type = $settings['template_type'];

		// Set up the query arguments based on the widget settings.
		$query_args = array(
			'post_type'      => $settings['posts_type'],
			'posts_status'   => $settings['posts_status'],
			'posts_per_page' => $settings['posts_count'],
			'paged'          => get_query_var( 'paged', 1 ),
			'orderby'        => $settings['posts_order_by'],
			'order'          => $settings['posts_order'],
			'offset'         => $settings['posts_offset'],
		);

		// Retrieve the posts based on the query arguments.
		$posts = new WP_Query( $query_args );

		// Display title.
		if ( 'yes' === $settings['show_title'] ) {
			printf(
				'<%1$s class="simplyposts-title">%2$s</%1$s>',
				esc_html( $settings['title_tag'] ),
				esc_html( $settings['title'] )
			);
		}

		// Check if there are posts.
		if ( $posts->have_posts() ) {

			switch ( $template_type ) {
				case 'list':
					$this->display_list( $posts );
					break;
				case 'grid':
					$this->display_grid( $settings, $posts );
					break;
				default:
					$this->display_list( $posts );
					break;
			}

			// Display the pagination if enabled.
			if ( 'yes' === $settings['show_pagination'] ) {
				the_posts_navigation();
			}
		} else {
			// Display a message if no posts are found.
			echo __( 'No posts found.', 'elementor-simply-posts' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}

	/**
	 * Displays a list of posts.
	 *
	 * @param \WP_Query $posts The posts query object.
	 * @access public
	 * @return void
	 */
	public function display_list( $posts ) {
		// Start the list element.
		?>
		<ul class="simplyposts-list">
				<?php
					// Loop through the posts.
				while ( $posts->have_posts() ) {
					$posts->the_post();
					?>
			<li>
				<!-- Display a link to the post. -->
				<a href="<?php the_permalink(); ?>">
					<!-- Display the post title. -->
					<?php the_title(); ?>
				</a>
			</li>
					<?php
				}
				?>
		</ul>
		<?php
		// Reset the post data after the loop.
		wp_reset_postdata();
	}

	/**
	 * Display a grid of posts.
	 *
	 * @param array     $settings The widget settings.
	 * @param \WP_Query $posts The posts query object.
	 * @access public
	 * @return void
	 */
	public function display_grid( $settings, $posts ) {
		// Check if the link should open in a new tab.
		$link_blank = isset( $settings['post_read_more_blank'] ) && 'yes' === $settings['post_read_more_blank'] ? ' target="_blank"' : '';

		// Start the grid container.
		echo '<div class="simplyposts-cards elementor-grid">';

		// Loop through the posts.
		while ( $posts->have_posts() ) {
			$posts->the_post();

			// Start the card element.
			echo '<div class="simplyposts-card">';

			// Display the image if enabled.
			if ( 'yes' === $settings['show_image'] ) {
				$image_url = get_the_post_thumbnail_url();

				if ( false !== $image_url ) {
					printf(
						'<div class="simplyposts-image"><a href="%s"%s><img src="%s" /></a></div>',
						esc_url( get_the_permalink() ),
						esc_html( $link_blank ),
						esc_url( $image_url )
					);
				}
			}

			// Display the title if enabled.
			if ( 'yes' === $settings['post_show_title'] ) {
				printf(
					'<div class="simplyposts-title"><a href="%1$s"%2$s><%3$s class="simplyposts-title">%4$s</%3$s></a></div>',
					esc_url( get_the_permalink() ),
					esc_html( $link_blank ),
					esc_html( $settings['post_title_tag'] ),
					esc_html( get_the_title() )
				);
			}

			// Display the date if enabled.
			if ( 'yes' === $settings['post_show_date'] ) {
				printf(
					'<div class="simplyposts-date"><p class="post-date">%s</p></div>',
					esc_html( get_the_date() )
				);
			}

			// Display the excerpt if enabled.
			if ( 'yes' === $settings['post_show_excerpt'] ) {
				printf(
					'<div class="simplyposts-excerpt"><p>%s</p></div>',
					wp_trim_words( get_the_content(), $settings['post_excerpt_length'] ) // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				);
			}

			// Display the read more link if enabled.
			if ( 'yes' === $settings['post_read_more'] ) {
				printf(
					'<div class="simplyposts-readmore"><a href="%1$s"%2$s>%3$s</a></div>',
					esc_url( get_the_permalink() ),
					esc_html( $link_blank ),
					$settings['post_read_more_text'] // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				);
			}

			// End the card element.
			echo '</div>';
		}

		// End the grid container.
		echo '</div>';

		// Reset the post data after the loop.
		wp_reset_postdata();
	}
}
