<?php

namespace App\FakeData;

use joshtronic\LoremIpsum;

class CourseFakeData extends FakeData
{
    const IMAGES = [
        'https://img.icons8.com/?id=55167&size=64&format=svg&token=&color=000000',
        'https://img.icons8.com/?id=46430&size=64&format=svg&token=&color=000000',
        'https://img.icons8.com/?id=55113&size=64&format=svg&token=&color=000000',
        'https://img.icons8.com/?id=46718&size=64&format=svg&token=&color=000000',
        'https://img.icons8.com/?id=107497&size=64&format=svg&token=&color=000000',
        'https://img.icons8.com/?id=54949&size=64&format=svg&token=&color=000000',
        'https://img.icons8.com/?id=55503&size=64&format=svg&token=&color=000000',
        'https://img.icons8.com/?id=121111&size=64&format=svg&token=&color=000000',
        'https://img.icons8.com/?id=121464&size=64&format=svg&token=&color=000000',
    ];

    /**
     * @var LoremIpsum
     */
    private $lipsum;

    public function __construct(LoremIpsum $loremIpsum)
    {
        $this->lipsum = $loremIpsum;
    }

    public function generateItem(): object
    {
        return (object) [
            'title' => $this->lipsum->words(rand(2, 3)),
            'image' => collect(self::IMAGES)->random(),
            'description_short' => $this->lipsum->words(rand(5, 8)),
        ];
    }
}
