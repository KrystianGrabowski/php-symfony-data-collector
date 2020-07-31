<?php
namespace App\Controller;

use App\Service\DataFetcher;
use App\Entity\Source;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DataContoller extends AbstractController
{
    /**
     * @Route("/fetch", methods={"Get"})
     */
    public function fetchData()
    {
        $fetcher = new DataFetcher();
        $data = $fetcher->fetch('https://api.optad360.com/testapi');
        return new JsonResponse($data);
    }

    /**
     * @Route("/readDb", methods={"Get"})
     */
    public function readDb()
    {
        $fetcher = $this->getDoctrine()->getRepository(Source::class)->findAll();
        return new JsonResponse($fetcher);
    }


}
?>