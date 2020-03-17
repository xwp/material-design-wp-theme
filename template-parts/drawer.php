<?php
/**
 * Template part for displaying menu drawer
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Material-theme-wp
 */

?>


<aside class="mdc-drawer material-drawer mdc-drawer--modal">
	<div class="mdc-drawer__header">
		<h1 class="shrine-title"><?php bloginfo( 'name' ); ?></h1>
	</div>
	<div class="mdc-drawer__content">
		<nav class="mdc-list">
			<a class="mdc-list-item mdc-list-item--activated" aria-selected="true" tabindex="0" href="#">
				<span class="mdc-list-item__text">Featured</span>
			</a>
			<a class="mdc-list-item" href="#">
				<span class="mdc-list-item__text">Apartment</span>
			</a>
			<a class="mdc-list-item" href="#">
				<span class="mdc-list-item__text">Accessories</span>
			</a>
		</nav>
	</div>
</aside>
