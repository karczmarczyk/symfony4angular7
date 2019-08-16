<?php
namespace App\Controller\Api;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class UploadController extends FOSRestController 
{

    /**
     * Upload files.
     * @Rest\Post("/upload")
     *
     * @return Response
     */
    public function getUpload (Request $request) {
        print_r($_FILES);
        // var_dump($request->files->all());
        // print_r($request->getContent());
        //var_dump($request);
        
        exit;return $this->handleView([]);
    }
}