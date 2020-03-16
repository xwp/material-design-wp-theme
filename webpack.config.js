module.exports = [{
	entry: './assets/src/css/index.scss',
	output: {
		path: `${__dirname}/assets/dist`,
		filename: 'style-bundle.js'
	},
	module: {
		rules: [
			{
				test: /\.scss$/,
				use: [
					{
						loader: 'file-loader',
						options: {
							name: 'material-theme-style.css',
							outputPath: 'css',
						},
					},
					{
						loader: 'extract-loader'
					},
					{
						loader: 'css-loader'
					},
					{
						loader: 'sass-loader',
						options: {
							implementation: require( 'sass' ),
							sassOptions: {
								includePaths: ['./node_modules']
							},
						},
					},
				]
			}
		]
	},
}];
