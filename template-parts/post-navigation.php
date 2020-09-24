<?php
/**
 * Copyright 2020 Material Design
 * 
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * 
 *     http://www.apache.org/licenses/LICENSE-2.0
 * 
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

/**
 * Template part for post next/previous links.
 *
 * @package MaterialTheme
 */

$previous_link = get_previous_post_link( '%link' );
$next_link     = get_next_post_link( '%link' );

?>

<div class="post-navigation">
	<div class="post-navigation__previous">
		<?php if ( ! empty( $previous_link ) ) : ?>
			<i class="material-icons mdc-button__icon">arrow_back_ios</i>
			<?php echo $previous_link; // phpcs:ignore ?>
		<?php endif; ?>
	</div>

	<div class="post-navigation__next">
		<?php if ( ! empty( $next_link ) ) : ?>
			<?php echo $next_link; // phpcs:ignore ?>
			<i class="material-icons mdc-button__icon">arrow_forward_ios</i>
		<?php endif; ?>
	</div>
</div>
