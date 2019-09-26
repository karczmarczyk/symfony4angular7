<?php
namespace App\Controller\Api;

use App\Entity\UploadedFile;
use App\Form\UploadedFileType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\FOSRestController;

use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UploadController extends AbstractController 
{

    /**
     * Upload files.
     * @Rest\Post("/upload")
     *
     * @return Response
     */
    public function getUpload (Request $request) {
        
        echo '$_FILES';
        var_dump($_FILES);
        echo '$_POST';
        var_dump($_POST);
        
        $uploadedFile = new UploadedFile();
        
        
        $form = $this->createForm(UploadedFileType::class, $uploadedFile/*,
        ['csrf_protection' => false]*/);
        
        echo '$request->files';
        var_dump($request->files);
        echo '$request->request->get(form)';
        var_dump($request->request->get("form"));

        // echo '$this->get(\'form.factory\');';
        // var_dump($this->get('form.factory')->);

        $form->handleRequest ($request);

        echo 'isValid=';
        echo (int)$form->isValid();

        echo '$this->isCsrfTokenValid(main_csrf_token,$_POST[_token]);';
        echo (int)$this->isCsrfTokenValid('main_csrf_token',$_POST['_token']);

        echo '$form->getData()';
        var_dump($form->getData());
        if ($form->isSubmitted() && $form->isValid()) {
            echo "OK!!!";
            echo '$form->getData()';
            var_dump($form->getData());
        } else {
            echo "notValid";
            dump((string) $form->getErrors(true, false));die;
        }
        
        exit;
        return $this->handleView([]);
    }
}