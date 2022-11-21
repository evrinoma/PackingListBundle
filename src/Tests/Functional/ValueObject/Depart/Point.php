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

class Point extends AbstractValueObject
{
    protected static string $default = '\u0427\u0413\u0420\u041a \u21161.2';
    protected static string $value = '\u0427\u0413\u0420\u041a_\u21161.1';

    public static function wrong(): string
    {
        return static::$wrong ?? 'xxxxxxx';
    }
}
