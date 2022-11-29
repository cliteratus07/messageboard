
<div class="users-form edit-profile">

	<?php echo $this->Form->create('User',['type' => 'file']); ?>
		<!-- TEST -->
		<!-- hidden userID -->
		<?php echo $this->Form->hidden('id', array('value' => $this->data['User']['id'])); ?>
		<!-- Picture and Details -->
		<div class="pic-details">
			<!-- Picture -->
			<div class="picture">
				<?php echo $this->Html->image($this->data['User']['image'], array('class' => 'image', 'height' => '250', 'width' => '250', 'fullBase' => true, 'plugin' => false)); ?>
			</div>

			<!-- Details -->
			<div class="edit-user-info">
				<div class="image">
					<?php echo $this->Form->input('image',['type'=>'file', 'class' => 'file-upload']);?>
				</div>
				<div class="username">
					<?php echo $this->Form->input('username',array('class'=>'form-control')); ?>
				</div>
				<div class="email">
                    <label for="email" style="font-weight: bold;">Email <font color="red">*</font></label>
					<?php echo $this->Form->email('email',array('class'=>'form-control')); ?>
				</div>
                
				<div class="gender">
                <?php echo $this->Form->input('gender', array('class'=>'form-control','type'=>'select', 'options'=>['Male' => 'Male','Female' => 'Female'], 'default'=>'Male')); ?>
				</div>

				<div class="birthdate">
					<?php echo $this->Form->input('birthdate', array('class'=>'form-control', 'type' => 'text', 'id' => 'datepicker', 'value' => $birthdate)); ?>
				</div>

				<div class="age">
					<?php echo $this->Form->input('age',array('class'=>'form-control', 'type' => 'number')); ?>
				</div>

                <div class="hubby">
                    <?php echo $this->Html->tag('p', 'Hubby:', array('class' => 'user-hobby')); ?>
                    <?php
                        echo $this->Form->textarea('hubby',array('class'=>'form-control', 'rows'=>'5'));
                    ?>
                </div>

		<!-- Edit Profile Button -->
		<div class="submit-profile">
			<?php
				echo $this->Form->submit('Update', array('class' => 'form-submit',  'title' => 'Click here to update your account') );
			?>
		</div>
	<?php echo $this->Form->end(); ?>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		var readURL = function(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();

				reader.onload = function (e) {
					$('.image').attr('src', e.target.result);
				}

				reader.readAsDataURL(input.files[0]);
			}
		}

		$(".file-upload").on('change', function(){
			readURL(this);
		});
	});


</script>
