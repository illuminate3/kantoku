<?php

namespace Modules\Kantoku\Scaffold\Theme\FileTypes;

use Modules\Kantoku\Scaffold\Theme\Traits\FindsThemePath;

class BasicView extends BaseFileType implements FileType
{
    use FindsThemePath;

    /**
     * Generate the current file type
     * @return string
     */
    public function generate()
    {
        $stub = $this->finder->get(__DIR__ . '/../stubs/index.blade.stub');

        $this->finder->put($this->themePathForFile($this->options['name'], '/views/default.blade.php'), $stub);
    }
}
