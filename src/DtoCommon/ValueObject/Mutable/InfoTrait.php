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
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Immutable\InfoTrait as InfoImmutableTrait;

trait InfoTrait
{
    use InfoImmutableTrait;

    /**
     * @param string $info
     *
     * @return DtoInterface
     */
    protected function setInfo(string $info): DtoInterface
    {
        $this->info = trim($info);

        return $this;
    }
}
