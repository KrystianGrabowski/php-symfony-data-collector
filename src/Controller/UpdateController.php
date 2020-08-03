<?php
namespace App\Controller;

use App\Service\DataFetcher;
use App\Entity\Source;
use App\Entity\AdStats;
use App\Entity\AdStatsSettings;
use App\Http\CustomJsonResponse;
use App\Service\ResponseHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UpdateController extends AbstractController
{
    /**
     * @Route("/update", methods={"Get"})
     */
    public function index()
    {
        try
        {
            $sources = $this->getDoctrine()->getRepository(Source::class)->findAll();
            foreach ($sources as $source)
            {
                $this->fetchAndSave($source->getId());
            }
            $response = new CustomJsonResponse();

            return $response->success();
        }
        catch (\Exception $exception)
        {
            $response = new CustomJsonResponse();

            return $response->failure($exception);
        }

    }

    /**
     * @Route("/update/{id}", methods={"Get"})
     */
    public function show($id)
    {
        try
        {
            $this->fetchAndSave($id);
            $response = new CustomJsonResponse();

            return $response->success();
        }
        catch (\Exception $exception)
        {
            $response = new CustomJsonResponse();

            return $response->failure($exception);
        }
    }

    /**
     * Fetch and save data using source with given id
     */
    private function fetchAndSave($id)
    {
        $source = $this->getDoctrine()->getRepository(Source::class)->find($id);
        dump($source->getIsActive());
        if ($source->getIsActive()) {
            $fetcher = new DataFetcher();
            $handler = new ResponseHandler(); 
    
            $response = $fetcher->fetch($source->getUrl());
            $settings = $handler->handleSettings($response['settings']);
            $headers = $handler->handleHeaders($response['headers']);
    
            $settingsId = $this->getDoctrine()->getRepository(AdStatsSettings::class)->save($settings);
            $data = $handler->handleData($response['data'], $headers, $settingsId, $source);
            $this->getDoctrine()->getRepository(AdStats::class)->save($data);
        }

    }
}
?>