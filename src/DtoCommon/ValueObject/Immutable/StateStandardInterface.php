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

interface StateStandardInterface
{
    public const STATE_STANDARD = 'state_standard';

    /**
     * @return bool
     */
    public function hasStateStandard(): bool;

    /**
     * @return string
     */
    public function getStateStandard(): string;
}
