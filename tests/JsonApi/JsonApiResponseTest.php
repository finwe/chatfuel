<?php declare(strict_types=1);

namespace Finwe\Chatfuel\JsonApi;

use Finwe\Chatfuel\JsonApi\Message\ButtonMessage;
use Finwe\Chatfuel\JsonApi\Message\ImageMessage;
use Finwe\Chatfuel\JsonApi\Message\TextMessage;
use Finwe\Chatfuel\JsonApi\Template\Button;
use Finwe\Chatfuel\JsonApi\Template\ButtonType;

class JsonApiResponseTest extends \PHPUnit\Framework\TestCase
{

	public function testBuildingResponse(): void
	{
		$response = new JsonApiResponse();

		$attributes = new SetAttribute();
		$attributes->addAttribute('attribute', 'value');

		$redirect = new Redirect();
		$redirect->addBlock('Bot start');

		$button = new ButtonMessage('Message', [
			new Button(ButtonType::get(ButtonType::SHOW_BLOCK), 'Go to block', ['Bot block']),
		]);

		$button->addButton(new Button(ButtonType::get(ButtonType::WEB_URL), 'Visit Website', 'http://example.com'));

		$response->addMessage(new TextMessage('Ahoj'))
			->addMessage(new ImageMessage('http://example.com'))
			->addMessage($button)
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
				[
					'attachment' => [
						'type' => 'template',
						'payload' => [
							'template_type' => 'button',
							'text' => 'Message',
							'buttons' => [
								[
									'type' => 'show_block',
									'title' => 'Go to block',
									'block_names' => ['Bot block'],
								],
								[
									'type' => 'web_url',
									'title' => 'Visit Website',
									'url' => 'http://example.com',
								]
							]
						],
					]
				]
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

	public function testEmptyResponse()
	{
		$response = new JsonApiResponse();

		$this->assertSame([], $response->getResponse());
	}

}
