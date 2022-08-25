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

trait CurrentDeptTrait
{
    private string $currentDept = '';

    /**
     * @return bool
     */
    public function hasCurrentDept(): bool
    {
        return '' !== $this->currentDept;
    }

    /**
     * @return string
     */
    public function getCurrentDept(): string
    {
        return $this->currentDept;
    }
}
