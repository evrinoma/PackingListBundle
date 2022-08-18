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

trait StampTrait
{
    private string $stamp = '';

    /**
     * @return bool
     */
    public function hasStamp(): bool
    {
        return '' !== $this->stamp;
    }

    /**
     * @return string
     */
    public function getStamp(): string
    {
        return $this->stamp;
    }
}
