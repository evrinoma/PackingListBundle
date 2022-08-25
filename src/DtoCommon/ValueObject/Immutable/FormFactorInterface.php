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

interface FormFactorInterface
{
    public const FORM_FACTOR = 'form_factor';

    /**
     * @return bool
     */
    public function hasFormFactor(): bool;

    /**
     * @return string
     */
    public function getFormFactor(): string;
}
