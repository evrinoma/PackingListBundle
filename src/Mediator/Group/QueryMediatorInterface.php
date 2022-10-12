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

namespace Evrinoma\PackingListBundle\Mediator\Group;

use Evrinoma\PackingListBundle\Dto\GroupApiDtoInterface;
use Evrinoma\UtilsBundle\QueryBuilder\QueryBuilderInterface;

interface QueryMediatorInterface
{
    /**
     * @return string
     */
    public function alias(): string;

    /**
     * @param GroupApiDtoInterface $dto
     * @param QueryBuilderInterface $builder
     *
     * @return mixed
     */
    public function createQuery(GroupApiDtoInterface $dto, QueryBuilderInterface $builder): void;

    /**
     * @param GroupApiDtoInterface $dto
     * @param QueryBuilderInterface $builder
     *
     * @return array
     */
    public function getResult(GroupApiDtoInterface $dto, QueryBuilderInterface $builder): array;
}
