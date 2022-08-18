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

namespace Evrinoma\PackingListBundle\DtoCommon\ValueObject\Preserve;

use Evrinoma\DtoBundle\Dto\DtoInterface;

trait ContractDescriptionTrait
{
    /**
     * @param string $contractDescription
     *
     * @return DtoInterface
     */
    public function setContractDescription(string $contractDescription): DtoInterface
    {
        return parent::setContractDescription($contractDescription);
    }
}
