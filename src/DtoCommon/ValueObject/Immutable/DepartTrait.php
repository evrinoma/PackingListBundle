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

trait DepartTrait
{
    private string $depart = '';

    /**
     * @return bool
     */
    public function hasDepart(): bool
    {
        return '' !== $this->depart;
    }

    /**
     * @return string
     */
    public function getDepart(): string
    {
        return $this->depart;
    }
}
