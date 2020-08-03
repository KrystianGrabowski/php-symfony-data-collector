<?php
namespace App\Controller;

use App\Entity\Source;
use App\Http\CustomJsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SourceContoller extends AbstractController
{
    /**
     * @Route("/source", methods={"Get"})
     */
    public function index()
    {
        try
        {
            $sources = $this->getDoctrine()->getRepository(Source::class)->findAll();
            $response = new CustomJsonResponse();

            return $response->success($sources);
        }
        catch (\Exception $exception)
        {
            $response = new CustomJsonResponse();

            return $response->failure($exception);
        }
    }

    /**
     * @Route("/source", methods={"POST"})
     */
    public function create(Request $request)
    {
        try
        {
            $content = $request->getContent();
            $content = json_decode($content, true);
            $source = new Source();
            $source->setUrl($content['url']);
            $source->setIsActive($content['is_active']);
    
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($source);
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
     * @Route("/source/{id}", methods={"GET"})
     */
    public function show($id)
    {
        try
        {
            $source = $this->getDoctrine()->getRepository(Source::class)->find($id);
            $response = new CustomJsonResponse();

            return $response->success($source);
        }
        catch (\Exception $exception)
        {
            $response = new CustomJsonResponse();

            return $response->failure($exception);
        }
    }

    /**
     * @Route("/source/{id}", methods={"DELETE"})
     */
    public function delete($id)
    {
        try
        {
            $source = $this->getDoctrine()->getRepository(Source::class)->find($id);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($source);
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