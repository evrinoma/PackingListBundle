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

use Evrinoma\DtoBundle\Annotation\Dtos;
use Evrinoma\DtoBundle\Dto\AbstractDto;
use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\DtoCommon\ValueObject\Mutable\IdTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\ContractDescriptionTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\ContractorNameTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\ContractTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\ItemsApiDtoTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\LabelTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\ProjectNameTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\SubContractTrait;
use Symfony\Component\HttpFoundation\Request;

class PackingListApiDto extends AbstractDto implements PackingListApiDtoInterface
{
    use ContractDescriptionTrait;
    use ContractorNameTrait;
    use ContractTrait;
    use IdTrait;
    use LabelTrait;
    use ProjectNameTrait;
    use SubContractTrait;
    use ItemsApiDtoTrait;

    /**
     * @Dtos(class="Evrinoma\PackingListBundle\Dto\ListItemApiDto", generator="genRequestItemsApiDto", add="addListItemApiDto")
     *
     * @var ListItemApiDtoInterface[]
     */
    protected array $itemsApiDto = [];

    /**
     * @param DtoInterface $dto
     *
     * @return $this
     */
    public function addListItemApiDto(DtoInterface $dto): DtoInterface
    {
        $this->itemsApiDto[] = $dto;

        return $this;
    }


    public function toDto(Request $request): DtoInterface
    {
        $class = $request->get(DtoInterface::DTO_CLASS);

        if ($class === $this->getClass()) {
            $contractDescription = $request->get(PackingListApiDtoInterface::CONTRACT_DESCRIPTION);
            $contractorName      = $request->get(PackingListApiDtoInterface::CONTRACTOR_NAME);
            $contract            = $request->get(PackingListApiDtoInterface::CONTRACT);
            $id                  = $request->get(PackingListApiDtoInterface::ID);
            $label               = $request->get(PackingListApiDtoInterface::LABEL);
            $projectName         = $request->get(PackingListApiDtoInterface::PROJECT_NAME);
            $subContract         = $request->get(PackingListApiDtoInterface::SUB_CONTRACT);

            if ($contractDescription) {
                $this->setContractDescription($contractDescription);
            }

            if ($contractorName) {
                $this->setContractorName($contractorName);
            }

            if ($contract) {
                $this->setContract($contract);
            }

            if ($id) {
                $this->setId($id);
            }

            if ($label) {
                $this->setLabel($label);
            }

            if ($projectName) {
                $this->setProjectName($projectName);
            }

            if ($subContract) {
                $this->setSubContract($subContract);
            }
        }

        return $this;
    }
}
