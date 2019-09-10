<?php declare(strict_types=1);

namespace Finwe\Chatfuel\JsonApi\Message;

class TextMessage implements \Finwe\Chatfuel\JsonApi\Message\MessageInterface
{

	/**
	 * @var string
	 */
	private $text;

	public function __construct(string $text)
	{
		$this->text = $text;
	}

	public function build(): array
	{
		return [
			'text' => $this->text,
		];
	}
}
