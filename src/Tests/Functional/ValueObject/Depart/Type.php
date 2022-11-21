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

namespace Evrinoma\PackingListBundle\Tests\Functional\ValueObject\Depart;

use Evrinoma\TestUtilsBundle\ValueObject\AbstractValueObject;

class Type extends AbstractValueObject
{
    protected static string $default = 'PACKING_LIST_GROUP_INFO';
    protected static string $value = 'PACKING_LIST_GROUP_INFO';

    public static function wrong(): string
    {
        return strrev(static::value());
    }
}
