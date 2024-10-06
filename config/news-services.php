<?php

return [

    'news-api' => [

        'url' => 'https://newsapi.org/v2/everything',

        'api-key' => env('NEWS_API_KEY')

    ],

    'new-york-times-api' => [

        'url' => 'https://api.nytimes.com/svc/search/v2/articlesearch.json',

        'api-key' => env('NEW_YORK_TIMES_API_KEY')

    ],

    'guardian-api' => [

        'url' => 'https://api.nytimes.com/svc/search/v2/articlesearch.json',

        'api-key' => env('GUARDIAN_API_KEY')

    ],

];
