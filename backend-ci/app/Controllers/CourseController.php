<?php

namespace App\Controllers;

use App\Models\CourseModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Controller;

class CourseController extends Controller
{
    use ResponseTrait;

    private $courseModel;

    public function __construct()
    {
        $this->courseModel = new CourseModel();
    }

    /**
     * Devuelve todos los cursos
     * @return \CodeIgniter\HTTP\ResponseInterface
     */
    public function index()
    {
        $courses = $this->courseModel->where('deleted_at', null)->findAll();
        return $this->respond($courses);
    }

    /**
     * Mostrar un curso específico
     * @param mixed $id
     * @return \CodeIgniter\HTTP\ResponseInterface
     */
    public function show($id)
    {
        $course = $this->courseModel->where('id',$id)->where('deleted_at', null)->first();
        if ($course) {
            return $this->respond($course);
        } else {
            return $this->failNotFound('Curso no encontrado'); 
        }
    }

    /**
     * crea un nuevo curso
     * @return \CodeIgniter\HTTP\ResponseInterface
     */
    public function create()
    {
        $validation =  \Config\Services::validation();
        $validation->setRules([
            'name' => 'required',
            'price' => 'required|numeric',
            'image' => 'uploaded[image]|max_size[image,2048]|mime_in[image,image/png,image/jpg,image/jpeg]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->fail($validation->getErrors());
        }
        
        $file = $this->request->getFile('image');
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(ROOTPATH . 'public/uploads', $newName); 
            $data = [
                'name' => $this->request->getPost('name'),
                'description' => $this->request->getPost('description'),
                'price' => $this->request->getPost('price'),
                'details' => $this->request->getPost('details'),
                'image' => 'uploads/' . $newName, 
            ];
            if ($this->courseModel->insert($data)) {
                $response = [
                    'status'   => 201,
                    'error'    => null,
                    'messages' => ['Curso creado correctamente'],
                    'data'     => ['id' => $this->courseModel->getInsertID()]
                ];
                return $this->respondCreated($response); 
            } else {
                return $this->fail($this->courseModel->errors());
            }
        } else {
            return $this->fail('Error al cargar la imagen');
        }
    }

    /**
     * Actualiza un curso existente
     * @param mixed $id
     * @return \CodeIgniter\HTTP\ResponseInterface
     */
    public function update($id)
    {
        $curso = $this->courseModel->where('id',$id)->where('deleted_at', null)->first();
        if (!$curso) {
            return $this->failNotFound('Curso no encontrado');
        }

        $data = $this->request->getPost();

        if ($this->courseModel->update($id, $data)) {
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => ['Curso actualizado correctamente']
            ];
            return $this->respond($response); 
        } else {
            return $this->fail($this->courseModel->errors()); 
        }
    }

    /**
     * elimina un curso existente de la base de datos de forma lógica
     * @param mixed $id
     * @return \CodeIgniter\HTTP\ResponseInterface
     */
    public function delete($id)
    {
        $curso = $this->courseModel->find($id);
        if (!$curso) {
            return $this->failNotFound('Curso no encontrado');
        }

        if ($this->courseModel->update($id, ['deleted_at' => date('Y-m-d H:i:s')])) {
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => ['Curso eliminado correctamente']
            ];
            return $this->respond($response); 
        } else {
            return $this->fail('Error al eliminar el curso'); 
        }
    }

}