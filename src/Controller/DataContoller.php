<?php
namespace App\Controller;

use App\Service\DataFetcher;
use App\Entity\Source;
use App\Entity\AdStats;
use App\Http\CustomJsonResponse;
use App\Service\ResponseHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DataContoller extends AbstractController
{

    /**
     * @Route("/data", methods={"Get"})
     */
    public function index()
    {
        try 
        {
            $adStats = $this->getDoctrine()->getRepository(AdStats::class)->findAll();
            $response = new CustomJsonResponse();
            
            return $response->success($adStats);
        } 
        catch (\Exception $exception) 
        {
            $response = new CustomJsonResponse();

            return $response->failure($exception);    
        }
    }


}
?>