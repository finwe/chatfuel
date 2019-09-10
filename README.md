# PHP Chatfuel JSON API wrapper

https://docs.chatfuel.com/en/articles/735122-json-api

## Usage

```php
<?php

use Finwe\Chatfuel\JsonApi\JsonApiResponse;
use Finwe\Chatfuel\JsonApi\Message\ImageMessage;
use Finwe\Chatfuel\JsonApi\Message\TextMessage;
use Finwe\Chatfuel\JsonApi\Redirect;
use Finwe\Chatfuel\JsonApi\SetAttribute;

$response = new JsonApiResponse();

$attributes = new SetAttribute();
$attributes->addAttribute('attribute', 'value');

$redirect = new Redirect();
$redirect->addBlock('Bot start');

$response->addMessage(new TextMessage('Hello'))
	->addMessage(new ImageMessage('http://example.com'))
	->setAttributes($attributes)
	->setRedirect($redirect);

header('Content-type: application/json');
echo json_encode($response->getResponse());

```

### Message types to use

#### `Finwe\Chatfuel\JsonApi\Message\TextMessage(string $text)`

A simple text message.

#### `Finwe\Chatfuel\JsonApi\Message\ImageMessage(string $url)`

Image message.

#### `Finwe\Chatfuel\JsonApi\Message\VideoMessage(string $url)`

Video message.

#### `Finwe\Chatfuel\JsonApi\Message\AudioMessage(string $url)`

Audio message.

#### `Finwe\Chatfuel\JsonApi\Message\ButtonMessage(string $text, \Finwe\Chatfuel\JsonApi\Template\Button[] $buttons)`

A text message with buttons.

Buttons can also be added with `addButton(Button $button)` method.

#### `Finwe\Chatfuel\JsonApi\Message\AttachmentMessage(string $type, array $payload)`

Generic message with custom payload. More concrete message types extend from this class.

### Payload part classes

#### `Finwe\Chatfuel\JsonApi\Template\Button(ButtonType $type, string $text, mixed $specification)`

Class to add a button below an element.

Button type is a [Consistence\Enum][1] instance, eg. `ButtonType::get(ButtonType::WEB_URL);`. Available types are `ButtonType::WEB_URL`, `ButtonType::JSON_PLUGIN_URL` and `ButtonType::SHOW_BLOCK`

Specification is either a string for all types, or an array of strings for `ButtonType::SHOW_BLOCK`.

[1]:https://github.com/consistence/consistence/blob/HEAD/docs/Enum/enums.md 
