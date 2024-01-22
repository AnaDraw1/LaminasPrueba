<?php
namespace Usuario\Form;

use Laminas\Form\Form;

class UsuarioForm extends Form
{
    public function __construct($name = null)
    {
        // We will ignore the name provided to the constructor
        parent::__construct('Usuario');

        $this->add([
            'name' => 'id',
            'type' => 'hidden',
        ]);
        $this->add([
            'name' => 'User',
            'type' => 'text',
            'options' => [
                'label' => 'User',
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