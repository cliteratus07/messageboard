<?php
    echo $this->Form->create('Message');
	echo $this->Form->hidden('from_user', array('value' => AuthComponent::user('id')));
    echo $this->Form->input('users',['class'=>'form-control touser'], array('id' => 'to_User'));
    echo $this->Form->input('message',['class'=>'form-control']);
    echo $this->Form->end('Send');

    ?>

    <script>
        $(document).ready(function() {
    $('.touser').select2();
});
    </script>