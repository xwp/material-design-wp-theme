/**
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

module.exports = {
	plugins: [
		require( '@wordpress/postcss-themes' )( {
			defaults: {
				primary: '#007cba',
				secondary: '#11a0d2',
				toggle: '#11a0d2',
				button: '#007cba',
				outlines: '#007cba',
			},
			themes: {
				'admin-color-light': {
					primary: '#007cba',
					secondary: '#c75726',
					toggle: '#11a0d2',
					button: '#007cba',
					outlines: '#007cba',
				},
				'admin-color-blue': {
					primary: '#82b4cb',
					secondary: '#d9ab59',
					toggle: '#82b4cb',
					button: '#d9ab59',
					outlines: '#417e9B',
				},
				'admin-color-coffee': {
					primary: '#c2a68c',
					secondary: '#9fa47b',
					toggle: '#c2a68c',
					button: '#c2a68c',
					outlines: '#59524c',
				},
				'admin-color-ectoplasm': {
					primary: '#a7b656',
					secondary: '#c77430',
					toggle: '#a7b656',
					button: '#a7b656',
					outlines: '#523f6d',
				},
				'admin-color-midnight': {
					primary: '#e14d43',
					secondary: '#77a6b9',
					toggle: '#77a6b9',
					button: '#e14d43',
					outlines: '#497b8d',
				},
				'admin-color-ocean': {
					primary: '#a3b9a2',
					secondary: '#a89d8a',
					toggle: '#a3b9a2',
					button: '#a3b9a2',
					outlines: '#5e7d5e',
				},
				'admin-color-sunrise': {
					primary: '#d1864a',
					secondary: '#c8b03c',
					toggle: '#c8b03c',
					button: '#d1864a',
					outlines: '#837425',
				},
			},
		} ),
		require( 'postcss-color-function' ),
		require( 'postcss-import' ),
		require( 'postcss-mixins' ),
		require( 'postcss-nested' ),
		require( 'postcss-simple-vars' ),
		require( 'postcss-preset-env' )( {
			stage: 0,
			preserve: false, // Omit pre-polyfilled CSS.
			features: {
				'nesting-rules': true, // Uses postcss-nesting which doesn't behave like Sass.
				'custom-properties': {
					preserve: true, // Do not remove :root selector.
				},
				'custom-media-queries': true,
			},
			autoprefixer: {
				grid: true,
			},
		} ),
		require( 'postcss-calc' ),
	],
};
