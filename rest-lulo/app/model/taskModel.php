<?php

class taskModel{

    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_tasks;charset=utf8', 'root', '');
    }


    function getAll(){
        $query = $this->db->prepare('SELECT * FROM task');
        $query->execute();
        
        $tasks= $query->fetchAll(PDO::FETCH_OBJ);

        return $tasks;
    }

    function getOne($id){
        $query = $this->db->prepare('SELECT * FROM task WHERE id=?');
        $query->execute([$id]);

        $task = $query->fetch(PDO::FETCH_OBJ);

        return $task;

    }

    function deleteOne($id){
        $query = $this->db->prepare('DELETE FROM task WHERE id = ?');
        $query->execute([$id]);
    }

    function insertTask($title, $description, $priority){
        $query = $this->db->prepare('INSERT INTO task (titulo, descripcion, prioridad, finalizada) VALUES (?, ?, ?, ?)');
        $query->execute([$title, $description, $priority, false]);

        return $this->db->lastInsertId(); 
        //devuelvo el ultimo id ,en este caso devuelvo la ultima tarea que agregue
    }

    function updateTask($id,$task){
        $query = $this->db->prepare('UPDATE task SET titulo=?,descripcion=?,prioridad=?,finalizada=? WHERE id=?');
        $query->execute(array($task->titulo,$task->descripcion,$task->prioridad,$task->finalizada,$id));
    }


}