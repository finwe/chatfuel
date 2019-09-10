<?php declare(strict_types=1);

namespace Finwe\Chatfuel\JsonApi\Message;

class AttachmentResponsePart implements \Finwe\Chatfuel\JsonApi\Message\MessageInterface
{

	/**
	 * @var string
	 */
	private $type;

	/**
	 * @var mixed[]
	 */
	private $payload;

	public function __construct(string $type, array $payload)
	{
		$this->type = $type;
		$this->payload = $payload;
	}

	public function build(): array
	{
		return [
			'attachment' => [
				'type' => $this->type,
				'payload' => $this->payload
			]
		];
	}
}
