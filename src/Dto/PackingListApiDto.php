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

use Evrinoma\DtoBundle\Dto\AbstractDto;
use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\DtoCommon\ValueObject\Mutable\IdTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\CommentTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\ConsigneeTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\ContractDescriptionTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\ContractorNameTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\ContractTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\CurrentDeptTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\DateTTNTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\DimensionsTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\FormFactorTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\LabelTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\LinkFileTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\ProjectNameTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\SubContractTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\WeightTrait;
use Symfony\Component\HttpFoundation\Request;

class PackingListApiDto extends AbstractDto implements PackingListApiDtoInterface
{
    use CommentTrait;
    use ConsigneeTrait;
    use ContractDescriptionTrait;
    use ContractorNameTrait;
    use ContractTrait;
    use CurrentDeptTrait;
    use DateTTNTrait;
    use DimensionsTrait;
    use FormFactorTrait;
    use IdTrait;
    use LabelTrait;
    use LinkFileTrait;
    use ProjectNameTrait;
    use SubContractTrait;
    use WeightTrait;

    public function toDto(Request $request): DtoInterface
    {
        $class = $request->get(DtoInterface::DTO_CLASS);

        if ($class === $this->getClass()) {
            $contractDescription = $request->get(PackingListApiDtoInterface::CONTRACT_DESCRIPTION);
            $contractorName = $request->get(PackingListApiDtoInterface::CONTRACTOR_NAME);
            $contract = $request->get(PackingListApiDtoInterface::CONTRACT);
            $id = $request->get(PackingListApiDtoInterface::ID);
            $label = $request->get(PackingListApiDtoInterface::LABEL);
            $projectName = $request->get(PackingListApiDtoInterface::PROJECT_NAME);
            $subContract = $request->get(PackingListApiDtoInterface::SUB_CONTRACT);
            $weight = $request->get(PackingListApiDtoInterface::WEIGHT);
            $formFactor = $request->get(PackingListApiDtoInterface::FORM_FACTOR);
            $dimensions = $request->get(PackingListApiDtoInterface::DIMENSIONS);
            $currentDept = $request->get(PackingListApiDtoInterface::CURRENT_DEPT);
            $dateTTN = $request->get(PackingListApiDtoInterface::DATE_TTN);
            $comment = $request->get(PackingListApiDtoInterface::COMMENT);
            $consignee = $request->get(PackingListApiDtoInterface::CONSIGNEE);
            $linkFile = $request->get(PackingListApiDtoInterface::LINK_FILE);

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
            if ($weight) {
                $this->setWeight($weight);
            }

            if ($formFactor) {
                $this->setFormFactor($formFactor);
            }

            if ($dimensions) {
                $this->setDimensions($dimensions);
            }

            if ($currentDept) {
                $this->setCurrentDept($currentDept);
            }

            if ($dateTTN) {
                $this->setDateTTN($dateTTN);
            }

            if ($comment) {
                $this->setComment($comment);
            }

            if ($consignee) {
                $this->setConsignee($consignee);
            }

            if ($linkFile) {
                $this->setLinkFile($linkFile);
            }
        }

        return $this;
    }
}
