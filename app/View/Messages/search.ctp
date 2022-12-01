<div class="container-fluid content" id="result" style="margin-top: 20px;;">
    <div class="row items p-3 mb-2 bg-dark text-white" style="margin-bottom: 8px;">
        <div class="col-sm">From</div>
        <div class="col-sm">To</div>
        <div class="col-sm">Message</div>
        <div class="col-sm">Created</div>
        <div class="col-sm">Action</div>
    </div>
    <div class="container table-content">

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
    
    </div>
    <!-- <div class="row">
    <div class="col-sm ml-auto"><a href="#" id="showmore" data-message="" class="ShowMore btn btn-success form-control">SHOW MORE</a></div>
    <div class="col-sm ml-auto"><a href="#" id="showless"  class="ShowLess btn btn-warning form-control">SHOW LESS</a></div>
    </div> -->
    <!-- <div class="load-more-btn">
		<button id="" class="btn btn-info form-control" type="button" value="2">Show More</button>
	</div> -->
    </div>

<script>
  
// $('document').ready(function(){
//   $('#search').keyup(function(){
//     var searchkey = $(this).val();
//     searchTags( searchkey );
//   });

//   function searchTags(keyword){
//     var data = keyword;
//     $.ajax({
//       url: "<?php echo $this->Html->url(['controller' => 'Messages', 'action'=>'Search']);?>",
//       method: 'post',
//       data: {keyword:data},
//       dataType:'text',
//       success: function(response)
//       {
//         $('.table-content').html(response);
//       }
//     });
//   };

//   $(document).on('click', '#showmore', function(){
//      var value = $(this).data("message")
//   });

// });

</script>