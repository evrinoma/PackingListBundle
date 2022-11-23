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
use Evrinoma\PackingListBundle\Dto\PackingListGroupApiDtoInterface;
use Evrinoma\PackingListBundle\Tests\Functional\ValueObject\PackingList\Id as PackingListId;
use Evrinoma\PackingListBundle\Tests\Functional\ValueObject\PackingListGroup\Id;
use Evrinoma\TestUtilsBundle\Repository\Api\ApiRepositoryHelperTestInterface;
use Evrinoma\TestUtilsBundle\Repository\Api\ApiRepositoryTestInterface;
use Evrinoma\UtilsBundle\Model\Rest\ErrorModel;
use Evrinoma\UtilsBundle\Model\Rest\PayloadModel;
use PHPUnit\Framework\Assert;
use Symfony\Component\HttpFoundation\Response;

trait BasePackingListGroupTestTrait
{
    protected function contentActionGet(): void
    {
        $id = Id::value();
        $this->content = <<< EOF
[
  {
    "packingListGroup": {
      "info": "Контейнер KRPU 0196703",
      "id": {$id}
    },
    "packingList": {
      "label": "УЛ1",
      "contract": " Договор №08/22",
      "contractDescription": "",
      "projectName": "XXXXXX ТЭЦ",
      "contractorName": "Про-Брайт ООО",
      "subContracts": "Счет №ЦБ-788 от 11.08.2022, Счет №ЦБ-789 от 11.08.2022",
      "weight": "",
      "formFactor": "ящики 3 шт",
      "dimensions": "",
      "currentDept": "Пункт №4(строй площадка)",
      "dateTTN": "2022-08-19",
      "comment": "",
      "consignee": "",
      "linkFile": "",
      "id": 1376
    },
    "packingListItems": [
      {
        "stateStandard": "",
        "quantity": 16,
        "measure": "шт.",
        "comment": "",
        "subContract": "Счет №ЦБ-788 от 11.08.2022",
        "number": "ИТЭ-МТО 66/21-0-S0-000-000-AR-RD",
        "stamp": "",
        "packingList": {
          "label": "УЛ1",
          "contract": " Договор №08/22",
          "contractDescription": "",
          "projectName": "XXXXXX ТЭЦ",
          "contractorName": "Про-Брайт ООО",
          "subContracts": "Счет №ЦБ-788 от 11.08.2022, Счет №ЦБ-789 от 11.08.2022",
          "weight": "",
          "formFactor": "ящики 3 шт",
          "dimensions": "",
          "currentDept": "Пункт №4(строй площадка)",
          "dateTTN": "2022-08-19",
          "comment": "",
          "consignee": "",
          "linkFile": "",
          "id": 1376
        },
        "id": 4483,
        "name": "Rem-300 F пенный обезжиривающий концентрат 5л."
      },
      {
        "stateStandard": "",
        "quantity": 10,
        "measure": "шт.",
        "comment": "",
        "subContract": "Счет №ЦБ-788 от 11.08.2022",
        "number": "ИТЭ-МТО 66/21-0-S0-000-000-AR-RD",
        "stamp": "",
        "packingList": {
          "label": "УЛ1",
          "contract": " Договор №08/22",
          "contractDescription": "",
          "projectName": "XXXXXX ТЭЦ",
          "contractorName": "Про-Брайт ООО",
          "subContracts": "Счет №ЦБ-788 от 11.08.2022, Счет №ЦБ-789 от 11.08.2022",
          "weight": "",
          "formFactor": "ящики 3 шт",
          "dimensions": "",
          "currentDept": "Пункт №4(строй площадка)",
          "dateTTN": "2022-08-19",
          "comment": "",
          "consignee": "",
          "linkFile": "",
          "id": 1376
        },
        "id": 4513,
        "name": "Перчатки латексные \"DERMAGRIP HIGH RISK POWDER FREE\"М\""
      }
    ],
    "id": 7
  },
  {
    "packingListGroup": {
      "info": "Контейнер KRPU 0196703",
      "id": {$id}
    },
    "packingList": {
      "label": "СПС-3/3",
      "contract": "Счет-договор № 14",
      "contractDescription": "поставка покрытий",
      "projectName": "XXXXXX ТЭЦ",
      "contractorName": "СПС ООО",
      "subContracts": "Счет-договор № 14 от 07.06.2022, Счет №ЦБ-789 от 11.08.2022",
      "weight": "",
      "formFactor": "Европаллет в стрейч пленке",
      "dimensions": "",
      "currentDept": "Пункт №4(строй площадка)",
      "comment": "",
      "consignee": "",
      "linkFile": "",
      "id": 1567
    },
    "packingListItems": [
      {
        "stateStandard": "",
        "quantity": 13,
        "measure": "шт.",
        "comment": "",
        "subContract": "Счет-договор № 14 от 07.06.2022",
        "number": "66/21-1-S1-M01-MB_-KG-2.1",
        "stamp": "Sikaflor-151 RU/267 RU/2671 ECD ",
        "packingList": {
          "label": "СПС-3/3",
          "contract": "Счет-договор № 14",
          "contractDescription": "поставка покрытий",
          "projectName": "XXXXXX ТЭЦ",
          "contractorName": "СПС ООО",
          "subContracts": "Счет-договор № 14 от 07.06.2022, Счет №ЦБ-789 от 11.08.2022",
          "weight": "",
          "formFactor": "Европаллет в стрейч пленке",
          "dimensions": "",
          "currentDept": "Пункт №4(строй площадка)",
          "comment": "",
          "consignee": "",
          "linkFile": "",
          "id": 1567
        },
        "id": 5039,
        "name": "Двухкомпонентная эпоксидная грунтовкаSikafloor-151 RU/267 RU/2627 ESD (B)Ведро 4,5 кг"
      },
      {
        "stateStandard": "",
        "quantity": 13,
        "measure": "шт.",
        "comment": "",
        "subContract": "Счет-договор № 14 от 07.06.2022",
        "number": "66/21-1-S1-M02-MB_-KG-2.1",
        "stamp": "Sikaflor-151 RU/267 RU/2627 ECD",
        "packingList": {
          "label": "СПС-3/3",
          "contract": "Счет-договор № 14",
          "contractDescription": "поставка покрытий",
          "projectName": "XXXXXX ТЭЦ",
          "contractorName": "СПС ООО",
          "subContracts": "Счет-договор № 14 от 07.06.2022, Счет №ЦБ-789 от 11.08.2022",
          "weight": "",
          "formFactor": "Европаллет в стрейч пленке",
          "dimensions": "",
          "currentDept": "Пункт №4(строй площадка)",
          "comment": "",
          "consignee": "",
          "linkFile": "",
          "id": 1567
        },
        "id": 5038,
        "name": "Двухкомпонентная эпоксидная грунтовкаSikafloor-151 RU/267 RU/2627 ESD (B)Ведро 4,5 кг"
      }
    ],
    "id": 13
  }
]
EOF;
    }

