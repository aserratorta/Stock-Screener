<?php

namespace AppBundle\Controller\Admin;

use Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class StockscreenerAdminController
 *
 * @category Controller
 * @package  AppBundle\Controller\Admin
 * @author   David Romaní <david@flux.cat>
 */
class StockscreenerAdminController extends BaseAdminController
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
        $stockScreenersList = $this->getDoctrine()->getRepository('AppBundle:Stockscreener')->filterScreenersSortedByValue();

        return $this->render(
            '::Admin/Filters/filters_form.html.twig',
            array(
                'action'   => 'show',
                'object'   => array(),
                'elements' => $this->admin->getShow(),
                'stockScreenersList' => $stockScreenersList,
            ),
            null,
            $request
        );
    }
}
