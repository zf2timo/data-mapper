<?php

return [
    'service_manager' => [
        'factories' => [
            'CategoryMapperFactory' => 'Module\Mapper\Factory\CategoryFactory',
            'ArticleMapperFactory' => 'Module\Mapper\Factory\ArticleFactory',
        ],
    ],
];