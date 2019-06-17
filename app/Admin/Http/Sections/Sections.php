<?php

namespace App\Admin\Http\Sections;

use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Section;
use AdminColumn;
use AdminDisplay;
use AdminForm;
use AdminFormElement;

/**
 * Class Sections
 *
 * @property \App\Section $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class Sections extends Section
{
    /**
     * @see http://sleepingowladmin.ru/docs/model_configuration#ограничение-прав-доступа
     *
     * @var bool
     */
    protected $checkAccess = false;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $alias;

    public function getTitle()
    {
        return 'Розділи';
    }

    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {
        return AdminDisplay::table()->with(['course', 'lessons'])
            ->setHtmlAttribute('class', 'table-primary')
            ->setColumns(
                AdminColumn::text('id', '#')->setWidth('30px'),
                AdminColumn::text('title', 'Назва'),
                AdminColumn::text('course.name', 'Курс'),
                AdminColumn::lists('lessons.name', 'Уроки'),
                AdminColumn::count('lessons', 'Кількість уроків')
            )->paginate(20);
    }

    /**
     * @param int $id
     *
     * @return FormInterface
     */
    public function onEdit($id)
    {
        return AdminForm::panel()
            ->addBody([
                AdminFormElement::text('title', 'Назва')->required(),
                AdminFormElement::select('course_id')->setLabel('Курс')
                    ->setModelForOptions(\App\Course::class)
                    ->setHtmlAttribute('placeholder', 'Вибиріть курс')
                    ->setDisplay('name')
                    ->required(),
            ]);
    }

    /**
     * @return FormInterface
     */
    public function onCreate()
    {
        return $this->onEdit(null);
    }

    /**
     * @return void
     */
    public function onDelete($id)
    {
        // remove if unused
    }
}
