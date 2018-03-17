# Baixiu pages
导入alishow.sql文件到数据库

把文件放在phpStudy的www文件夹下

配置phpstady软件的站点域名管理  ‘例如‘www.alishow.com

```
打开配置文件>vhosts-conf

<VirtualHost *:80>
    DocumentRoot "D:/phpStudy/WWW/alishow"
    ServerName www.alishow.com
    ServerAlias phpStudy.net
  <Directory "D:/phpStudy/WWW/alishow">
        //在options后面添加indexes
      Options Indexes FollowSymLinks ExecCGI
      AllowOverride All
      Order allow,deny
      Allow from all
      Require all granted
  </Directory>
</VirtualHost>
