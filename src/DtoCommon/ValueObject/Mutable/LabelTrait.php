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
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Immutable\LabelTrait as LabelImmutableTrait;

trait LabelTrait
{
    use LabelImmutableTrait;

    /**
     * @param string $label
     *
     * @return DtoInterface
     */
    protected function setLabel(string $label): DtoInterface
    {
        $this->label = trim($label);

        return $this;
    }
}
