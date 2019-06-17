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
 * Class Lessons
 *
 * @property \App\Lesson $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class Lessons extends Section
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
        return 'Уроки';
    }

    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {
        return AdminDisplay::table()->with(['section', 'exercises', 'questions'])
            ->setHtmlAttribute('class', 'table-primary')
            ->setColumns(
                AdminColumn::text('id', '#')->setWidth('30px'),
                AdminColumn::text('name', 'Назва'),
                AdminColumn::text('section.title', 'Розділ'),
                AdminColumn::lists('exercises.title', 'Вправи'),
                AdminColumn::lists('questions.title', 'Питання')
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
                AdminFormElement::text('name', 'Назва')->required(),
                AdminFormElement::text('video', 'Youtube відео id'),
                AdminFormElement::select('section_id')->setLabel('Розділ')
                    ->setModelForOptions(\App\Section::class)
                    ->setHtmlAttribute('placeholder', 'Вибиріть розділ')
                    ->setDisplay('title')
                    ->required(),
                AdminFormElement::textarea('body', 'Контент')->required(),
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
