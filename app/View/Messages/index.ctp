<div class="container">
  <div class="row offset-2">
    <div class="col-sm col-md">
<h1><?php echo AuthComponent::user('username')?>'s Messages</h1>
    </div>
  </div>
</div>
<table>
    <tr>
        <th>From</th>
        <th>To</th>
        <th>Message</th>
        <th>Created</th>
        <th>Action</th>
    </tr>
    <?php foreach($messages1 as $message1) : ?>
    <tr>
        <td><?php echo $message1['FromUser']['username']; ?></td>
        <td><?php echo $message1['ToUser']['username']; ?></td>
        <td><?php echo $message1['Message']['message']; ?></td>
        <td><?php echo $message1['Message']['created_at']; ?></td>
        <td><a href="#" class="btn btn-danger btn-lg active" role="button" aria-pressed="true"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
    </tr>
    <?php endforeach; ?>
</table>