<?php declare(strict_types=1);

namespace Finwe\Chatfuel\JsonApi\Message;

class VideoAttachmentMessage extends \Finwe\Chatfuel\JsonApi\Message\AttachmentResponsePart
{

	public function __construct(string $url)
	{
		parent::__construct('video', [
			'url' => $url,
		]);
	}

}