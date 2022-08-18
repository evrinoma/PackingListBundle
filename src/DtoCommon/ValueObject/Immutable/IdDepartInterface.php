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

interface IdDepartInterface
{
    public const ID_DEPART = 'id_depart';

    /**
     * @return bool
     */
    public function hasIdDepart(): bool;

    /**
     * @return string
     */
    public function getIdDepart(): string;
}
