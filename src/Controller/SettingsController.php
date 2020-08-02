<?php
namespace App\Controller;

use App\Entity\AdStatsSettings;
use App\Entity\Source;
use App\Http\CustomJsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SettingsController extends AbstractController
{
    /**
     * @Route("/settings", methods={"Get"})
     */
    public function index()
    {
        try
        {
            $settings = $this->getDoctrine()->getRepository(AdStatsSettings::class)->findAll();
            $response = new CustomJsonResponse();

            return $response->success($settings);
        }
        catch (\Exception $exception)
        {
            $response = new CustomJsonResponse();

            return $response->failure($exception);
        }
    }

    /**
     * @Route("/settings", methods={"POST"})
     */
    public function create(Request $request)
    {
        try
        {
            $content = $request->getContent();
            $content = json_decode($content, true);
            $settings = new AdStatsSettings();
            $settings->setCurrency($content['currency']);
            $settings->setPeriodLength($content['periodLength']);
    
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($settings);
            $entityManager->flush();
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
     * @Route("/settings/{id}", methods={"GET"})
     */
    public function show($id)
    {
        try
        {
            $settings = $this->getDoctrine()->getRepository(AdStatsSettings::class)->find($id);
            $response = new CustomJsonResponse();

            return $response->success($settings);
        }
        catch (\Exception $exception)
        {
            $response = new CustomJsonResponse();

            return $response->failure($exception);
        }
    }

    /**
     * @Route("/settings/{id}", methods={"DELETE"})
     */
    public function delete($id)
    {
        try
        {
            $settings = $this->getDoctrine()->getRepository(AdStatsSettings::class)->find($id);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($settings);
            $entityManager->flush();
            $response = new CustomJsonResponse();

            return $response->success();
        }
        catch (\Exception $exception)
        {
            $response = new CustomJsonResponse();
            
            return $response->failure($exception);
        }
    }
}
?>