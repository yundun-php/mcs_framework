<?php

/**
 * This file is part of the YundunMcs framework.
 *
 * @author    Qingshan Luo <shanshan.lqs@gmail.com>
 * @copyright 2017 - 2018 Qingshan Luo
 * @license   GNU Lesser General Public License 3.0
 */

namespace YundunMcs\Config\Loaders;

use YundunMcs\Util\Validator;
use YundunMcs\Config\AbstractFileLoader;
use YundunMcs\Serializer\JsonSerializer;

class JsonLoader extends AbstractFileLoader
{
    /**
     * The json loader constructor.
     *
     * @param string $directory The directory of the configuration files.
     * @param string $suffix    The suffix of the configuration file name.
     *
     * @return void
     */
    public function __construct(string $directory, string $suffix = '.json')
    {
        parent::__construct($directory, $suffix);
    }

    /**
     * Read the configuration item from the configuration file.
     *
     * @param string $file The configuration file path.
     *
     * @return mixed
     */
    protected function read(string $file)
    {
        if (Validator::isNotEmptyString($json = file_get_contents($file))) {
            return JsonSerializer::create()->deserialize($json, true);
        }

        return [];
    }
}
