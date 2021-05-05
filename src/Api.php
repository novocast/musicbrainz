<?php

/*
 * This file is part of the Musicbrainz package.
 *
 * © Anthony Totton <novocast7@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Musicbrainz;

use GuzzleHttp\Client;
use MakinaCorpus\Lucene\Query;


class Api
{
    private $endpoint = 'https://musicbrainz.org/ws/2/';
    private $coverEndpoint = 'https://coverartarchive.org/';
    private $config = [
        'id' => '',
        'format' => 'json'
    ];

    /**
     *  lookup:   /<ENTITY_TYPE>/<MBID>?inc=<INC>
     *  browse:   /<RESULT_ENTITY_TYPE>?<BROWSING_ENTITY_TYPE>=<MBID>&limit=<LIMIT>&offset=<OFFSET>&inc=<INC>
     *  search:   /<ENTITY_TYPE>?query=<QUERY>&limit=<LIMIT>&offset=<OFFSET>
     */

    /**
     * Undocumented function
     *
     * @param [type] $entity
     * @param [type] $arguments
     * @param [type] $settings
     * @return void
     */
    public function lookup($entity, $arguments, $settings = null)
    {
        /**
         * @todo This is duplicate of search. Redo as Lookup
         */
        $endpoint = $this->endpoint;
        $entityCode = $entity;
        if ($entity === 'cover-art') {
            $endpoint = $this->coverEndpoint;
            $entityCode = 'release';
        }

        $url = $endpoint . $entityCode . "/$arguments[0]" . "?inc=isrcs";

        return $this->callApi($url, $settings);
    }

    /**
     * Undocumented function
     *
     * @param [type] $entity
     * @param [type] $arguments
     * @param [type] $settings
     * @return void
     */
    public function browse($entity, $arguments, $settings = null)
    {
        /**
         * @todo This is duplicate of search. Redo as Browse
         */

        $query = new Query();

        foreach ($arguments[0] as $field => $value) {
            $query->matchTerm($field, $value);
        }

        /**
         * This line fixes an issue with wildcard searching in the php-lucene library
         */
        $query = str_replace(':"\*"', ":*", $query);

        $url = $this->endpoint . $entity . "?query=$query&limit=5&offset=0" . '';

        return $this->callApi($url, $settings);
    }

    /**
     * Undocumented function
     *
     * @param [type] $entity
     * @param [type] $arguments
     * @param [type] $settings
     * @return void
     */
    public function search($entity, $arguments, $settings = null)
    {
        $query = new Query();

        foreach ($arguments[0] as $field => $value) {
            $query->matchTerm($field, $value);
        }

        $url = $this->endpoint . $entity . "?query=$query&limit=5&offset=0" . '';

        return $this->callApi($url, $settings);
    }

    /**
     * Undocumented function
     *
     * @param [type] $entity
     * @param [type] $arguments
     * @param [type] $settings
     * @return void
     */
    public function callApi($url, $settings = null)
    {
        $config = $this->config;

        if ($settings !== null) {
            $config = array_merge($config, $settings);
        }

        $customHeaders = [
            'User-Agent' => $config['id']
        ];

        if ($config['format'] === 'json') {
            $url .= '&fmt=json';
            $customHeaders['Accept'] = 'application/json';
        }

        $requestConfig = [
            'verify' => false,
            'headers' => $customHeaders
        ];

        if (isset($config['proxy'])) {
            $requestConfig['proxy'] = $config['proxy'];
        }

        $client = new Client();
        $res = $client->request('GET', $url, $requestConfig);

        return json_decode($res->getBody());
    }
}
