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

use Evrinoma\PackingListBundle\Dto\DepartApiDtoInterface;
use Evrinoma\PackingListBundle\Tests\Functional\ValueObject\Depart\Id;
use Evrinoma\PackingListBundle\Tests\Functional\ValueObject\Depart\Point;
use Evrinoma\PackingListBundle\Tests\Functional\ValueObject\PackingList\Id as PackingListId;
use Evrinoma\PackingListBundle\Tests\Functional\ValueObject\PackingListGroup\Id as PackingListGroupId;
use Evrinoma\TestUtilsBundle\Repository\Api\ApiRepositoryHelperTestInterface;
use Evrinoma\TestUtilsBundle\Repository\Api\ApiRepositoryTestInterface;
use Evrinoma\UtilsBundle\Model\Rest\ErrorModel;
use Evrinoma\UtilsBundle\Model\Rest\PayloadModel;
use PHPUnit\Framework\Assert;
use Symfony\Component\HttpFoundation\Response;

trait BaseDepartTestTrait
{
    protected function contentActionGet(): void
    {
        $id = Id::value();
        $this->content = <<< EOF
{
"id":{$id},
"warehouse":64,
"point":"\u0427\u0413\u0420\u041a \u21161.2",
"name":"\u041f\u0443\u043d\u043a\u0442 \u21161",
"address":"\u041c\u0443\u0440\u043c\u0430\u043d\u0441\u043a",
"final":false
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
        unset($query[DepartApiDtoInterface::POINT]);
        unset($query[DepartApiDtoInterface::ID]);
        unset($query[DepartApiDtoInterface::TYPE]);
        unset($query[DepartApiDtoInterface::GROUP]);

        $content[] = [
               ApiRepositoryHelperTestInterface::QUERY => $query,
               ApiRepositoryHelperTestInterface::CONTENT => <<< EOF
[{
"id":49,
"warehouse":64,
"packingList":
    {
    "id":2,
    "label":"",
    "weight":"",
    "formFactor":"",
    "contract":"948",
    "projectName":"\u0427\u0435\u0440\u043d\u043e\u0433\u043e\u0440\u0441\u043a\u0430\u044f \u0422\u042d\u0426",
    "contractorName":"SIEMENS",
    "subContracts":"",
    "dimensions":""
    },
"point":"\u0427\u0413\u0420\u041a \u21161.2",
"name":"\u041f\u0443\u043d\u043a\u0442 \u21161",
"address":"\u041c\u0443\u0440\u043c\u0430\u043d\u0441\u043a",
"final":false
},
{
"id":52,
"warehouse":61,
"packingList":
    {
    "id":2,
    "label":"",
    "weight":"",
    "formFactor":"",
    "contract":"948",
    "projectName":"\u0427\u0435\u0440\u043d\u043e\u0433\u043e\u0440\u0441\u043a\u0430\u044f \u0422\u042d\u0426",
    "contractorName":"SIEMENS",
    "subContracts":"",
    "dimensions":""
    },
"point":"\u0427\u0413\u0420\u041a_\u21161.1",
"name":"\u041f\u0443\u043d\u043a\u0442 \u21161",
"address":"\u0410\u0440\u0445\u0430\u043d\u0433\u0435\u043b\u044c\u0441\u043a",
"final":true
}]
EOF,
               ApiRepositoryHelperTestInterface::CALL => function ($args) {
                   Assert::assertCount(2, $args[PayloadModel::PAYLOAD]);
                   foreach ($args[PayloadModel::PAYLOAD] as $item) {
                       $this->checkCriteriaDepart($item);
                   }
               },
        ];

        $query = static::getDefault();
        unset($query[DepartApiDtoInterface::ID]);
        unset($query[DepartApiDtoInterface::TYPE]);
        unset($query[DepartApiDtoInterface::GROUP]);

        $packingListId = PackingListId::value();

        $content[] = [
               ApiRepositoryHelperTestInterface::QUERY => $query,
            ApiRepositoryHelperTestInterface::CONTENT => <<< EOF
[{
"id":52,
"warehouse":61,
"packingList":
    {
    "id":{$packingListId},
    "label":"",
    "weight":"",
    "formFactor":"",
    "contract":"948",
    "projectName":"\u0427\u0435\u0440\u043d\u043e\u0433\u043e\u0440\u0441\u043a\u0430\u044f \u0422\u042d\u0426",
    "contractorName":"SIEMENS",
    "subContracts":"",
    "dimensions":""
    },
"point":"\u0427\u0413\u0420\u041a_\u21161.1",
"name":"\u041f\u0443\u043d\u043a\u0442 \u21161",
"address":"\u0410\u0440\u0445\u0430\u043d\u0433\u0435\u043b\u044c\u0441\u043a",
"final":true
}]
EOF,
               ApiRepositoryHelperTestInterface::CALL => function ($args) {
                   Assert::assertCount(1, $args[PayloadModel::PAYLOAD]);
                   foreach ($args[PayloadModel::PAYLOAD] as $item) {
                       $this->checkCriteriaDepart($item);
                   }
               },
           ];

        $query = static::getDefault();
        unset($query[DepartApiDtoInterface::POINT]);
        unset($query[DepartApiDtoInterface::ID]);
        unset($query[DepartApiDtoInterface::PACKING_LIST]);

        $packingListGroupId = PackingListGroupId::value();

        $content[] = [
            ApiRepositoryHelperTestInterface::QUERY => $query,
            ApiRepositoryHelperTestInterface::CONTENT => <<< EOF
[{
"id":13,
"warehouse":59,
"packingListGroupInfo":
    {
    "id":{$packingListGroupId},
    "info":"\u041a\u043e\u043d\u0442\u0435\u0439\u043d\u0435\u0440 KRPU 1003579"
    },
"point":"\u0427\u0413\u0420\u041a_\u21162",
"name":"\u041f\u0443\u043d\u043a\u0442 \u21162",
"address":"\u043f\u043e\u0440\u0442 \u0414\u0443\u0434\u0438\u043d\u043a\u0430",
"final":false
},
{
"id":15,
"warehouse":60,
"packingListGroupInfo":
    {
    "id":{$packingListGroupId},
    "info":"\u041a\u043e\u043d\u0442\u0435\u0439\u043d\u0435\u0440 KRPU 1003579"
    },
"point":"\u0427\u0413\u0420\u041a_\u21163",
"name":"\u041f\u0443\u043d\u043a\u0442 \u21163",
"address":"\u041f\u0440\u043e\u043c\u0435\u0436.\u0431\u0430\u0437\u0430 \u041d\u043e\u0440\u0438\u043b\u044c\u0441\u043a",
"final":false
},
{
"id":18,
"warehouse":62,
"packingListGroupInfo":
    {
    "id":{$packingListGroupId},
    "info":"\u041a\u043e\u043d\u0442\u0435\u0439\u043d\u0435\u0440 KRPU 1003579"
    },
"point":"\u0427\u0413\u0420\u041a_\u21164",
"name":"\u041f\u0443\u043d\u043a\u0442 \u21164",
"address":"\u0441\u0442\u0440\u043e\u0439 \u043f\u043b\u043e\u0449\u0430\u0434\u043a\u0430",
"final":true
}]
EOF,
            ApiRepositoryHelperTestInterface::CALL => function ($args) {
                Assert::assertCount(3, $args[PayloadModel::PAYLOAD]);
                foreach ($args[PayloadModel::PAYLOAD] as $item) {
                    $this->checkCriteriaWarehouse($item);
                }
            },
        ];

        foreach ($content as $value) {
            $this->content = $value[ApiRepositoryHelperTestInterface::CONTENT];
            yield [
                ApiRepositoryHelperTestInterface::QUERY => $value[ApiRepositoryHelperTestInterface::QUERY],
                ApiRepositoryHelperTestInterface::CALL => $value[ApiRepositoryHelperTestInterface::CALL],
            ];
        }
    }

    protected function contentActionCriteriaNotFound(): \Generator
    {
        $query = static::getDefault();
        unset($query[DepartApiDtoInterface::POINT]);
        unset($query[DepartApiDtoInterface::ID]);
        unset($query[DepartApiDtoInterface::TYPE]);
        unset($query[DepartApiDtoInterface::GROUP]);

        $content[] = [
            ApiRepositoryHelperTestInterface::QUERY => $query,
            ApiRepositoryHelperTestInterface::EXCEPTION => new \RuntimeException('HTTP/1.1 404 Not Found returned for "'.ApiRepositoryTestInterface::HOST.static::API_GET.'?packingListId='.PackingListId::wrong().'"'),
            ApiRepositoryHelperTestInterface::CALL => function ($args) {
                $this->hasError($args);
            },
        ];

        $query = static::getDefault();
        unset($query[DepartApiDtoInterface::ID]);
        unset($query[DepartApiDtoInterface::TYPE]);
        unset($query[DepartApiDtoInterface::GROUP]);

        $content[] = [
            ApiRepositoryHelperTestInterface::QUERY => $query,
            ApiRepositoryHelperTestInterface::EXCEPTION => new \RuntimeException('HTTP/1.1 404 Not Found returned for "'.ApiRepositoryTestInterface::HOST.static::API_GET.'?packingListId='.PackingListId::wrong().'&point='.Point::wrong().'"'),
            ApiRepositoryHelperTestInterface::CALL => function ($args) {
                $this->hasError($args);
            },
        ];

        $query = static::getDefault();
        unset($query[DepartApiDtoInterface::POINT]);
        unset($query[DepartApiDtoInterface::ID]);
        unset($query[DepartApiDtoInterface::PACKING_LIST]);

        $content[] = [
            ApiRepositoryHelperTestInterface::QUERY => $query,
            ApiRepositoryHelperTestInterface::EXCEPTION => new \RuntimeException('HTTP/1.1 404 Not Found returned for "'.ApiRepositoryTestInterface::HOST.static::API_GET.'?groupId='.PackingListGroupId::wrong().'&type=PACKING_LIST_GROUP_INFO"'),
            ApiRepositoryHelperTestInterface::CALL => function ($args) {
                $this->hasError($args);
            },
        ];

        foreach ($content as $value) {
            $this->exception = $value[ApiRepositoryHelperTestInterface::EXCEPTION];
            yield [ApiRepositoryHelperTestInterface::QUERY => $value[ApiRepositoryHelperTestInterface::QUERY], ApiRepositoryHelperTestInterface::CALL => $value[ApiRepositoryHelperTestInterface::CALL]];
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

    protected function createDepart(): array
    {
        $query = static::getDefault();

        return $this->post($query);
    }

    protected function createWarehouse(): array
    {
        $query = static::getDefault();

        return $this->post($query);
    }

    protected function checkGetDepart($entity): void
    {
        Assert::assertArrayHasKey(DepartApiDtoInterface::ID, $entity);
        Assert::assertArrayHasKey(DepartApiDtoInterface::NAME, $entity);
        Assert::assertArrayHasKey(DepartApiDtoInterface::ADDRESS, $entity);
        Assert::assertArrayHasKey(DepartApiDtoInterface::POINT, $entity);
        Assert::assertArrayHasKey(DepartApiDtoInterface::WAREHOUSE, $entity);
        Assert::assertArrayHasKey(DepartApiDtoInterface::FINAL, $entity);
    }

    protected function checkCriteriaDepart($entity): void
    {
        $this->checkGetDepart($entity);
        Assert::assertArrayHasKey(DepartApiDtoInterface::PACKING_LIST, $entity);
    }

    protected function checkCriteriaWarehouse($entity): void
    {
        $this->checkGetDepart($entity);
        Assert::assertArrayHasKey(DepartApiDtoInterface::GROUP, $entity);
    }
}
