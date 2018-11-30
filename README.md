安装

将此项目 clone 到mediawiki 的extension 目录中

```shell
cd mediawiki/extension
git clone https://github.com/Hiold/MoegirlRanking.git
```

在 `mediawiki/LocalSettings.php` 中加入 
```php
wfLoadExtension('MoegirlRanking');
```

升级数据库, 具体原理参考 https://www.mediawiki.org/wiki/Manual:Update.php 
```
cd mediawiki/maintenance
php update.php
```

使用解析函数展示内容,可在首页或者自定义页面使用该函数:

{{#MoeRanking:ranktimeday|default|{近期天数}|{获取数量}}}
![Image text](https://raw.githubusercontent.com/Hiold/images/master/default.png)



{{#MoeRanking:ranktimeday|default_single|{近期天数}|{名次}}}
![Image text](https://raw.githubusercontent.com/Hiold/images/master/byTime.png)



{{#MoeRanking:ranktimeday|default_single_field|{近期天数}|{名次}|{属性}}}
目前可用的属性有:title(词条名)、url(词条链接)、cts(访问量)
![Image text](https://raw.githubusercontent.com/Hiold/images/master/byTimeField.png)
