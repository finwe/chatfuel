<?php declare(strict_types=1);

namespace Finwe\Chatfuel\JsonApi\Message;

class VideoMessage extends \Finwe\Chatfuel\JsonApi\Message\AttachmentMessage
{

	public function __construct(string $url)
	{
		parent::__construct('video', [
			'url' => $url,
		]);
	}

}
