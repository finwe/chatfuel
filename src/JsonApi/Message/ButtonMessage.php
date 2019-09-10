<?php declare(strict_types=1);

namespace Finwe\Chatfuel\JsonApi\Message;

use Finwe\Chatfuel\JsonApi\Template\Button;
use Webmozart\Assert\Assert;

class ButtonMessage implements \Finwe\Chatfuel\JsonApi\Message\MessageInterface
{

	/**
	 * @var string
	 */
	private $text;

	/**
	 * @var \Finwe\Chatfuel\JsonApi\Template\Button[]
	 */
	private $buttons;

	public function __construct(string $text, array $buttons)
	{
		Assert::allIsInstanceOf($buttons, Button::class);

		$this->text = $text;
		$this->buttons = $buttons;
	}

	public function addButton(Button $button): self
	{
		$this->buttons[] = $button;

		return $this;
	}

	public function build(): array
	{
		return [
			'attachment' => [
				'type' => 'template',
				'payload' => [
					'template_type' => 'button',
					'text' => $this->text,
					'buttons' => array_reduce($this->buttons, static function ($all, Button $item) {
						$all[] = $item->build();
						return $all;
					}, [])
				],
			],
		];
	}

}
