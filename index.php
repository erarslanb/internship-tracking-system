<html>
<head>
  <style>
  ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #333;
  }

  li {
    float: left;
  }

  li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
  }

  /* Change the link color to #111 (black) on hover */
  li a:hover {
    background-color: green;
  }
  </style>
</head>

<body>
  <div>
    <ul>
      <li><a href="companies.php">Companies</a></li>
      <li  style="float:right"><a href="index.php">Log In</a></li>
    </ul>
  </div>
  <?php   session_start(); unset($_SESSION['sid'], $_SESSION['iid'], $_SESSION['secid']); ?>
  <br></br>
  <div>
      <form action="login.php" method="post">
          ID:<input type="text" name="id">
          PASSWORD:<input type="password" name="pass">
          <input type="submit" value="Login">
      </form>
  </div>
</body>
</html>
