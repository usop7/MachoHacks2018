<html>
  <head>
    <title>BCIT Transcript Verification</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <div class="bg"></div>
    <div class="bg bg2"></div>
    <div class="bg bg3"></div>
    <div class="userinfo">  
      <h1>BCIT Transcript Verification</h1>
      <form action='check_process.php' method='post' id='userform'>
        <input type='text' name='code' placeholder='Enter verification code' class='inputbox'>
        <input type='button' name='check' class="btn" value="verify" >
      </form>
    </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script>
    $('.btn').click(
      function() {
        $('#userform').submit();
      });
  </script>
  </body>
</html>