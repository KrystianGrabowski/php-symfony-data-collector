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
        $handler = new ResponseHandler($this->getDoctrine()->getManager());
        foreach ($sources as $source)
        {
            $response = $fetcher->fetch($source->getUrl());
            $handler->handle($response);
        }
        return new JsonResponse("OK");
    }

    /**
     * @Route("/data", methods={"Get"})
     */
    public function index()
    {
        $adStats = $this->getDoctrine()->getRepository(AdStats::class)->findAll();
        return new JsonResponse($adStats);
    }


}
?>