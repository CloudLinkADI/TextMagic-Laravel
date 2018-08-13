# TextMagic-Laravel
The TextMagic SMS API PHP wrapper can save you a lot of time, as it includes all the necessary API commands and tests. It only takes a few seconds to download it from GitHub and to install it into your own app or software. After installation, you’ll then be able to send text messages.

##Requirements
The PHP wrapper has the following requirements:

* PHP 5.2.1 or higher
* phpunit 4.5 or higher


## Send an SMS using TextMagic Facade (Code Example)

```php
try {
    $result = TextMagic::createMessages(
        array(
            'text' => 'Hello from TextMagic PHP',
            'phones' => implode(', ', array('99900000'))
        )
    );
}
catch (\Exception $e) {
    //Error Handling Code Here
}
echo $result['id'];
```

#Installation
You can install the package via composer:

```
composer require beyondcode/laravel-self-diagnosis
```

After you have installed package, open your Laravel config file config/app.php and add the following lines.

In the $providers array add the service providers for this package.

``` php
CloudLinkADI\TextMagic\TextMagicServiceProvider::class
```

Add the facade of this package to the $aliases array.

``` php
  
'TextMagic' => CloudLinkADI\TextMagic\TextMagic::class
```


Now the Image Class will be auto-loaded by Laravel.

**For Laravel version > 5.5**<br/>
If you're using Laravel 5.5+ the SelfDiagnosisServiceProvider will be automatically registered for you.





**Publishing Config File** <br/>
Run artisan vendor:publish command to publish the config file 
 
```
$ php artsian vendor:publish --tag=config
```

## API Reference
* https://www.textmagic.com/docs/api/php/
* https://rest.textmagic.com/api/v2/doc

### Suppported Methods
**endpoint: /bulk**<br>
```php
// By TextMagic Facade 
$result = TextMagic::getBulkList($arg);
$result = TextMagic::getBulk($arg);

// Or with including 's at endpoint model

$result = TextMagic::getBulksList($arg);
$result = TextMagic::getBulks($arg);

// Or by getting model

$textMagic = app('TextMagic');
$textMagic->bulks->getList($arg);
$textMagic->bulks->get($arg);

```

**endpoint: /chats**<br>
```php
// By TextMagic Facade 
$result = TextMagic::getChatList($arg);
$result = TextMagic::getChat($arg);

// Or with including 's at endpoint model

$result = TextMagic::getChatsList($arg);
$result = TextMagic::getChats($arg);

// Or by getting model

$textMagic = app('TextMagic');
$textMagic->chats->getList($arg);
$textMagic->chats->get($arg);

```

**endpoint: /contacts**<br>
```php
// By TextMagic Facade 
$result = TextMagic::getContactsLists($arg);
$result = TextMagic::getContactsList($arg);
$result = TextMagic::createContact($arg);
$result = TextMagic::getContact($arg);
$result = TextMagic::updateContact($arg,$arg2);
$result = TextMagic::deleteContact($arg);
$result = TextMagic::searchContact($arg);

// Function With Ending 's is also available and  
// You can always use all method by endpoint mdoel `$textMagic->contacts->{metodName}($arg)`
```

**endpoint: /customfields**<br>
```php
// By TextMagic Facade 
$result = TextMagic::getCcustomFieldList($arg);
$result = TextMagic::createCcustomField($arg);
$result = TextMagic::updateCcustomField($id,$arr);
$result = TextMagic::getCcustomField($arg);
$result = TextMagic::deleteCcustomField($arg);
$result = TextMagic::updateCcustomFieldContact($arg);

// Function With Ending 's is also available and  
// You can always use all method by endpoint mdoel `$textMagic->customfields->{metodName}($arg)`
```

**endpoint: /invoices**<br>
```php
// By TextMagic Facade 
$result = TextMagic::getIinvoiceList($arg);

// Or with including 's at endpoint model

$result = TextMagic::getIinvoicesList($arg);

// Or by getting model

$textMagic = app('TextMagic');
$textMagic->invoices->getList($arg);
```

**endpoint: /lists**<br>
```php
// By TextMagic Facade 
$result = TextMagic::getListList($arg);
$result = TextMagic::createList($arg);
$result = TextMagic::createList($arg);
$result = TextMagic::updateList($id,$arr);
$result = TextMagic::deleteList($id);
$result = TextMagic::searchList($id);
$result = TextMagic::getListContacts($id);
$result = TextMagic::updateListContacts($id,$arr);
$result = TextMagic::deleteListContacts($id);

// Function With Ending 's is also available and  
// You can always use all method by endpoint mdoel `$textMagic->lists->{metodName}($arg)`
```

