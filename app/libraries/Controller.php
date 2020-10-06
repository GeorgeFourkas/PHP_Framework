<?php

    /*
    * Base Controller
    * Loads the Models And View
    */
    class Controller{
        //load Model

        //IF WE WANT TO CREATE A NEW USER FOR EXAMPLE WE CALL THIS FUNTION AND IT CREATES A NEW USER.SAME WITH POSTS ETC
        public function model($model){

            // require model file

            require_once '../app/models/'.$model.'.php';

            //instantiate Model

            return new $model();
        }

        //Load View

        public function view($view, $data = []){
            //check for the view file
            if(file_exists('../app/views/' .$view . '.php')){
                require_once '../app/views/' .$view . '.php';
            }else{
                //view doesnt exist
                die('view doesnt exists :(');
            }
        }
    }


