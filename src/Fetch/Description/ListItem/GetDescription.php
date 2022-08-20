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

namespace Evrinoma\PackingListBundle\Fetch\Description\ListItem;

use Evrinoma\FetchBundle\Description\Api\AbstractApiDescription;
use Evrinoma\PackingListBundle\Fetch\Handler\BaseHandler;
use Symfony\Component\HttpFoundation\Request;

class GetDescription extends AbstractApiDescription
{
    public const NAME = 'api_packing_list_item';
    protected string $method = Request::METHOD_GET;

    protected function getOptions($entity): array
    {
        return [];
    }

    protected function getUrl($entity): string
    {
        return parent::getUrl($entity).'/'.$entity;
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
