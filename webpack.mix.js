const mix = require('laravel-mix');

// Компиляция SCSS и JS файлов
mix
    .sass('resources/scss/app.scss', 'public/css')  // Компиляция SCSS в public/css
    .js('resources/js/app.js', 'public/js')        // Компиляция JS в public/js
    .sourceMaps();                                 // Генерация карт исходного кода для отладки
