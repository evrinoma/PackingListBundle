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

namespace Evrinoma\PackingListBundle\DtoCommon\ValueObject\Immutable;

trait IsFinalTrait
{
    private ?bool  $isFinal = null;

    /**
     * @return bool
     */
    public function isIsFinal(): bool
    {
        return $this->isFinal;
    }

    /**
     * @return bool
     */
    public function hasIsFinal(): bool
    {
        return null !== $this->isFinal;
    }
}
