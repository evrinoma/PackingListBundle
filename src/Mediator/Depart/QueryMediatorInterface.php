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

namespace Evrinoma\PackingListBundle\Mediator\Depart;

use Evrinoma\PackingListBundle\Dto\DepartApiDtoInterface;
use Evrinoma\UtilsBundle\QueryBuilder\QueryBuilderInterface;

interface QueryMediatorInterface
{
    /**
     * @return string
     */
    public function alias(): string;

    /**
     * @param DepartApiDtoInterface $dto
     * @param QueryBuilderInterface $builder
     *
     * @return mixed
     */
    public function createQuery(DepartApiDtoInterface $dto, QueryBuilderInterface $builder): void;

    /**
     * @param DepartApiDtoInterface $dto
     * @param QueryBuilderInterface $builder
     *
     * @return array
     */
    public function getResult(DepartApiDtoInterface $dto, QueryBuilderInterface $builder): array;
}
