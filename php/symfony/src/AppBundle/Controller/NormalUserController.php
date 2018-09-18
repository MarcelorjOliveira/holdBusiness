<?php

namespace AppBundle\Controller;
use AppBundle\Entity\Seguir;

use AppBundle\Entity\NormalUser;
use AppBundle\Entity\SymfonyUser;
use AppBundle\Form\NormalUserForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class NormalUserController extends Controller {

    /**
     * @Route("/index/normalUser")
     */
    public function indexAction(Request $request) {

        if (!empty($request->request->get('email')) && !empty($request->request->get('senhaPlana'))) {

            $normalUser = new NormalUser();

            $em = $this->getDoctrine()->getManager();

            $normalUser->setEmail($request->request->get('email'));

            $normalUser->setSenhaPlana($request->request->get('senhaPlana'));

            $senha = $this->get('security.password_encoder')->encodePassword($normalUser, $normalUser->getSenhaPlana());

            $normalUser->setSenha($senha);

            $normalUser->setRegra('ROLE_NORMALUSER');

            $normalUser->setCriado(new \DateTime);

            $em->persist($normalUser);

            $em->flush();

            return $this->redirectToRoute('homepage');
        }

        return $this->render('normalUser/index.html.twig', array(
                'teste' => 'teste'  ,
        ));
    }

}
