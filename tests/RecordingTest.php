<?php

namespace MusicBrainz;

use PHPUnit\Framework\TestCase;

class RecordingTest extends TestCase
{
    public $tests = [
        [
            'artist' => 'Queen',
            'title' => 'Fat Bottomed Girls',
            'result' => true
        ],
        [
            'artist' => 'Hudson Mohawke',
            'title' => 'Zoo00oom',
            'result' => true
        ],
        [
            'artist' => 'The Righteous Brothers',
            'title' => "You've Lost That Lovin’ Feelin’",
            'result' => true
        ],
        [
            'artist' => 'Not a real Artist Name 7',
            'title' => "I've made this up too",
            'result' => false
        ],
        [
            'artist' => 'Leonardo Da Vinci ;)',
            'title' => "Purple Elephant Halo Rider CXVI",
            'result' => false
        ]
    ];

    /**
     * @todo this
     *
     * @return void
     */
    public function testLookup()
    {
        $this->assertSame(true, false);
    }

    /**
     * @todo this
     *
     * @return void
     */
    public function testBrowse()
    {
        $this->assertSame(true, false);
    }

    /**
     * @todo this
     *
     * @return void
     */
    public function testSearch()
    {
        $config = [
            'id' => 'YOUR_MUSICBRAINZ_USERAGENT_STRING/1.0.0 (yourcontact@emailaddress.com)'
        ];

        foreach ($this->tests as $test) {
            $recording = new Entity\Recording($config);
            $searchResult = $recording->search([
                'artist' => $test['artist'],
                'title' => $test['title']
            ]);

            var_dump($searchResult);
            exit();
        }
    }
}
