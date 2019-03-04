<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Widgets\Chart\Bar;
use Encore\Admin\Widgets\Chart\Doughnut;
use Encore\Admin\Widgets\Chart\Line;
use Encore\Admin\Widgets\Chart\Pie;
use Encore\Admin\Widgets\Chart\PolarArea;
use Encore\Admin\Widgets\Chart\Radar;
use Encore\Admin\Widgets\Collapse;
use Encore\Admin\Widgets\InfoBox;
use Encore\Admin\Widgets\Tab;
use Encore\Admin\Widgets\Table;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('各种管理');
            $content->description('');
            $content->row(function ($row) {
                $row->column(3, new InfoBox('用户管理', 'users', 'aqua', '/admin/users',"Users" ));
                $row->column(3, new InfoBox('用户地址管理', 'users', 'aqua', '/admin/shippings', "Shippings"));
                $row->column(3, new InfoBox('购买请求管理', 'users', 'aqua', '/admin/wants', "Wants"));
                $row->column(3, new InfoBox('书籍从属管理', 'users', 'aqua', '/admin/owners', "Owners"));
                $row->column(3, new InfoBox('用户评论管理', 'users', 'aqua', '/admin/comments', "Comments"));
                $row->column(3, new InfoBox('订单管理', 'shopping-cart', 'green', '/admin/orders', "Orders"));
                $row->column(3, new InfoBox('订单内容管理', 'shopping-cart', 'green', '/admin/order_items', "Order items"));
                $row->column(3, new InfoBox('书籍管理', 'book', 'yellow', '/admin/books', "Books"));
                $row->column(3, new InfoBox('图书大类管理', 'book', 'yellow', '/admin/categorys', "Categories"));
                $row->column(3, new InfoBox('书籍子类别管理', 'book', 'yellow', '/admin/subcategorys', "Subcategories"));
                $row->column(3, new InfoBox('学校管理', 'book', 'yellow', '/admin/schools', "Schools"));
                $row->column(3, new InfoBox('出版社管理', 'book', 'yellow', '/admin/publishers', "Publishers"));
            });
        });
    }
}
