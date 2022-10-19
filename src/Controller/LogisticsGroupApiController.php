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

namespace Evrinoma\PackingListBundle\Controller;

use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Evrinoma\DtoBundle\Factory\FactoryDtoInterface;
use Evrinoma\PackingListBundle\Dto\LogisticsGroupApiDtoInterface;
use Evrinoma\PackingListBundle\Exception\LogisticsGroup\LogisticsGroupCannotBeCreatedException;
use Evrinoma\PackingListBundle\Exception\LogisticsGroup\LogisticsGroupCannotBeRemovedException;
use Evrinoma\PackingListBundle\Exception\LogisticsGroup\LogisticsGroupCannotBeSavedException;
use Evrinoma\PackingListBundle\Exception\LogisticsGroup\LogisticsGroupInvalidException;
use Evrinoma\PackingListBundle\Exception\LogisticsGroup\LogisticsGroupNotFoundException;
use Evrinoma\PackingListBundle\Facade\LogisticsGroup\FacadeInterface;
use Evrinoma\PackingListBundle\Serializer\GroupInterface;
use Evrinoma\UtilsBundle\Controller\AbstractWrappedApiController;
use Evrinoma\UtilsBundle\Controller\ApiControllerInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use JMS\Serializer\SerializerInterface;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

final class LogisticsGroupApiController extends AbstractWrappedApiController implements ApiControllerInterface
{
    private string $dtoClass;

    private ?Request $request;

    private FactoryDtoInterface $factoryDto;

    private FacadeInterface $facade;

    public function __construct(
        SerializerInterface $serializer,
        RequestStack $requestStack,
        FactoryDtoInterface $factoryDto,
        FacadeInterface $facade,
        string $dtoClass
    ) {
        parent::__construct($serializer);
        $this->request = $requestStack->getCurrentRequest();
        $this->factoryDto = $factoryDto;
        $this->dtoClass = $dtoClass;
        $this->facade = $facade;
    }

    /**
     * @Rest\Post("/api/packing_list/logistics/group/create", options={"expose": true}, name="api_packing_list_logistics_group_create")
     * @OA\Post(
     *     tags={"packing-list"},
     *     description="the method perform create departure packing logistics",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 example={
     *                     "class": "Evrinoma\PackingListBundle\Dto\LogisticsGroupApiDto",
     *                     "group": {
     *                         "id": "4"
     *                     },
     *                     "depart": {
     *                         "warehouse": "9"
     *                     },
     *                     "user": {
     *                         "id": "9",
     *                         "email": "email@email.com",
     *                         "name": "name",
     *                         "surname": "surname",
     *                         "patronymic": "patronymic",
     *                     },
     *                 },
     *                 type="object",
     *                 @OA\Property(property="class", type="string", default="Evrinoma\PackingListBundle\Dto\LogisticsGroupApiDto"),
     *                 @OA\Property(property="group", type="object"),
     *                 @OA\Property(property="depart", type="object")
     *             )
     *         )
     *     )
     * )
     * @OA\Response(response=200, description="Create logistics group item")
     *
     * @return JsonResponse
     */
    public function postAction(): JsonResponse
    {
        /** @var LogisticsGroupApiDtoInterface $fcrApiDto */
        $logisticGroupApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);

        $this->setStatusCreated();

        $json = [];
        $error = [];
        $group = GroupInterface::API_POST_LOGISTICS_GROUP;

        try {
            $this->facade->post($logisticGroupApiDto, $group, $json);
        } catch (\Exception $e) {
            $error = $this->setRestStatus($e);
        }

