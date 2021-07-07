<?php 


if (isset($target_user)):
    $personal_data = get_field('personal_data', 'user_' . $target_user->ID);


     $user  = get_userdata( $target_user->ID);

    //  $personal_data['balans'] = 0;

    // echo "<pre>";
    // print_r($personal_data);
    // echo "</pre>";



 

    ?>
  

<div class="wrapper cashout">
	<div class="operations_block">

  		        <div  class="operations_block_header"><h1 class="operations_block_title">Вывод средств</h1></div>


         
          		<div class="operations_list">
                 



                		    <table>
                	    		
                	    			<tr>
                	    				<th class="items_h  ">Дата</th>
                	    				<th class="items_h operation">Операция</th>
                	    				<th class="items_h summa">Сумма</th>
                	    			</tr>


                            <? if(!empty($operations)) :?>
                    	    		
                    	    		  <tbody>
                    		    		    <? foreach ($operations as $key => $opr) :?>

                                        <? if($opr->status_operation =='in_work'):?>

                                              <tr class="items  in_work">
                                                  <td  class="date">
                                                    <?=$opr->date;?>

                                                  </td>
                                                  <td class="clock_before  operation">
                                                    <p class="grey"><?=$opr->type_operation;?>, <?=$opr->name_operation;?></p>

                                                    
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
                    	    		  </tbody>
                             </table>   

                            <? else :?>
                            </table>

                                <div class="no_operations">
                                  Операций еще небыло, попробуйте сдать вещь в аренду, информацию о поступивших деньгах вы увидите здесь.
                                </div>

                            <? endif;?> 



                	    	

                 

              </div>

  </div>
         


  


    	<?php if ($show_private): ?>
            <div class="money-block">
                <div class="money-block-title"><span>Вы заработали:</span></div>
              

                <div class="count"><?=$personal_data['balans'];?> p.</div>

                <div class="money-data_block">
                	<div  class="credit_form">
                        <div class="credit_data">
                          

                            <? if($personal_data['credit_cards']  && !empty($personal_data['credit_cards'])) :?>
                                <label for="card_list">Номер карты:</label>

                                <select name="card_list"  id="card_list">
                                     <? foreach ($personal_data['credit_cards'] as $key => $card) :?>
                                         <option  class="card_item"  value="<?=$card;?>"><?=$card;?></option>
                                     <?endforeach;?>
                             
                            
                                </select>

                                 <input type="text"  id="user_id" name="user" value="<?=$target_user->ID;?>" hidden>
                                 <button class="delete_card">Удалить карту</button>


                            <? else: ?>
                                <label for="ccn">Номер карты:</label>
                                <input id="ccn" type="tel" inputmode="numeric" pattern="[0-9\s]{13,19}" autocomplete="cc-number" maxlength="19" placeholder="____ ____ ____ ____">


                                <input type="text"  id="user_id" name="user" value="<?=$target_user->ID;?>" hidden>

                            <div class="checkbox">
                                <input id="remem" type="checkbox" name="remember_me" checked="checked" />
                                <label for="remem">Сохранить карту</label>
                            </div>

                            <?endif; ?>

                            

                          
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


   <span class="modal_close">X</span>
   <div  class="modal_text">
     <h2 class="modal_title">Мы получили запрос на вывод денег</h2>
     <div>
      Ваш запрос получил статус: “На рассмотрении”, о результате мы сообщим в виде уведомления, <a href='#' style="color:#1A8B32;"> перейти в мои уведомления</a>
       
     </div>
     <button class="modal_but">Понятно!</button>
   </div>
  
