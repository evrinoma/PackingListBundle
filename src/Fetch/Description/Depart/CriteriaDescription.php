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

namespace Evrinoma\PackingListBundle\Fetch\Description\Depart;

use Evrinoma\FetchBundle\Description\Api\AbstractApiDescription;
use Evrinoma\PackingListBundle\Dto\DepartApiDtoInterface;
use Evrinoma\PackingListBundle\Fetch\Handler\BaseGetHandler;
use Symfony\Component\HttpFoundation\Request;

class CriteriaDescription extends AbstractApiDescription
{
    public const NAME = 'api_packing_list_depart_criteria';
    protected string $method = Request::METHOD_GET;

    protected function getOptions($entity): array
    {
        /* @var DepartApiDtoInterface $entity */
        return ['packingListId' => $entity->getPackingListId()];
    }

    /**
     * @return string
     */
    public function tag(): string
    {
        return BaseGetHandler::class;
    }

    public function name(): string
    {
        return static::NAME;
    }
}
