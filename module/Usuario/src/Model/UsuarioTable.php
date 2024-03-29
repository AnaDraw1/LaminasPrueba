<?php
namespace Usuario\Model;

use RuntimeException;
use Laminas\Db\TableGateway\TableGatewayInterface;

class UsuarioTable
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

    public function getUsuario($id)
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

    public function saveUsuario(Usuario $Usuario)
    {
        $data = [
            'User' => $Usuario->User,
            'Email'  => $Usuario->Email,
            'Contra'  => $Usuario->Contra,
        ];

        $id = (int) $Usuario->id;

        if ($id === 0) {
            $this->tableGateway->insert($data);
            return;
        }

        try {
            $this->getUsuario($id);
        } catch (RuntimeException $e) {
            throw new RuntimeException(sprintf(
                'Cannot update Usuario with identifier %d; does not exist',
                $id
            ));
        }

        $this->tableGateway->update($data, ['id' => $id]);
    }

    public function deleteUsuario($id)
    {
        $this->tableGateway->delete(['id' => (int) $id]);
    }
}
?>