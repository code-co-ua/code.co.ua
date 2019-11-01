<?php

namespace Domain\Course\FakeData;

use App\FakeData;
use joshtronic\LoremIpsum;

class CourseFakeData extends FakeData
{
    const IMAGES = [
        'https://code-co-ua.github.io/svg/55167.svg',
        'https://code-co-ua.github.io/svg/46430.svg',
        'https://code-co-ua.github.io/svg/55095.svg',
        'https://code-co-ua.github.io/svg/55113.svg',
        'https://code-co-ua.github.io/svg/46718.svg',
        'https://code-co-ua.github.io/svg/107497.svg',
        'https://code-co-ua.github.io/svg/54949.svg',
        'https://code-co-ua.github.io/svg/55503.svg',
        'https://code-co-ua.github.io/svg/121111.svg',
        'https://code-co-ua.github.io/svg/121464.svg',
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
            'title' => ucfirst($this->lipsum->words(rand(2, 3))),
            'image' => collect(self::IMAGES)->random(),
            'description_short' => $this->lipsum->words(rand(5, 8)),
        ];
    }
}
