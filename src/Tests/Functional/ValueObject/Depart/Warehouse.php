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

class Warehouse extends AbstractValueObject
{
    protected static string $default = '64';
    protected static string $value = '64';

    public static function wrong(): string
    {
        return static::$wrong ?? '34';
    }
}
