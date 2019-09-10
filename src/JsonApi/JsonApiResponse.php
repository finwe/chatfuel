<?php declare(strict_types=1);

namespace Finwe\Chatfuel\JsonApi;

use Finwe\Chatfuel\JsonApi\Message\MessageInterface;

class JsonApiResponse
{

	/**
	 * @var \Finwe\Chatfuel\JsonApi\Message\MessageInterface[]
	 */
	private $messages;

	/**
	 * @var \Finwe\Chatfuel\JsonApi\Redirect|null
	 */
	private $redirect;

	/**
	 * @var \Finwe\Chatfuel\JsonApi\SetAttribute|null
	 */
	private $setAttribute;

	public function __construct()
	{
		$this->messages = [];
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
		$response = [];

		if ($this->messages) {
			$response += [
				'messages' => array_reduce($this->messages, function ($all, MessageInterface $item) {
					$all[] = $item->build();
					return $all;
				}, []),
			];
		}

		if ($this->redirect) {
			$response += $this->redirect->build();
		}

		if ($this->setAttribute) {
			$response += $this->setAttribute->build();
		}

		return $response;
	}

}
