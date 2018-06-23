<?php

view()->composer(
    [
        'kantoku::admin.workbench.tabs.migrate',
        'kantoku::admin.workbench.tabs.seed',
    ],
    'Modules\Kantoku\Composers\MigrateViewComposer'
);
