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
 * Class Questions
 *
 * @property \App\Question $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class Questions extends Section
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
        return 'Питання';
    }

    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {
        return AdminDisplay::table()->with(['answer', 'answers', 'lesson'])
            ->setHtmlAttribute('class', 'table-primary')
            ->setColumns(
                AdminColumn::text('id', '#')->setWidth('30px'),
                AdminColumn::text('body', "Текст"),
                AdminColumn::text('answer.title', "Правильна відповідь"),
                AdminColumn::lists('answers.title', 'Відповіді'),
                AdminColumn::text('lesson.name', 'Урок')
            )->paginate(20);
    }

    /**
     * @param int $id
     *
     * @return FormInterface
     */
    public function onEdit($id)
    {
        return AdminForm::panel()->addBody([
            AdminFormElement::textarea('body', 'Текст'),
            AdminFormElement::select('lesson_id')->setLabel('Урок')
                ->setModelForOptions(\App\Lesson::class)
                ->setHtmlAttribute('placeholder', 'Вибиріть урок')
                ->setDisplay('name')
                ->required(),
            AdminFormElement::select('answer_id')->setLabel('Правильна відповідь')
                ->setModelForOptions(\App\Answer::class)
                ->setLoadOptionsQueryPreparer(function ($element, $query) use ($id) {
                    return $query->where('question_id', $id);
                })
                ->setHtmlAttribute('placeholder', 'Вибиріть відповідь')
                ->setDisplay('title')
                ->required(),
            AdminFormElement::text('id', 'ID')->setReadonly(1),
            AdminFormElement::text('created_at')->setLabel('Створено')->setReadonly(1)
        ]);
    }

    /**
     * @return FormInterface
     */
    public function onCreate()
    {
        return AdminForm::panel()->addBody([
            AdminFormElement::text('body', 'Текст'),
            AdminFormElement::select('lesson_id')->setLabel('Урок')
                ->setModelForOptions(\App\Lesson::class)
                ->setHtmlAttribute('placeholder', 'Вибиріть урок')
                ->setDisplay('name')
                ->required(),
            AdminFormElement::select('answer_id')->setLabel('Правильна відповідь')
                ->setModelForOptions(\App\Answer::class)
                ->setHtmlAttribute('placeholder', 'Вибиріть відповідь')
                ->setDisplay('title'),
        ]);
    }

    /**
     * @return void
     */
    public function onDelete($id)
    {
        // remove if unused
    }
}
