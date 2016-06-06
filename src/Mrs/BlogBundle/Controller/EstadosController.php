<?php

namespace Mrs\BlogBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Mrs\BlogBundle\Entity\Estados;
use Mrs\BlogBundle\Form\EstadosType;

/**
 * Estados controller.
 *
 */
class EstadosController extends Controller
{

    /**
     * Lists all Estados entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MrsBlogBundle:Estados')->findAll();

        return $this->render('MrsBlogBundle:Estados:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Estados entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Estados();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
        
//         $validator = $this->get('validator');
//         $errors = $validator->validate($entity,array('criacao'));
//         

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('estados_show', array('id' => $entity->getId())));
        }

        return $this->render('MrsBlogBundle:Estados:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Estados entity.
     *
     * @param Estados $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Estados $entity)
    {
        $form = $this->createForm(new EstadosType(), $entity, array(
            'validation_groups' => array('criacao'),
            'action' => $this->generateUrl('estados_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Estados entity.
     *
     */
    public function newAction()
    {
        $entity = new Estados();
        $form   = $this->createCreateForm($entity);

        return $this->render('MrsBlogBundle:Estados:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Estados entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MrsBlogBundle:Estados')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Estados entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('MrsBlogBundle:Estados:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Estados entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MrsBlogBundle:Estados')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Estados entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('MrsBlogBundle:Estados:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Estados entity.
    *
    * @param Estados $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Estados $entity)
    {
        $form = $this->createForm(new EstadosType(), $entity, array(
            'validation_groups' => array('atualizacao'),
            'action' => $this->generateUrl('estados_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Estados entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MrsBlogBundle:Estados')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Estados entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('estados_show', array('id' => $id)));
        }

        return $this->render('MrsBlogBundle:Estados:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Estados entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MrsBlogBundle:Estados')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Estados entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('estados'));
    }

    /**
     * Creates a form to delete a Estados entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('estados_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
