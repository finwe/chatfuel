<?php declare(strict_types=1);

namespace Finwe\Chatfuel\JsonApi;

use Finwe\Chatfuel\JsonApi\Message\MessageInterface;

class JsonApiResponse
{

	private $messages;

	/**
	 * @var \Finwe\Chatfuel\JsonApi\Redirect
	 */
	private $redirect;

	/**
	 * @var \Finwe\Chatfuel\JsonApi\SetAttribute
	 */
	private $setAttribute;

	public function __construct()
	{
		$this->messages = [];
		$this->redirect;
		$this->setAttribute;
	}

	public function addMessage(MessageInterface $message): self
	{
		$this->messages[] = $message;

		return $this;
	}

	public function setRedirect(Redirect $redirect): self
	{
		$this->redirect = $redirect;

		return $this;
	}

	public function setAttributes(SetAttribute $setAttribute): self
	{
		$this->setAttribute = $setAttribute;

		return $this;
	}

	public function getResponse(): array
	{
		return [
			'messages' => array_reduce($this->messages, function ($all, MessageInterface $item) {
				$all[] = $item->build();
				return $all;
			}, []),
		] + $this->redirect->build()
			+ $this->setAttribute->build();
	}

}
