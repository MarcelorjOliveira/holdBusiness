<?php

/*
 * This file is part of the Sonata Project package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Application\Sonata\MediaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Entity\SymfonyUser;
use AppBundle\Entity\Project;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class GalleryController extends Controller {

    /**
     * @Security("has_role('ROLE_NORMALUSER')")
     *
     */
    public function indexAction() {
        $galleries = $this->get('sonata.media.manager.gallery')->findBy(array(
            'enabled' => true,
        ));

        return $this->render('ApplicationSonataMediaBundle:Gallery:index.html.twig', array(
                    'galleries' => $galleries,
        ));
    }

    /**
     * @Security("has_role('ROLE_NORMALUSER')")
     *
     */
    public function viewProject($projectId) {
        $galleries = $this->get('sonata.media.manager.gallery')->findBy(array('enabled' => true, 'pin' => $projectId));
        return $this->render('Gallery/viewProject.html.twig', array('galleries' => $galleries, /* 'formularioGalerias' => $formularioGalerias */));
    }

    /**
     * @Security("has_role('ROLE_NORMALUSER')")
     *
     */
    public function viewAction($id) {
        $gallery = $this->get('sonata.media.manager.gallery')->findOneBy(array(
            'id' => $id,
            'enabled' => true,
        ));

        if (!$gallery) {
            throw new NotFoundHttpException('unable to find the gallery with the id');
        }

        return $this->render('ApplicationSonataMediaBundle:Gallery:view.html.twig', array(
                    'gallery' => $gallery,
        ));
    }

    public function fotosAction($id) {

        $objetoSymfonyUser = SymfonyUser::constroi($this->getUser(), $this->getDoctrine());
        $objetoProject = Project::constroi($id, $this->getDoctrine());
//          $form = $this->createForm(GaleriaForm::class, null);

        $galleries = $this->get('sonata.media.manager.gallery')->findBy(array('enabled' => true, 'pin' => $objetoProject->getId()));
        return $this->render('hold/pin/fotos/index.html.twig', array('objetoSymfonyUser' => $objetoSymfonyUser, 'objetoProject' => $objetoProject, 'galleries' => $galleries, /* 'formularioGalerias' => $formularioGalerias */));
    }

}
