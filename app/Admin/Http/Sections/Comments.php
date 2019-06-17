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
 * Class Comments
 *
 * @property \Laravelista\Comments\Comment $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class Comments extends Section
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
        return 'Коментарі';
    }

    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {
        return AdminDisplay::table()->with(['commenter', 'children'])
            ->setHtmlAttribute('class', 'table-primary')
            ->setColumns(
                AdminColumn::text('id', '#')->setWidth('30px'),
                AdminColumn::text('commenter.name', "Автор"),
                AdminColumn::text('comment', 'Текст'),
                AdminColumn::custom('Ресурс', function ($model) {
                    return '<a href="' . route($model->commentable_type . '.show', ['id' => $model->commentable_id]) . '">Переглянути</a>';
                }),
                AdminColumn::datetime('created_at', 'Створено'),
                AdminColumn::datetime('updated_at', 'Змінено')
            )->paginate(20);
    }

    /**
     * @param int $id
     *
     * @return FormInterface
     */
    public function onEdit($id)
    {
        // remove if unused
    }

    /**
     * @return void
     */
    public function onDelete($id)
    {
        // remove if unused
    }
}
