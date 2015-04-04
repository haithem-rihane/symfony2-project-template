<?php

namespace Base\UserBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Base\UserBundle\Entity\User;
use Base\UserBundle\Form\UserType;
use APY\DataGridBundle\Grid\Source\Entity;
use APY\DataGridBundle\Grid\Action\RowAction;
use APY\DataGridBundle\Grid\Column\ActionsColumn;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * User controller.
 *
 * @Route("/users")
 */
class UserController extends Controller
{
    /**
     * Lists all User entities.
     *
     * @Route(".html", name="users")
     *
     * @return mixed
     */
    public function indexAction()
    {
        $source = new Entity('BaseUserBundle:User');

        /* @var $grid \APY\DataGridBundle\Grid\Grid */
        $grid = $this->get('grid');

        $grid->setSource($source);
        $grid->setNoResultMessage($this->get('translator')->trans('No data'));

        // Custom colums config.
        $grid->hideColumns('id');

        /* @var $column \APY\DataGridBundle\Grid\Column\Column */
        $column = $grid->getColumn('name');
        $column->setOperators(['like']);
        $column->setOperatorsVisible(false);
        $column->setDefaultOperator('like');
        $column->setTitle($this->get('translator')->trans('form.name', [], 'FOSUserBundle'));

        $column = $grid->getColumn('surname');
        $column->setOperators(['like']);
        $column->setOperatorsVisible(false);
        $column->setDefaultOperator('like');
        $column->setTitle($this->get('translator')->trans('form.surname', [], 'FOSUserBundle'));

        $column = $grid->getColumn('username');
        $column->setOperators(['like']);
        $column->setOperatorsVisible(false);
        $column->setDefaultOperator('like');
        $column->setTitle($this->get('translator')->trans('form.username', [], 'FOSUserBundle'));

        $column = $grid->getColumn('email');
        $column->setOperators(['like']);
        $column->setOperatorsVisible(false);
        $column->setDefaultOperator('like');
        $column->setTitle($this->get('translator')->trans('form.email', [], 'FOSUserBundle'));

        $column = $grid->getColumn('roles');
        $column->setFilterType('select');
        $column->setOperators(['like']);
        $column->setOperatorsVisible(false);
        $column->setDefaultOperator('like');
        $column->setSelectFrom('values');
        $column->setTitle($this->get('translator')->trans('form.role', [], 'FOSUserBundle'));
        $column->setSize(200);
        $column->setValues(
            [
                'ROLE_ADMIN' => $this->get('translator')->trans('admin.role_admin', [], 'FOSUserBundle'),
            ]
        );

        $column = $grid->getColumn('locked');
        $column->setFilterType('select');
        $column->setSelectFrom('values');
        $column->setTitle($this->get('translator')->trans('form.locked', [], 'FOSUserBundle'));
        $column->setSize(110);
        $column->setValues(
            [
                true => $this->get('translator')->trans('positive', [], 'general'),
                false => $this->get('translator')->trans('negative', [], 'general'),
            ]
        );

        // Add actions column.
        $rowAction = new RowAction($this->get('translator')->trans('Edit'), 'user_edit');
        $actionsColumn = new ActionsColumn(
            'info_column',
            $this->get('translator')->trans('Actions'),
            [$rowAction],
            '<br/>'
        );
        $actionsColumn->setSize(110);
        $grid->addColumn($actionsColumn);

        return $grid->getGridResponse('BaseUserBundle::User\index.html.twig');
    }

    /**
     * Displays a form to edit an existing User entity.
     *
     * @param int $id
     *
     * @Route("/{id}/edit.html", name="user_edit")
     * @Method("GET")
     * @Template()
     *
     * @throws NotFoundHttpException
     *
     * @return mixed
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BaseUserBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $editForm = $this->createEditForm($entity);

        return [
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
        ];
    }

    /**
     * Creates a form to edit a User entity.
     *
     * @param User $entity The entity.
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(User $entity)
    {
        $form = $this->createForm(
            new UserType(),
            $entity,
            [
                'action' => $this->generateUrl('user_update', ['id' => $entity->getId()]),
                'method' => 'PUT',
            ]
        );

        $form->add('submit', 'submit', ['label' => 'Update']);

        return $form;
    }

    /**
     * Edits an existing User entity.
     *
     * @param Request $request
     * @param int     $id
     *
     * @Route("/{id}", name="user_update")
     * @Method("PUT")
     * @Template("BaseUserBundle:User:edit.html.twig")
     *
     * @throws NotFoundHttpException
     *
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BaseUserBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            $this->container->get('session')->getFlashBag()->set('notice', 'profile.flash.updated');

            return $this->redirect($this->generateUrl('user_edit', ['id' => $id]));
        }

        return [
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
        ];
    }
}
