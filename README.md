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
