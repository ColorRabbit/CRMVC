#### 目录结构
```
├── application
│   ├── Controller      # 控制层
│   │   └── apiController.php
│   ├── Model           # model层
│   │   ├── accountDetailsModel.php
│   │   ├── alertContactModel.php
│   │   └── monitorsModel.php
│   └── View            # 视图层
│       ├── api
│       │   └── showlist.html.twig
│       └── layout.html.twig    # 视图层公用文件
├── cache           # 缓存目录
├── config          # 存放配置文件的地方
│   ├── config.yml       # 配置文件
│   ├── parameters.yml   # 数据库配置文件
│   └── services.yml     # include文件配置
├── framework
│   ├── CR.php              # 入口
│   ├── application
│   │   ├── Controller.php
│   │   └── Model.php
│   ├── libs                # 添加类库的地方
│   │   ├── HandleError.php
│   │   ├── MyError.php
│   │   ├── MysqliDb.php
│   │   ├── Router.php
│   │   └── WorkShop.php
│   └── services
│       ├── pdoClient.php    # 实例化数据库入口
│       ├── services.php     # 通用的核心方法,这里添加一些常用的类库
│       └── singleSign.php
└── index.php       # 入口
└── .htaccess       # htaccess
├── README.md
```

#### .htaccess配置
```
# nginx
autoindex on;
index index.php;
if ( !-e $request_filename) {
    rewrite "^/CRMVC/(.*)$" /CRMVC/index.php last;
}

# apache
<IfModule mod_rewrite.c>
RewriteEngine On
#如果文件存在就直接访问目录不进行RewriteRule
RewriteCond %{REQUEST_FILENAME} !-f
#如果目录存在就直接访问目录不进行RewriteRule
RewriteCond %{REQUEST_FILENAME} !-d
#将所有其他URL重写到 index.php/URL
RewriteRule ^(.*)$ index.php [PT,L]
</IfModule>
```

#### parameters配置

    mv ./config/parameters.bak ./config/parameters.yml
```yaml
parameters:
    database_type: mysql
    host: 127.0.0.1
    port: 3306
    db: 表名
    username: 用户名
    password: 密码
    charset: utf8
    persist: false
```

#### nginx.conf配置
```nginx_conf
location /CRMVC/ {
    root /usr/local/var/www/defult;
    #rewrite ^/ http://127.0.0.1/CRMVC/index.php;
    include /usr/local/var/www/defult/CRMVC/.htaccess;
}
```

[mysql文件来自](https://github.com/joshcam/PHP-MySQLi-Database-Class/blob/master/readme.md)


16年中旬写的，17年有重新翻了下，最近重写整理下提交。随缘更新优化
