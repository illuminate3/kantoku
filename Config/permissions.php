<?php

return [
    'kantoku.sidebar' => [
        'group' => 'kantoku::kantoku.show sidebar group',
    ],
    'kantoku.modules' => [
        'index' => 'kantoku::modules.list resource',
        'show' => 'kantoku::modules.show resource',
        'update' => 'kantoku::modules.update resource',
        'disable' => 'kantoku::modules.disable resource',
        'enable' => 'kantoku::modules.enable resource',
        'publish' => 'kantoku::modules.publish assets',
    ],
    'kantoku.themes' => [
        'index' => 'kantoku::themes.list resource',
        'show' => 'kantoku::themes.show resource',
        'publish' => 'kantoku::themes.publish assets',
    ],
];
