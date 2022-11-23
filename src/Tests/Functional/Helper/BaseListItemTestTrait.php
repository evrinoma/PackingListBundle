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

use Evrinoma\PackingListBundle\Dto\ListItemApiDtoInterface;
use Evrinoma\PackingListBundle\Dto\PackingListApiDtoInterface;
use Evrinoma\PackingListBundle\Tests\Functional\ValueObject\ListItem\Id;
use Evrinoma\PackingListBundle\Tests\Functional\ValueObject\PackingList\Id as PackingListId;
use Evrinoma\TestUtilsBundle\Repository\Api\ApiRepositoryHelperTestInterface;
use Evrinoma\TestUtilsBundle\Repository\Api\ApiRepositoryTestInterface;
use Evrinoma\UtilsBundle\Model\Rest\ErrorModel;
use Evrinoma\UtilsBundle\Model\Rest\PayloadModel;
use PHPUnit\Framework\Assert;
use Symfony\Component\HttpFoundation\Response;

trait BaseListItemTestTrait
{
    protected function contentActionGet(): void
    {
        $id = Id::value();
        $this->content = <<< EOF
{
  "state_standard": "gost",
  "quantity": 0.7,
  "measure": "шт.",
  "comment": "bla bla",
  "subContract": "Счет на оплату № ОО-10922 от 25.04.2022",
  "number": "66/21-0-S0-000-000-VN-S",
  "stamp": "MR060W1-009-01",
  "packingList": {
    "label": "1",
    "contract": "Счет на оплату № ОО-10922",
    "contractDescription": "поставка замка и ленты",
    "projectName": "XXXXXX ТЭЦ",
    "contractorName": "Мега-Фикс Трейд  ООО",
    "subContracts": "Счет на оплату № ОО-10922 от 25.04.2022",
    "weight": "",
    "formFactor": "",
    "dimensions": "",
    "currentDept": "Пункт №4(строй площадка)",
    "dateTtn": "2022-07-29",
    "comment": "",
    "consignee": "",
    "linkFile": "file://test.pdf",
    "id": 1021
  },
  "id": {$id},
  "name": "Лента хомутная MGF G9*0,6 мм 30 м W2"
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
        unset($query[ListItemApiDtoInterface::ID]);
        unset($query[ListItemApiDtoInterface::PACKING_LIST]);

        $content[] = [
            ApiRepositoryHelperTestInterface::QUERY => $query,
            ApiRepositoryHelperTestInterface::CONTENT => <<< EOF
[{
  "state_standard": "ГОСТ 34028",
  "quantity": 4.8,
  "measure": "т",
  "comment": "",
  "subContract": "Спецификация №1-АГ-Ч от 19.01.2022",
  "number": "66/21-1-S1-000-000-KG-S",
  "stamp": "16 А500С",
  "packingList": {
    "label": "Бирка 9/1/5",
    "contract": "Договор №1/54/1062/11419",
    "contractDescription": "поставка арматуры",
    "projectName": "XXXXXX ТЭЦ",
    "contractorName": "А Групп, ООО",
    "subContracts": "Спецификация №1-АГ-Ч от 19.01.2022",
    "weight": "4,8",
    "formFactor": "пачка",
    "dimensions": "",
    "currentDept": "Пункт №4(строй площадка)",
    "dateTtn": "2022-02-07",
    "comment": "",
    "consignee": "",
    "linkFile": "",
    "id": 17
  },
  "id": 1467,
  "name": "Арматура ф 16 А500С ГОСТ 34028 дл.11,7"
},
{
  "state_standard": "ГОСТ 34028",
  "quantity": 4.355,
  "measure": "т",
  "comment": "",
  "subContract": "Спецификация №1-АГ-Ч от 19.01.2022",
  "number": "66/21-1-S1-000-000-KG-S",
  "stamp": "16 А500С",
  "packingList": {
    "label": "Бирка 9/2/5",
    "contract": "Договор №1/54/1062/11419",
    "contractDescription": "поставка арматуры",
    "projectName": "XXXXXX ТЭЦ",
    "contractorName": "А Групп, ООО",
    "subContracts": "Спецификация №1-АГ-Ч от 19.01.2022,Спецификация №2-АГ-Ч от 19.01.2022",
    "weight": "4,355",
    "formFactor": "пачка",
    "dimensions": "",
    "currentDept": "Пункт №4(строй площадка)",
    "dateTtn": "2022-02-07",
    "comment": "",
    "consignee": "",
    "linkFile": "",
    "id": 18
  },
  "id": 1468,
  "name": "Арматура ф 16 А500С ГОСТ 34028 дл.11,7"
},
{
  "state_standard": "ГОСТ 34028",
  "quantity": 3.816,
  "measure": "т",
  "comment": "",
  "subContract": "Спецификация №2-АГ-Ч от 19.01.2022",
  "number": "66/21-1-S1-M01-MB_-KG-2.1",
  "stamp": "28-А500С",
  "packingList": {
    "label": "Бирка 1/2/6",
    "contract": "Договор №1/54/1062/11419",
    "contractDescription": "поставка арматуры",
    "projectName": "XXXXXX ТЭЦ",
    "contractorName": "А Групп, ООО",
    "subContracts": "Спецификация №1-АГ-Ч от 19.01.2022,Спецификация №2-АГ-Ч от 19.01.2022",
    "weight": "3,816",
    "formFactor": "пачка",
    "dimensions": "",
    "currentDept": "Пункт №4(строй площадка)",
    "dateTtn": "2022-02-03",
    "comment": "",
    "consignee": "",
    "linkFile": "",
    "id": 19
  },
  "id": 683,
  "name": "Арматура ф 28 А500С ГОСТ 34028 дл.11,7"
},
{
  "state_standard": "ГОСТ 34028",
  "quantity": 3.873,
  "measure": "т",
  "comment": "",
  "subContract": "Спецификация №2-АГ-Ч от 19.01.2022",
  "number": "66/21-1-S1-M01-MB_-KG-2.1",
  "stamp": "28-А500С",
  "packingList": {
    "label": "Бирка 1/1/6",
    "contract": "Договор №1/54/1062/11419",
    "contractDescription": "поставка арматуры",
    "projectName": "XXXXXX ТЭЦ",
    "contractorName": "А Групп, ООО",
    "subContracts": "Спецификация №1-АГ-Ч от 19.01.2022,Спецификация №2-АГ-Ч от 19.01.2022",
    "weight": "3,873",
    "formFactor": "пачка",
    "dimensions": "",
    "currentDept": "Пункт №4(строй площадка)",
    "dateTtn": "2022-02-03",
    "comment": "",
    "consignee": "",
    "linkFile": "",
    "id": 20
  },
  "id": 682,
  "name": "Арматура ф 28 А500С ГОСТ 34028 дл.11,7"
}]
EOF,
            ApiRepositoryHelperTestInterface::CALL => function ($args) {
                Assert::assertCount(4, $args[PayloadModel::PAYLOAD]);
                foreach ($args[PayloadModel::PAYLOAD] as $item) {
                    $this->checkListItem($item);
                }
            },
        ];

        $query = static::getDefault();
        unset($query[ListItemApiDtoInterface::ID]);
        $packingListId = PackingListId::value();

        $content[] = [
            ApiRepositoryHelperTestInterface::QUERY => $query,
            ApiRepositoryHelperTestInterface::CONTENT => <<< EOF
[{
  "state_standard": "gost",
  "quantity": 0.7,
  "measure": "шт.",
  "comment": "bla bla",
  "subContract": "Счет на оплату № ОО-10922 от 25.04.2022",
  "number": "66/21-0-S0-000-000-VN-S",
  "stamp": "MR060W1-009-01",
  "packingList": {
    "label": "1",
    "contract": "Счет на оплату № ОО-10922",
    "contractDescription": "поставка замка и ленты",
    "projectName": "XXXXXX ТЭЦ",
    "contractorName": "Мега-Фикс Трейд  ООО",
    "subContracts": "Счет на оплату № ОО-10922 от 25.04.2022",
    "weight": "",
    "formFactor": "",
    "dimensions": "",
    "currentDept": "Пункт №4(строй площадка)",
    "dateTtn": "2022-07-29",
    "comment": "",
    "consignee": "",
    "linkFile": "file://test.pdf",
    "id": {$packingListId}
  },
  "id": 682,
  "name": "Лента хомутная MGF G9*0,6 мм 30 м W2"
}]
EOF,
            ApiRepositoryHelperTestInterface::CALL => function ($args) {
                Assert::assertCount(1, $args[PayloadModel::PAYLOAD]);
                foreach ($args[PayloadModel::PAYLOAD] as $item) {
                    $this->checkListItem($item);
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
        $query = static::getDefault([ListItemApiDtoInterface::PACKING_LIST => [PackingListApiDtoInterface::ID => PackingListId::wrong()]]);

        $content[] = [
            ApiRepositoryHelperTestInterface::QUERY => $query,
            ApiRepositoryHelperTestInterface::EXCEPTION => new \RuntimeException('HTTP/1.1 404 Not Found returned for "'.ApiRepositoryTestInterface::HOST.static::API_GET.'?packingListId='.PackingListId::wrong().'"'),
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

    protected function createListItem(): array
    {
        $query = static::getDefault();

        return $this->post($query);
    }

    protected function checkResult($entity): void
    {
        Assert::assertArrayHasKey(PayloadModel::PAYLOAD, $entity);
        Assert::assertCount(1, $entity[PayloadModel::PAYLOAD]);
        $this->checkListItem($entity[PayloadModel::PAYLOAD][0]);
    }

    protected function checkListItem($entity): void
    {
        Assert::assertArrayHasKey(ListItemApiDtoInterface::ID, $entity);
        Assert::assertArrayHasKey(ListItemApiDtoInterface::PACKING_LIST, $entity);
        Assert::assertArrayHasKey(ListItemApiDtoInterface::NAME, $entity);
        Assert::assertArrayHasKey(ListItemApiDtoInterface::COMMENT, $entity);
        Assert::assertArrayHasKey(ListItemApiDtoInterface::MEASURE, $entity);
        Assert::assertArrayHasKey(ListItemApiDtoInterface::QUANTITY, $entity);
        Assert::assertArrayHasKey(ListItemApiDtoInterface::STAMP, $entity);
        Assert::assertArrayHasKey(ListItemApiDtoInterface::SUB_CONTRACT, $entity);
        Assert::assertArrayHasKey(ListItemApiDtoInterface::NUMBER, $entity);
    }
}
