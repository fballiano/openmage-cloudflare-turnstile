# Cloudflare Turnstile module for OpenMage/Magento1

Turnstile is Cloudflare's CAPTCHA alternative, read more at https://developers.cloudflare.com/turnstile

Features
---------
- Super easy and non-intrusive implementation, you don't have to modify and block or phtml file
- Support for customer registration, customer forgot password, newsletter subscribe, 
  checkout (guest/register), product review, wishlist share
- Easy customization (for theme related changes to the supported forms) via configurable CSS selectors 
- Compatible with **Magento 1.9, OpenMage 19 and OpenMage 20 on PHP >= 7.4**

TODO
- support for backend (login/forgotpassword)
- lazy load for turnstile's javascript file

How to use it
-------------
- Install via composer (`composer require fballiano/openmage-cloudflare-turnstile`), 
  modman (`modman clone https://github.com/fballiano/openmage-cloudflare-turnstile`)
  or any other way you like
- Configure your Turnstile SITE_KEY/SECRET_KEY in "system -> Configuration -> Admin -> Cloudflare Turnstile"
- If you want to test the module you can use development keys available at 
  https://developers.cloudflare.com/turnstile/reference/testing

Backup!!!
---------
Backup your database and files before launching the cleaning process!!!
This module is provided "as is" and I'll not be responsible for any data damage.

Support
-------
If you have any issues with this extension, open an issue on GitHub.

Contribution
------------
Any contributions are highly appreciated. The best way to contribute code is to open a
[pull request on GitHub](https://help.github.com/articles/using-pull-requests).

Developer
---------
Fabrizio Balliano  
[http://fabrizioballiano.com](http://fabrizioballiano.com)  
[@fballiano](https://twitter.com/fballiano)

Licence
-------
[OSL - Open Software Licence 3.0](http://opensource.org/licenses/osl-3.0.php)

Copyright
---------
(c) Fabrizio Balliano
