<?php

declare(strict_types=1);

namespace Qameta\Allure\Attribute;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS | Attribute::TARGET_METHOD | Attribute::IS_REPEATABLE)]
final class SubSuite extends AbstractLabel
{
    public function __construct(string $value)
    {
        parent::__construct(Label::SUB_SUITE, $value);
    }
}
