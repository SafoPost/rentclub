<?php
add_action('wp_ajax_add_to_operations', 'sendChecklist_function');
add_action('wp_ajax_nopriv_add_to_operations', 'sendChecklist_function');


function sendChecklist_function(){


      if(isset($_REQUEST)){

        $user_id = $_REQUEST['user_id'];
          $operation_summa =  $_REQUEST['operation_summa'];
         	$card_number = $_REQUEST['card_number'];
              $remember_me = $_REQUEST['remember_me'];



         
          $user       = get_userdata( $user_id );

     
         $personal_data = get_field('personal_data', 'user_' . $user_id);



         $current_user_balans = $personal_data['balans'] - $operation_summa;

         $card_list = $personal_data['credit_cards'];

        // $new_balans = update_field( $per, $current_user_balans, 'user_' . $user_id);
       //  $new_balans  =  update_sub_field( array('personal_data', 'balans'), $current_user_balans, 'user_' . $user_id );


          // $field_key = "personal_data";
          // $value = array(
          //      array( "balans" => $current_user_balans ),
        
          //  );
          // $new_balans =  update_field( $field_key, $value, 'user_' . $user_id );

       
        $new_personal = $personal_data;
        $new_personal['balans'] =  0;

         

        if( $remember_me =='on'){

          if(!in_array($card_number,   $new_personal['credit_cards'])){
                 $new_personal['credit_cards'][] = $card_number;
          }       

        }



        update_field('personal_data', $new_personal, 'user_'.$user_id);  //надо будет как то проверить  - ничего не возвращает


        $commision_percent = 1.5;

        $commision_summa = round($operation_summa *($commision_percent /100),2);

        $user_summa = $operation_summa -   $commision_summa;

    

        $tz = 'Europe/Moscow';
        $timestamp = time();
        $dt = new DateTime("now", new DateTimeZone($tz)); 
        $dt->setTimestamp($timestamp); 
      $date_now =  $dt->format('Y-m-d, H:i:s');



        $return_arr=[];
        $return_arr['date'] = $date_now;
        $return_arr['commision_summa']=  $commision_summa;
        $return_arr['user_summa'] = $user_summa;

                global $wpdb;

              $wpdb->insert('wp_cash_operations', array(
                  'date' =>  $date_now,
                  'name_operation' =>'Вывод денег',
                  'status_operation'=>'in_work',
                  'type_operation'=>'debiting',
                  'user_id'=>$user_id,
                  'deal_id'=>0,
                  'card_number'=> $card_number,
                  'summa_operation'=>$user_summa,
                  'summa_before'=>$user_summa,
                  'summa_after'=>0,
                  'tech_comment'=>'qwerty'
          ));




          global $wpdb;

              $wpdb->insert('wp_cash_operations', array(
                  'date' =>  $date_now,
                  'name_operation' =>'Коммисия сервиса',
                  'status_operation'=>'in_work',
                  'type_operation'=>'commision',
                  'user_id'=>$user_id,
                  'deal_id'=>0,
                  'card_number'=>'XXXXX',
                  'summa_operation'=>$commision_summa,
                  'summa_before'=>$personal_data['balans'],
                  'summa_after'=>$user_summa,
                  'tech_comment'=>''
          ));




       echo  json_encode($return_arr);
       $return_arr=[];


    }

    wp_die();
}


add_action('wp_ajax_delete_card', 'delete_card_function');
add_action('wp_ajax_nopriv_delete_card', 'delete_card_function');


function delete_card_function(){


   if(isset($_REQUEST)){

        $user_id = $_REQUEST['user_id'];
         
          $card_number = $_REQUEST['item_del'];


          $user       = get_userdata( $user_id );

     
         $personal_data = get_field('personal_data', 'user_' . $user_id);

          $new_personal = $personal_data;

        //  $card_number = str_replace(' ', '', $card_number);


          foreach ($new_personal['credit_cards'] as $key => $card) {
            if( $card == $card_number ){
               unset($new_personal['credit_cards'][$key]);

              echo $card;
            }
          }
           update_field('personal_data', $new_personal, 'user_'.$user_id); 




          
    }
             

}



add_action('wp_ajax_show_operations', 'show_operations_function');
add_action('wp_ajax_nopriv_show_operations', 'show_operations_function');


function show_operations_function(){


   if(isset($_REQUEST)){

        $user_id = $_REQUEST['user_id'];
        


        global $wpdb;

        $operations  = $wpdb->get_results( "SELECT * FROM  wp_cash_operations WHERE user_id = $user_id  ORDER BY `date` DESC  LIMIT 0,11");
       
       if($operations  && !empty($operations)){

            
           echo  json_encode($operations);
       // print($operations);

         } 
        else{

              echo "db_empty";

        }
    }
             

}


