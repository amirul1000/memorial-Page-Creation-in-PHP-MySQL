<?php  
require('./global.php');
class Memoryclass {
    private $db;
    function __construct() {
        $conn = dbconnect();
        $this->db = $conn; 
    }
    //Add memory
    public function add_memory($memorial_id,$data){
        //return $memorial_id;
        $memorial = get_memorial_by_id($memorial_id);
        if($memorial){
            extract($data);
            $query = "INSERT INTO memories (memorial_id,user_name, memory)
                      VALUES('$memorial[id]','$user_name', '$memory')";
            $insert = mysqli_query($this->db, $query);
            if($insert){
				$last_id = mysqli_insert_id($this->db);
				//Add an activity
				$activity_query = "INSERT INTO memorial_activity (memorial_id,memory_added,memory_id)
									VALUES('$memorial[id]',1,'$last_id')";
				$insert_activity = mysqli_query($this->db, $activity_query);
                return true;
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
    }
    //Add visit logs
    public function add_visit_log($memorial_id,$visitor_name){
        $memorial = get_memorial_by_id($memorial_id);
        if($memorial){
            $query = "INSERT INTO visit_logs (memorial_id,visitor_name)
                      VALUES('$memorial[id]','$visitor_name')";
            $insert = mysqli_query($this->db, $query);
            if($insert){               
                return true;
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
    }
    public function get_visitor($memorial_id){
        $memorial = get_memorial_by_id($memorial_id);
        if($memorial){
            $query = "INSERT INTO visit_logs (memorial_id,visitor_name)
                      VALUES('$memorial[id]','$visitor_name')";
            $insert = mysqli_query($this->db, $query);
            if($insert){               
                return true;
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
    }
}  
?>