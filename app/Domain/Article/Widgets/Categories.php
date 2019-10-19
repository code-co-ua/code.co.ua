<?php

namespace Domain\Article\Widgets;

use Domain\Article\Category;
use Arrilot\Widgets\AbstractWidget;

class Categories extends AbstractWidget
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

        return view('widgets.categories', [
            'config' => $this->config,
            'categories' => Category::all()
        ]);
    }
}
