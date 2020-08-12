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

class Api
{
    private $endpoint = 'https://musicbrainz.org/ws/2/';
    private $config = [
        'id' => '',
        'format' => 'json'
    ];


    public function callApi($entity, $method, $arguments, $settings = null)
    {
        $config = $this->config;

        if ($settings !== null) {
            $config = array_merge($config, $settings);
        }

        $jsonString = '&fmt=json';

        $url = $this->endpoint . $entity;

        //Create an array of custom headers.
        $customHeaders = [
            'User-Agent: ' . $config['id']
        ];

        if ($config['format'] === 'json') {
            $url .= $jsonString;
            $customHeaders[] = 'Accept: application/json';
        }

        var_dump($customHeaders);
        var_dump($url);
        exit();

        //Create a cURL handle.
        $ch = curl_init($this->endpoint);

        //Use the CURLOPT_HTTPHEADER option to use our
        //custom headers.
        curl_setopt($ch, CURLOPT_HTTPHEADER, $customHeaders);

        //Set options to follow redirects and return output
        //as a string.
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        //Execute the request.
        $result = curl_exec($ch);

        var_dump($result);
        exit();
    }
}
