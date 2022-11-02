<?php

require_once 'app/model/taskModel.php';
require_once 'app/view/Api.View.php';


class apiController{
    private $view;
    private $model;
    private $data;

    function __construct(){

        $this->view = new apiView();
        $this->model = new taskModel();
        $this->data = file_get_contents("php://input");
    
    }

   

    private function getData() {
        return json_decode($this->data);
    }



    function getTasks($params = null){

        $tasks = $this->model->getAll();
        $this->view->response($tasks);

    }

    function getTask($params= null){
        $id = $params[':ID'];

        $task = $this->model->getOne($id);

       
        
        if($task){
            $this->view->response($task);
        }
        else{
            $this->view->response("La tarea con el id=$id no existe", 404);
        }
    }


    function deleteTask($params = null){

        $id = $params[':ID'];

        $task = $this->model->getOne($id);

        if($task){
            $this->model->deleteOne($id);
            $this->view->response($task);
        }

        else{
            $this->view->response("La tarea con el id=$id no existe", 404);
        }

    }

    function insertTask($params = null){

        $task = $this->getData();

        if (empty($task->titulo) || empty($task->descripcion) || empty($task->prioridad)) {
            $this->view->response("Complete los datos", 400);
        } else {
            $id = $this->model->insertTask($task->titulo, $task->descripcion, $task->prioridad);
            $task = $this->model->getOne($id);
            $this->view->response($task, 201);
        }
    }


    function updateTask($params = null){

        $id = $params[':ID'];
        
        $task = $this->getData(); //Agarra lo q mando en postman y lo pasa a json

        if($task){
            $this->model->updateTask($id,$task);
            $this->view->response($task);
            $this->view->response("La tarea con el id=$id FUE CREADA CON EXITO", 201);
        }

        else{
            $this->view->response("La tarea con el id=$id no existe", 404);
        }
    }
    
}