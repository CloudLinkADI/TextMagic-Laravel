[![Latest Stable Version](https://poser.pugx.org/cloudlinkadi/textmagic-laravel/v/stable)](https://packagist.org/packages/cloudlinkadi/textmagic-laravel)
[![Total Downloads](https://poser.pugx.org/cloudlinkadi/textmagic-laravel/downloads)](https://packagist.org/packages/cloudlinkadi/textmagic-laravel)
[![License](https://poser.pugx.org/cloudlinkadi/textmagic-laravel/license)](https://packagist.org/packages/cloudlinkadi/textmagic-laravel)


# TextMagic-Laravel
The TextMagic-Laravel SMS API PHP wrapper provides a convenient Laravel wrapper around the TextMagic PHP api.  See https://www.textmagic.com/

## Requirements
The PHP wrapper has the following requirements:

* Laravel >=5.0

## Installation
You can install the package via composer:

```
composer require cloudlinkadi/textmagic-laravel
```

###Registering the Application
####Laravel < 5.5
After you have installed package, open your Laravel config file config/app.php and add the following lines.

In the $providers array add the service providers for this package.

``` php
CloudLinkADI\TextMagic\TextMagicServiceProvider::class
```

Add the facade of this package to the $aliases array.

``` php
  
'TextMagic' => CloudLinkADI\TextMagic\TextMagic::class
```

####Laravel >= 5.5
No need to add the classes are they are automatically registed


As you're using Laravel 5.5+ the TextMagicServiceProvider & TextMagic Facade will be automatically registered for you.



###Configuration
Run artisan vendor:publish command to publish the config file 
 
```
$ php artisan vendor:publish --provider="CloudLinkADI\TextMagic\TextMagicServiceProvider" --tag=config
```

Set the config values for username and api-key either by editing the config file, or by setting the TEXTMAGIC_USERNAME and TEXTMAGIC_API_KEY variables in your .env file.

## Usage Instructions (Code Example)

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