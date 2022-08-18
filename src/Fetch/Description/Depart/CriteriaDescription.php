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
use Evrinoma\PackingListBundle\Fetch\Handler\BaseHandler;
use Symfony\Component\HttpFoundation\Request;

class CriteriaDescription extends AbstractApiDescription
{
    public const NAME = 'api_packing_depart_criteria';
    protected string $method = Request::METHOD_GET;
    protected string $route = '/api/packing_list/departs';

    public function __construct(string $apiHost = 'http://cmp.ite-ng.ru')
    {
        parent::__construct($apiHost);
    }

    protected function getOptions($entity): array
    {
        /* @var DepartApiDtoInterface $entity */
        return ['packingListId' => $entity->getId()];
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
