<div class="container">
  <div class="row offset-2">
    <div class="col-sm col-md">
<h1><?php echo 'Reply for '. $message['Message']['message']; ?></h1>
    </div>
  </div>
</div>

<div class="container">
<?php

    echo $this->Form->create('Replies');
	echo $this->Form->hidden('user_id', array('value' => AuthComponent::user('id')));
	echo $this->Form->hidden('message_id', array('value' => $message['Message']['id']));
    echo $this->Form->input('message',['class'=>'form-control']);
    echo $this->Form->end('Send');

    ?>
</div>
<!-- <div class="table-content">
<table>
    <tr>
        <th>From</th>
        <th>To</th>
        <th>Message</th>
        <th>Created</th>
        <th>Action</th>
    </tr>
    <tr>
        <td><img src="<?php echo $this->webroot; ?>img/<?php echo $message1['FromUser']['image']; ?>" alt="message" style="width:30px;height:30px;border-radius: 50%;"><?php echo $message['FromUser']['username']; ?></td>
        <td><img src="<?php echo $this->webroot; ?>img/<?php echo $message1['ToUser']['image']; ?>" alt="message" style="width:30px;height:30px;border-radius: 50%;"><?php echo $message['ToUser']['username']; ?></td>
        <td><?php echo $message['Message']['message']; ?></td>
        <td><?php echo $message['Message']['created_at']; ?></td>
        <td>
        <?php 
       echo $this->Form->postLink('',
          array(
               'controller'=>'messages','action'=>'delete', $message['Message']['id']), array(
               'class'=>'del btn btn-sm btn-danger fa fa-trash disabled',
               'id'=>$message['Message']['id'], 'aria-hidden'=>"true" //important 
          ), 'Are you sure you want to delete this post?');
      ?> 
        </td>
    </tr>
    <?php foreach($messages2 as $message2) : ?>
    <tr>
        <td><img src="<?php echo $this->webroot; ?>img/<?php echo $message2['User']['image']; ?>" alt="message" style="width:30px;height:30px;border-radius: 50%;"><?php echo $message2['User']['username']; ?></td>
        <td><?php echo ' '; ?></td>
        <td><?php echo $message2['Reply']['reply']; ?></td>
        <td><?php echo $message2['Reply']['created_at']; ?></td>
        <td>
        <?php if($message2['User']['id'] == AuthComponent::user('id'))
        {
            echo $this->Form->postLink('',
            array(
                 'controller'=>'replies','action'=>'delete', $message2['Reply']['id']), array(
                 'class'=>'del btn btn-sm btn-danger fa fa-trash',
                 'id'=>$message2['Reply']['id'], 'aria-hidden'=>"true" //important 
            ), 'Are you sure you want to delete this post?');  
        }
        else{
            echo $this->Form->postLink('',
          array(
               'controller'=>'replies','action'=>'delete', $message2['Reply']['id']), array(
               'class'=>'del btn btn-sm btn-danger fa fa-trash disabled',
               'id'=>$message2['Reply']['id'], 'aria-hidden'=>"true" //important 
          ), 'Are you sure you want to delete this post?');
      
        }
       ?> 
        </td>
    </tr>
    <?php endforeach; ?>
</table>
</div> -->

