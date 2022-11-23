<?php

declare(strict_types=1);

/*
 * This file is part of the package.
 *
 * (c) Nikolay Nikolaev <evrinoma@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Evrinoma\PackingListBundle\Tests\Functional\ValueObject\Group;

use Evrinoma\TestUtilsBundle\ValueObject\AbstractValueObject;

class Info extends AbstractValueObject
{
    protected static string $default = 'Контейнер KRPU xxxxx';
    protected static string $value = 'Контейнер KRPU xxxxx';

    public static function wrong(): string
    {
        return strrev(static::value());
    }
}
