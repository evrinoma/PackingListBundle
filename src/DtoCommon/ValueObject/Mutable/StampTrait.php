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

namespace Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable;

use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Immutable\StampTrait as StampImmutableTrait;

trait StampTrait
{
    use StampImmutableTrait;

    /**
     * @param string $stamp
     *
     * @return DtoInterface
     */
    protected function setStamp(string $stamp): DtoInterface
    {
        $this->stamp = trim($stamp);

        return $this;
    }
}
