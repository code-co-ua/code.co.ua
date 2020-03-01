<?php

namespace App\Http\Sections;

use AdminColumn;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use Domain\Exercise\Server;
use Illuminate\Database\Eloquent\Model;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Form\Buttons\{Save, Cancel};
use SleepingOwl\Admin\Section;

/**
 * @todo access by role
 * @property Server $model
 */
class Servers extends Section implements Initializable
{
    public function initialize()
    {
        $this->addToNavigation()
            ->setPriority(100)
            ->setIcon('fa fa-server');
    }

    public function getTitle(): string
    {
        return __('Servers');
    }

    public function onDisplay(array $payload = []): DisplayInterface
    {
        return AdminDisplay::datatables()
            ->setName('firstdatatables')
            ->setOrder([[0, 'asc']])
            ->setDisplaySearch(true)
            ->paginate(25)
            ->setColumns([
                AdminColumn::text('id', '#')
                    ->setWidth('50px')
                    ->setHtmlAttribute('class', 'text-center'),
                AdminColumn::text('user', 'User'),
                AdminColumn::text('host', 'Host'),
                AdminColumn::text('created_at', 'Created / updated', 'updated_at')
                    ->setWidth('160px')
                    ->setOrderable(function($query, $direction) {
                        $query->orderBy('updated_at', $direction);
                    })->setSearchable(false),
            ])
            ->setHtmlAttribute('class', 'table-primary table-hover th-center');
    }

    public function onEdit(?int $id = null, array $payload = []): FormInterface
    {
        $form = AdminForm::card()->addBody([
            AdminFormElement::columns()->addColumn([
                AdminFormElement::text('user', 'User')->required(),
            ], 'col-4')->addColumn([
                AdminFormElement::text('host', 'Host')->required(),
            ], 'col-8'),
        ]);

        $form->getButtons()->setButtons([
            'save'  => new Save(),
            'cancel'  => (new Cancel()),
        ]);

        return $form;
    }

    public function onCreate($payload = []): FormInterface
    {
        return $this->onEdit(null, $payload);
    }

    public function isDeletable(Model $model): bool
    {
        return true;
    }

    public function onRestore($id): void
    {
        // remove if unused
    }
}
