<?php
namespace App\Controller;

use App\Service\DataFetcher;
use App\Entity\Source;
use App\Entity\AdStats;
use App\Service\ResponseHandler;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DataContoller extends AbstractController
{
    /**
     * @Route("/data/update", methods={"Get"})
     */
    public function fetchData()
    {
        $sources = $this->getDoctrine()->getRepository(Source::class)->findAll();
        $fetcher = new DataFetcher();
        $handler = new ResponseHandler();
        foreach ($sources as $source)
        {
            $response = $fetcher->fetch($source->getUrl());
            $handler->handle($response);
        }
        return new JsonResponse([1,2,3]);
    }

    /**
     * @Route("/data", methods={"Get"})
     */
    public function readDb()
    {
        $fetcher = $this->getDoctrine()->getRepository(Source::class)->findAll();
        return new JsonResponse($fetcher);
    }


}
?>