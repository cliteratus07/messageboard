<div class="container">
  <div class="row offset-2">
    <div class="col-sm col-md">
<h1><?php echo AuthComponent::user('username')?>'s Messages</h1>
    </div>
  </div>
</div>
<p>Search</p>
<?= $this->form->control('search');?>
<!-- <div class="table-content">
<table>
    <tr>
        <th>From</th>
        <th>To</th>
        <th>Message</th>
        <th>Created</th>
        <th>Action</th>
    </tr>
    <?php foreach($messages1 as $message1) : ?>
      <?php if($message1['FromUser']['id'] == AuthComponent::user('id') || $message1['ToUser']['id'] == AuthComponent::user('id')) : ?>
    <tr>
        <td><img src="<?php echo $this->webroot; ?>img/<?php echo $message1['FromUser']['image']; ?>" alt="message" style="width:30px;height:30px;border-radius: 50%;">
		<?php echo $message1['FromUser']['username']; ?></td>
        <td><img src="<?php echo $this->webroot; ?>img/<?php echo $message1['ToUser']['image']; ?>" alt="message" style="width:30px;height:30px;border-radius: 50%;"><?php echo $message1['ToUser']['username']; ?></td>
        <td>
        <?php 
               echo $this->HTML->Link($this->Text->truncate(
                $message1['Message']['message'],
                10,
                [
                    'ellipsis' => '... click to view more',
                    'exact' => true
                ]
            ), array('controller'=>'messages',
               'action'=>'view', $message1['Message']['id']));
        ?></td>
        <td><?php echo $message1['Message']['created_at']; ?></td>
        <td>
        <?php if($message1['FromUser']['id'] == AuthComponent::user('id'))
        {
          echo $this->Form->postLink('',
          array(
               'controller'=>'messages','action'=>'delete', $message1['Message']['id']), array(
               'class'=>'del btn btn-sm btn-danger fa fa-trash',
               'id'=>$message1['Message']['id'], 'aria-hidden'=>"true" //important 
          ), 'Are you sure you want to delete this post?');
        }
        else
        {
          echo $this->Form->postLink('',
          array(
               'controller'=>'messages','action'=>'delete', $message1['Message']['id']), array(
               'class'=>'del btn btn-sm btn-danger fa fa-trash disabled',
               'id'=>$message1['Message']['id'], 'aria-hidden'=>"true" //important 
              ), 'Are you sure you want to delete this post?');
        }
       ?> 

<?php 
       echo $this->Form->postLink('',
          array(
               'controller'=>'messages','action'=>'view', $message1['Message']['id']), array(
               'class'=>'del btn btn-sm btn-danger fa fa-reply',
               'id'=>$message1['Message']['id'], 'aria-hidden'=>"true" //important 
          ));
      ?> 
        </td>
    </tr>
    <?php endif; ?>
    <?php endforeach; ?>
</table>
</div> -->


<div class="container-fluid content table-content" style="margin-top: 20px;;">
    <div class="row items p-3 mb-2 bg-dark text-white" style="margin-bottom: 8px;">
        <div class="col-sm">From</div>
        <div class="col-sm">To</div>
        <div class="col-sm">Message</div>
        <div class="col-sm">Created</div>
        <div class="col-sm">Action</div>
    </div>
    <?php foreach($messages1 as $message1) : ?>
      <?php if($message1['FromUser']['id'] == AuthComponent::user('id') || $message1['ToUser']['id'] == AuthComponent::user('id')) : ?>
    <div class="row items p-3 mb-2 bg-ligt text-dark" style="margin-bottom: 8px;">
        <div class="col-sm"><img src="<?php echo $this->webroot; ?>img/<?php echo $message1['FromUser']['image']; ?>" alt="message" style="width:30px;height:30px;border-radius: 50%;">
		<?php echo $message1['FromUser']['username']; ?></div>
        <div class="col-sm"><img src="<?php echo $this->webroot; ?>img/<?php echo $message1['ToUser']['image']; ?>" alt="message" style="width:30px;height:30px;border-radius: 50%;"> <?php echo $message1['ToUser']['username']; ?></div>
        <div class="col-sm"><?php 
               echo $this->HTML->Link($this->Text->truncate(
                $message1['Message']['message'],
                10,
                [
                    'ellipsis' => '... click to view more',
                    'exact' => true
                ]
            ), array('controller'=>'messages',
               'action'=>'view', $message1['Message']['id']));
        ?></div>
        <div class="col-sm"><?php echo $message1['Message']['created_at']; ?></div>
        <div class="col-sm">
        <?php if($message1['FromUser']['id'] == AuthComponent::user('id'))
        {
          echo $this->Form->postLink('',
          array(
               'controller'=>'messages','action'=>'delete', $message1['Message']['id']), array(
               'class'=>'del btn btn-sm btn-danger fa fa-trash',
               'id'=>$message1['Message']['id'], 'aria-hidden'=>"true", 'title' => 'Delete'  //important 
          ), 'Are you sure you want to delete this post?');
        }
        else
        {
          echo $this->Form->postLink('',
          array(
               'controller'=>'messages','action'=>'delete', $message1['Message']['id']), array(
               'class'=>'del btn btn-sm btn-danger fa fa-trash disabled',
               'id'=>$message1['Message']['id'], 'aria-hidden'=>"true", 'title' => 'Delete' //important 
              ), 'Are you sure you want to delete this post?');
        }
       ?> 

<?php 
       echo $this->Form->postLink('',
          array(
               'controller'=>'messages','action'=>'view', $message1['Message']['id']), array(
               'class'=>'del btn btn-sm btn-danger fa fa-reply',
               'id'=>$message1['Message']['id'], 'aria-hidden'=>"true", 'title' => 'Reply'  //important 
          ));
      ?>  </div>
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
  $('#search').keyup(function(){
    var searchkey = $(this).val();
    searchTags( searchkey );
  });

  function searchTags(keyword){
    var data = keyword;
    $.ajax({
      method: 'get',
      url: "<?php echo $this->Html->url(['controller' => 'Messages', 'action'=>'Search']);?>",
      data: {keyword:data},

      success: function(response)
      {
        $('.table-content').html(response);
      }
    });
  };


  $(document).ready(function(){
    $(function(){
$('.content .items').hide();
$('.content .items:nth-child(n+1):nth-child(-n+3)').show();

$('.ShowMore').click(function(){
$(this).closest('.content').find('.items:not(:visible):lt(3)').show();
})

$('.ShowLess').click(function(){
$(this).closest('.content').find('.items').hide();
$(this).closest('.content').find('.items:lt(3)').show();
})

})


} );
});

</script>