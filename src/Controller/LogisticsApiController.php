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
use Evrinoma\PackingListBundle\Dto\LogisticsApiDtoInterface;
use Evrinoma\PackingListBundle\Exception\Logistics\LogisticsCannotBeCreatedException;
use Evrinoma\PackingListBundle\Exception\Logistics\LogisticsCannotBeRemovedException;
use Evrinoma\PackingListBundle\Exception\Logistics\LogisticsCannotBeSavedException;
use Evrinoma\PackingListBundle\Exception\Logistics\LogisticsInvalidException;
use Evrinoma\PackingListBundle\Exception\Logistics\LogisticsNotFoundException;
use Evrinoma\PackingListBundle\Facade\Logistics\FacadeInterface;
use Evrinoma\PackingListBundle\Serializer\GroupInterface;
use Evrinoma\UtilsBundle\Controller\AbstractWrappedApiController;
use Evrinoma\UtilsBundle\Controller\ApiControllerInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use JMS\Serializer\SerializerInterface;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

final class LogisticsApiController extends AbstractWrappedApiController implements ApiControllerInterface
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
     * @Rest\Post("/api/packing_list/logistics/create", options={"expose": true}, name="api_packing_list_logistics_create")
     * @OA\Post(
     *     tags={"packing-list"},
     *     description="the method perform create departure packing logistics",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 example={
     *                     "class": "Evrinoma\PackingListBundle\Dto\LogisticsApiDto",
     *                     "packing_list": {
     *                         "id": "1004"
     *                     },
     *                     "depart": {
     *                         "id": "9"
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
     *                 @OA\Property(property="class", type="string", default="Evrinoma\PackingListBundle\Dto\LogisticsApiDto"),
     *                 @OA\Property(property="packing_list", type="object"),
     *                 @OA\Property(property="depart", type="object")
     *             )
     *         )
     *     )
     * )
     * @OA\Response(response=200, description="Create logistics item")
     *
     * @return JsonResponse
     */
    public function postAction(): JsonResponse
    {
        /** @var LogisticsApiDtoInterface $fcrApiDto */
        $logisticApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);

        $this->setStatusCreated();

        $json = [];
        $error = [];
        $group = GroupInterface::API_POST_LOGISTICS;

        try {
            $this->facade->post($logisticApiDto, $group, $json);
        } catch (\Exception $e) {
            $error = $this->setRestStatus($e);
        }

        return $this->setSerializeGroup($group)->JsonResponse('Create logistics item', $json, $error);
    }

    /**
     * @Rest\Put("/api/packing_list/logistics/save", options={"expose": true}, name="api_packing_list_logistics_save")
     * @OA\Put(
     *     tags={"packing-list"},
     *     description="the method perform save departure packing logistics for current entity",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 example={
     *                     "class": "Evrinoma\PackingListBundle\Dto\LogisticsApiDto"
     *                 },
     *                 type="object",
     *                 @OA\Property(property="class", type="string", default="Evrinoma\PackingListBundle\Dto\LogisticsApiDto"),
     *             )
     *         )
     *     )
     * )
     * @OA\Response(response=200, description="Save logistics item")
     *
     * @return JsonResponse
     */
    public function putAction(): JsonResponse
    {
        /** @var LogisticsApiDtoInterface $fcrApiDto */
        $logisticApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);

        $json = [];
        $error = [];
        $group = GroupInterface::API_PUT_LOGISTICS;

        try {
            $this->facade->put($logisticApiDto, $group, $json);
        } catch (\Exception $e) {
            $error = $this->setRestStatus($e);
        }

        return $this->setSerializeGroup($group)->JsonResponse('Save logistics item', $json, $error);
    }

    /**
     * @Rest\Delete("/api/packing_list/logistics/delete", options={"expose": true}, name="api_packing_list_logistics_delete")
     * @OA\Delete(
     *     tags={"packing-list"},
     *     @OA\Parameter(
     *         description="class",
     *         in="query",
     *         name="class",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             default="Evrinoma\PackingListBundle\Dto\LogisticsApiDto",
     *             readOnly=true
     *         )
     *     ),
     *     @OA\Parameter(
     *         description="Id Entity Packing List",
     *         in="query",
     *         name="packing_list[id]",
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     * )
     * @OA\Response(response=200, description="Delete logistics item")
     *
     * @return JsonResponse
     */
    public function deleteAction(): JsonResponse
    {
        /** @var LogisticsApiDtoInterface $fcrApiDto */
        $logisticApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);

        $this->setStatusAccepted();

        $json = [];
        $error = [];

        try {
            $this->facade->delete($logisticApiDto, '', $json);
        } catch (\Exception $e) {
            $error = $this->setRestStatus($e);
        }

        return $this->JsonResponse('Delete logistics item', $json, $error);
    }

    /**
     * @Rest\Get("/api/packing_list/logistics/criteria", options={"expose": true}, name="api_packing_list_logistics_criteria")
     * @OA\Get(
     *     tags={"packing-list"},
     *     @OA\Parameter(
     *         description="class",
     *         in="query",
     *         name="class",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             default="Evrinoma\PackingListBundle\Dto\LogisticsApiDto",
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
     *         description="Id Entity Packing List",
     *         in="query",
     *         name="packing_list[id]",
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     * )
     * @OA\Response(response=200, description="Return logistics item")
     *
     * @return JsonResponse
     */
    public function criteriaAction(): JsonResponse
    {
        /** @var LogisticsApiDtoInterface $fcrApiDto */
        $logisticApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);

        $json = [];
        $error = [];
        $group = GroupInterface::API_CRITERIA_LOGISTICS;

        try {
            $this->facade->criteria($logisticApiDto, $group, $json);
        } catch (\Exception $e) {
            $error = $this->setRestStatus($e);
        }

        return $this->setSerializeGroup($group)->JsonResponse('Get logistics item', $json, $error);
    }

    /**
     * @Rest\Get("/api/packing_list/logistics", options={"expose": true}, name="api_packing_list_logistics")
     * @OA\Get(
     *     tags={"packing-list"},
     *     @OA\Parameter(
     *         description="class",
     *         in="query",
     *         name="class",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             default="Evrinoma\PackingListBundle\Dto\LogisticsApiDto",
     *             readOnly=true
     *         )
     *     ),
     *     @OA\Parameter(
     *         description="Id Entity Packing List",
     *         in="query",
     *         name="packing_list[id]",
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     * )
     * @OA\Response(response=200, description="Return logistics item")
     *
     * @return JsonResponse
     */
    public function getAction(): JsonResponse
    {
        /** @var LogisticsApiDtoInterface $fcrApiDto */
        $logisticApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);

        $json = [];
        $error = [];
        $group = GroupInterface::API_GET_LOGISTICS;

        try {
            $this->facade->criteria($logisticApiDto, $group, $json);
        } catch (\Exception $e) {
            $error = $this->setRestStatus($e);
        }

        return $this->setSerializeGroup($group)->JsonResponse('Get logistics item', $json, $error);
    }

    /**
     * @param \Exception $e
     *
     * @return array
     */
    public function setRestStatus(\Exception $e): array
    {
        switch (true) {
            case $e instanceof LogisticsCannotBeCreatedException:
            case $e instanceof LogisticsCannotBeRemovedException:
            case $e instanceof LogisticsCannotBeSavedException:
            case $e instanceof LogisticsNotFoundException:
                $this->setStatusNotImplemented();
                break;
            case $e instanceof UniqueConstraintViolationException:
                $this->setStatusConflict();
                break;
            case $e instanceof LogisticsInvalidException:
                $this->setStatusUnprocessableEntity();
                break;
            default:
                $this->setStatusBadRequest();
        }

        return [$e->getMessage()];
    }
}
