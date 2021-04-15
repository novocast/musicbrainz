<?php

/*
 * This file is part of the Musicbrainz package.
 *
 * © Anthony Totton <novocast7@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Musicbrainz\Entities;

use Musicbrainz\Entities\Entities;

class Recording extends Entity
{

    public $entity = 'recording';

    public function formatResponse($response, $type = 'search')
    {
        if ($type === 'lookup') {
            return $response;
        }

        if ($type === 'browse') {

            return $response->recordings;
        }

        if ($response->recordings) {
            return $response->recordings;
        }

        return null;
    }

    /**
     * Calls the api with the requested data and formats the response
     *
     * @param [type] $name
     * @param [type] $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        return $this->formatResponse(parent::__call($name, [
            $this->entity,
            $arguments,
            ['id' => $this->appId]
        ]), $name);
    }
}
