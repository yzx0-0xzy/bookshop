<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ url('/') }}">
                二手学长网（返回主页）
            </a>
        </div>
        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <ul class="nav navbar-nav">
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <!-- 登录注册链接开始 -->
                @guest
                    <li><a href="{{ route('login') }}">登录</a></li>
                    <li><a href="{{ route('register') }}">注册</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="/mybooks">我发布的书</a>
                            </li>
                            <li>
                                <a href="/wants">我想要的书</a>
                            </li>
                            <li>
                                <a href="/info">修改个人信息</a>
                            </li>
                            <li>
                                <a href="/express">收货地址</a>
                            </li>
                            <li>
                                <a href="/order">我的订单</a>
                            </li>
                            <li>
                                <a href="/book/favorites">我的收藏</a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    退出登录
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                    <ul class="nav navbar-nav navbar-right">
                    <li>
                    <a href="/publish">
                        发布旧书
                    </a>
                    </li>
                    </ul>
                @endguest
                <!-- 登录注册链接结束 -->
            </ul>
        </div>
    </div>
</nav>