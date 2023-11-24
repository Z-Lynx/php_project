<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Bills;

class BillsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Bills';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Bills());

        $grid->column('id', __('Id'));
        $grid->column('product_id', __('Product id'));
        $grid->column('user_id', __('User id'));
        $grid->column('quantity', __('Quantity'));
        $grid->column('total_amout', __('Total amout'));
        $grid->column('status', __('Status'));
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
        $show = new Show(Bills::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('product_id', __('Product id'));
        $show->field('user_id', __('User id'));
        $show->field('quantity', __('Quantity'));
        $show->field('total_amout', __('Total amout'));
        $show->field('status', __('Status'));
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
        $form = new Form(new Bills());

        $form->number('product_id', __('Product id'));
        $form->number('user_id', __('User id'));
        $form->decimal('quantity', __('Quantity'));
        $form->decimal('total_amout', __('Total amout'));
        $form->text('status', __('Status'));

        return $form;
    }
}
