# 常见问题

---

- [加密kEY不存在问题](#section-1)
- [无权限写入问题](#section-2)
- [防跨站攻击问题](#section-3)
- [同步索引错误问题](#section-4)
- [搜索报错问题](#section-5)
- [图片上传后不显示](#section-6)
- [无法登陆后台问题](#section-7)
- [安装最后一步显示500错误](#section-8)

<a name="section-1"></a>
## 加密kEY不存在问题
![No application encryption key has been specified](/images/docs/key.png)  
这是`.env`中`APP_KEY`值不存在或者为空，解决办法是在项目根目录下执行:
```bash
php artisan key:generate
```

<a name="section-2"></a>
## 无权限写入问题
这个问题一般来说就是权限配置不得当导致的，比如你是以root用户创建的项目，但是以www用户运行就会导致无权限写入问题。  
第一个办法是更改目录所有者为www用户(推荐)  
```bash
chown -R www.www root_path
```
> {info} 第一个www指的是www用户，第二个www指的是www用户组。root_path指的是你项目的根目录路径。  

第二个办法是更改目录写入权限(不推荐)
```bash
chmod -R 777 root_path
```
<a name="section-3"></a>
## 防跨站攻击问题
![open_basedir](/images/docs/basedir.png)  
这个问题是根目录配置不正确导致。请参考下图配置：  
![bt_open_basedir](/images/docs/bt_basedir.png)  

<a name="section-4"></a>
## 同步索引错误问题
![write a readonly database](/images/docs/index.jpg)  
CoreBlog使用了TntSearch做全文索引，TntSearch是基于sqlite数据库开发的。`sqlite`数据库存放在`root_path/storage/indexes/posts.index`中。
```bash
chmod 777 root_path/storage/indexes/posts.index
```
> {info} 请将root_path更改为你项目的根目录路径  

<a name="section-5"></a>
## 搜索报错问题
```bash
path/storage/indexes/posts.index does not exist
```
出现上述问题是未初始化tntsearch的sqlite数据库导致的。在项目根目录执行:
```bash
php artisan search:sync-posts
```
如果提示`Sync Posts Index Success!`代表修复成功。

<a name="section-6"></a>
## 图片上传后不显示
请确认你是否禁止了PHP函数`symlink`如被禁止了请解除限制，然后在项目根目录执行:
```bash
php artisan storage:link
```

<a name="section-7"></a>
## 无法登陆后台问题
症状是初始化安装完毕之后，使用设置好的邮箱和密码登陆提示账号密码错误。  
这是安装程序设置管理员账号失败了，临时解决办法是使用默认的账号密码登录。
默认账号为:`admin@example.com`密码为`password`。  
后台可以修改密码，邮箱需要去数据库修改一下。  
此问题在部分场景下会出现，如碰到此问题请联系作者帮忙排查。

<a name="section-8"></a>
## 安装最后一步显示500错误
大部分原因是文件权限问题。请检查一下是项目目录所有者和所有组是否更改成www。  
如还不能解决，请复制项目根目录下`/storage/logs/laravel-year-month-day.log`的内容加QQ群求助解决。