**endpoint: /messages**<br>
```php
// By TextMagic Facade 
$result = TextMagic::getMessageList($arg);
$result = TextMagic::getMessage($arg);
$result = TextMagic::createMessage($arg);
$result = TextMagic::deleteMessage($id);
$result = TextMagic::searchMesage($id);
$result = TextMagic::getMessagePrice($id);

// Function With Ending 's is also available and  
// You can always use all method by endpoint mdoel `$textMagic->messages->{metodName}($arg)`
```

**endpoint: /numbers**<br>
```php
// By TextMagic Facade 
$result = TextMagic::getNumberList($arg);
$result = TextMagic::getNumberAvailable($arg);
$result = TextMagic::getNumber($arg);
$result = TextMagic::createNumber($arg);
$result = TextMagic::deleteNumber($id);

// Function With Ending 's is also available and  
// You can always use all method by endpoint mdoel `$textMagic->numbers->{metodName}($arg)`
```

**endpoint: /replies**<br>
```php
// By TextMagic Facade 
$result = TextMagic::getRepliesList($arg);
$result = TextMagic::getReplies($arg);
$result = TextMagic::deleteReplies($arg);
$result = TextMagic::searchReplies($id);

// Function With Ending 's is also available and  
// You can always use all method by endpoint mdoel `$textMagic->replies->{metodName}($arg)`
```

**endpoint: /schedules**<br>
```php
// By TextMagic Facade 
$result = TextMagic::getScheduleList($arg);
$result = TextMagic::getSchedule($arg);
$result = TextMagic::deleteSchedule($arg);

// Function With Ending 's is also available and  
// You can always use all method by endpoint mdoel `$textMagic->schedules->{metodName}($arg)`
```

**endpoint: /senderids**<br>
```php
// By TextMagic Facade 
$result = TextMagic::getSenderIdList($arg);
$result = TextMagic::getSenderId($arg);
$result = TextMagic::createSenderId($arg);
$result = TextMagic::deleteSenderId($arg);

// Function With Ending 's is also available and  
// You can always use all method by endpoint mdoel `$textMagic->senderids->{metodName}($arg)`
```

**endpoint: /sessions**<br>
```php
// By TextMagic Facade 
$result = TextMagic::getSessionList($arg);
$result = TextMagic::getSession($arg);
$result = TextMagic::deleteSession($arg);
$result = TextMagic::getSessionMessage($arg);

// Function With Ending 's is also available and  
// You can always use all method by endpoint mdoel `$textMagic->sessions->{metodName}($arg)`
```

**endpoint: /sources**<br>
```php
// By TextMagic Facade 
$result = TextMagic::getSourceList($arg);

// Or with including 's at endpoint model

$result = TextMagic::getSourcesList($arg);

// Or by getting model

$textMagic = app('TextMagic');
$textMagic->sources->getList($arg);

```

**endpoint: /stats**<br>
```php
// By TextMagic Facade 
$result = TextMagic::spendingStats($arg);
$result = TextMagic::messagingStats($arg);

// NOTE :: These functions without including 's is not available here

// by getting model

$textMagic = app('TextMagic');
$textMagic->stats->spending($arg);
$textMagic->stats->messaging($arg);

```

**endpoint: /subaccounts**<br>
```php
// By TextMagic Facade 
$result = TextMagic::getSubaccountList($arg);
$result = TextMagic::getSubaccount($arg);
$result = TextMagic::createSubaccount($arg);
$result = TextMagic::deleteSubaccount($arg);

// Function With Ending 's is also available and  
// You can always use all method by endpoint mdoel `$textMagic->subaccounts->{metodName}($arg)`
```

**endpoint: /templates**<br>
```php
// By TextMagic Facade 
$result = TextMagic::getTemplateList($arg);
$result = TextMagic::getTemplate($arg);
$result = TextMagic::createTemplate($arg);
$result = TextMagic::updateTemplate($id,$arg);
$result = TextMagic::deleteTemplate($arg);
$result = TextMagic::searchTemplate($arg);

// Function With Ending 's is also available and  
// You can always use all method by endpoint mdoel `$textMagic->templates->{metodName}($arg)`
```

**endpoint: /unsubscribers**<br>
```php
// By TextMagic Facade 
$result = TextMagic::getUnsubscriberList($arg);
$result = TextMagic::getUnsubscriber($arg);
$result = TextMagic::createUnsubscriber($arg);

// Function With Ending 's is also available and  
// You can always use all method by endpoint mdoel `$textMagic->unsubscribers->{metodName}($arg)`
```

**endpoint: /unsubscribers**<br>
```php
// By TextMagic Facade 
$result = TextMagic::getUser();
$result = TextMagic::updateUser($params);

// NOTE :: Function With Ending 's is not available Here
  
// by getting model
$textMagic = app('TextMagic');
$textMagic->user->get();
$textMagic->user->update($arg);
```

**Utilities**<br>
```php
// By TextMagic Facade 
$result = TextMagic::ping();
  
// by getting model
$textMagic = app('TextMagic');
$textMagic->utils->ping();
```