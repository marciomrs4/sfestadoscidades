<?php

namespace Mrs\BlogBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Mrs\BlogBundle\Entity\Cidades;
use Mrs\BlogBundle\Form\CidadesType;

/**
 * Cidades controller.
 *
 * @Route("/cidades")
 */
class CidadesController extends Controller
{

    /**
     * Lists all Cidades entities.
     *
     * @Route("/", name="cidades")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MrsBlogBundle:Cidades')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Cidades entity.
     *
     * @Route("/", name="cidades_create")
     * @Method("POST")
     * @Template("MrsBlogBundle:Cidades:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Cidades();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('cidades_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Cidades entity.
     *
     * @param Cidades $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Cidades $entity)
    {
        $form = $this->createForm(new CidadesType(), $entity, array(
            'action' => $this->generateUrl('cidades_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Cidades entity.
     *
     * @Route("/new", name="cidades_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Cidades();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Cidades entity.
     *
     * @Route("/{id}", name="cidades_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MrsBlogBundle:Cidades')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cidades entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Cidades entity.
     *
     * @Route("/{id}/edit", name="cidades_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MrsBlogBundle:Cidades')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cidades entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Cidades entity.
    *
    * @param Cidades $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Cidades $entity)
    {
        $form = $this->createForm(new CidadesType(), $entity, array(
            'action' => $this->generateUrl('cidades_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Cidades entity.
     *
     * @Route("/{id}", name="cidades_update")
     * @Method("PUT")
     * @Template("MrsBlogBundle:Cidades:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MrsBlogBundle:Cidades')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cidades entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('cidades'));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Cidades entity.
     *
     * @Route("/{id}", name="cidades_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MrsBlogBundle:Cidades')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Cidades entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('cidades'));
    }

    /**
     * Creates a form to delete a Cidades entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('cidades_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
