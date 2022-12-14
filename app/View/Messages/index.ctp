<div class="container">
  <div class="row offset-2">
    <div class="col-sm col-md">
<h1><?php echo AuthComponent::user('username')?>'s Messages</h1>
    </div>
  </div>
</div>
<p>Search</p>
<?= $this->form->control('search');?>

<div class="container-fluid content table-content" style="margin-top: 20px;;">
    <div class="row items p-3 mb-2 bg-dark text-white" style="margin-bottom: 8px;">
        <div class="col-sm">From</div>
        <div class="col-sm">To</div>
        <div class="col-sm">Message</div>
        <div class="col-sm">Created</div>
        <div class="col-sm">Action</div>
    </div>
    <?php foreach($messages1 as $message1) : ?>

      <div class="row items p-3 mb-2 bg-ligt text-dark" style="margin-bottom: 8px;">
      <?php foreach($users as $user) : ?>
        <?php if($user['Users']['id'] == $message1['Messages']['from_user']) : ?>
        <div class="col-sm"><img src="<?php echo $this->webroot; ?>img/<?php echo $user['Users']['image']; ?>" alt="message" style="width:30px;height:30px;border-radius: 50%;">
		<?php echo $user['Users']['username']; ?></div>
    <?php endif; ?>
    <?php endforeach; ?>
    
    <?php foreach($users as $user) : ?>
    <?php if($user['Users']['id'] == $message1['Messages']['to_user']) : ?>
        <div class="col-sm"><img src="<?php echo $this->webroot; ?>img/<?php echo $user['Users']['image']; ?>" alt="message" style="width:30px;height:30px;border-radius: 50%;"> <?php echo $user['Users']['username']; ?></div>
        <?php endif; ?>
    <?php endforeach; ?>

        <div class="col-sm"><?php 
               echo $this->HTML->Link($this->Text->truncate(
                $message1['Messages']['message'],
                10,
                [
                    'ellipsis' => '... click to view more',
                    'exact' => true
                ]
            ), array('controller'=>'messages',
               'action'=>'view', $message1['Messages']['id']));
        ?></div>
        <div class="col-sm"><?php echo $message1['Messages']['created_at']; ?></div>
        <div class="col-sm">
        <?php if($message1['Messages']['from_user'] == AuthComponent::user('id'))
        {
          echo $this->Form->postLink('',
          array(
               'controller'=>'messages','action'=>'delete', $message1['Messages']['id']), array(
               'class'=>'del btn btn-sm btn-danger fa fa-trash',
               'id'=>$message1['Messages']['id'], 'aria-hidden'=>"true", 'title' => 'Delete'  //important 
          ), 'Are you sure you want to delete this post?');
        }
        else
        {
          echo $this->Form->postLink('',
          array(
               'controller'=>'messages','action'=>'delete', $message1['Messages']['id']), array(
               'class'=>'del btn btn-sm btn-danger fa fa-trash disabled',
               'id'=>$message1['Messages']['id'], 'aria-hidden'=>"true", 'title' => 'Delete' //important 
              ), 'Are you sure you want to delete this post?');
        }
       ?> 

<?php 
       echo $this->Form->postLink('',
          array(
               'controller'=>'messages','action'=>'view', $message1['Messages']['id']), array(
               'class'=>'del btn btn-sm btn-danger fa fa-reply',
               'id'=>$message1['Messages']['id'], 'aria-hidden'=>"true", 'title' => 'Reply'  //important 
          ));
      ?>  </div>
    </div>

    <?php endforeach; ?>
    <!-- <div class="row">
    <div class="col-sm ml-auto"><a id="showmore" href="#" class="ShowMore btn btn-success form-control" value="2">SHOW MORE</a></div>
    <div class="col-sm ml-auto"><a href="#" class="ShowLess btn btn-warning form-control">SHOW LESS</a></div>
    </div> -->
    </div>
    <div class="load-more-btn">
		<button id="" class="btn btn-info form-control" type="button" value="2">Show More</button>
	</div>

    <div id='result'> </div>

<script>
  
$('document').ready(function(){
  $('#search').keyup(function(){
    var searchkey = $(this).val();
    searchTags( searchkey );
  });

  function searchTags(keyword){
    var data = keyword;
    $.ajax({
      url: "<?php echo $this->Html->url(['controller' => 'Messages', 'action'=>'Search']);?>",
      method: 'post',
      data: {keyword:data},
      dataType:'text',
      success: function(response)
      {
        $('.table-content').html(response);
      }
    });
  };

//   $(document).on('click','#showmore',function(){

// var limit = $(this).attr('value');;

// alert(limit);

// // $.ajax({
// //       url: "<?php echo $this->Html->url(['controller' => 'Messages', 'action'=>'loadmore']);?>",
// //       method: 'post',
// //       data: {limit:limit},
// //       dataType:'text',
// //       success: function(response)
// //       {
// //         $('.table-content').html(response);
// //       }
// //     });
// 			console.log("<?php echo Router::url( array("controller" => "Messages", "action" => "loadmore" )); ?>/" + limit);

// $.ajax({
//   url: "<?php echo Router::url( array("controller" => "Messages", "action" => "loadmore" )); ?>/" + limit,
//   type: 'post',
//   data: { name: "test" }
// }).done( function(data) {
//   // console.log(data);
//   $( ".table-content" ).html( response );
// });
// });

$(document).ready(function() {
		$(document).on('click','.load-more-btn > button',function(){

			var loadmore_limit = 1 + Number($(this).val());

			$(this).attr('value', loadmore_limit); //versions older than 1.6

			alert(loadmore_limit);

			// console.log("<?php echo Router::url( array("controller" => "messages", "action" => "loadmore" )); ?>/" + loadmore_limit);

			$.ajax({
				url: "<?php echo Router::url( array("controller" => "messages", "action" => "loadmore" )); ?>/" + loadmore_limit,
				type: 'post',
			}).done( function(data) {
				// console.log(data);
				$( ".table-content" ).html( data );
			});
		});
	});


//   $(document).ready(function(){
//     $(function(){
// $('.content .items').hide();
// $('.content .items:nth-child(n+1):nth-child(-n+3)').show();

// $('.ShowMore').click(function(){
// $(this).closest('.content').find('.items:not(:visible):lt(3)').show();
// })

// $('.ShowLess').click(function(){
// $(this).closest('.content').find('.items').hide();
// $(this).closest('.content').find('.items:lt(3)').show();
// })

// })


// } );
});

</script>