<?php

namespace Modules\Kantoku\Scaffold\Theme\FileTypes;

interface FileType
{
    /**
     * Generate the current file type
     * @return string
     */
    public function generate();
}
