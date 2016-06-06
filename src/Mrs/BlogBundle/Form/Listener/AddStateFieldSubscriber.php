<?php
namespace Mrs\BlogBundle\Form\Listener;

use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Doctrine\ORM\EntityRepository;

class AddStateFieldSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return array(
            FormEvents::PRE_SET_DATA => 'preSetData',
            FormEvents::PRE_SUBMIT => 'preSubmit'
        );
    }

    public function preSetData(FormEvent $event)
    {
        $user = $event->getData(); //data es un objeto AppBundle\Entity\User

        // Pasamos siempre el country así sea null
        // para que cuando sea un usuario nuevo, el listado de estados esté
        // vacio inicialmente, y solo se llene de items, cuando se ejecute el
        // ajax que obtiene los estados del pais seleccionado por el usuario.

        $estado = ($user and $user->getEstado()) ? $user->getEstado() : null; // Importante los parentesis al usar "and".

        // Es importante siempre verificar que el valor devuelto por $event->getData()
        // (que en este caso es $user) no sea null, porque no es obligatorio que al crear
        // el formulario, se le pase una instancia de User,
        // y si no se le pasa, User será nulo.

        $this->addField($event->getForm(),  $estado);
    }

    /**
     * Cuando el usuario llene los datos del formulario y haga el envío del mismo,
     * este método será ejecutado.
     */
    public function preSubmit(FormEvent $event)
    {
        $data = $event->getData();
//data es un arreglo con los valores establecidos por el usuario en el form.

//como $data contiene el pais seleccionado por el usuario al enviar el formulario,
// usamos el valor de la posicion $data['country'] para filtrar el sql de los estados
        $this->addField($event->getForm(), $data['estado']);
    }

    protected function addField(Form $form, $estados)
    {
// actualizamos el campo state, pasandole el country a la opción
// query_builder, para que el dql tome en cuenta el pais
// y filtre la consulta por su valor.
        $form->add('cidade', 'entity', array(
            'class' => 'Mrs\BlogBundle\Entity\Cidades',
            'query_builder' => function(EntityRepository $er) use ($estados){
                return $er->createQueryBuilder('cidades')
                    ->where('cidades.estados_id = :estado')
                    ->setParameter('estado', $estados);
            }
        ));
    }
}