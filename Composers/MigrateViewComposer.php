<?php

namespace Modules\Kantoku\Composers;

use Illuminate\Contracts\View\View;
use Modules\Kantoku\Manager\ModuleManager;

class MigrateViewComposer
{
    /**
     * @var ModuleManager
     */
    private $module;

    public function __construct(ModuleManager $module)
    {
        $this->module = $module;
    }

    public function compose(View $view)
    {
        $view->modules = $this->module->enabled();
    }
}
