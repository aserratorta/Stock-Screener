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
//        $object = $request->get($this->admin->g);

        $form = $this->createForm(FilterType::class);
        $form->handleRequest($request);
//        if ($form->isSubmitted() && $form->isValid()) {
//            $screener = $form->getData();

//        }

        $screenersList = $this->getDoctrine()->getRepository('AppBundle:Screener')->filterScreenersSortedByValue();

        return $this->render(
            '::Admin/Filters/filters_form.html.twig',
            array(
                'action'   => 'show',
                'object'   => array(),
                'form'     => $form->createView(),
                'elements' => $this->admin->getShow(),
                'screenersList' => $screenersList,
            ),
            null,
            $request
        );
    }
}
