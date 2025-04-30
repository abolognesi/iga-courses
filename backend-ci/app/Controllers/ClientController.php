<?php

namespace App\Controllers;

use App\Models\ClientModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Controller;

class ClientController extends Controller
{
    use ResponseTrait;

    private $clientModel;

    public function __construct()
    {
        $this->clientModel = new ClientModel();
    }

    /**
     * Retorna todos los clientes
     * @return \CodeIgniter\HTTP\ResponseInterface
     */
    public function index()
    {
        $clients = $this->clientModel->findAll();
        return $this->respond($clients);
    }

    /**
     * Mostrar un cliente específico
     * @param mixed $id
     * @return \CodeIgniter\HTTP\ResponseInterface
     */
    public function show($id)
    {
        $client = $this->clientModel->find($id);
        if ($client) {
            return $this->respond($client);
        } else {
            return $this->failNotFound('Cliente no encontrado');
        }
    }

    /**
     * Crea un nuevo cliente
     * @return \CodeIgniter\HTTP\ResponseInterface
     */
    public function create()
    {
        $data = $this->request->getPost();
        if ($this->clientModel->insert($data)) {
            $response = [
                'status'   => 201,
                'error'    => null,
                'messages' => ['Cliente creado correctamente'],
                'data'     => ['id' => $this->clientModel->getInsertID()]
            ];
            return $this->respondCreated($response);
        } else {
            return $this->fail($this->clientModel->errors());
        }
    }

    /**
     * Actualiza un cliente existente
     * @param mixed $id
     * @return \CodeIgniter\HTTP\ResponseInterface
     */
    public function update($id)
    {
        $client = $this->clientModel->find($id);
        if (!$client) {
            return $this->failNotFound('Cliente no encontrado');
        }
        
        $data = $this->request->getPost();
        if ($this->clientModel->update($id, $data)) {
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => ['Cliente actualizado correctamente']
            ];
            return $this->respond($response);
        } else {
            return $this->fail($this->clientModel->errors());
        }
    }

    /**
     * Elimina un cliente existente
     * @param mixed $id
     * @return \CodeIgniter\HTTP\ResponseInterface
     */
    public function delete($id)
    {
        $cliente = $this->clientModel->find($id);
        if (!$cliente) {
            return $this->failNotFound('Cliente no encontrado');
        }

        if ($this->clientModel->delete($id)) {
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => ['Cliente eliminado correctamente']
            ];
            return $this->respond($response);
        } else {
            return $this->fail('Error al eliminar el cliente');
        }
    }
}