# 介绍
此项目是跟着 [Learnku](https://learnku.com/) 的教程[《L02 Laravel 教程 - Web 开发实战进阶》](https://learnku.com/courses/laravel-intermediate-training/8.x)完成的BBS，功能简约，甚是喜爱。

# 功能列表

# 安装
## 1. 下载
```
git clone https://github.com/yellowStarts/larabbs.git
```

## 2. 基本配置
创建 `.env`:
```
cp .env.example .env
```
编辑 `env`:
```
APP_NAME=Lemoner # 设置站点名称,设置成你自己的
APP_ENV=production #设置为生产环境
APP_DEBUG=false # 关闭 Debug
APP_URL=https://blog.lemonhuang.cn # 设置站点url

# 设置数据库
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=larabbs
DB_USERNAME=larabbs
DB_PASSWORD=xxxxxxxx
```
安装依赖包：
```
composer install
```
更新目录权限
由于 Nginx 默认用户名和用户组都是 www(用的宝塔一键安装面板)，所以我们将 larabbs 整个项目目录的所属用户和用户组也设置为 www：
```
cd /www/wwwroot
chown -R www:www larabbs/
```
生成 `app_key`:
```
php artisan key:generate
```
数据库迁移
```
php artisan migrate --seed
```
## 3.邮件设置
```
MAIL_MAILER=smtp
MAIL_HOST=smtp.qq.com
MAIL_PORT=25
MAIL_USERNAME=918xxxx78@qq.com
MAIL_PASSWORD=xxxxxxxxxx
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=918xxxx78@qq.com
MAIL_FROM_NAME="${APP_NAME}"
```
以上的配置如果无法使用，可能是你的云服务端口号封禁的问题，可以试用以下方案，改变端口号`MAIL_PORT` 和 `MAIL_ENCRYPTION`:
```
MAIL_MAILER=smtp
MAIL_HOST=smtp.qq.com
MAIL_PORT=465
MAIL_USERNAME=918xxxx78@qq.com
MAIL_PASSWORD=xxxxxxxxxx
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS=918xxxx78@qq.com
MAIL_FROM_NAME="${APP_NAME}"
```
## 4.设置百度翻译API
```
BAIDU_TRANSLATE_APPID=201805280xxxxxx
BAIDU_TRANSLATE_KEY=xxxxxxxxxxxxxxxx
```

## 5.使用队列
```
QUEUE_CONNECTION=redis
REDIS_CLIENT=predis
```

## 6.安装进程管理工具 Supervisor
安装 Supervisor：
```
yum install supervisor
```
每一次部署代码时，需 `artisan horizon:terminate` 然后再 `artisan horizon` 重新加载代码

## 7.计划任务
使用调度器时，我们需要修改系统的 Cron 计划任务配置信息，运行以下命令:
```
export EDITOR=vi && crontab -e
```
复制下面这一行：
```
* * * * * php /home/vagrant/Code/larabbs/artisan schedule:run >> /dev/null 2>&1
```
