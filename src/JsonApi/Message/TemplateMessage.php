<?php declare(strict_types=1);

namespace Finwe\Chatfuel\JsonApi\Message;

class TemplateMessage extends \Finwe\Chatfuel\JsonApi\Message\AttachmentMessage
{

	public function __construct(array $payload)
	{
		parent::__construct('template', $payload);
	}

}
