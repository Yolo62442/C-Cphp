<?php
class Recipe{
    private $id ;
    private $title;
    private $step1;
    private $step2;
    private $step3;
    private $type;
    private $user_id;
    private $rating;
    function __construct($id, $title, $step1, $step2, $step3, $type, $user_id, $rating){
        $this->id = $id;
        $this->title = $title;
        $this->step1 = $step1;
        $this->step2 = $step2;
        $this->step3 = $step3;
        $this->type = $type;
        $this->user_id = $user_id;
        $this->rating = $rating;
    }
    public function getId(){
        return $this->id;
    }
    public function getTitle(){
        return $this->title;
    }
    public function getStep1(){
        return $this->step1;
    }
    public function getStep2(){
        return $this->step2;
    }
    public function getStep3(){
        return $this->step3;
    }
    public function getType(){
        return $this->type;
    }
    public function getUserId(){
        return $this->user_id;
    }
    public function getRating(){
        return $this->rating;
    }
}
 ?>
