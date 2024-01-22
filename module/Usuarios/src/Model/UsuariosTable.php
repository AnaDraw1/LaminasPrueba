<?php
namespace Usuarios\Model;

use RuntimeException;
use Laminas\Db\TableGateway\TableGatewayInterface;

class UsuariosTable
{
    private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        return $this->tableGateway->select();
    }

    public function getUsuarios($id)
    {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(['id' => $id]);
        $row = $rowset->current();
        if (! $row) {
            throw new RuntimeException(sprintf(
                'Could not find row with identifier %d',
                $id
            ));
        }

        return $row;
    }

    public function saveUsuarios(Usuarios $Usuarios)
    {
        $data = [
            'Usuario' => $Usuarios->Usuario,
            'Email'  => $Usuarios->Email,
            'Contra'  => $Usuarios->Contra,
        ];

        $id = (int) $Usuarios->id;

        if ($id === 0) {
            $this->tableGateway->insert($data);
            return;
        }

        try {
            $this->getUsuarios($id);
        } catch (RuntimeException $e) {
            throw new RuntimeException(sprintf(
                'Cannot update Usuarios with identifier %d; does not exist',
                $id
            ));
        }

        $this->tableGateway->update($data, ['id' => $id]);
    }

    public function deleteUsuarios($id)
    {
        $this->tableGateway->delete(['id' => (int) $id]);
    }
}
?>