<?php
namespace Usuarios\Form;

use Laminas\Form\Form;

class UsuariosForm extends Form
{
    public function __construct($name = null)
    {
        // We will ignore the name provided to the constructor
        parent::__construct('Usuarios');

        $this->add([
            'name' => 'id',
            'type' => 'hidden',
        ]);
        $this->add([
            'name' => 'Usuario',
            'type' => 'text',
            'options' => [
                'label' => 'Usuario',
            ],
        ]);
        $this->add([
            'name' => 'Email',
            'type' => 'text',
            'options' => [
                'label' => 'Email',
            ],
        ]);
        $this->add([
            'name' => 'Contra',
            'type' => 'text',
            'options' => [
                'label' => 'Contra',
            ],
        ]);
        $this->add([
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => [
                'value' => 'Go',
                'id'    => 'submitbutton',
            ],
        ]);
    }
}
?>