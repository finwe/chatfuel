<?php declare(strict_types=1);

namespace Finwe\Chatfuel\JsonApi\Message;

class AudioAttachmentMessage extends \Finwe\Chatfuel\JsonApi\Message\AttachmentResponsePart
{

	public function __construct(string $url)
	{
		parent::__construct('audio', [
			'url' => $url,
		]);
	}

}
