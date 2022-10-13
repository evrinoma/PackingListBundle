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

namespace Evrinoma\PackingListBundle\Tests\Functional\ValueObject\LogisticsGroup;

use Evrinoma\TestUtilsBundle\ValueObject\Common\AbstractId;

class Id extends AbstractId
{
    protected static string $default = '6';
    protected static string $value = '2';
}
