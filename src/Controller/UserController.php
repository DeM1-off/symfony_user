<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use App\Repository\UserTelephoneRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserController extends AbstractController
{
    /**
     * @Route("/", name="user")
     */
    public function index(UserRepository $usersRepository, UserTelephoneRepository $userTelephoneRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $usersRepository->findAll(),
            'phone' =>$userTelephoneRepository->findAll()
        ]);
    }
    /**
     * @Route("/new", name="user_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $post = new User();
        $form = $this->createForm(UserType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($post);
            $entityManager->flush();
            return $this->redirectToRoute('user');
        }
        return $this->render('user/new.html.twig', [
            'post' => $post,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/user/{url}", name="show_post")
     */
    public function show(string $url, UserTelephoneRepository $userTelephoneRepository)
    {
        $users= $this->getDoctrine()->getRepository(User::class)->find($url);
        if (!$users) {
            return $this->redirect();
        }
        return $this->render('user/user.html.twig', [
            'users' => $users,
            'phone' => $userTelephoneRepository->findBy(['user_id' => $url])
        ]);
    }

    /**
     * @Route("/gelete/{id}", name="user_delete", methods={"DELETE"})
     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user');
    }



}
