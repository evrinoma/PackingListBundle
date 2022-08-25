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
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Immutable\DateTTNTrait as DateTTNImmutableTrait;

trait DateTTNTrait
{
    use DateTTNImmutableTrait;

    /**
     * @param string $dateTTN
     *
     * @return DtoInterface
     */
    protected function setDateTTN(string $dateTTN): DtoInterface
    {
        $this->dateTTN = trim($dateTTN);

        return $this;
    }
}
