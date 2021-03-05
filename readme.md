# General Speedsms API

This package replace shitty code that [speedsms.vn](https://speedsms.vn) provided. Also you need register an account on their site.

## Installation

Install via composer

```bash
composer require alexzvn/speedsms-api
```

## Use Speedsms API

First require autoload into your php script.

```php
<?php

use Alexzvn\Speedsms\Speedsms;

require_once 'path-to/vendor/autoload.php';

$sms = new Speedsms('your api key goes here');

```

### Query account info

```php
// Fetch information from speedsms.vn
// Because speedsms suck then whenever api key invalid,
//  you will hit 404 error exception
$user = $sms->getUserInfo();

// get email
$user->email();

// get balance (int)
$user->balance();
```

### Send an sms to phone number

```php

$phone = '0355012345';

// maximum is 160 length for ascii and 70 if contains unicode
// other wise you'll hit Alexzvn\Speedsms\MessageLengthException
$message = 'your message'; 

$type = Speedsms::SMS_SUPPORT;

// depend on type you choice
// for sms support no needed
$sender = '';

$response = $sms->sendSms($phone, $message, $type, $sender);
```

### Handle incoming callback sms

```php
$sms = Speedsms::incoming()

// get phone
$sms->phone

// get message
$sms->message

// and get type
$sms->type
```

## Contributing

Feel free to create pull request or issue for this package.

## License

The package is available as open source under the terms of the [MIT License](http://opensource.org/licenses/MIT).
