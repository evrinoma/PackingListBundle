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

namespace Evrinoma\PackingListBundle\Dto;

use Evrinoma\DtoBundle\Annotation\Dto;
use Evrinoma\DtoBundle\Dto\AbstractDto;
use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\DtoCommon\ValueObject\Mutable\IdTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\GroupTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\PackingListTrait;
use Symfony\Component\HttpFoundation\Request;

class PackingListGroupApiDto extends AbstractDto implements PackingListGroupApiDtoInterface
{
    use GroupTrait;
    use IdTrait;
    use PackingListTrait;

    /**
     * @Dto(class="Evrinoma\PackingListBundle\Dto\PackingListApiDto", generator="genRequestPackingListApiDto")
     *
     * @var PackingListApiDtoInterface|null
     */
    protected ?PackingListApiDtoInterface $packingListApiDto = null;

    /**
     * @Dto(class="Evrinoma\PackingListBundle\Dto\GroupApiDto", generator="genRequestGroupApiDto")
     *
     * @var GroupApiDtoInterface|null
     */
    protected ?GroupApiDtoInterface $groupApiDto = null;

    public function toDto(Request $request): DtoInterface
    {
        $class = $request->get(DtoInterface::DTO_CLASS);

        if ($class === $this->getClass()) {
            $id = $request->get(PackingListApiDtoInterface::ID);

            if ($id) {
                $this->setId($id);
            }
        }

        return $this;
    }
}
