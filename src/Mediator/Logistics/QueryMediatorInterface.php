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

namespace Evrinoma\PackingListBundle\Mediator\Logistics;

use Evrinoma\PackingListBundle\Dto\LogisticsApiDtoInterface;
use Evrinoma\UtilsBundle\QueryBuilder\QueryBuilderInterface;

interface QueryMediatorInterface
{
    /**
     * @return string
     */
    public function alias(): string;

    /**
     * @param LogisticsApiDtoInterface $dto
     * @param QueryBuilderInterface    $builder
     *
     * @return mixed
     */
    public function createQuery(LogisticsApiDtoInterface $dto, QueryBuilderInterface $builder): void;

    /**
     * @param LogisticsApiDtoInterface $dto
     * @param QueryBuilderInterface    $builder
     *
     * @return array
     */
    public function getResult(LogisticsApiDtoInterface $dto, QueryBuilderInterface $builder): array;
}
