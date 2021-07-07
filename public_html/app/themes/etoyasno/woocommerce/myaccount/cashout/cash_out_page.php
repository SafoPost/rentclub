<?php 


if (isset($target_user)):
    $personal_data = get_field('personal_data', 'user_' . $target_user->ID);


     $user  = get_userdata( $target_user->ID);


?>
  

<div class="wrapper cashout">
  <div class="operations_block">

              <div  class="operations_block_header"><h1 class="operations_block_title">Вывод средств</h1></div>


         
              <div class="operations_list">
                 



                  <table  id="table_operation">
                          
                            <tr>
                              <th class="items_h  ">Дата</th>
                              <th class="items_h operation">Операция</th>
                              <th class="items_h summa">Сумма</th>
                            </tr>


                        <? if(!empty($operations)) :?>
                              
                               
                                    <? foreach ($operations as $key => $opr) :?>

                                        <? if($opr->status_operation =='in_work'):?>

                                              <tr class="items  in_work">
                                                  <td  class="date">
                                                    <?=$opr->date;?>

                                                  </td>
                                                  <td class="clock_before  operation">
                                                    <p class="grey"><?=$opr->name_operation;?></p>

                                                    
                                                  </td>
                                                  <td class="summa">
                                                    <? if($opr->type_operation =='crediting') :?>

                                                         <p class="grey">+<?=$opr->summa_operation;?>p.</p>
                                                      <? else :?>
                                                         <p  class="grey">-<?=$opr->summa_operation;?>p.</p>
                                                      <?endif;?>   
                                                         
                                                    
                                                  </td>
                                              </tr>


                                        <? else:?>  
                                
                                                <tr class="items">
                                                  <td class="date">
                                                    <?=$opr->date;?>

                                                  </td>
                                                  <td  class="operation">
                                                    <p><?=$opr->type_operation;?>, <?=$opr->name_operation;?></p>

                                                    
                                                  </td>
                                                  <td class="summa">
                                                    <? if($opr->type_operation =='crediting') :?>

                                                         <p class="green">+<?=$opr->summa_operation;?>p.</p>
                                                      <? else :?>
                                                         <p class="blue">-<?=$opr->summa_operation;?>p.</p>
                                                      <?endif;?>   
                                                         
                                                    
                                                  </td>


                                                </tr>
                                        <?endif;?>
                                  

                                
                                    <?  endforeach; ?>
                               
                          </table>   

                        <? else :?>
                  </table>

                                <div class="no_operations">
                                  Операций еще небыло, попробуйте сдать вещь в аренду, информацию о поступивших деньгах вы увидите здесь.
                                </div>

                        <? endif;?> 
              </div>

              <div  class="pagination">

             <? echo paginate_links( array(
                        'base' => add_query_arg( 'cpage', '%#%' ),
                        'format' => '',
                        'prev_text' => __(' &lt;'),
                        'next_text' => __(' &gt;'),
                        'total' => ceil($total / $items_per_page),
                        'current' => $page
                    ));?>

              </div>      

  </div>
         


  


        <?php if ($show_private): ?>
            <div class="money-block">
                <div class="money-block-title"><span>Вы заработали:</span></div>
              

                  <div class="count"><?=$personal_data['balans'];?> p.</div>

                  <div class="money-data_block">
                    <div  class="credit_form">
                          <div class="credit_data">
                               

                           
                              <div class="input_box">  
                               <label for="ccn">Номер карты:</label> 

                                      <input id="ccn" type="tel" inputmode="numeric" pattern="[0-9\s]{13,19}" autocomplete="cc-number" maxlength="19" placeholder="____ ____ ____ ____">
                                      <? if($personal_data['credit_cards']  && !empty($personal_data['credit_cards'])) :?>
                                        <span  class="choose"></span>
                                      <? endif;?>

                                      

                                  <div class="checkbox">
                                      <input id="remem" type="checkbox" name="remember_me"  class="custom-checkbox" />
                                      <label for="remem">Сохранить карту</label>
                                  </div>
                              </div> 


                              <div  class="select_box">


                                  <? if($personal_data['credit_cards']  && !empty($personal_data['credit_cards'])) :?>
                                   
                                       <label for="card_list">Номер карты:</label>
                                     
                                      <select name="card_list"  id="card_list">
                                           <? foreach ($personal_data['credit_cards'] as $key => $card) :?>
                                               <option  class="card_item"  value="<?=$card;?>"><?=$card;?></option>
                                           <?endforeach;?>
                                   
                                  
                                      </select>
                                      <span class="add_new"></span>

                                     
                                       <button class="delete_card">Удалить карту</button>
                                  
                                  <?endif;?>
                              </div>
                             

                              

                            
                          </div>

                          <button class="cashout_but" disabled >Вывести денги</button>


                    </div>
                      <div class="comission_rule">
                          <p  class="comission_info">Комиссия платежной системы: 1.5% </p>
                          <p  class="min_cashout">Минимальная сумма вывода: 1000 р</p>
                      </div>
                      <div class="pay_systems">
                          <div class="gpay"><img src="<?=get_template_directory_uri();?>/source/img/google_pay.png"></div>
                          <div class="applepay"><img src="<?=get_template_directory_uri();?>/source/img/apple_pay.png"></div>
                          <div class="mastercard"><img src="<?=get_template_directory_uri();?>/source/img/mastercard.png"></div>
                          <div class="visa"><img src="<?=get_template_directory_uri();?>/source/img/visa.png"></div>
                          <div class="maestro"><img src="<?=get_template_directory_uri();?>/source/img/maestro.png"></div>

                      </div>
                    
                  </div>


            </div>
        <?php endif; ?>
