/**
 * External dependencies
 */
const path = require( 'path' );
const MiniCssExtractPlugin = require( 'mini-css-extract-plugin' );
const OptimizeCSSAssetsPlugin = require( 'optimize-css-assets-webpack-plugin' );
const RtlCssPlugin = require( 'rtlcss-webpack-plugin' );
const TerserPlugin = require( 'terser-webpack-plugin' );
const WebpackBar = require( 'webpackbar' );

/**
 * WordPress dependencies
 */
const defaultConfig = require( '@wordpress/scripts/config/webpack.config' );

// Exclude `node_modules` folder from `source-map-loader` to prevent webpack warnings.
if ( defaultConfig.module && Array.isArray( defaultConfig.module.rules ) ) {
	defaultConfig.module.rules.some( function( rule ) {
		if ( rule.use && rule.use.includes( 'source-map-loader' ) ) {
			rule.exclude = /node_modules/;
			return true;
		}

		return false;
	} );
}

const sharedConfig = {
	output: {
		path: path.resolve( process.cwd(), 'assets', 'js' ),
		filename: '[name].js',
		chunkFilename: '[name].js',
	},
	optimization: {
		minimizer: [
			new TerserPlugin( {
				parallel: true,
				sourceMap: false,
				cache: true,
				terserOptions: {
					output: {
						comments: /translators:/i,
					},
				},
				extractComments: false,
			} ),
			new OptimizeCSSAssetsPlugin( {} ),
		],
	},
	module: {
		...defaultConfig.module,
		rules: [
			...defaultConfig.module.rules,
			{
				test: /\.css$/,
				use: [
					// prettier-ignore
					MiniCssExtractPlugin.loader,
					'css-loader',
					'postcss-loader',
				],
			},
		],
	},
	plugins: [
		...defaultConfig.plugins,
		new MiniCssExtractPlugin( {
			filename: '../css/[name]-compiled.css',
		} ),
		new RtlCssPlugin( {
			filename: '../css/[name]-compiled-rtl.css',
		} ),
	],
};

const customizer = {
	...defaultConfig,
	...sharedConfig,
	entry: {
		'customize-controls': [
			'./assets/src/customizer/customize-controls.js',
			'./assets/css/src/customize-controls.css',
		],
		'customize-preview': [
			'./assets/src/customizer/customize-preview.js',
			'./assets/css/src/customize-preview.css',
		],
	},
	plugins: [
		...sharedConfig.plugins,
		new WebpackBar( {
			name: 'Customizer',
			color: '#f27136',
		} ),
	],
};

const frontEnd = {
	...defaultConfig,
	...sharedConfig,
	entry: {
		'front-end': [
			'./assets/src/front-end/index.js',
			'./assets/css/src/front-end.css',
		],
	},
	plugins: [
		...sharedConfig.plugins,
		new WebpackBar( {
			name: 'Front End',
			color: '#36f271',
		} ),
	],
};

const admin = {
	...defaultConfig,
	...sharedConfig,
	entry: {
		admin: [ './assets/css/src/admin.css' ],
	},
	plugins: [
		...sharedConfig.plugins,
		new WebpackBar( {
			name: 'Admin',
			color: '#36f271',
		} ),
	],
};

const editor = {
	...defaultConfig,
	...sharedConfig,
	entry: {
		editor: [ './assets/css/src/editor.css' ],
	},
	plugins: [
		...sharedConfig.plugins,
		new WebpackBar( {
			name: 'Editor',
			color: '#ebbf48',
		} ),
	],
};
const materialCssPackages = [
	'@material/typography/dist/mdc.typography.css',
	'@material/button/dist/mdc.button.css',
	'@material/top-app-bar/dist/mdc.top-app-bar.css',
	'@material/icon-button/dist/mdc.icon-button.css',
	'@material/drawer/dist/mdc.drawer.css',
	'@material/list/dist/mdc.list.css',
	'@material/form-field/dist/mdc.form-field.css',
	'@material/floating-label/dist/mdc.floating-label.css',
	'@material/textfield/dist/mdc.textfield.css',
	'@material/checkbox/dist/mdc.checkbox.css',
	'@material/card/dist/mdc.card.css',
	'@material/layout-grid/dist/mdc.layout-grid.css',
	'@material/ripple/dist/mdc.ripple.css',
	'@material/image-list/dist/mdc.image-list.css',
	'@material/tab-bar/dist/mdc.tab-bar.css',
	'@material/tab-scroller/dist/mdc.tab-scroller.css',
	'@material/tab-indicator/dist/mdc.tab-indicator.css',
	'@material/tab/dist/mdc.tab.css',
];
const materialCss = {
	...defaultConfig,
	...sharedConfig,
	entry: materialCssPackages.reduce( ( entryConfig, packagePath ) => {
		const packageHandle = `mdc-${packagePath
			.split( 'mdc.' )[1]
			.replace( '.css', '' ) }`;
		return {
			...entryConfig,
			[packageHandle]: packagePath,
		};
	}, {} ),
	plugins: [
		...sharedConfig.plugins,
		new WebpackBar( {
			name: 'Material CSS',
			color: '#3ce1bb',
		} ),
	],
};

module.exports = [
	// prettier-ignore
	customizer,
	frontEnd,
	admin,
	editor,
	materialCss,
];
