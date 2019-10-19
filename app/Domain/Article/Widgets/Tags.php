<?php

namespace Domain\Article\Widgets;

use Arrilot\Widgets\AbstractWidget;
use Conner\Tagging\Model\Tag;

class Tags extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        //
        return view('widgets.tags', [
            'config' => $this->config,
            'tags' => Tag::all()
        ]);
    }
}
