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

namespace Evrinoma\PackingListBundle\Tests\Functional\Helper;

use Evrinoma\PackingListBundle\Dto\PackingListApiDtoInterface;
use Evrinoma\PackingListBundle\Tests\Functional\ValueObject\LogisticsGroup\Id;
use Evrinoma\TestUtilsBundle\Repository\Api\ApiRepositoryHelperTestInterface;
use Evrinoma\TestUtilsBundle\Repository\Api\ApiRepositoryTestInterface;
use Evrinoma\UtilsBundle\Model\Rest\ErrorModel;
use Evrinoma\UtilsBundle\Model\Rest\PayloadModel;
use PHPUnit\Framework\Assert;
use Symfony\Component\HttpFoundation\Response;

trait BasePackingListTestTrait
{
    protected function contentActionGet(): void
    {
        $id = Id::value();
        $this->content = <<< EOF
{
  "label": "18/07-1",
  "contract": "Договор № 166/21",
  "contractDescription": "Договор на СМР",
  "projectName": "XXXXXX ТЭЦ",
  "contractorName": "БыстроДом",
  "subContracts": "Дополнительное соглашение №4 от 13.04.2022, Счет №ЦБ-789 от 11.08.2022",
  "weight": "",
  "formFactor": "",
  "dimensions": "",
  "currentDept": "Пункт №4(строй площадка)",
  "dateTTN": "2022-07-18",
  "comment": "",
  "consignee": "",
  "linkFile": "",
  "id": {$id}
}
EOF;
    }

    protected function exceptionActionGetNotFound(): void
    {
        $this->exception = new \RuntimeException('HTTP/1.1 404 Not Found returned for "'.ApiRepositoryTestInterface::HOST.static::API_GET.'?id='.Id::wrong().'"');
    }

    protected function contentActionCriteria(): \Generator
    {
        $query = static::getDefault();
        unset($query[PackingListApiDtoInterface::ID]);

        $content[] = [
            ApiRepositoryHelperTestInterface::QUERY => $query,
            ApiRepositoryHelperTestInterface::CONTENT => <<< EOF
[{
  "label": "18/07-1",
  "contract": "Договор № 166/21",
  "contractDescription": "Договор на СМР 1",
  "projectName": "XXXXXX ТЭЦ",
  "contractorName": "БыстроДом",
  "subContracts": "Дополнительное соглашение №2 от 13.04.2022, Счет №ЦБ-789 от 11.08.2022",
  "weight": "",
  "formFactor": "",
  "dimensions": "",
  "currentDept": "Пункт №4(строй площадка)",
  "dateTTN": "2022-07-18",
  "comment": "",
  "consignee": "",
  "linkFile": "",
  "id": 1000
},
{
  "label": "18/07-1",
  "contract": "Договор № 166/21",
  "contractDescription": "Договор на СМР 2",
  "projectName": "XXXXXX ТЭЦ",
  "contractorName": "БыстроДом",
  "subContracts": "Дополнительное соглашение №3 от 13.04.2022, Счет №ЦБ-789 от 11.08.2022",
  "weight": "",
  "formFactor": "",
  "dimensions": "",
  "currentDept": "Пункт №4(строй площадка)",
  "dateTTN": "2022-07-18",
  "comment": "",
  "consignee": "",
  "linkFile": "",
  "id": 1001
},
{
  "label": "18/07-1",
  "contract": "Договор № 166/21",
  "contractDescription": "Договор на СМР 3",
  "projectName": "XXXXXX ТЭЦ",
  "contractorName": "БыстроДом",
  "subContracts": "Дополнительное соглашение №4 от 13.04.2022, Счет №ЦБ-789 от 11.08.2022",
  "weight": "",
  "formFactor": "",
  "dimensions": "",
  "currentDept": "Пункт №4(строй площадка)",
  "dateTTN": "2022-07-18",
  "comment": "",
  "consignee": "",
  "linkFile": "",
  "id": 1002
}]
EOF,
            ApiRepositoryHelperTestInterface::CALL => function ($args) {
                Assert::assertCount(3, $args[PayloadModel::PAYLOAD]);
                foreach ($args[PayloadModel::PAYLOAD] as $item) {
                    $this->checkPackingList($item);
                }
            },
        ];

        foreach ($content as $value) {
            $this->content = $value[ApiRepositoryHelperTestInterface::CONTENT];
            yield [ApiRepositoryHelperTestInterface::QUERY => $value[ApiRepositoryHelperTestInterface::QUERY], ApiRepositoryHelperTestInterface::CALL => $value[ApiRepositoryHelperTestInterface::CALL]];
        }
    }

