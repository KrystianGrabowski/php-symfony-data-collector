<?php
namespace App\Controller;

use App\Service\DataFetcher;
use App\Entity\Source;
use App\Entity\AdStats;
use App\Entity\AdStatsSettings;
use App\Repository\AdStatsSettingsRepository;
use App\Http\CustomJsonResponse;
use App\Service\InsertOrNull;
use App\Service\ResponseHandler;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
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
                $this->show($source->getId());
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
            $source = $this->getDoctrine()->getRepository(Source::class)->find($id);
            $fetcher = new DataFetcher();
            $handler = new ResponseHandler(); 

            $response = $fetcher->fetch($source->getUrl());
            $settings = $handler->handleSettings($response['settings']);
            $headers = $handler->handleHeaders($response['headers']);

            $settingsId = $this->saveSettings($settings);
            $data = $handler->handleData($response['data'], $headers, $settingsId, $source);
            $this->saveData($data);
            $response = new CustomJsonResponse();

            return $response->success();
        }
        catch (\Exception $exception)
        {
            $response = new CustomJsonResponse();

            return $response->failure($exception);
        }
    }

    private function saveData($data)
    {
        $entityManager = $this->getDoctrine()->getManager();

        foreach($data as $stats)
        {
            try
            {
                $duplicate = $entityManager->getRepository(AdStats::class)->findByKey($stats);
                if ($duplicate == null)
                {
                    $entityManager->persist($stats);
                    $entityManager->flush();
                }
            }
            catch (UniqueConstraintViolationException $exception)
            {

            }
        }
    }

    public function saveSettings($settings)
    {
        try
        {
            $entityManager = $this->getDoctrine()->getManager();
            $duplicate = $entityManager->getRepository(AdStatsSettings::class)->findByAll($settings);
            if ($duplicate == null)
            {
                $entityManager->persist($settings);
                $entityManager->flush();
                return $settings->getId();
            }
            else 
            {
                return $duplicate->getId();
            }
        }
        catch (UniqueConstraintViolationException $exception)
        {

        }

    }
}
?>