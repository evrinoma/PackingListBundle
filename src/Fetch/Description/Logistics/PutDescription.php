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

namespace Evrinoma\PackingListBundle\Fetch\Description\Logistics;

use Evrinoma\FetchBundle\Description\Api\AbstractApiDescription;
use Evrinoma\PackingListBundle\Dto\LogisticsApiDtoInterface;
use Evrinoma\PackingListBundle\Fetch\Handler\BaseHandler;
use Symfony\Component\HttpFoundation\Request;

class PutDescription extends AbstractApiDescription
{
    public const NAME = 'api_packing_logistics_save';
    protected string $method = Request::METHOD_PUT;

    protected function getOptions($entity): array
    {
        /* @var LogisticsApiDtoInterface $entity */
        return [
            'id' => $entity->getPackingListId(),
            'idDepart' => $entity->getIdDepart(),
            ];
    }

    /**
     * @return string
     */
    public function tag(): string
    {
        return BaseHandler::class;
    }

    public function name(): string
    {
        return static::NAME;
    }
}
