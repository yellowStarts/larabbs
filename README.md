# 介绍

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
APP_NAME=LaraBBS # 设置站点名称
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
php artisan migrate
```
## 邮件设置
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
## 设置百度翻译API
```
BAIDU_TRANSLATE_APPID=201805280xxxxxx
BAIDU_TRANSLATE_KEY=xxxxxxxxxxxxxxxx
```


