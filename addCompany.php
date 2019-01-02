
<html>
  <style>
        .container input {
          width: 300px;
          clear: both;
        }
  </style>
        <div class = container>
            <form action="addComp.php" method="post">
                <label>Company Name: </label>
                <br></br>
                <input type="text" name="company_name">
                <br></br>
                <label>City: </label>
                <br></br>
                <input type="text" name="city">
                <br></br>
                <label>Phone: </label>
                <br></br>
                <input type="text" name="company_phone">
                <br></br>
                <label>Address: </label>
                <br></br>
                <input type="text" name="address">
                <br></br>
                <label>Available Quota: </label>
                <br></br>
                <input type="text" name="available_quota">
                <br></br>
                <br></br>
                <button type="submit" value="Add Company">Add Company</button>
            </form>
            <form action="welcomeSecretary.php" method="post">
              <button type="submit" value="Back">Back</button>
            </form>
        </div>
</html>