</div>



   

<?php endif;?>
<div  iid="#modal1" class="open_modal"></div>
<div id="modal1" class="modal_div">


   <span class="modal_close"></span>
   <div>
     <h2 class="modal_title">Мы получили запрос на вывод денег</h2>
     <div class="modal_text">
      Ваш запрос получил статус: “На рассмотрении”, о результате мы сообщим в виде уведомления, <a href='#' style="color:#1A8B32;"> перейти в мои уведомления</a>
       
     </div>
     <button class="modal_but">Понятно!</button>
   </div>
  
</div>
<div id="overlay"></div>


<script>
  
jQuery(document).ready(function ($) {

 

     jQuery('.cashout_but').attr("disabled", false);

     var select_block_box = false;


     var  choose = jQuery('.choose');
     var add_new = jQuery('.add_new');

     if(choose.length >0){
       jQuery('.choose').on('click',function(){

        jQuery('.select_box').css('display', 'block');
        jQuery('.input_box').css('display', 'none');
        select_block_box = true;

       })
     }
      if(add_new.length >0){
       jQuery('.add_new').on('click',function(){

        jQuery('.select_box').css('display', 'none');
        jQuery('.input_box').css('display', 'block');

        select_block_box = false;

       })
     }


      var select_block   =   jQuery('#card_list');

     
      if(select_block.length >0){
        
               //разделитель по 4 цифры  когда есть список карт 
               var ll = document.querySelectorAll('.card_item');

               for (let j = 0; j < ll.length; j++) {

                     var new_item =  formatCardCode2(ll[j]);
             
               }

               jQuery('.delete_card').on('click',function(){

                  let  card_number = jQuery('#card_list').val();
                  let user_id = jQuery('#user_id').val();

                  let arr ={
                    item_del : card_number,
                    action :'delete_card',
                    user_id: <?=$target_user->ID;?>


                  }
                   $.ajax({
                       url: '/wp/wp-admin/admin-ajax.php',
                   
                       data: arr,
                       type: 'POST',
                         beforeSend:function(xhr){
                       },
                         success:function(data){
                               let del_item = data.slice(0, -1);
                               console.log(del_item);
                                  let list = document.querySelectorAll('.card_item');
                                  for (let z = 0; z < list.length; z++) {
                                         if(list[z].value == del_item){
                                             console.log(list.length);
                                             if(list.length ==1){


                                              jQuery('.select_box').css('display', 'none');
                                                jQuery('.input_box').css('display', 'block');

                                                  select_block_box = false;
                                                  list[z].remove();
                                                  jQuery('.choose').css('display', 'none');


                                             }else{
                                               list[z].remove();
                                             }

                                             
                                         }
                                       
             
                                 }
                      
                       
                        
                       }
                   });



               });
              
      }
        

      
         var cc = document.getElementById('ccn');
         for (var i in ['input', 'change', 'blur', 'keyup']) {
              cc.addEventListener('input', formatCardCode, false);
         }


        jQuery("#ccn").on("input",function() {
          console.log(this.value);

             if(this.value !=='' && this.value.length ==19){
               jQuery('.cashout_but').attr("disabled", false);
             }else{
                jQuery('.cashout_but').attr("disabled", true);
             }
         });


        function formatCardCode() {
             var cardCode = this.value.replace(/[^\d]/g, '').substring(0,16);
             cardCode = cardCode != '' ? cardCode.match(/.{1,4}/g).join(' ') : '';
             this.value = cardCode;
        }

          //     }



        function formatCardCode2(item) {
       
           var cardCode = item.value.replace(/[^\d]/g, '').substring(0,16);

           cardCodeValue = cardCode != '' ? cardCode.match(/.{1,4}/g).join(' ') : '';

           var arr = cardCodeValue.split(' ');
             arr[1]='****';
             arr[2]='****';
           var htmlValue = arr.join(' ');

           item.value = cardCodeValue;
           item.innerHTML = htmlValue;

                return item;
        }


    
        jQuery('.cashout_but').on('click', function(){



              let remember_me = '';

              if (jQuery('#remem').is(':checked')){
                remember_me = 'on';
              }else remember_me= 'off';

              let money_string = jQuery('.count').text();
              let money = money_string.replace('p.','');

              let card_number='';

              if(select_block.length >0 && select_block_box){
               card_number = jQuery('#card_list').val();
                console.log(card_number);

             }else{
                card_number = jQuery('#ccn').val();
                console.log(card_number);
             }

               console.log(card_number);

              let user_id = jQuery('#user_id').val();
              //console.log(jQuery('#remem').val());

              if(money < 1000){
              
                  jQuery('.min_cashout').css('color','red');
                

              }
              else{

                let  arr ={
                  action:'add_to_operations',
                
                  operation_summa: money,
                  remember_me:remember_me,
                  card_number: card_number,
                  user_id: <?=$target_user->ID;?>
                };
                //    let data  = JSON.stringify(arr);


                 $.ajax({
                     url: '/wp/wp-admin/admin-ajax.php',
                 
                     data: arr,
                     type: 'POST',
                       beforeSend:function(xhr){
                     },
                       success:function(data, status, xhr){

                         if (xhr.status === 200) {
                              jQuery('.count').text('0 р.');


                              show_reload_list();
                              

                               // var list = JSON.parse(data);
                               //  console.log(list);
                               // let tr ="<tr class='items  in_work'><td class='date'>"+list['date']+"</td><td class='clock_before  operation'><p class='grey'>Вывод денег</p></td><td class='summa'><p class='grey'>-"+list['user_summa']+"</p></td></tr>";
                               // tr+= "<tr class='items  in_work'><td class='date'>"+list['date']+"</td><td class='clock_before  operation'><p class='grey'>Коммисия</p></td><td class='summa'><p class='grey'>-"+list['commision_summa']+"</p></td></tr>";

                             

                               // jQuery(jQuery('table#table_operation tr')[0]).after(tr);


                                 // var url = window.location.href;    
                                 //   url += '?cpage=1'
                                 //    window.location.href = url;
                             


                               jQuery('.open_modal').trigger('click');
                          }
                    
                       
                      
                     }
                 });
              


              
              }
            
         });


              //при загрузки списка операций аяксом
        function show_reload_list(){
           

          let arr ={
            action: 'show_operations',
            user_id:<?=$target_user->ID;?>
          }

                  $.ajax({
                     url: '/wp/wp-admin/admin-ajax.php',
                 
                     data: arr,
                     type: 'POST',
                       beforeSend:function(xhr){
                     },
                       success:function(data, status, xhr){

                             
                                if (xhr.status === 200) {
                                    var list_operations = JSON.parse(data.slice(0, -1));
                                    console.log(list_operations);

                                      let trs ="<tr><th class='items_h'>Дата</th><th class='items_h operation'>Операция</th><th class='items_h summa'>Сумма</th></tr>";

                                      for( var j in list_operations){

                                          if(list_operations[j]['status_operation'] =='in_work'){
                                             trs+="<tr class='items  in_work'><td class='date'>"+list_operations[j]['date']+"</td><td class='clock_before  operation'><p class='grey'>"+list_operations[j]['name_operation']+"</p></td><td class='summa'><p class='grey'>-"+list_operations[j]['summa_operation']+"р.</p></td></tr>";

                                          }else{
                                                let color ='';
                                                 if(list_operations[j]['type_operation'] =='crediting'){
                                                  color = 'green';
                                                 }else color ='blue';

                                               trs+="<tr class='items'><td class='date'>"+list_operations[j]['date']+"</td><td class='operation'><p>"+list_operations[j]['name_operation']+"</p></td><td class='summa'><p class="+color+">-"+list_operations[j]['summa_operation']+"</p></td></tr>";
                                          }

                                      }

                                      jQuery('#table_operation tr').remove();
                                      jQuery('#table_operation').append(trs);

                                      if(jQuery('.no_operations').length){
                                        jQuery('.no_operations').remove();

                                      }





                                }


                     }
                 });
             
        }






          var overlay = $('#overlay');
          var open_modal = $('.open_modal'); 
          var close = $('.modal_close, #overlay');
          var modal = $('.modal_div'); 

          open_modal.click( function(event){ 

                    var div = $(this).attr('iid'); 
                    overlay.fadeIn(400, function(){ 
                           $(div).css('display', 'block').animate({opacity: 1, top: '50%'}, 200); 
                      });
          });

          close.click( function(){
              modal.animate({opacity: 0, top: '45%'}, 200,
                function(){ 
                     $(this).css('display', 'none');
                     overlay.fadeOut(400);
                  }
              );
          });

});
</script>


