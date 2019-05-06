<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class TestController extends FOSRestController {

    /**
     * @Route("/test/exp1")
     */
    public function exp1 () {
        echo "OK"; exit;
    }

    /**
     * Lists all Movies.
     * @Rest\Get("/movies")
     *
     * @return Response
     */
    public function getMovieAction()
    {
        $movies = [
            ['id'=>1, 'name'=>'GF'],
            ['id'=>2, 'name'=>'BBB']
        ];
        return $this->handleView($this->view($movies));
    }
}