    protected function exceptionActionGetNotFound(): void
    {
        $this->exception = new \RuntimeException('HTTP/1.1 404 Not Found returned for "'.ApiRepositoryTestInterface::HOST.static::API_GET.'?id='.Id::wrong().'"');
    }

    protected function contentActionCriteria(): \Generator
    {
        $query = static::getDefault();
        $packingListId = PackingListId::value();

        $content[] = [
            ApiRepositoryHelperTestInterface::QUERY => $query,
            ApiRepositoryHelperTestInterface::CONTENT => <<< EOF
[{
   "packingListGroup": {
    "info": "Контейнер KRPU 0196703",
    "id": 4
  },
  "packingList": {
    "label": "СПС-3/3",
    "contract": "Счет-договор № 14",
    "contractDescription": "поставка покрытий",
    "projectName": "XXXXXX ТЭЦ",
    "contractorName": "СПС ООО",
    "subContracts": "Счет-договор № 14 от 07.06.2022, Счет №ЦБ-789 от 11.08.2022",
    "weight": "",
    "formFactor": "Европаллет в стрейч пленке",
    "dimensions": "",
    "currentDept": "Пункт №4(строй площадка)",
    "comment": "",
    "consignee": "",
    "linkFile": "",
    "id": {$packingListId}
  },
  "packingListItems": [
    {
      "stateStandard": "",
      "quantity": 13,
      "measure": "шт.",
      "comment": "",
      "subContract": "Счет-договор № 14 от 07.06.2022",
      "number": "66/21-1-S1-M01-MB_-KG-2.1",
      "stamp": "Sikaflor-151 RU/267 RU/2671 ECD ",
      "packingList": {
        "label": "СПС-3/3",
        "contract": "Счет-договор № 14",
        "contractDescription": "поставка покрытий",
        "projectName": "XXXXXX ТЭЦ",
        "contractorName": "СПС ООО",
        "subContracts": "Счет-договор № 14 от 07.06.2022, Счет №ЦБ-789 от 11.08.2022",
        "weight": "",
        "formFactor": "Европаллет в стрейч пленке",
        "dimensions": "",
        "currentDept": "Пункт №4(строй площадка)",
        "comment": "",
        "consignee": "",
        "linkFile": "",
        "id": {$packingListId}
      },
      "id": 5039,
      "name": "Двухкомпонентная эпоксидная грунтовкаSikafloor-151 RU/267 RU/2627 ESD (B)Ведро 4,5 кг"
    },
    {
      "stateStandard": "",
      "quantity": 13,
      "measure": "шт.",
      "comment": "",
      "subContract": "Счет-договор № 14 от 07.06.2022",
      "number": "66/21-1-S1-M02-MB_-KG-2.1",
      "stamp": "Sikaflor-151 RU/267 RU/2627 ECD",
      "packingList": {
        "label": "СПС-3/3",
        "contract": "Счет-договор № 14",
        "contractDescription": "поставка покрытий",
        "projectName": "XXXXXX ТЭЦ",
        "contractorName": "СПС ООО",
        "subContracts": "Счет-договор № 14 от 07.06.2022, Счет №ЦБ-789 от 11.08.2022",
        "weight": "",
        "formFactor": "Европаллет в стрейч пленке",
        "dimensions": "",
        "currentDept": "Пункт №4(строй площадка)",
        "comment": "",
        "consignee": "",
        "linkFile": "",
        "id": {$packingListId}
      },
      "id": 5038,
      "name": "Двухкомпонентная эпоксидная грунтовкаSikafloor-151 RU/267 RU/2627 ESD (B)Ведро 4,5 кг"
    }
  ],
  "id": 11
}]
EOF,
            ApiRepositoryHelperTestInterface::CALL => function ($args) {
                Assert::assertCount(1, $args[PayloadModel::PAYLOAD]);
                foreach ($args[PayloadModel::PAYLOAD] as $item) {
                    $this->checkPackingListGroup($item);
                }
            },
        ];

        $query = static::getDefault();
        unset($query[packingListGroupApiDtoInterface::PACKING_LIST]);

        $content[] = [
            ApiRepositoryHelperTestInterface::QUERY => $query,
            ApiRepositoryHelperTestInterface::CONTENT => <<< EOF
[{
   "packingListGroup": {
    "info": "Контейнер KRPU 0196703",
    "id": 4
  },
  "packingList": {
    "label": "СПС-3/3",
    "contract": "Счет-договор № 14",
    "contractDescription": "поставка покрытий",
    "projectName": "XXXXXX ТЭЦ",
    "contractorName": "СПС ООО",
    "subContracts": "Счет-договор № 14 от 07.06.2022, Счет №ЦБ-789 от 11.08.2022",
    "weight": "",
    "formFactor": "Европаллет в стрейч пленке",
    "dimensions": "",
    "currentDept": "Пункт №4(строй площадка)",
    "comment": "",
    "consignee": "",
    "linkFile": "",
    "id": 1567
  },
  "packingListItems": [
    {
      "stateStandard": "",
      "quantity": 13,
      "measure": "шт.",
      "comment": "",
      "subContract": "Счет-договор № 14 от 07.06.2022",
      "number": "66/21-1-S1-M01-MB_-KG-2.1",
      "stamp": "Sikaflor-151 RU/267 RU/2671 ECD ",
      "packingList": {
        "label": "СПС-3/3",
        "contract": "Счет-договор № 14",
        "contractDescription": "поставка покрытий",
        "projectName": "XXXXXX ТЭЦ",
        "contractorName": "СПС ООО",
        "subContracts": "Счет-договор № 14 от 07.06.2022, Счет №ЦБ-789 от 11.08.2022",
        "weight": "",
        "formFactor": "Европаллет в стрейч пленке",
        "dimensions": "",
        "currentDept": "Пункт №4(строй площадка)",
        "comment": "",
        "consignee": "",
        "linkFile": "",
        "id": 1567
      },
      "id": 5039,
      "name": "Двухкомпонентная эпоксидная грунтовкаSikafloor-151 RU/267 RU/2627 ESD (B)Ведро 4,5 кг"
    },
    {
      "stateStandard": "",
      "quantity": 13,
      "measure": "шт.",
      "comment": "",
      "subContract": "Счет-договор № 14 от 07.06.2022",
      "number": "66/21-1-S1-M02-MB_-KG-2.1",
      "stamp": "Sikaflor-151 RU/267 RU/2627 ECD",
      "packingList": {
        "label": "СПС-3/3",
        "contract": "Счет-договор № 14",
        "contractDescription": "поставка покрытий",
        "projectName": "XXXXXX ТЭЦ",
        "contractorName": "СПС ООО",
        "subContracts": "Счет-договор № 14 от 07.06.2022, Счет №ЦБ-789 от 11.08.2022",
        "weight": "",
        "formFactor": "Европаллет в стрейч пленке",
        "dimensions": "",
        "currentDept": "Пункт №4(строй площадка)",
        "comment": "",
        "consignee": "",
        "linkFile": "",
        "id": 1567
      },
      "id": 5038,
      "name": "Двухкомпонентная эпоксидная грунтовкаSikafloor-151 RU/267 RU/2627 ESD (B)Ведро 4,5 кг"
    }
  ],
  "id": 13
},
{
   "packingListGroup": {
    "info": "Контейнер KRPU 0196703",
    "id": 5
  },
  "packingList": {
    "label": "СПС-3/3",
    "contract": "Счет-договор № 14",
    "contractDescription": "поставка покрытий",
    "projectName": "XXXXXX ТЭЦ",
    "contractorName": "СПС ООО",
    "subContracts": "Счет-договор № 14 от 07.06.2022, Счет №ЦБ-789 от 11.08.2022",
    "weight": "",
    "formFactor": "Европаллет в стрейч пленке",
    "dimensions": "",
    "currentDept": "Пункт №4(строй площадка)",
    "comment": "",
    "consignee": "",
    "linkFile": "",
    "id": 1568
  },
  "packingListItems": [
    {
      "stateStandard": "",
      "quantity": 13,
      "measure": "шт.",
      "comment": "",
      "subContract": "Счет-договор № 14 от 07.06.2022",
      "number": "66/21-1-S1-M01-MB_-KG-2.1",
      "stamp": "Sikaflor-151 RU/267 RU/2671 ECD ",
      "packingList": {
        "label": "СПС-3/3",
        "contract": "Счет-договор № 14",
        "contractDescription": "поставка покрытий",
        "projectName": "XXXXXX ТЭЦ",
        "contractorName": "СПС ООО",
        "subContracts": "Счет-договор № 14 от 07.06.2022, Счет №ЦБ-789 от 11.08.2022",
        "weight": "",
        "formFactor": "Европаллет в стрейч пленке",
        "dimensions": "",
        "currentDept": "Пункт №4(строй площадка)",
        "comment": "",
        "consignee": "",
        "linkFile": "",
        "id": 1568
      },
      "id": 5040,
      "name": "Двухкомпонентная эпоксидная грунтовкаSikafloor-151 RU/267 RU/2627 ESD (B)Ведро 4,5 кг"
    },
    {
      "stateStandard": "",
      "quantity": 13,
      "measure": "шт.",
      "comment": "",
      "subContract": "Счет-договор № 14 от 07.06.2022",
      "number": "66/21-1-S1-M02-MB_-KG-2.1",
      "stamp": "Sikaflor-151 RU/267 RU/2627 ECD",
      "packingList": {
        "label": "СПС-3/3",
        "contract": "Счет-договор № 14",
        "contractDescription": "поставка покрытий",
        "projectName": "XXXXXX ТЭЦ",
        "contractorName": "СПС ООО",
        "subContracts": "Счет-договор № 14 от 07.06.2022, Счет №ЦБ-789 от 11.08.2022",
        "weight": "",
        "formFactor": "Европаллет в стрейч пленке",
        "dimensions": "",
        "currentDept": "Пункт №4(строй площадка)",
        "comment": "",
        "consignee": "",
        "linkFile": "",
        "id": 1568
      },
      "id": 5041,
      "name": "Двухкомпонентная эпоксидная грунтовкаSikafloor-151 RU/267 RU/2627 ESD (B)Ведро 4,5 кг"
    }
  ],
  "id": 14
}]
EOF,
            ApiRepositoryHelperTestInterface::CALL => function ($args) {
                Assert::assertCount(2, $args[PayloadModel::PAYLOAD]);
                foreach ($args[PayloadModel::PAYLOAD] as $item) {
                    $this->checkPackingListGroup($item);
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
        $query = static::getDefault([PackingListGroupApiDtoInterface::PACKING_LIST => [PackingListApiDtoInterface::ID => PackingListId::wrong()]]);

        $content[] = [
            ApiRepositoryHelperTestInterface::QUERY => $query,
            ApiRepositoryHelperTestInterface::EXCEPTION => new \RuntimeException('HTTP/1.1 404 Not Found returned for "'.ApiRepositoryTestInterface::HOST.static::API_GET.'?packingListId='.Id::wrong().'"'),
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
                Assert::assertArrayHasKey(PayloadModel::PAYLOAD, $find);
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

    protected function createPackingListGroup(): array
    {
        $query = static::getDefault();

        return $this->post($query);
    }

    protected function checkResult($entity): void
    {
        Assert::assertArrayHasKey(PayloadModel::PAYLOAD, $entity);
        Assert::assertCount(1, $entity[PayloadModel::PAYLOAD]);
        $this->checkPackingListGroup($entity[PayloadModel::PAYLOAD][0]);
    }

    protected function checkPackingListGroup($entity): void
    {
        Assert::assertArrayHasKey(PackingListGroupApiDtoInterface::ID, $entity);
        Assert::assertArrayHasKey('packing_list_group', $entity);
        Assert::assertArrayHasKey(PackingListGroupApiDtoInterface::PACKING_LIST, $entity);
        Assert::assertArrayHasKey('packing_list_items', $entity);
    }
}
