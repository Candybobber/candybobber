<div class="container">
  <div class="row">
    <div class="col-sm-10">
      <p class="text-right">
        <a href="/admin/index">
          <i class="fa fa-chevron-left"></i>Back to admin panel
        </a>
      </p>
      <div class="col-md-12">
        <h3>Users list</h3>
        <table class="table table-striped">
          <thead>
          <tr>
            <th>#</th>
            <th>id</th>
            <th>Login</th>
            <th>Email</th>
            <th>Registration date</th>
            <th>Delete</th>
            <th>Edit</th>
          </tr>
          </thead>
          <tbody>
          <?php foreach ($usersList as $user): ?>
            <tr>
              <td><?php echo ++$i; ?></td>
              <td><?php echo $user['id']; ?></td>
              <td><?php echo $user['login']; ?></td>
              <td><?php echo $user['email']; ?></td>
              <td><?php echo $user['date']; ?></td>
              <td>
                <a href="/admin/users/delete/<?php echo $user['id']; ?>">
                  <i class="fa fa-trash-o"></i>Delete</a>
                </a>
              </td>
              <td>
                <a href="/admin/users/edit/<?php echo $user['id']; ?>">
                  <i class="fa fa-pencil-square-o"></i>Edit
                </a>
              </td>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>