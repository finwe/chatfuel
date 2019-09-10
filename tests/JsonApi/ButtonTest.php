<?php

namespace Finwe\Chatfuel\JsonApi\Template;

/**
 * @group unit
 */
class ButtonTest extends \PHPUnit\Framework\TestCase
{

	public function testInvalidCreation(): void
	{
		$this->expectException(\InvalidArgumentException::class);

		new Button(ButtonType::get(ButtonType::WEB_URL), '', []);
	}

}
