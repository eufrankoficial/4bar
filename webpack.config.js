const path = require('path');

module.exports = {
    entry: path.resolve('resources', 'assets', 'js', 'app.js'),
    output: {
        filename: 'bundle.js',
        path: path.resolve(__dirname, 'public/assets/core/js'),
    },
    module: {
        rules:[
            {
                test: /\.vue$/,
                loader: 'vue-loader',
                exclude: /(node_modules)/
            }
        ]
    }
};
