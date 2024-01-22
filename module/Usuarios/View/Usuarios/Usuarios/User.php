<?php
namespace Usuarios\Model\Rowset;

use Laminas\Filter\ToInt;

class User extends AbstractModel implements \Laminas\InputFilter\InputFilterAwareInterface
{

    public $inputFilter = null;

    public $User = null;

    public $Email = null;

    public $Contra = null;

    public $id = null;

    public function getUser()
    {
        return $this->User;
    }

    public function setUser($value)
    {
        $this->User = $value;
        return $this;
    }

    public function getEmail()
    {
        return $this-> Email;
    }

    public function setEmail($value)
    {
        $this-> Email = $value;
        return $this;
    }

    public function getContra()
    {
        return $this-> Contra;
    }

    public function setContra($value)
    {
        $this-> Contra = $value;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($value)
    {
        $this->id = $value;
        return $this;
    }

    public function exchangeArray(array $row)
    {
        $this->id = (!empty($row['id'])) ? $row['id'] : null;
        $this->User = (!empty($row['User'])) ? $row['User'] : null;
        $this-> Email = (!empty($row[' Email'])) ? $row[' Email'] : null;
        $this-> Contra = (!empty($row[' Contra'])) ? $row[' Contra'] : null;
        $this->id = (!empty($row['id'])) ? $row['id'] : null;
    }

    
    public function getArrayCopy()
    {
        return[
            'id' => $this->getId(),
            'User' => $this->getUser(),
            'Email' => $this->getEmail(),
            'Contra' => $this->getContra(),
            'id' => $this->getId(),
        ];
    }

    public function getInputFilter(bool $includeIdField = true)
    {
        if ($this->inputFilter) {
            return $this->inputFilter;
        }

        $inputFilter = new \Laminas\InputFilter\InputFilter();

        if ($includeIdField) {
            $inputFilter->add([
                'name' => 'id',
                'required' => true,
                'filters' => [
                    ['name' => ToInt::class],
                ],
            ]);
        }
        $inputFilter->add([
            'name' => 'User',
        ]);

        $inputFilter->add([
            'name' => ' Email',
        ]);

        $inputFilter->add([
            'name' => ' Contra',
        ]);


        $this->inputFilter = $inputFilter;
        return $inputFilter;
    }

    public function setInputFilter(\Laminas\InputFilter\InputFilterInterface $inputFilter)
    {
        throw new DomainException('This class does not support adding of extra input filters');
    }


}
?>