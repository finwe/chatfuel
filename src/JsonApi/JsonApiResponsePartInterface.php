<?php declare(strict_types=1);

namespace Finwe\Chatfuel\JsonApi;

interface JsonApiResponsePartInterface
{

	public function build(): array;

}
