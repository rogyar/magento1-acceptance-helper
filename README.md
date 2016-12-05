# Acceptance Helper Magento 1 extension
## Description
The main extension purpose is to provide an ability to execute some platform operations during the Magento acceptance testing: fixtures generation, settings change, manipulation with entities etc. This extension should not be used on production environment since it uses controllers accessible by direct URLs without authentication. 

## Features
- Flush cache
- Create test product
- Remove test product
- Remove customer by email
- Remove subscriber by email
- Remove order by number
TBM

## Installation
### Manual installation
- Download the package contents 
- Put `app` directory from package into your Magento root directory (without overwriting files)

### Installation via Modman
- Install [Modman](https://github.com/colinmollenhour/modman) package manager.
- Run the following commands in console:
```Bash
cd /var/www            # Magento is installed here
modman init
modman clone git@github.com:rogyar/magento1-acceptance-helper.git
```

## Usage
All operations are being processed by direct links.
### Flush Cache
```
http://your.site.com/index.php/acceptancehelper/index/clearcache
```
### Remove Customer
```
http://your.site.com/index.php/acceptancehelper/index/removecustomer/email/customer%40email.com
```
`customer%40email.com` here is an "url_encoded" email string.
### Add Product
```
http://your.site.com/index.php/acceptancehelper/index/createproduct
```
Product details can be adjusted directly in `Helper/Product.php`.
### Remove Product
```
http://your.site.com/index.php/acceptancehelper/index/removeproduct
```
This command will remove product created by the "Add Product" command.
### Remove Subscriber
```
http://your.site.com/index.php/acceptancehelper/index/removesubscribtion/email/customer%40email.com
```
`customer%40email.com` here is an "url_encoded" email string.
### Remove Order
```
http://your.site.com//index.php/acceptancehelper/index/removeorder/order/orderNumber
```
`orderNumber` here is an order number.