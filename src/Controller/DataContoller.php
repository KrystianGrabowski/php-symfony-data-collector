<?php
namespace App\Controller;

use App\Service\DataFetcher;
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
        $data = $fetcher->fetchData('https://api.optad360.com/testapi');
        return new JsonResponse($data);
    }
}
?>