        return $this->setSerializeGroup($group)->JsonResponse('Create logistics group item', $json, $error);
    }

    /**
     * @Rest\Put("/api/packing_list/logistics/group/save", options={"expose": true}, name="api_packing_list_logistics_group_save")
     * @OA\Put(
     *     tags={"packing-list"},
     *     description="the method perform save departure packing logistics for current entity",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 example={
     *                     "class": "Evrinoma\PackingListBundle\Dto\LogisticsGroupApiDto"
     *                 },
     *                 type="object",
     *                 @OA\Property(property="class", type="string", default="Evrinoma\PackingListBundle\Dto\LogisticsGroupApiDto"),
     *             )
     *         )
     *     )
     * )
     * @OA\Response(response=200, description="Save logistics group item")
     *
     * @return JsonResponse
     */
    public function putAction(): JsonResponse
    {
        /** @var LogisticsGroupApiDtoInterface $fcrApiDto */
        $logisticGroupApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);

        $json = [];
        $error = [];
        $group = GroupInterface::API_PUT_LOGISTICS_GROUP;

        try {
            $this->facade->put($logisticGroupApiDto, $group, $json);
        } catch (\Exception $e) {
            $error = $this->setRestStatus($e);
        }

        return $this->setSerializeGroup($group)->JsonResponse('Save logistics group item', $json, $error);
    }

    /**
     * @Rest\Delete("/api/packing_list/logistics/group/delete", options={"expose": true}, name="api_packing_list_logistics_group_delete")
     * @OA\Delete(
     *     tags={"packing-list"},
     *     @OA\Parameter(
     *         description="class",
     *         in="query",
     *         name="class",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             default="Evrinoma\PackingListBundle\Dto\LogisticsGroupApiDto",
     *             readOnly=true
     *         )
     *     ),
     *     @OA\Parameter(
     *         description="Packing List Group Entity Id ",
     *         in="query",
     *         name="group[id]",
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     * )
     * @OA\Response(response=200, description="Delete logistics group item")
     *
     * @return JsonResponse
     */
    public function deleteAction(): JsonResponse
    {
        /** @var LogisticsGroupApiDtoInterface $fcrApiDto */
        $logisticGroupApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);

        $this->setStatusAccepted();

        $json = [];
        $error = [];

        try {
            $this->facade->delete($logisticGroupApiDto, '', $json);
        } catch (\Exception $e) {
            $error = $this->setRestStatus($e);
        }

        return $this->JsonResponse('Delete logistics group item', $json, $error);
    }

    /**
     * @Rest\Get("/api/packing_list/logistics/group/criteria", options={"expose": true}, name="api_packing_list_logistics_group_criteria")
     * @OA\Get(
     *     tags={"packing-list"},
     *     @OA\Parameter(
     *         description="class",
     *         in="query",
     *         name="class",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             default="Evrinoma\PackingListBundle\Dto\LogisticsGroupApiDto",
     *             readOnly=true
     *         )
     *     ),
     *     @OA\Parameter(
     *         description="id Entity Depart",
     *         in="query",
     *         name="depart[id]",
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *     @OA\Parameter(
     *         description="Packing List Group Entity Id ",
     *         in="query",
     *         name="group[id]",
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     * )
     * @OA\Response(response=200, description="Return logistics group item")
     *
     * @return JsonResponse
     */
    public function criteriaAction(): JsonResponse
    {
        /** @var LogisticsGroupApiDtoInterface $fcrApiDto */
        $logisticGroupApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);

        $json = [];
        $error = [];
        $group = GroupInterface::API_CRITERIA_LOGISTICS_GROUP;

        try {
            $this->facade->criteria($logisticGroupApiDto, $group, $json);
        } catch (\Exception $e) {
            $error = $this->setRestStatus($e);
        }

        return $this->setSerializeGroup($group)->JsonResponse('Get logistics group item', $json, $error);
    }

    /**
     * @Rest\Get("/api/packing_list/logistics/group", options={"expose": true}, name="api_packing_list_logistics_group")
     * @OA\Get(
     *     tags={"packing-list"},
     *     @OA\Parameter(
     *         description="class",
     *         in="query",
     *         name="class",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             default="Evrinoma\PackingListBundle\Dto\LogisticsGroupApiDto",
     *             readOnly=true
     *         )
     *     ),
     *     @OA\Parameter(
     *         description="Packing List Group Entity Id ",
     *         in="query",
     *         name="group[id]",
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     * )
     * @OA\Response(response=200, description="Return logistics group item")
     *
     * @return JsonResponse
     */
    public function getAction(): JsonResponse
    {
        /** @var LogisticsGroupApiDtoInterface $fcrApiDto */
        $logisticGroupApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);

        $json = [];
        $error = [];
        $group = GroupInterface::API_GET_LOGISTICS_GROUP;

        try {
            $this->facade->criteria($logisticGroupApiDto, $group, $json);
        } catch (\Exception $e) {
            $error = $this->setRestStatus($e);
        }

        return $this->setSerializeGroup($group)->JsonResponse('Get logistics group item', $json, $error);
    }

    /**
     * @param \Exception $e
     *
     * @return array
     */
    public function setRestStatus(\Exception $e): array
    {
        switch (true) {
            case $e instanceof LogisticsGroupCannotBeCreatedException:
            case $e instanceof LogisticsGroupCannotBeRemovedException:
            case $e instanceof LogisticsGroupCannotBeSavedException:
            case $e instanceof LogisticsGroupNotFoundException:
                $this->setStatusNotImplemented();
                break;
            case $e instanceof UniqueConstraintViolationException:
                $this->setStatusConflict();
                break;
            case $e instanceof LogisticsGroupInvalidException:
                $this->setStatusUnprocessableEntity();
                break;
            default:
                $this->setStatusBadRequest();
        }

        return [$e->getMessage()];
    }
}
