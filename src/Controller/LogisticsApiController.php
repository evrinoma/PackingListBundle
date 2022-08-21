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
use Evrinoma\PackingListBundle\Manager\Logistics\CommandManagerInterface;
use Evrinoma\PackingListBundle\Manager\Logistics\QueryManagerInterface;
use Evrinoma\PackingListBundle\PreValidator\Logistics\DtoPreValidatorInterface;
use Evrinoma\UtilsBundle\Controller\AbstractWrappedApiController;
use FOS\RestBundle\Controller\Annotations as Rest;
use JMS\Serializer\SerializerInterface;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

final class LogisticsApiController extends AbstractWrappedApiController
{
    private string $dtoClass;
    /**
     * @var ?Request
     */
    private ?Request $request;
    /**
     * @var QueryManagerInterface
     */
    private QueryManagerInterface $queryManager;
    /**
     * @var CommandManagerInterface
     */
    private CommandManagerInterface $commandManager;
    /**
     * @var FactoryDtoInterface
     */
    private FactoryDtoInterface $factoryDto;
    /**
     * @var DtoPreValidatorInterface
     */
    private DtoPreValidatorInterface $preValidator;

    public function __construct(SerializerInterface $serializer, RequestStack $requestStack, FactoryDtoInterface $factoryDto, CommandManagerInterface $commandManager, QueryManagerInterface $queryManager, DtoPreValidatorInterface $preValidator, string $dtoClass)
    {
        parent::__construct($serializer);
        $this->request = $requestStack->getCurrentRequest();
        $this->factoryDto = $factoryDto;
        $this->commandManager = $commandManager;
        $this->queryManager = $queryManager;
        $this->dtoClass = $dtoClass;
        $this->preValidator = $preValidator;
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
     *                     "packing_list_id": "1004",
     *                     "id_depart": "9",
     *                 },
     *                 type="object",
     *                 @OA\Property(property="class", type="string", default="Evrinoma\PackingListBundle\Dto\LogisticsApiDto"),
     *                 @OA\Property(property="packing_list_id", type="string"),
     *                 @OA\Property(property="id_depart", type="string"),
     *             )
     *         )
     *     )
     * )
     * @OA\Response(response=200, description="Create packing logistics")
     *
     * @return JsonResponse
     */
    public function postAction(): JsonResponse
    {
        /** @var LogisticsApiDtoInterface $fcrApiDto */
        $logicsticApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);
        $commandManager = $this->commandManager;

        $json = [];
        $error = [];

        try {
            $this->preValidator->onPost($logicsticApiDto);

            $em = $this->getDoctrine()->getManager();

            $em->transactional(
                function () use ($logicsticApiDto, $commandManager, &$json) {
                    $json[] = $commandManager->post($logicsticApiDto);
                }
            );
        } catch (\Exception $e) {
            $error = $this->setRestStatus($e);
        }

        return $this->setSerializeGroup('api_post_logistics')->JsonResponse('Create logistics', $json, $error);
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
        $json = [];

        try {
            throw new LogisticsCannotBeSavedException();
        } catch (\Exception $e) {
            $error = $this->setRestStatus($e);
        }

        return $this->setSerializeGroup('api_put_logistics')->JsonResponse('Save logistics item', $json, $error);
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
     *         name="packing_list_id",
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
        $json = [];

        try {
            throw new LogisticsCannotBeRemovedException();
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
     *         name="id_depart",
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *     @OA\Parameter(
     *         description="Id Entity Packing List",
     *         in="query",
     *         name="packing_list_id",
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
        $json = [];

        try {
            throw new LogisticsNotFoundException();
        } catch (\Exception $e) {
            $error = $this->setRestStatus($e);
        }

        return $this->setSerializeGroup('api_get_logistics')->JsonResponse('Get logistics item', $json, $error);
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
     *         name="packing_list_id",
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
        $json = [];

        try {
            throw new LogisticsNotFoundException();
        } catch (\Exception $e) {
            $error = $this->setRestStatus($e);
        }

        return $this->setSerializeGroup('api_get_logistics')->JsonResponse('Get logistics item', $json, $error);
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
                $this->setStatusNotImplemented();
                break;
            case $e instanceof UniqueConstraintViolationException:
                $this->setStatusConflict();
                break;
            case $e instanceof LogisticsNotFoundException:
                $this->setStatusNotFound();
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
