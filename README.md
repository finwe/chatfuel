# PHP Chatfuel JSON API wrapper

https://docs.chatfuel.com/en/articles/735122-json-api

## Usage

```php
<?php

use Finwe\Chatfuel\JsonApi\JsonApiResponse;
use Finwe\Chatfuel\JsonApi\Message\ImageAttachmentMessage;
use Finwe\Chatfuel\JsonApi\Message\TextResponsePart;
use Finwe\Chatfuel\JsonApi\Redirect;
use Finwe\Chatfuel\JsonApi\SetAttribute;

$response = new JsonApiResponse();

$attributes = new SetAttribute();
$attributes->addAttribute('attribute', 'value');

$redirect = new Redirect();
$redirect->addBlock('Bot start');

$response->addMessage(new TextResponsePart('Hello'))
	->addMessage(new ImageAttachmentMessage('http://example.com'))
	->setAttributes($attributes)
	->setRedirect($redirect);

header('Content-type: application/json');
echo json_encode($response->getResponse());

```

### Message types to use

#### `Finwe\Chatfuel\JsonApi\Message\TextResponsePart(string $text)`
#### `Finwe\Chatfuel\JsonApi\Message\ImageAttachmentMessage(string $url)`
#### `Finwe\Chatfuel\JsonApi\Message\VideoAttachmentMessage(string $url)`
#### `Finwe\Chatfuel\JsonApi\Message\AudioAttachmentMessage(string $url)`
#### `Finwe\Chatfuel\JsonApi\Message\AttachmentResponsePart(string $type, array $payload)`
