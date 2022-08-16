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

namespace Evrinoma\PackingListBundle\PreValidator\Depart;

use Evrinoma\PackingListBundle\Dto\DepartApiDtoInterface;
use Evrinoma\PackingListBundle\Exception\Depart\DepartInvalidException;

interface DtoPreValidatorInterface
{
    /**
     * @param DepartApiDtoInterface $dto
     *
     * @throws DepartInvalidException
     */
    public function onPost(DepartApiDtoInterface $dto): void;

    /**
     * @param DepartApiDtoInterface $dto
     *
     * @throws DepartInvalidException
     */
    public function onPut(DepartApiDtoInterface $dto): void;

    /**
     * @param DepartApiDtoInterface $dto
     *
     * @throws DepartInvalidException
     */
    public function onDelete(DepartApiDtoInterface $dto): void;
}