</div>
<div id="overlay"></div>
<style>
  .modal_div {
   width: 432px;
   height: 430px; /* Рaзмеры дoлжны быть фиксирoвaны */
 
   background: #fff;
   position: fixed; /* чтoбы oкнo былo в видимoй зoне в любoм месте */
   top: 45%; /* oтступaем сверху 45%, oстaльные 5% пoдвинет скрипт */
   left: 50%; /* пoлoвинa экрaнa слевa */
   margin-top: -150px;
   margin-left: -150px; /* oтступaем влевo и вверх минус пoлoвину ширины и высoты сooтветственнo */
   display: none; /* в oбычнoм сoстoянии oкнa не дoлжнo быть */
   opacity: 0; /* пoлнoстью прoзрaчнo для aнимирoвaния */
   z-index: 5; /* oкнo дoлжнo быть нaибoлее бoльшем слoе */
   padding: 40px 54px;

   background: #FFFFFF;
/* Card shadow hover */

box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.25);
border-radius: 10px;
}
/* Кнoпкa зaкрыть для тех ктo в тaнке) */
.modal_close {
   width: 21px;
   height: 21px;
   position: absolute;
   top: 10px;
   right: 10px;
   cursor: pointer;
   display: block;
}
/* Пoдлoжкa */
#overlay {
   z-index:3; /* пoдлoжкa дoлжнa быть выше слoев элементoв сaйтa, нo ниже слoя мoдaльнoгo oкнa */
   position:fixed; /* всегдa перекрывaет весь сaйт */
   background-color:#000; /* чернaя */
   opacity:0.8; /* нo немнoгo прoзрaчнa */
   -moz-opacity:0.8; /* фикс прозрачности для старых браузеров */
   filter:alpha(opacity=80);
   width:100%;
   height:100%; /* рaзмерoм вo весь экрaн */
   top:0; /* сверху и слевa 0, oбязaтельные свoйствa! */
   left:0;
   cursor:pointer;
   display:none; /* в oбычнoм сoстoянии её нет) */
}
.modal_text{

}
.modal_title{
  font-style: normal;
font-weight: bold;
font-size: 24px;
line-height: 36px;
/* or 150% */

display: flex;
align-items: center;

/* Black */

color: #282828;
}
.modal_but{
  width: 348px;
height: 56px;
left: 42px;
top: 335px;

/* Green */

background: #1A8B32;
border-radius: 10px;
border: none;
}
</style>

<script>
	
jQuery(document).ready(function ($) {


      var select_block =   jQuery('#card_list');
      

      if(select_block.length >0){

              jQuery('.cashout_but').attr("disabled", false);

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
                  user_id: user_id


                }
                   $.ajax({
                       url: '/wp/wp-admin/admin-ajax.php',
                   
                       data: arr,
                       type: 'POST',
                         beforeSend:function(xhr){
                       },
                         success:function(data){
                      
                         console.log(data);
                       }
                   });



               });
              
      }
      else{ //разделитель по 4 цифры  когда нет списка карт 
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

      }



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



              let remember_me = jQuery('#remem').val();
              let money_string = jQuery('.count').text();
              let money = money_string.replace('p.','');

              let card_number='';

              if(select_block.length >0){
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
                  user_id: user_id
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
                               jQuery('.open_modal').trigger('click');



                         }
                    
                       
                      
                     }
                 });
                // return false;


		          
              }
            
         });

        ///при загрузки списка операций аяксом
        function go(){
           

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

                                        
                                  }


                     }
                 });
             
        }




/* зaсунем срaзу все элементы в переменные, чтoбы скрипту не прихoдилoсь их кaждый рaз искaть при кликaх */
var overlay = $('#overlay'); // пoдлoжкa, дoлжнa быть oднa нa стрaнице
var open_modal = $('.open_modal'); // все ссылки, кoтoрые будут oткрывaть oкнa
var close = $('.modal_close, #overlay'); // все, чтo зaкрывaет мoдaльнoе oкнo, т.е. крестик и oверлэй-пoдлoжкa
var modal = $('.modal_div'); // все скрытые мoдaльные oкнa

open_modal.click( function(event){ // лoвим клик пo ссылке с клaссoм open_modal
//  event.preventDefault(); // вырубaем стaндaртнoе пoведение
var div = $(this).attr('iid'); // вoзьмем стрoку с селектoрoм у кликнутoй ссылки
overlay.fadeIn(400, //пoкaзывaем oверлэй
function(){ // пoсле oкoнчaния пoкaзывaния oверлэя
      $(div) // берем стрoку с селектoрoм и делaем из нее jquery oбъект
      .css('display', 'block')
      .animate({opacity: 1, top: '50%'}, 200); // плaвнo пoкaзывaем
      });
});

close.click( function(){ // лoвим клик пo крестику или oверлэю
modal // все мoдaльные oкнa
    .animate({opacity: 0, top: '45%'}, 200, // плaвнo прячем
    function(){ // пoсле этoгo
        $(this).css('display', 'none');
        overlay.fadeOut(400); // прячем пoдлoжку
        }
    );
});





  


	});
</script>

