## 二手书交易网站
## Requirements
- PHP 7.1.3 +
- Mysql 5.5 +
- Memory 1G +
- Disk 10G +
- Laravel 5.4
## nginx 配置
- 伪静态:
```
location / {
    try_files $uri $uri/ /index.php?$query_string;
}
```
## 配置.env文件
- 将.env.example文件复制一份，修改为.env文件
配置如下属性：
```
DB_CONNECTION=mysql
DB_HOST=[数据库ip地址]（本地为127.0.0.1）
DB_PORT=[数据库端口号]（默认,3306）
DB_DATABASE=[数据库名称]
DB_USERNAME=[数据库用户名]
DB_PASSWORD=[数据库用户密码]
```

## 用终端打开工作目录，依次运行如下命令
```
php composer.phar install
php artisan key:generate
npm install
npm run dev
php artisan migrate
```
