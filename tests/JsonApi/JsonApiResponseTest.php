<?php declare(strict_types=1);

namespace Finwe\Chatfuel\JsonApi;

use Finwe\Chatfuel\JsonApi\Message\ImageAttachmentMessage;
use Finwe\Chatfuel\JsonApi\Message\TextResponsePart;

class JsonApiResponseTest extends \PHPUnit\Framework\TestCase
{

	public function testBuildingResponse(): void
	{
		$response = new JsonApiResponse();

		$attributes = new SetAttribute();
		$attributes->addAttribute('attribute', 'value');

		$redirect = new Redirect();
		$redirect->addBlock('Bot start');

		$response->addMessage(new TextResponsePart('Ahoj'))
			->addMessage(new ImageAttachmentMessage('http://example.com'))
			->setAttributes($attributes)
			->setRedirect($redirect);

		$expected = [
			'messages' => [
				[
					'text' => 'Ahoj'
				],
				[
					'attachment' => [
						'type' => 'image',
						'payload' => [
							'url' => 'http://example.com',
						]
					]
				],
			],
			'redirect_to_blocks' => [
				'Bot start',
			],
			'set_attributes' => [
				'attribute' => 'value',
			],
		];

		$this->assertSame($expected, $response->getResponse());
	}

}
