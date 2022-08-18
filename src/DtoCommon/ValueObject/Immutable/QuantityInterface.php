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

interface QuantityInterface
{
    public const QUANTITY = 'quantity';

    /**
     * @return bool
     */
    public function hasQuantity(): bool;

    /**
     * @return string
     */
    public function getQuantity(): string;
}