    protected function contentActionCriteriaNotFound(): \Generator
    {
        $query = static::getDefault([PackingListApiDtoInterface::ID => Id::wrong()]);

        $content[] = [
            ApiRepositoryHelperTestInterface::QUERY => $query,
            ApiRepositoryHelperTestInterface::EXCEPTION => new \RuntimeException('HTTP/1.1 404 Not Found returned for "'.ApiRepositoryTestInterface::HOST.static::API_GET.'?id='.Id::wrong().'"'),
            ApiRepositoryHelperTestInterface::CALL => function ($args) {
                $this->hasError($args);
            },
        ];

        foreach ($content as $value) {
            $this->exception = $value[ApiRepositoryHelperTestInterface::EXCEPTION];
            yield [
                ApiRepositoryHelperTestInterface::QUERY => $value[ApiRepositoryHelperTestInterface::QUERY],
                ApiRepositoryHelperTestInterface::CALL => $value[ApiRepositoryHelperTestInterface::CALL],
            ];
        }
    }

    protected function assertGet(string $id, int $status = Response::HTTP_OK): array
    {
        $find = $this->get($id);

        switch ($status) {
            case Response::HTTP_OK:
                $this->testResponseStatusOK();
                $this->checkResult($find);
                break;
            case Response::HTTP_BAD_REQUEST:
                $this->testResponseStatusBadRequest();
                $this->hasError($find);
                break;
            case Response::HTTP_NOT_FOUND:
                $this->testResponseStatusNotFound();
                $this->hasError($find);
                break;
        }

        return $find;
    }

    protected function hasError($value)
    {
        Assert::assertArrayHasKey(PayloadModel::PAYLOAD, $value);
        Assert::assertCount(0, $value[PayloadModel::PAYLOAD]);
        Assert::assertCount(1, $value[ErrorModel::ERROR]);
    }

    protected function createPackingList(): array
    {
        $query = static::getDefault();

        return $this->post($query);
    }

    protected function checkResult($entity): void
    {
        Assert::assertArrayHasKey(PayloadModel::PAYLOAD, $entity);
        Assert::assertCount(1, $entity[PayloadModel::PAYLOAD]);
        $this->checkPackingList($entity[PayloadModel::PAYLOAD][0]);
    }

    protected function checkPackingList($entity): void
    {
        Assert::assertArrayHasKey(PackingListApiDtoInterface::ID, $entity);
        Assert::assertArrayHasKey(PackingListApiDtoInterface::SUB_CONTRACTS, $entity);
        Assert::assertArrayHasKey(PackingListApiDtoInterface::COMMENT, $entity);
        Assert::assertArrayHasKey(PackingListApiDtoInterface::CONSIGNEE, $entity);
        Assert::assertArrayHasKey(PackingListApiDtoInterface::CONTRACT, $entity);
        Assert::assertArrayHasKey(PackingListApiDtoInterface::CONTRACT_DESCRIPTION, $entity);
        Assert::assertArrayHasKey(PackingListApiDtoInterface::CONTRACTOR_NAME, $entity);
        Assert::assertArrayHasKey(PackingListApiDtoInterface::CURRENT_DEPT, $entity);
        Assert::assertArrayHasKey(PackingListApiDtoInterface::DATE_TTN, $entity);
        Assert::assertArrayHasKey(PackingListApiDtoInterface::DIMENSIONS, $entity);
        Assert::assertArrayHasKey(PackingListApiDtoInterface::FORM_FACTOR, $entity);
        Assert::assertArrayHasKey(PackingListApiDtoInterface::LABEL, $entity);
        Assert::assertArrayHasKey(PackingListApiDtoInterface::LINK_FILE, $entity);
        Assert::assertArrayHasKey(PackingListApiDtoInterface::PROJECT_NAME, $entity);
        Assert::assertArrayHasKey(PackingListApiDtoInterface::WEIGHT, $entity);
    }
}
