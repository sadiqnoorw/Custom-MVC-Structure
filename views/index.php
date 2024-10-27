<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>

    <h1>Users Info</h1>
    <table class="table table-hover">

        <thead>
            <tr>
                <th>#</th>
                <th>full name</th>
                <th>Email</th>
                <th>is_active</th>
            </tr>
        </thead>
        <tbody>
            <?php  foreach ($users as  $user) { ?>
                <tr>
                    <th scope="row"><?= $user['id']?></th>
                    <td><?= $user['full_name']?></td>
                    <td><?= $user['email']?></td>
                    <td><?= $user['is_active']?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>

