<?php

/* Simple configuration file for Laravel Sitemap package */
return [
    'use_cache' => false,
    'cache_key' => 'Laravel.Sitemap.' . config('app.url'),
    'cache_duration' => 3600,
    'escaping' => true,
    'tags' => [
        'php' => 'PHP',
        'python' => 'Python',
        'linux' => 'Linux',
        'sape' => 'Sape',
        'bash' => 'Bash',
        'javascript' => 'JavaScript',
        'jquery' => 'jQuery',
        'html' => 'HTML',
        'яндекс' => 'Яндекс',
        'mysql' => 'MySQL',
        'парсинг' => 'парсинг',
        'vk' => 'VK',
        'google' => 'Google',
        'zend' => 'Zend'
    ]
];