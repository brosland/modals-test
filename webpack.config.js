const webpack = require('webpack');
const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

module.exports = {
	entry: {
		app: './www/assets/base/index.js'
	},
	output: {
		path: path.join(__dirname, 'www/dist'),
		filename: '[name].bundle.js'
	},
	module: {
		rules: [
			{
				test: /\.js?$/,
				exclude: /node_modules/,
				loader: 'babel-loader',
				query: {
					cacheDirectory: true,
					"presets": [
						["env", {
							"targets": {
								"browsers": ["last 2 versions", "safari >= 7"]
							}
						}]
					]
				}
			},
			{
				test: /\.css$/, use: [
					MiniCssExtractPlugin.loader,
					'css-loader'
				]
			},
			{
				test: /\.(jpe?g|png|gif|svg|ico)$/i,
				use: [
					'file-loader?name=images/[name].[ext]'
				]
			},
			{
				test: /\.(eot|ttf|woff)$/i,
				use: [
					'file-loader?name=fonts/[name].[ext]'
				]
			},
			{
				test: /\.woff2?(\?v=[0-9]\.[0-9]\.[0-9])?$/,
				use: 'url-loader?name=fonts/[name].[ext]&limit=10000'
			}
		]
	},
	plugins: [
		new webpack.ProvidePlugin({
			$: 'jquery',
			jQuery: 'jquery',
			'window.jQuery': 'jquery',
			'window.Nette': 'nette-forms',
			Popper: ['popper.js', 'default']
		}),
		new MiniCssExtractPlugin({
			filename: "[name].bundle.css"
		})
	]
};