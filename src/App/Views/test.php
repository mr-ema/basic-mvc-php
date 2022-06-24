<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="/css/main.css">
  <link rel="stylesheet" type="text/css" href="/css/utilities.css">
  <title>Test View</title>
</head>
<body>
  <header>
    <div class="bg w-100 text-center f-column g-2">
      <h1>Testing views</h1>
    </div>
  </header>
  <main class="bg">
    <form id="form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="flex container f-column g-2 w-50">
      <label for="firstName">
        <input class="w-100 input-field " type="text" name="firstName" placeholder="First Name" />
      </label>
      <label for="lastName">
        <input class="w-100 input-field " type="text" name="lastName" placeholder=" Last Name" />
      </label>
      <label for="mail">
        <input class="w-100 input-field " type="email" name="mail" placeholder="Email" />
      </label>
      <button class="button w-50 self-center" type="submit">Send</button>
    </form>

    <div class="flex g-2 w-50 text-center f-column">
      <div class="table table-titles">
        <span>ID</span>
        <span>First Name</span>
        <span>Last Name</span>
        <span>Email</span>
      </div>
      <div class="table">
      <?php 
      if  ($data['users'])  {
        // output data of each user
        foreach($data['users'] as $user) {
          echo "
            <span> {$user['id']} </span>
            <span> {$user['firstname']} </span>
            <span> {$user['lastname']} </span>
            <span> {$user['email']} </span>
          ";
        }
      }else echo "<span>No Results</span>"
        
      ?>
      </div>
    </div>
    </main>
</body>
</html>