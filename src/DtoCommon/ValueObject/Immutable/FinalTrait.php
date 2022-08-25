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

trait FinalTrait
{
    private ?bool  $final = null;

    /**
     * @return bool
     */
    public function isFinal(): bool
    {
        return $this->final;
    }

    /**
     * @return bool
     */
    public function hasFinal(): bool
    {
        return null !== $this->final;
    }
}
