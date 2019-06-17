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
 * Class Users
 *
 * @property \App\User $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class Users extends Section
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
        return 'Користувачі';
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
                AdminColumn::text('name', "Ім'я")->setWidth('200px'),
                AdminColumn::email('email', 'Емейл'),
                AdminColumn::custom('Адміністратор?', function ($model) {
                    return $model->isAdmin ? 'так' : 'ні';
                }),
                AdminColumn::datetime('created_at', 'Дата реєстрації')
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
            AdminFormElement::text('name', "Ім'я")->required(),
            AdminFormElement::text('email', 'Емейл')->required(),
            AdminFormElement::textarea('about', 'Опис'),
            AdminFormElement::text('avatar', "Фото"),
            AdminFormElement::number('balance', "Баланс"),
            AdminFormElement::checkbox('isAdmin', "Адміністратор?"),
            AdminFormElement::text('id', 'ID')->setReadonly(1),
            AdminFormElement::text('created_at')->setLabel('Створено')->setReadonly(1),
        ]);
    }

    /**
     * @return FormInterface
     */
    public function onCreate()
    {
        return AdminForm::panel()->addBody([
            AdminFormElement::text('name', "Ім'я")->required(),
            AdminFormElement::text('email', 'Емейл')->required(),
            AdminFormElement::textarea('about', 'Опис'),
            AdminFormElement::text('avatar', "Фото")->setDefaultValue('user'),
            AdminFormElement::number('balance', "Баланс")->setDefaultValue(0),
            AdminFormElement::checkbox('isAdmin', "Адміністратор?"),
            AdminFormElement::password('password', 'Пароль')->hashWithBcrypt()
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
