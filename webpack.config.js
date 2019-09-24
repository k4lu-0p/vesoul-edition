var Encore = require('@symfony/webpack-encore');
const CopyWebpackPlugin = require('copy-webpack-plugin');


Encore

    .setOutputPath('public/build/')
    .setPublicPath('/build')
    //.setManifestKeyPrefix('build/')

    // Activer SASS
    .enableSassLoader()
    // Activer TS
    .enableTypeScriptLoader()
    // Activer jQuery
    .autoProvideVariables({
        $: 'jquery',
        jQuery: 'jquery',
        'window.jQuery': 'jquery',
    })
    
    .addEntry('front', ['./assets/front/js/layout-front.js', './assets/front/js/home.js'])
    .addEntry('admin', './assets/back/js/layout-back.js')
    .addPlugin(new CopyWebpackPlugin([
        { from: './assets/front/static', to: 'images' }
    ]))

    .enableSingleRuntimeChunk()
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())

;

// Use polling instead of inotify
const config = Encore.getWebpackConfig();
config.watchOptions = {
    poll: true,
};

// Export the final configuration
module.exports = config;