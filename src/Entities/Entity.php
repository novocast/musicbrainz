<?php

/*
 * This file is part of the MusicBrainz package.
 *
 * © Anthony Totton <novocast7@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace MusicBrainz\Entity;

use MusicBrainz\Api;

class Entity
{
    protected $apiMethods = ['lookup', 'browse', 'search'];
    public $isCoreResource = true;

    public $appId = null;

    public function formatResponse($response, $type = 'search')
    {
        return $response;
    }


    public function __construct($config = null)
    {
        if ($config !== null) {
            $this->appId = $config['id'];
        }
    }

    public function __call($name, $arguments)
    {
        $response = null;
        if (in_array($name, $this->apiMethods)) {
            $api = new Api();
            $response = $api->$name(...$arguments);
        }

        return $response;
    }
}
