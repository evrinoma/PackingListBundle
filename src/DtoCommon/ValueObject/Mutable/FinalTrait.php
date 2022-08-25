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
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Immutable\FinalTrait as FinalImmutableTrait;

trait FinalTrait
{
    use FinalImmutableTrait;

    /**
     * @return DtoInterface
     */
    protected function setFinal(): DtoInterface
    {
        $this->final = true;

        return $this;
    }

    /**
     * @return DtoInterface
     */
    protected function resetFinal(): DtoInterface
    {
        $this->final = false;

        return $this;
    }
}
