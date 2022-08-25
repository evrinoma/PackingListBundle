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
use Evrinoma\PackingListBundle\Dto\PackingListApiDto;
use Evrinoma\PackingListBundle\Dto\PackingListApiDtoInterface;
use Symfony\Component\HttpFoundation\Request;

trait PackingListTrait
{
    /**
     * @var PackingListApiDtoInterface|null
     */
    protected ?PackingListApiDtoInterface $packingListApiDto= null;

    /**
     * @return \Generator
     */
    public function genRequestPackingListApiDto(?Request $request): ?\Generator
    {
        if ($request) {
            $type = $request->get(PackingListInterface::PACKING_LIST);
            if ($type) {
                $newRequest                    = $this->getCloneRequest();
                $type[DtoInterface::DTO_CLASS] = PackingListApiDto::class;
                $newRequest->request->add($type);

                yield $newRequest;
            }
        }
    }

    public function hasPackingListApiDto(): bool
    {
        return null !== $this->packingListApiDto;
    }

    public function getPackingListApiDto(): PackingListApiDtoInterface
    {
        return $this->packingListApiDto;
    }

}
