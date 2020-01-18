A custom module for [frugue.com](https://frugue.com).

## How to install
```        
bin/magento maintenance:enable
rm -rf composer.lock
composer clear-cache
composer require frugue/core:*
bin/magento setup:upgrade
bin/magento cache:enable
rm -rf var/di var/generation generated/code
bin/magento setup:di:compile
rm -rf pub/static/*
bin/magento setup:static-content:deploy \
	--area adminhtml \
	--theme Magento/backend \
	-f en_US
bin/magento setup:static-content:deploy \
	--area frontend \
	--theme TemplateMonster/theme007 \
	-f en_US de_DE fr_FR ru_RU
bin/magento maintenance:disable
```

## How to upgrade
```
bin/magento maintenance:enable
composer remove frugue/core
rm -rf composer.lock
composer clear-cache
composer require frugue/core:*
bin/magento setup:upgrade
bin/magento cache:enable
rm -rf var/di var/generation generated/code
bin/magento setup:di:compile
rm -rf pub/static/*
bin/magento setup:static-content:deploy \
	--area adminhtml \
	--theme Magento/backend \
	-f en_US
bin/magento setup:static-content:deploy \
	--area frontend \
	--theme TemplateMonster/theme007 \
	-f en_US de_DE fr_FR ru_RU
bin/magento maintenance:disable
```