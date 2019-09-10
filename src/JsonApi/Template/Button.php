<?php declare(strict_types=1);

namespace Finwe\Chatfuel\JsonApi\Template;

use Webmozart\Assert\Assert;

class Button
{

	/**
	 * @var \Finwe\Chatfuel\JsonApi\Template\ButtonType
	 */
	private $type;

	/**
	 * @var string
	 */
	private $title;

	/**
	 * @var mixed
	 */
	private $specification;

	public function __construct(ButtonType $type, string $title, $specification)
	{
		$this->validateSpecification($type->getValue(), $specification);

		Assert::maxLength($title, 20);
		Assert::stringNotEmpty($title);

		$this->type = $type;
		$this->title = $title;
		$this->specification = $specification;
	}

	public function build(): array
	{
		return [
			'type' => $this->type->getValue(),
			'title' => $this->title,
			$this->getSpecificationKey($this->type->getValue(), $this->specification) => $this->specification,
		];
	}

	private function getSpecificationKey(string $type, $value): string
	{
		$types = [
			ButtonType::SHOW_BLOCK => is_array($value) ? 'block_names' : 'block_name',
			ButtonType::WEB_URL => 'url',
			ButtonType::JSON_PLUGIN_URL => 'url',
		];

		return $types[$type];
	}

	private function validateSpecification(string $type, $value): void
	{
		if (($type === ButtonType::SHOW_BLOCK) && is_array($value)) {
			Assert::allString($value);
		} else {
			Assert::string($value);
		}
	}

}
