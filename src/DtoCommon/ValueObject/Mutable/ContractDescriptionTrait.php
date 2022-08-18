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
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Immutable\ContractDescriptionTrait as ContractDescriptionImmutableTrait;

trait ContractDescriptionTrait
{
    use ContractDescriptionImmutableTrait;

    /**
     * @param string $contractDescription
     *
     * @return DtoInterface
     */
    protected function setContractDescription(string $contractDescription): DtoInterface
    {
        $this->contractDescription = trim($contractDescription);

        return $this;
    }
}
