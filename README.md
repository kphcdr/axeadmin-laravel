# axeadmin-laravel
axeadmin 是一套用于laravel的扩展，可以使你快速搭建一个可用的后台。

# 要求

`laravel` >= 5.5

`mysql`


# 安装

1. 拥有一个已经可以正常运行的laravel服务
1. `composer require kphcdr/axeadmin-laravel`
1. `php artisan axe:install`
1. 开始使用  http://xxx.com/axe

# 备忘

1. 初始管理员账号admin 密码 admin,你可以通过php artisan axe:reset-password 重置密码
1. 配置文件位于 config/axe.php，可以根据实际情况进行修改

# 致谢

axeadmin 使用了  [layuiAdmin](https://www.layui.com/admin/)

axeadmin 借鉴了  [laravel-admin](https://github.com/z-song/laravel-admin)
