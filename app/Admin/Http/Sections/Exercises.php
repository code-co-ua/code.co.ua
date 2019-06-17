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
 * Class Exercises
 *
 * @property \App\Exercise $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class Exercises extends Section
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
        return 'Вправи';
    }

    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {
        return AdminDisplay::table()->with(['lesson.section', 'user'])
            ->setHtmlAttribute('class', 'table-primary')
            ->setColumns(
                AdminColumn::text('id', '#')->setWidth('30px'),
                AdminColumn::text('title', 'Назва'),
                AdminColumn::text('language', 'Мова'),
                AdminColumn::text('lesson.name', 'Урок'),
                AdminColumn::text('lesson.section.title', 'Розділ'),
                AdminColumn::text('user.name', 'Автор')
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
                AdminFormElement::select('lesson_id')->setLabel('Урок')
                    ->setModelForOptions(\App\Lesson::class)
                    ->setHtmlAttribute('placeholder', 'Вибиріть урок')
                    ->setDisplay('name')
                    ->required(),
                AdminFormElement::textarea('body', 'Контент')->required(),
                AdminFormElement::textarea('solution', 'Рішення')->required(),
                AdminFormElement::textarea('output', 'Правильний вивід')->required(),
                AdminFormElement::text('language', 'Мова')->required()
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
