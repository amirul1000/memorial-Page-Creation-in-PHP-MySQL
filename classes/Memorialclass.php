<?php  
require('./global.php');
class Memorialclass {
    private $db;
    function __construct() {
        $conn = dbconnect();
        $this->db = $conn; 
    }
    
    public function add_memorial($user_id,$data){
        $user_check = get_user_by_user_id($user_id);
        if($user_check){
            extract($data);
            $query = "INSERT INTO memorial_details (`user_id`,`full_name`,`english_full_name`, `date_of_birth`, `date_of_passing`, `h_date_of_birth`, `h_date_of_passing`, `memorial_location`, `place_before_death`, `cause_of_death`, `religion`, `height`, `education`, `army_service`, `occupation`, `hobbies`, `social_links`, `prayer`, `profile_pic`, `background_image`,`facebook`,`instagram`)
            VALUES('$user_id','$full_name','$english_full_name', '$date_of_birth', '$date_of_passing', '$h_date_of_birth', '$h_date_of_passing', '$memorial_location', '$place_before_death', '$cause_of_death', '$religion', '$height', '$education', '$army_service', '$occupation', '$hobbies', '$social_links', '$prayer', '$profile_pic', '$background_image','$facebook','$instagram')";
			
            $insert = mysqli_query($this->db, $query);
            if($insert){
                $last_id = mysqli_insert_id($this->db);
                if($gallery_images){
                    $pictures = serialize(($gallery_images));
                    $gallery_query = "INSERT INTO pictures (user_id,memorial_id,other_pictures)
                                    VALUES('$user_id','$last_id', '$pictures')";
                    $insert = mysqli_query($this->db, $gallery_query);
                }
                if($memorial_videos){
                    $videos = serialize(($memorial_videos));
                    $video_query = "INSERT INTO videos (`user_id`,`memorial_id`,`videos`)
                                    VALUES('$user_id','$last_id', '$videos')";
                    $insert = mysqli_query($this->db, $video_query);
                }
                $returndata = array(
                    'message' => 'התווסף בהצלחה',
                    'id' => $last_id
                );
                return $returndata;
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
    }
    //Get memorial details by user_id
    public function get_detail($user_id){
        $user_check = get_user_by_user_id($user_id);
        if($user_check != false){
            $memorial_query = "SELECT * FROM memorial_details WHERE user_id='$user_check[id]' LIMIT 1";
            $result = mysqli_query($this->db, $memorial_query);
            $memorial_details = mysqli_fetch_assoc($result);
            if($memorial_details){
                //Memorial photos
                $photos_query = "SELECT other_pictures FROM pictures WHERE memorial_id ='$memorial_details[id]'";
                $result = mysqli_query($this->db, $photos_query);
                $photos = mysqli_fetch_assoc($result); 
                //Memorial Videos
                $videos_query = "SELECT videos FROM videos WHERE memorial_id ='$memorial_details[id]'";
                $result = mysqli_query($this->db, $videos_query);
                $videos = mysqli_fetch_assoc($result);

                $data = array(
                    'details' => !empty($memorial_details) ? $memorial_details : '',
                    'images' => !empty($photos['other_pictures']) ? $photos['other_pictures'] : '',
                    'videos' => !empty($videos['videos']) ? $videos['videos'] : '',
                );
                return $data;
            }
            else{
                return false;
            }
        }
    }
    //Get memorial details by memorial_id
    public function get_detail_by_memorial_id($memorial_id){
        if(empty($memorial_id)){
            return 'Memorial id can not be empty';
        }

        $memorial_query = "SELECT * FROM memorial_details WHERE id ='$memorial_id' LIMIT 1";
        $result = mysqli_query($this->db, $memorial_query);
        $memorial_details = mysqli_fetch_assoc($result);
        if($memorial_details){
            //Memorial photos
            $photos_query = "SELECT other_pictures FROM pictures WHERE memorial_id ='$memorial_details[id]'";
            $result = mysqli_query($this->db, $photos_query);
            $photos = mysqli_fetch_assoc($result); 
            //Memorial Videos
            $videos_query = "SELECT videos FROM videos WHERE memorial_id ='$memorial_details[id]'";
            $result = mysqli_query($this->db, $videos_query);
            $videos = mysqli_fetch_assoc($result);
            //count visitors on memorial
            $counter_query = "SELECT * FROM visit_logs WHERE memorial_id ='$memorial_details[id]'";
            $result = mysqli_query($this->db, $counter_query);
            $visit_count = mysqli_num_rows($result);

            //memories
            $memory_query = "SELECT * FROM memories WHERE memorial_id ='$memorial_details[id]' ORDER BY created_at DESC";
            $result = mysqli_query($this->db, $memory_query);
            $memories = mysqli_fetch_all($result,MYSQLI_ASSOC);
            //visitors
            $visitors_query = "SELECT * FROM visit_logs WHERE memorial_id ='$memorial_details[id]' ORDER BY created_at DESC";
            $result = mysqli_query($this->db, $visitors_query);
            $all_visitors = mysqli_fetch_all($result,MYSQLI_ASSOC);
			//Visitor Media
            $media_query = "SELECT * FROM media WHERE memorial_id ='$memorial_details[id]' ORDER BY created_at DESC";
            $result = mysqli_query($this->db, $media_query);
            $all_visitor_media = mysqli_fetch_all($result,MYSQLI_ASSOC);
            
			//Timeline
			$get_timeline = $this->timeline($memorial_details['id']);
			if($get_timeline){
				foreach($get_timeline as $tim){
					$timelinedata = [];
					if($tim['memory_added'] == 1){
						$timelinedata['memory'] = $this->get_memory_by_id($tim['memory_id']);
					}
					if($tim['media_added'] == 1){
						$timelinedata['media'] = $this->get_media_by_id($tim['media_id']);
					}
				}
			}
            $data = array(
                'details' => !empty($memorial_details) ? $memorial_details : '',
                'images' => !empty($photos['other_pictures']) ? $photos['other_pictures'] : '',
                'videos' => !empty($videos['videos']) ? $videos['videos'] : '',
                'visit_counts' => !empty($visit_count) ? $visit_count : '',
                'memories' => !empty($memories) ? $memories : '',
                'all_visitors' => !empty($all_visitors) ? $all_visitors : '',
                'all_visitor_media' => !empty($all_visitor_media) ? $all_visitor_media : '',
                'timeline' => !empty($timelinedata) ? $timelinedata : '',
                
            );
            return $data;
        }
        else{
            return false;
        }
    }

    public function edit_detail($id,$data){
        $memorial_check_query = "SELECT * FROM memorial_details WHERE id='$id' LIMIT 1";
        $result = mysqli_query($this->db, $memorial_check_query);
        $memorial = mysqli_fetch_assoc($result);
        if($memorial){
            extract($data);
            $query = "update memorial_details set full_name = '$full_name', date_of_birth = '$date_of_birth',date_of_passing = '$date_of_passing',h_date_of_birth = '$h_date_of_birth',h_date_of_passing = '$h_date_of_passing',memorial_location = '$memorial_location',place_before_death = '$place_before_death', cause_of_death = '$cause_of_death',religion = '$religion',height = '$height',education = '$education',army_service = '$army_service',occupation = '$occupation',hobbies = '$hobbies',social_links = '$social_links',prayer = '$prayer', profile_pic = '$profile_pic',background_image = '$background_image' where id='$id'";
            
            $edit = mysqli_query($this->db, $query);
            if($edit){
                return true;
            }
            else{
               return false;
            }
        }
    }
	
	public function update_qr_photo_url($id,$data){
            extract($data);
			$query = "update memorial_details set qr_photo_url = '$qr_photo_url' where id='$id'";
            $edit = mysqli_query($this->db, $query);
            if($edit){
                return true;
            }
            else{
               return false;
            }
    }
	
    //Add visit logs
    public function add_visit_log($memorial_id,$visitor_name){
        $data = [];
		session_start();
        $memorial = get_memorial_by_id($memorial_id);		
        if($memorial){
            $query = "INSERT INTO visit_logs (memorial_id,visitor_name)
                      VALUES('$memorial[id]','$visitor_name')";
            $insert = mysqli_query($this->db, $query);
            if($insert){               
                $data = array(
					'success' => true,
					'message' => 'התווסף בהצלחה'
				);
                return json_encode($data);
            }
            else{
                $data = array(
					'success' => false,
					'message' => 'Data not added'
				);
                return json_encode($data);
            }
        }
        else{
            $data = array(
                'success' => false,
                'message' => 'Something went wrong'
            );
            return json_encode($data);
        }
    }
	//Add photo by visitor
    public function add_media_by_visitor($memorial_id,$photo){
        $memorial = get_memorial_by_id($memorial_id);
        if($memorial){
            $query = "INSERT INTO media (memorial_id,media_url)
                      VALUES('$memorial[id]','$photo')";
            $insert = mysqli_query($this->db, $query);
            if($insert){
				$last_id = mysqli_insert_id($this->db);
				//Add an activity
				$activity_query = "INSERT INTO memorial_activity (memorial_id,media_added,media_id)
									VALUES('$memorial[id]',1,'$last_id')";
				$insert_activity = mysqli_query($this->db, $activity_query);				
                return true;
            }
            else{
                return false;
            }
        }
        else{
           false;
        }
    }
	//Timeline
	public function timeline($memorial_id){
		$memorial = get_memorial_by_id($memorial_id);
		if($memorial){
			$activity_query = "SELECT * FROM memorial_activity WHERE memorial_id ='$memorial[id]' ORDER BY created_at DESC";
            $result = mysqli_query($this->db, $activity_query);
            $memories = mysqli_fetch_all($result,MYSQLI_ASSOC);
			if($memories){
				return $memories;
			}
			else{
				return false;
			}
		}
		return false;
	}
	//get media
	public function get_media_by_id($id){
		$media_check_query = "SELECT media_url FROM media WHERE id='$id' LIMIT 1";
		$result = mysqli_query($this->db, $media_check_query);
		$media = mysqli_fetch_assoc($result);
		if($media){
			return $media;
		}
		else{
			return false;
		}
	}
	//get memory
	public function get_memory_by_id($id){
		$memory_check_query = "SELECT memory FROM memories WHERE id='$id' LIMIT 1";
		$result = mysqli_query($this->db, $memory_check_query);
		$memory = mysqli_fetch_assoc($result);
		if($memory){
			return $memory;
		}
		else{
			return false;
		}
	}
	//Add memory
	public function add_memory($memorial_id,$memory){
		$data = [];
        $memorial = get_memorial_by_id($memorial_id);
        if($memorial){
            $query = "INSERT INTO memories (memorial_id, memory)
                      VALUES('$memorial[id]','$memory')";
            $insert = mysqli_query($this->db, $query);
            if($insert){
				$last_id = mysqli_insert_id($this->db);
				//Add an activity
				$activity_query = "INSERT INTO memorial_activity (memorial_id,memory_added,memory_id)
									VALUES('$memorial[id]',1,'$last_id')";
				$insert_activity = mysqli_query($this->db, $activity_query);
                $data = array(
					'success' => true,
					'message' => 'התווסף בהצלחה'
				);
                return json_encode($data);
            }
            else{
               $data = array(
					'success' => false,
					'message' => 'Memory not added'
				);
                return json_encode($data);
            }
        }
        else{
            $data = array(
				'success' => false,
				'message' => 'Something went wrong'
			);
			return json_encode($data);
        }
    }
}  
?>