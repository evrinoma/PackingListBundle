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

use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\PackingListBundle\Dto\ListItemApiDto;
use Evrinoma\PackingListBundle\Dto\ListItemApiDtoInterface;
use Symfony\Component\HttpFoundation\Request;

trait ItemsApiDtoTrait
{
    /**
     * @var ListItemApiDtoInterface[]
     */
    protected array $itemsApiDto = [];

    /**
     * @return \Generator
     */
    public function genRequestItemsApiDto(?Request $request): ?\Generator
    {
        if ($request) {
            $child = $request->get(ItemsApiDtoInterface::ITEMS);
            if ($child) {
                foreach ($child as $menu) {
                    $newRequest = $this->getCloneRequest();
                    $menu[DtoInterface::DTO_CLASS] = ListItemApiDto::class;
                    $newRequest->request->add($menu);

                    yield $newRequest;
                }
            }
        }
    }

    /**
     * @return ListItemApiDtoInterface[]
     */
    public function getItemsApiDto(): array
    {
        return $this->itemsApiDto;
    }

    /**
     * @return bool
     */
    public function hasItemsApiDto(): bool
    {
        return 0 !== \count($this->itemsApiDto);
    }
}