<div class="container-fluid content">
    <!-- <div class="row items" style="margin-bottom: 8px;">
        <div class="col-sm">From</div>
        <div class="col-sm">To</div>
        <div class="col-sm">Message</div>
        <div class="col-sm">Created</div>
        <div class="col-sm">Action</div>
    </div> -->
    <div class="row items p-3 mb-2 bg-info text-white" style="margin-bottom: 8px;">
        <div class="col-sm"><img src="<?php echo $this->webroot; ?>img/<?php echo $message1['FromUser']['image']; ?>" alt="message" style="width:30px;height:30px;border-radius: 50%;"><?php echo $message['FromUser']['username']; ?></div>
        <div class="col-sm"><img src="<?php echo $this->webroot; ?>img/<?php echo $message1['ToUser']['image']; ?>" alt="message" style="width:30px;height:30px;border-radius: 50%;"><?php echo $message['ToUser']['username']; ?></div>
        <div class="col-sm"><?php echo $message['Message']['message']; ?></div>
        <div class="col-sm"><?php echo $message['Message']['created_at']; ?></div>
        <div class="col-sm">
        <?php 
       echo $this->Form->postLink('',
          array(
               'controller'=>'messages','action'=>'delete', $message['Message']['id']), array(
               'class'=>'del btn btn-sm btn-danger fa fa-trash disabled',
               'id'=>$message['Message']['id'], 'aria-hidden'=>"true" //important 
          ), 'Are you sure you want to delete this post?');
      ?> </div>
    </div>
    <?php foreach($messages2 as $message2) : ?>
        <?php if($message2['User']['id'] == AuthComponent::user('id')) : ?>
    
            <div class="row items p-3 mb-2 bg-primary text-white" style="margin-bottom: 8px;">
        <div class="col-sm"><?php echo $message2['Reply']['reply']; ?></div>
        <div class="col-sm"><img src="<?php echo $this->webroot; ?>img/<?php echo $message2['User']['image']; ?>" alt="message" style="width:30px;height:30px;border-radius: 50%;"></div>
        <div class="col-sm"><?php echo $message2['Reply']['created_at']; ?></div>
        <div class="col-sm"><?php if($message2['User']['id'] == AuthComponent::user('id'))
        {
            echo $this->Form->postLink('',
            array(
                 'controller'=>'replies','action'=>'delete', $message2['Reply']['id']), array(
                 'class'=>'del btn btn-sm btn-danger fa fa-trash',
                 'id'=>$message2['Reply']['id'], 'aria-hidden'=>"true" //important 
            ), 'Are you sure you want to delete this post?');  
        }
        else{
            echo $this->Form->postLink('',
          array(
               'controller'=>'replies','action'=>'delete', $message2['Reply']['id']), array(
               'class'=>'del btn btn-sm btn-danger fa fa-trash disabled',
               'id'=>$message2['Reply']['id'], 'aria-hidden'=>"true" //important 
          ), 'Are you sure you want to delete this post?');
      
        }
       ?> </div>
    </div>
    <?php else: ?>
        <div class="row items p-3 mb-2 bg-secondary text-white" style="margin-bottom: 8px;">
        <div class="col-sm"><img src="<?php echo $this->webroot; ?>img/<?php echo $message2['User']['image']; ?>" alt="message" style="width:30px;height:30px;border-radius: 50%;"></div>
        <div class="col-sm"><?php echo $message2['Reply']['reply']; ?></div>
        <div class="col-sm"><?php echo $message2['Reply']['created_at']; ?></div>
        <div class="col-sm"><?php if($message2['User']['id'] == AuthComponent::user('id'))
        {
            echo $this->Form->postLink('',
            array(
                 'controller'=>'replies','action'=>'delete', $message2['Reply']['id']), array(
                 'class'=>'del btn btn-sm btn-danger fa fa-trash',
                 'id'=>$message2['Reply']['id'], 'aria-hidden'=>"true", 'title' => 'Delete' //important 
            ), 'Are you sure you want to delete this post?');  
        }
        else{
            echo $this->Form->postLink('',
          array(
               'controller'=>'replies','action'=>'delete', $message2['Reply']['id']), array(
               'class'=>'del btn btn-sm btn-danger fa fa-trash disabled',
               'id'=>$message2['Reply']['id'], 'aria-hidden'=>"true", 'title' => 'Delete' //important 
          ), 'Are you sure you want to delete this post?');
      
        }
       ?> </div>
    </div>
    <?php endif; ?>
    <?php endforeach; ?>
    <div class="row">
    <div class="col-sm ml-auto"><a href="#" class="ShowMore btn btn-success form-control">SHOW MORE</a></div>
    <div class="col-sm ml-auto"><a href="#" class="ShowLess btn btn-warning form-control">SHOW LESS</a></div>
    </div>
    </div>


<script>
  
$('document').ready(function(){
  $('#RepliesViewForm').submit(function(e){
    e.preventDefault();
    // var val = $(this).find('input:').val();
    var userid = $('#RepliesUserId').val();
    var messageid = $('#RepliesMessageId').val();
    var messagereply = $('#RepliesMessage').val();
    alert (userid);
    alert (messageid);
    alert (messagereply);
    // searchTags( searchkey );
    $.ajax({
      method: 'post',
      url: "<?php echo $this->Html->url(['controller' => 'Replies', 'action'=>'add']);?>",
      data: {userid:userid,
        messageid:messageid,
        messagereply:messagereply,},

      success: function(response)
      {
        $('.table-content').html(response);
      }
    });
    location.reload();
  });

  
  $(document).ready(function(){
    $(function(){
$('.content .items').hide();
$('.content .items:nth-child(n+1):nth-child(-n+3)').show();

$('.ShowMore').click(function(){
$(this).closest('.content').find('.items:not(:visible):lt(5)').show();
})

$('.ShowLess').click(function(){
$(this).closest('.content').find('.items').hide();
$(this).closest('.content').find('.items:lt(3)').show();
})

})


} );
});

</script>