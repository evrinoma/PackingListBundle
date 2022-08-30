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
use Evrinoma\PackingListBundle\Fetch\Handler\BasePostHandler;
use Evrinoma\PackingListBundle\Model\Logistics\LogisticsInterface;
use Symfony\Component\HttpFoundation\Request;

class PostDescription extends AbstractApiDescription
{
    public const NAME = 'api_packing_list_logistics_create';
    protected string $method = Request::METHOD_POST;

    protected function getOptions($entity): array
    {
        /* @var LogisticsInterface $entity */
        return [
            'packingListId' => $entity->getPackingList()->getId(),
            'departId' => $entity->getDepart()->getId(),
            'userId' => $entity->getUser(),
            'email' => $entity->getEmail(),
            'surname' => $entity->getSurname(),
            'name' => $entity->getName(),
            'patronymic' => $entity->getPatronymic(),
        ];
    }

    /**
     * @return string
     */
    public function tag(): string
    {
        return BasePostHandler::class;
    }

    public function name(): string
    {
        return static::NAME;
    }
}
