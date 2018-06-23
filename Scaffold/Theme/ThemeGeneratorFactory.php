<?php

namespace Modules\Kantoku\Scaffold\Theme;

use Modules\Kantoku\Scaffold\Theme\Exceptions\FileTypeNotFoundException;
use Modules\Kantoku\Scaffold\Theme\FileTypes\FileType;

class ThemeGeneratorFactory
{
    /**
     * @param string $file
     * @param array $options
     * @return FileType
     * @throws FileTypeNotFoundException
     */
    public function make($file, array $options)
    {
        $class = 'Modules\Kantoku\Scaffold\Theme\FileTypes\\' . ucfirst($file);

        if (!class_exists($class)) {
            throw new FileTypeNotFoundException();
        }

        return new $class($options);
    }
}
