<?php
namespace Usuarios\Controller;

// Add the following import statements at the top of the file:
use Usuarios\Form\UsuariosForm;
use Usuarios\Model\Usuarios;

use Usuarios\Model\UsuariosTable;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

use Laminas\Session\Container as SessionContainer;

class UsuariosController extends AbstractActionController
{
 
   // Add this property:
   private $table;

   // Add this constructor:
   public function __construct(UsuariosTable $table)
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
        $form = new UsuariosForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();

        if (! $request->isPost()) {
            return ['form' => $form];
        }

        $Usuarios = new Usuarios();
        $form->setInputFilter($Usuarios->getInputFilter());
        $form->setData($request->getPost());

        if (! $form->isValid()) {
            return ['form' => $form];
        }

        $Usuarios->exchangeArray($form->getData());
        $this->table->saveUsuarios($Usuarios);
        return $this->redirect()->toRoute('Usuarios');
    }

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);

        if (0 === $id) {
            return $this->redirect()->toRoute('Usuarios', ['action' => 'add']);
        }

        // Retrieve the Usuarios with the specified id. Doing so raises
        // an exception if the Usuarios is not found, which should result
        // in redirecting to the landing page.
        try {
            $Usuarios = $this->table->getUsuarios($id);
        } catch (\Exception $e) {
            return $this->redirect()->toRoute('Usuarios', ['action' => 'index']);
        }

        $form = new UsuariosForm();
        $form->bind($Usuarios);
        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
        $viewData = ['id' => $id, 'form' => $form];

        if (! $request->isPost()) {
            return $viewData;
        }

        $form->setInputFilter($Usuarios->getInputFilter());
        $form->setData($request->getPost());

        if (! $form->isValid()) {
            return $viewData;
        }

        try {
            $this->table->saveUsuarios($Usuarios);
        } catch (\Exception $e) {
        }

        // Redirect to Usuarios list
        return $this->redirect()->toRoute('Usuarios', ['action' => 'index']);
    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('Usuarios');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');

            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                $this->table->deleteUsuarios($id);
            }

            // Redirect to list of Usuarioss
            return $this->redirect()->toRoute('Usuario');
        }

        return [
            'id'    => $id,
            'Usuario' => $this->table->getUsuarios($id),
        ];
    }
}
?>