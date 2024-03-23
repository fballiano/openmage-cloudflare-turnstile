# Cloudflare Turnstile module for OpenMage/Magento1

Turnstile is Cloudflare's CAPTCHA alternative, read more at https://developers.cloudflare.com/turnstile

<table><tr><td align=center>
<strong>If you find my work valuable, please consider sponsoring</strong><br />
<a href="https://github.com/sponsors/fballiano" target=_blank title="Sponsor me on GitHub"><img src="https://img.shields.io/badge/sponsor-30363D?style=for-the-badge&logo=GitHub-Sponsors&logoColor=#white" alt="Sponsor me on GitHub" /></a>
<a href="https://www.buymeacoffee.com/fballiano" target=_blank title="Buy me a coffee"><img src="https://img.shields.io/badge/Buy_Me_A_Coffee-FFDD00?style=for-the-badge&logo=buy-me-a-coffee&logoColor=black" alt="Buy me a coffee" /></a>
<a href="https://www.paypal.com/paypalme/fabrizioballiano" target=_blank title="Donate via PayPal"><img src="https://img.shields.io/badge/PayPal-00457C?style=for-the-badge&logo=paypal&logoColor=white" alt="Donate via PayPal" /></a>
</td></tr></table>

Features
---------
- Super easy and non-intrusive implementation, you don't have to modify and block or phtml file
- Support for customer registration, customer forgot password, newsletter subscribe, 
  checkout (guest/register), product review, wishlist share
- Support for admin login and forgot password
- Easy customization (for theme related changes to the supported forms) via configurable CSS selectors
- Lazy load of Cloudflare's javascript, Google PageSpeed will appreciate
- Compatible with Magento 1.9, OpenMage 19 and OpenMage 20 on PHP >= 7.4

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
