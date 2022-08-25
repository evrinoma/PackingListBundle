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

trait FormFactorTrait
{
    private string $formFactor = '';

    /**
     * @return bool
     */
    public function hasFormFactor(): bool
    {
        return '' !== $this->formFactor;
    }

    /**
     * @return string
     */
    public function getFormFactor(): string
    {
        return $this->formFactor;
    }
}
