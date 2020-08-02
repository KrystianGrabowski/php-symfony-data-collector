<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class TestApiController extends AbstractController
{
    /**
     * @Route("/testapi", methods={"Get"})
     */
    public function index()
    {
        return new JsonResponse([
            'settings' => [
                'currency' => 'PLN',
                'periodLength' => 1,
                'groupby' => ''
            ],
            'headers' => [
                0 => 'URLs',
                1 => 'Date',
                2 => 'Tags',
                3 => 'Estimated revenue',
                4 => 'Ad impressions',
                5 => 'Ad eCPM',
                6 => 'CLICKS',
                7 => 'Ad CTR',
            ],
            'data' => [
                0 => [
                    0 => 'example.pl',
                    1 => '2020-03-03',
                    2 => 'example1',
                    3 => '77.2',
                    4 => '4431',
                    5 => '4.32',
                    6 => '665',
                    7 => '0.11',
                ],
                1 => [
                    0 => 'example2.pl',
                    1 => '2020-03-03',
                    2 => 'example1',
                    3 => '21.37',
                    4 => '432',
                    5 => '0.99',
                    6 => '12',
                    7 => '9.99',
                ],
                2 => [
                    0 => 'example3.pl',
                    1 => '2020-03-04',
                    2 => 'example2',
                    3 => '2.2',
                    4 => '44111',
                    5 => '9.32',
                    6 => '666',
                    7 => '1.21',
                ],
            ]
        ]);
    }
}
?>