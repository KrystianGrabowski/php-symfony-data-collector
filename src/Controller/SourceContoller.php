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

class SourceContoller extends AbstractController
{
    /**
     * @Route("/source", methods={"Get"})
     */
    public function index()
    {
        $sources = $this->getDoctrine()->getRepository(Source::class)->findAll();

        return new JsonResponse($sources);
    }

    /**
     * @Route("/source", methods={"POST"})
     */
    public function create(Request $request)
    {
        $content = $request->getContent();
        $content = json_decode($content, true);
        $source = new Source();
        $source->setUrl($content['url']);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($source);
        $entityManager->flush();

        return new Response(Response::HTTP_CREATED);
    }

    /**
     * @Route("/source/{id}", methods={"GET"})
     */
    public function show($id)
    {
        $source = $this->getDoctrine()->getRepository(Source::class)->find($id);

        return new JsonResponse($source);
    }

    /**
     * @Route("/source/{id}", methods={"DELETE"})
     */
    public function delete($id)
    {
        $source = $this->getDoctrine()->getRepository(Source::class)->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($source);
        $entityManager->flush();

        return new Response(Response::HTTP_OK);
    }


}
?>