<html>
  <head>
    <title>BCIT Transcript Create</title>
    <link rel="stylesheet" href="style.css?v=0.1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  </head>
  <body>
    <div class="bg"></div>
    <div class="bg bg2"></div>
    <div class="bg bg3"></div>
    <div class="userinfo">
      <h1>BCIT Admin</h1>
      <form id='postForm' name='postForm'>
        <p><input type='text' name='number' placeholder='Student Number' class='inputbox' id='number'></p>
        <p><input type='text' name='name' placeholder='Student Name' class='inputbox' id='name'></p>
        <p><input type='text' name='term' placeholder='Term' class='inputbox' id='term'></p>
        <p><input type='text' name='grade' placeholder='Grades' class='inputbox' id='grade'></p>
        <p><input type='submit' name='check' class="btn" value="Create" id='createBtn'></p>
      </form>
      <!-- Hash output -->
      <div>
        <p id='hash' class='red'></p>
      </div>
    </div>
    <script>

    $('#createBtn').click(function(e){
      var number = $('#number').val();
      var name = $('#name').val();
      var term = $('#term').val();
      var grade = $('#grade').val();

      e.preventDefault();
      $.ajax({
        url: "create_process.php",
        type: "POST",
        data: {number: number, name: name, term: term, grade: grade},
        success: function(result) {
          $('#hash').html(result);
        }
      });
    });
      
    </script>
  </body>
</html>
