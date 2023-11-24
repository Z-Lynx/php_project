<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Notifications;

class NotificationsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Notifications';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Notifications());

        $grid->column('id', __('Id'));
        $grid->column('type', __('Type'));
        $grid->column('user_id', __('User id'));
        $grid->column('data', __('Data'));
        $grid->column('read_at', __('Read at'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Notifications::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('type', __('Type'));
        $show->field('user_id', __('User id'));
        $show->field('data', __('Data'));
        $show->field('read_at', __('Read at'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Notifications());

        $form->text('type', __('Type'));
        $form->number('user_id', __('User id'));
        $form->textarea('data', __('Data'));
        $form->datetime('read_at', __('Read at'))->default(date('Y-m-d H:i:s'));

        return $form;
    }
}
