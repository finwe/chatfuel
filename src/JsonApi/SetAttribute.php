<?php declare(strict_types=1);

namespace Finwe\Chatfuel\JsonApi;

use Webmozart\Assert\Assert;

class SetAttribute implements \Finwe\Chatfuel\JsonApi\JsonApiResponsePartInterface
{

	/**
	 * @var string[]
	 */
	private $attributes;

	public function __construct(array $attributes = [])
	{
		if ($attributes) {
			Assert::isMap($attributes);
			Assert::allString($attributes, 'Use strings for attribute values as strings are safer. Use "not set" to unset an attribute.');
		}

		$this->attributes = $attributes;
	}

	public function addAttribute(string $name, string $value): self
	{
		Assert::stringNotEmpty($name, 'Attribute name must not be empty');
		Assert::stringNotEmpty($value, 'Use a string for attribute values as strings are safer. Use "not set" to unset an attribute.');

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
