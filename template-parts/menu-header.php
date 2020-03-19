<?php
/**
 * Template part for displaying top app bar
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Material-theme-wp
 */

?>

<header class="mdc-top-app-bar top-app-bar -with-drawer">
	<div class="mdc-top-app-bar__row">
		<section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-start">
			<button class="material-icons mdc-top-app-bar__navigation-icon mdc-icon-button top-app-bar__menu-trigger"><?php esc_html_e( 'menu', 'material-theme-wp' ); ?></button>
			<?php if ( has_custom_logo() ) : ?>
				<div class="logo">
					<?php the_custom_logo(); ?>
				</div>
			<?php endif; ?>
			<span class="mdc-top-app-bar__title top-app-bar__title">
				<?php
				if ( is_front_page() && is_home() ) :
					?>
					<h1 class="site-title mdc-typography mdc-typography--headline1">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
					</h1>
					<?php
				else :
					?>
					<p class="site-title mdc-typography mdc-typography--headline1"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php
				endif;
				?>
			</span>
		</section>
		<section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-end top-app-bar__menu" role="toolbar">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'menu-1',
				'menu_id'        => 'primary-menu',
				'walker'         => new Material_Theme_Menu(),
				'container'      => '',
				'items_wrap'     => '<nav id="%1$s" class="%2$s">%3$s</nav>',
			) );
			?>

			<button class="mdc-button mdc-button--outlined search__button"> 
				<span class="mdc-button__ripple"></span>
				<i class="material-icons mdc-button__icon">search</i>
				<?php esc_html_e( 'Search', 'material-theme-wp' ); ?>
			</button>
		</section>
	</div>
</header>
