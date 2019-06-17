<?php

namespace App\Admin\Http\Sections;

use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Section;
use AdminColumn;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use App\Article;

/**
 * Class Articles
 *
 * @property \App\Article $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class Articles extends Section
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
        return 'Статті';
    }

    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {
        return AdminDisplay::table()->with(['user', 'category'])
            ->setHtmlAttribute('class', 'table-primary')
            ->setColumns(
                AdminColumn::text('id', '#')->setWidth('30px'),
                AdminColumn::text('name', "Назва"),
                AdminColumn::custom('Статус', function ($model) {
                    return Article::status[$model->status];
                }),
                AdminColumn::image('image', 'Фото'),
                AdminColumn::text('category.name', 'Категорія'),
                AdminColumn::text('user.name', 'Автор'),
                AdminColumn::datetime('created_at', 'Додано')
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
            AdminFormElement::text('name', "Назва")->required(),
            AdminFormElement::textarea('body', 'Контент'),
            AdminFormElement::select('category_id')->setLabel('Категорія')
                ->setModelForOptions(\App\Category::class)
                ->setHtmlAttribute('placeholder', 'Вибиріть категорію')
                ->setDisplay('name'),
            AdminFormElement::select('status', 'Статус', Article::status),
            AdminFormElement::image('image', 'Фото'),
            AdminFormElement::text('id', 'ID')->setReadonly(1),
            AdminFormElement::text('created_at')->setLabel('Створено')->setReadonly(1),
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
