<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Form\Type\FilterType;
use Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class ScreenerAdminController
 *
 * @category Controller
 * @package  AppBundle\Controller\Admin
 * @author   David Romaní <david@flux.cat>
 */
class ScreenerAdminController extends BaseAdminController
{
    /**
     * Filter action
     *
     * @param int|string|null $id
     * @param Request         $request
     *
     * @return Response
     * @throws NotFoundHttpException If the object does not exist
     * @throws AccessDeniedException If access is not granted
     */
    public function filterAction(Request $request = null)
    {
        $request = $this->resolveRequest($request);

        //TODO

        $form = $this->createForm(FilterType::class);
        $form->handleRequest($request);
//        if ($form->isSubmitted() && $form->isValid()) {
//             persist new contact message form record
//            $object->setAnswered(true);
//            $em = $this->getDoctrine()->getManager();
//            $em->persist($object);
//            $em->flush();
//        }

        return $this->render(
            '::Admin/Filters/filters_form.html.twig',
            array(
                'action'   => 'show',
                'object'   => array(),
                'form'     => $form->createView(),
                'elements' => $this->admin->getShow(),
            ),
            null,
            $request
        );
    }
}
