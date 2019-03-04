<?php

namespace App\Admin\Controllers;

use App\Book;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class BookController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('书籍管理');
            $content->description('列表');

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('书籍管理');
            $content->description('编辑');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('书籍管理');
            $content->description('创建');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Book::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->name('名称');
            $grid->publisher_id('出版社ID');
            $grid->subcategory_id('小类ID');
            $grid->writer('作者');
            $grid->price('原价');
            $grid->book_image('图片名称');
            $grid->created_at();
            $grid->updated_at();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Book::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->text('name', '书名');
            $form->number('publisher_id', '出版社id');
            $form->number('subcategory_id', '子类id');
            $form->text('writer', '作者');
            $form->number('price', '原价');
            $form->text('book_image', '图片名称');
            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
