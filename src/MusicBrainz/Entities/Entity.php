<?php

/*
 * This file is part of the MusicBrainz package.
 *
 * © Anthony Totton <novocast7@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace MusicBrainz;

use MusicBrainz\Api;

class Entity
{
    protected $apiMethods = ['lookup', 'browse', 'search'];
    public $isCoreResource = true;

    public function formatResponse($response)
    {
        return $response;
    }

    public function __call($name, $arguments)
    {
        $response = null;
        if (in_array($name, $this->apiMethods)) {
            $response = Api::$name($arguments);
        }

        return $this->formatResponse($response);
    }
}
