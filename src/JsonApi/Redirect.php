<?php declare(strict_types=1);

namespace Finwe\Chatfuel\JsonApi;

use Webmozart\Assert\Assert;

class Redirect implements \Finwe\Chatfuel\JsonApi\JsonApiResponsePartInterface
{

	/**
	 * @var string[]
	 */
	private $blocks;

	public function __construct(array $blocks = [])
	{
		Assert::allString($blocks);

		$this->blocks = $blocks;
	}

	public function addBlock(string $block): self
	{
		$this->blocks[] = $block;

		return $this;
	}

	public function build(): array
	{
		return [
			'redirect_to_blocks' => $this->blocks,
		];
	}

}
