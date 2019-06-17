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
 * Class Courses
 *
 * @property \App\Course $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class Courses extends Section
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
        return 'Курси';
    }

    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {
        return AdminDisplay::table()
            ->setHtmlAttribute('class', 'table-primary')
            ->setColumns(
                AdminColumn::text('id', '#')->setWidth('30px'),
                AdminColumn::link('title', "Заголовок")->setWidth('200px'),
                AdminColumn::link('name', "Назва")->setWidth('200px'),
                AdminColumn::text('description_short', 'Короткий опис'),
                AdminColumn::image('image', 'Фото')
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
            AdminFormElement::text('title', "Заголовок")->required(),
            AdminFormElement::text('name', "Назва")->required(),
            AdminFormElement::textarea('description', 'Опис'),
            AdminFormElement::textarea('description_short', 'Короткий опис'),
            AdminFormElement::textarea('description_after', 'Текст після змісту'),
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
