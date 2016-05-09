<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

/**
 * Class StockAdmin
 *
 * @category Admin
 * @package  AppBundle\Admin
 * @author   Anton Serra <aserratorta@gmail.com>
 */
class StockAdmin extends AbstractBaseAdmin
{
    protected $classnameLabel = 'Stock';
    protected $baseRoutePattern = 'screeners/stock';
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
            ->remove('batch');
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
            ->add(
                'sector',
                null,
                array(
                    'label' => 'Sector',
                    'required' => true,
                )
            )
            ->add(
                'exchange',
                null,
                array(
                    'label' => 'Exchange',
                )
            )
            ->end()
            ->with('Controls', $this->getFormMdSuccessBoxArray(5))
            ->add(
                'capAmount',
                null,
                array(
                    'label' => 'capAmount',
                )
            )
            ->add(
                'capCategory',
                null,
                array(
                    'label' => 'capCategory',
                )
            )
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
            ->add(
                'exchange',
                null,
                array(
                    'label' => 'Exchange',
                )
            )
            ->add(
                'capAmount',
                null,
                array(
                    'label' => 'capAmount',
                )
            )
            ->add(
                'capCategory',
                null,
                array(
                    'label' => 'capCategory',
                )
            )
            ->add(
                'sector',
                null,
                array(
                    'label' => 'Sector',
                )
            )
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
                    'editable' => true,
                )
            )
            ->add(
                'exchange',
                null,
                array(
                    'label' => 'Exchange',
                    'editable' => true,
                )
            )
            ->add(
                'capAmount',
                null,
                array(
                    'label' => 'capAmount',
                    'editable' => true,
                )
            )
            ->add(
                'capCategory',
                null,
                array(
                    'label' => 'capCategory',
                    'editable' => true,
                )
            )
            ->add(
                'sector',
                null,
                array(
                    'label' => 'Sector',
                    'editable' => true,
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
                        'edit'   => array('template' => '::Admin/Buttons/list__action_edit_button.html.twig'),
                        'delete' => array('template' => '::Admin/Buttons/list__action_delete_button.html.twig'),
                    )
                )
            );
    }
}
