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

trait ConsigneeTrait
{
    private string $consignee = '';

    /**
     * @return bool
     */
    public function hasConsignee(): bool
    {
        return '' !== $this->consignee;
    }

    /**
     * @return string
     */
    public function getConsignee(): string
    {
        return $this->consignee;
    }
}
