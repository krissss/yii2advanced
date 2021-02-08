var Encore = require('@symfony/webpack-encore');
var dotenv = require('dotenv').config();
var webpack = require('webpack');
var entries = require('./resources/js/config').entries

// Manually configure the runtime environment if not already configured yet by the "encore" command.
// It's useful when you use tools that rely on webpack.config.js file.
if (!Encore.isRuntimeEnvironmentConfigured()) {
  Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

entries.forEach(({name, src}) => {
  Encore.addEntry(name, src)
})

Encore
  // directory where compiled assets will be stored
  .setOutputPath('public/assets/build/')
  // public path used by the web server to access the output path
  .setPublicPath((process.env.PUBLIC_URL || '/') + 'assets/build')
  // only needed for CDN's or sub-directory deploy
  //.setManifestKeyPrefix('build/')

  /*
   * ENTRY CONFIG
   *
   * Add 1 entry for each "page" of your app
   * (including one that's included on every page - e.g. "app")
   *
   * Each entry will result in one JavaScript file (e.g. app.js)
   * and one CSS file (e.g. app.css) if your JavaScript imports CSS.
   */
  //.addEntry('app', './resources/js/app.js')

  // When enabled, Webpack "splits" your files into smaller pieces for greater optimization.
  .splitEntryChunks()

  // will require an extra script tag for runtime.js
  // but, you probably want this, unless you're building a single-page app
  .enableSingleRuntimeChunk()
  //.disableSingleRuntimeChunk()

  /*
   * FEATURE CONFIG
   *
   * Enable & configure other features below. For a full
   * list of features, see:
   * https://symfony.com/doc/current/frontend.html#adding-more-features
   */
  .cleanupOutputBeforeBuild()
  //.enableBuildNotifications()
  .enableSourceMaps(!Encore.isProduction())
  // enables hashed filenames (e.g. app.abc123.css)
  .enableVersioning(Encore.isProduction())

  // enables @babel/preset-env polyfills
  .configureBabelPresetEnv((config) => {
    config.useBuiltIns = 'usage';
    config.corejs = 3;
  })

// enables Sass/SCSS support
  .enableSassLoader()
  .enablePostCssLoader()
  .enableVueLoader(() => {}, {
    runtimeCompilerBuild: false
  })
  .addLoader({
    test: /\.(mp3|wav|mp4)$/,
    type: 'asset/resource',
    generator: { filename: 'source/[name].[hash:8][ext]' },
  })

// uncomment if you use TypeScript
//.enableTypeScriptLoader()

// uncomment to get integrity="..." attributes on your script & link tags
// requires WebpackEncoreBundle 1.4 or higher
//.enableIntegrityHashes(Encore.isProduction())

// uncomment if you're having problems with a jQuery plugin
//.autoProvidejQuery()

// uncomment if you use API Platform Admin (composer require api-admin)
//.enableReactPreset()
//.addEntry('admin', './assets/js/admin.js')

  // 增加 .env 到 process.env
  .addPlugin(new webpack.DefinePlugin({
    'process.env': dotenv.parsed
  }))
;

  module.exports = Encore.getWebpackConfig();
