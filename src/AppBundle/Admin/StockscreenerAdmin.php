<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

/**
 * Class StockscreenerAdmin
 *
 * @category Admin
 * @package  AppBundle\Admin
 * @author   Anton Serra <aserratorta@gmail.com>
 */
class StockscreenerAdmin extends AbstractBaseAdmin
{
    protected $classnameLabel = 'Stock Screener';
    protected $baseRoutePattern = 'screeners/stock-screener';
    protected $datagridValues = array(
        '_sort_by'    => 'title',
        '_sort_order' => 'desc',
    );

    /**
     * Configure route collection
     *
     * @param RouteCollection $collection
     */
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection
            ->remove('show')
            ->remove('edit')
            ->remove('batch')
            ->add('filter', 'filter');
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('General', $this->getFormMdSuccessBoxArray(7))
            ->add(
                'ticker',
                null,
                array(
                    'label' => 'Ticker',
                )
            )
            ->add(
                'title',
                null,
                array(
                    'label' => 'Títol',
                )
            )
//            ->add(
//                'sector',
//                null,
//                array(
//                    'label' => 'Sector',
//                )
//            )
            ->add(
                'stock',
                null,
                array(
                    'label' => 'Stock',
                )
            )
            ->add(
                'value',
                null,
                array(
                    'label' => 'Valor',
                    'required' => true,
                )
            )
            ->end()
            ->with('Controls', $this->getFormMdSuccessBoxArray(5))
            ->add(
                'enabled',
                'checkbox',
                array(
                    'label'    => 'Actiu',
                    'required' => false,
                )
            )
            ->end();
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add(
                'title',
                null,
                array(
                    'label' => 'Títol',
                )
            )
//            ->add(
//                'sector',
//                null,
//                array(
//                    'label' => 'Sector',
//                    'editable' => true,
//                )
//            )
            ->add(
                'enabled',
                null,
                array(
                    'label' => 'Actiu',
                    'editable' => true,
                )
            );
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        unset($this->listModes['mosaic']);
        $listMapper
            ->add(
                'title',
                null,
                array(
                    'label' => 'Títol',
                    'editable' => true,
                )
            )
            ->add(
                'sector.ticker',
                null,
                array(
                    'label' => 'Ticker',
                )
            )
//            ->add(
//                'sector',
//                null,
//                array(
//                    'label' => 'Super Sector',
//                    'editable' => true,
//                )
//            )
            ->add(
                'stock.ticker',
                null,
                array(
                    'label' => 'Ticker',
                )
            )
            ->add(
                'stock',
                null,
                array(
                    'label' => 'Stock',
                    'editable' => true,
                )
            )
            ->add(
                'value',
                null,
                array(
                    'label' => 'Valor',
                    'required' => true,
                )
            )
            ->add(
                'enabled',
                null,
                array(
                    'label' => 'Actiu',
                    'editable' => true,
                )
            )
            ->add(
                '_action',
                'actions',
                array(
                    'label'   => 'Accions',
                    'actions' => array(
//                        'edit'   => array('template' => '::Admin/Buttons/list__action_edit_button.html.twig'),
                        'delete' => array('template' => '::Admin/Buttons/list__action_delete_button.html.twig'),
                    )
                )
            );
    }
}
