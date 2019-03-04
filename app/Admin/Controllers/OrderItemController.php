<?php

namespace App\Admin\Controllers;

use App\OrderItem;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class OrderItemController extends Controller
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

            $content->header('订单item管理');
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

            $content->header('订单item管理');
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

            $content->header('订单item管理');
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
        return Admin::grid(OrderItem::class, function (Grid $grid) {

            $grid->id('ID')->sortable();

            $grid->order_id('订单号');
            $grid->seller_id('卖家id');
            $grid->buyer_id('买家id');
            $grid->book_id('书籍id');
            $grid->book_name('书名');
            $grid->book_image('书籍图片名');
            $grid->book_price('书籍价格');
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
        return Admin::form(OrderItem::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->text('order_id', '订单ID');
            $form->text('seller_id', '卖家ID');
            $form->text('buyer_id', '买家ID');
            $form->text('book_id', '书籍ID');
            $form->text('book_name', '书籍名');
            $form->text('book_image', '书籍图片');
            $form->text('book_price', '书籍价格');

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
