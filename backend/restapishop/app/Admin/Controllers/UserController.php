<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\User;

class UserController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'User';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('email', __('Email'));
        $grid->column('email_verified_at', __('Email verified at'));
        // $grid->column('password', __('Password'));
        $grid->column('avatar', __('Avatar'));
        $grid->column('is_admin', __('Is admin'));
        $grid->column('github_id', __('Github id'));
        $grid->column('google_id', __('Google id'));
        $grid->column('fcm_id', __('Fcm id'));
        $grid->column('auth_type', __('Auth type'));
        // $grid->column('remember_token', __('Remember token'));
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
        $show = new Show(User::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('email', __('Email'));
        $show->field('email_verified_at', __('Email verified at'));
        $show->field('password', __('Password'));
        $show->field('avatar', __('Avatar'));
        $show->field('is_admin', __('Is admin'));
        $show->field('github_id', __('Github id'));
        $show->field('google_id', __('Google id'));
        $show->field('fcm_id', __('Fcm id'));
        $show->field('auth_type', __('Auth type'));
        $show->field('remember_token', __('Remember token'));
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
        $form = new Form(new User());

        $form->text('name', __('Name'));
        $form->email('email', __('Email'));
        $form->datetime('email_verified_at', __('Email verified at'))->default(date('Y-m-d H:i:s'));
        $form->password('password', __('Password'));
        $form->image('avatar', __('Avatar'));
        $form->switch('is_admin', __('Is admin'));
        $form->text('github_id', __('Github id'));
        $form->text('google_id', __('Google id'));
        $form->text('fcm_id', __('Fcm id'));
        $form->text('auth_type', __('Auth type'));
        $form->text('remember_token', __('Remember token'));

        return $form;
    }
}
