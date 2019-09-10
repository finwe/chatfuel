<?php declare(strict_types=1);

namespace Finwe\Chatfuel\JsonApi;

class SetAttribute implements \Finwe\Chatfuel\JsonApi\JsonApiResponsePartInterface
{

	/**
	 * @var string[]
	 */
	private $attributes;

	public function __construct(array $attributes = [])
	{
		$this->attributes = $attributes;
	}

	public function addAttribute(string $name, string $value): self
	{
		$this->attributes[$name] = $value;

		return $this;
	}

	public function build(): array
	{
		return [
			'set_attributes' => $this->attributes,
		];
	}

}
