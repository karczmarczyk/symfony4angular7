<?php
namespace App\Controller\Api;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\FOSRestController;
use App\Entity\User;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\DtoJs\UserDtoJs;

class UserController extends FOSRestController 
{

    /**
     * Lists all Users.
     * @Rest\Get("/users")
     *
     * @return Response
     */
    public function getUsers () {
        $repository = $this->getDoctrine()->getRepository(User::class);

        $users = $repository->findAll();
        return $this->handleView($this->view($users));
    }

    /**
     * Return current user
     * @Rest\Get("/user/current")
     * 
     * User {
     *  id: number;
     *  username: string;
     *  password: string;
     *  firstName: string;
     *  lastName: string;
     *  email: string;
     *  token: string;
     * }
     * 
     */
    public function getCurrentUser () {
        $user = $this->getUser();
        return new JsonResponse(new UserDtoJs($user), 200);
    }

    /**
     * Delete user
     * @Rest\Delete("/users/{id}")
     *
     * @return Response
     */
    public function delete (Request $request, $id) {
        $repository = $this->getDoctrine()->getRepository(User::class);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($repository->find($id));
        $entityManager->flush();
        return new JsonResponse([], 200);
    }
}