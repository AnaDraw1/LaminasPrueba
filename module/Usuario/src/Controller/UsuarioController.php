<?php
namespace Usuario\Controller;

// Add the following import statements at the top of the file:
use Usuario\Form\UsuarioForm;
use Usuario\Model\Usuario;

use Usuario\Model\UsuarioTable;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

use Laminas\Session\Container as SessionContainer;

class UsuarioController extends AbstractActionController
{
 
   // Add this property:
   private $table;

   // Add this constructor:
   public function __construct(UsuarioTable $table)
   {
       $this->table = $table;
   }
 
    public function indexAction()
    {
        return new ViewModel([
            'Usuarios' => $this->table->fetchAll(),
        ]);
    }

    public function addAction()
    {
        $form = new UsuarioForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();

        if (! $request->isPost()) {
            return ['form' => $form];
        }

        $Usuario = new Usuario();
        $form->setInputFilter($Usuario->getInputFilter());
        $form->setData($request->getPost());

        if (! $form->isValid()) {
            return ['form' => $form];
        }

        $Usuario->exchangeArray($form->getData());
        $this->table->saveUsuario($Usuario);
        return $this->redirect()->toRoute('Usuario');
    }

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);

        if (0 === $id) {
            return $this->redirect()->toRoute('Usuario', ['action' => 'add']);
        }

        // Retrieve the Usuario with the specified id. Doing so raises
        // an exception if the Usuario is not found, which should result
        // in redirecting to the landing page.
        try {
            $Usuario = $this->table->getUsuario($id);
        } catch (\Exception $e) {
            return $this->redirect()->toRoute('Usuario', ['action' => 'index']);
        }

        $form = new UsuarioForm();
        $form->bind($Usuario);
        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
        $viewData = ['id' => $id, 'form' => $form];

        if (! $request->isPost()) {
            return $viewData;
        }

        $form->setInputFilter($Usuario->getInputFilter());
        $form->setData($request->getPost());

        if (! $form->isValid()) {
            return $viewData;
        }

        try {
            $this->table->saveUsuario($Usuario);
        } catch (\Exception $e) {
        }

        // Redirect to Usuario list
        return $this->redirect()->toRoute('Usuario', ['action' => 'index']);
    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('Usuario');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');

            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                $this->table->deleteUsuario($id);
            }

            // Redirect to list of Usuarios
            return $this->redirect()->toRoute('Usuario');
        }

        return [
            'id'    => $id,
            'Usuario' => $this->table->getUsuario($id),
        ];
    }
}
?>