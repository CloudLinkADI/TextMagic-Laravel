<p align="center"><a href="https://cloud.link" target="_blank"><img src="https://cdn.cloud.link/img/cl-logo.png" alt="CloudLink" width="361.6" height="64"></a></p>

<p align="center">
  
<a href="https://packagist.org/packages/cloudlinkadi/textmagic-laravel">
  <img alt="Latest Stable Version" src="https://poser.pugx.org/cloudlinkadi/textmagic-laravel/v/stable">
</a>
<a href="https://packagist.org/packages/cloudlinkadi/textmagic-laravel">
  <img alt="Total Downloads" src="https://poser.pugx.org/cloudlinkadi/textmagic-laravel/downloads">
</a>
<a href="https://packagist.org/packages/cloudlinkadi/textmagic-laravel">
  <img alt="License" src="https://poser.pugx.org/cloudlinkadi/textmagic-laravel/license">
</a>
<a href="https://github.styleci.io/repos/7548986/shield">
  <img style="max-width:100%;" alt="StyleCI" src="https://github.styleci.io/repos/7548986/shield">
</a>

</p>


# TextMagic-Laravel
The TextMagic-Laravel SMS API PHP wrapper provides a convenient Laravel wrapper around the TextMagic PHP api.  See https://www.textmagic.com/

## Requirements
The PHP wrapper has the following requirements:

* Laravel >=5.0

## Installation
You can install the package via composer:

```
composer require cloudlink/textmagic-laravel:^1.0
```

## Registering the Application
**Laravel < 5.5**</br>
After you have installed package, open your Laravel config file config/app.php and add the following lines.

In the $providers array add the service providers for this package.

``` php
CloudLink\TextMagic\TextMagicServiceProvider::class
```

Add the facade of this package to the $aliases array.

``` php
  
'TextMagic' => CloudLink\TextMagic\TextMagic::class
```

**Laravel >= 5.5**</br>
No need to add the classes are they are automatically registed


As you're using Laravel 5.5+ the TextMagicServiceProvider & TextMagic Facade will be automatically registered for you.

## Configuration
Run artisan vendor:publish command to publish the config file 
 
```
$ php artisan vendor:publish --provider="CloudLink\TextMagic\TextMagicServiceProvider" --tag=config
```

Set the config values for username and api-key either by editing the config file, or by setting the TEXTMAGIC_USERNAME and TEXTMAGIC_API_KEY variables in your .env file.

## Usage Instructions
### Code Example

```php
$client = new TextMagic();
try {
    $result = $client->messages->send(
        [
            'text' => 'Hello from TextMagic PHP',
            'phones' => implode(', ', ['99900000','99900001'])
        
    );
}
catch (\Exception $e) {
    //Error Handling Code Here
}
echo $result['id'];
```


### API Reference
Refer to these links for a list of available functions 
* https://www.textmagic.com/docs/api/php/
* https://rest.textmagic.com/api/v2/doc

### Additional Suppported Methods
Not all TextMagic functions are available through the vendor provided PHP library.  The following is a list of endpoints that are supported through this library.

**endpoint: /lookups**<br>
```php
$result = $client->lookups->lookup('999000000');

```

**Other endpoints will be added based on request - if you need something that's not currently available let us know**
