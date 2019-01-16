<?php
$conn = mysqli_connect("localhost", "root", "111111", "opentutorials");
$sql = "SELECT * FROM topic";
$result = mysqli_query($conn, $sql);
$list = '';

while($row = mysqli_fetch_array($result)){
  //<li><a href="index.php?id=19">MySQL</a></li>
  //$list = $list."<li>{$row['title']}</li>";

  //기존 escaping 이전
  //$list = $list."<li><a
  //href=\"index.php?id={$row['id']}\">{$row['title']}</a></li>";
  //escaping 이후
  $escaped_title = htmlspecialchars($row['title']);
  $list = $list."<li><a
  href=\"index.php?id={$row['id']}\">{$escaped_title}</a></li>";
}

$sql = "SELECT * FROM author";
$result = mysqli_query($conn, $sql);
$select_form = '<select name="author_id">';
while($row = mysqli_fetch_array($result)){
  $select_form .= '<option value="'.$row['id'].'">'.$row['name'].'</option>';
}
$select_form .= '</select>';
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">

    <script>

      var Body = {
        SetColor:function(color){
          document.querySelector('body').style.color = color;
        },

        SetBackgroundColor:function(color){
          document.querySelector('body').style.backgroundColor = color;
        }
      }

      var Links = {
        SetColor:function(color){
          var alist = document.querySelectorAll('a');
          var i = 0;
          while(i < alist.length){
            alist[i].style.color = color;
            i +=1;
          }
        }
      }

      function nightDatHandler(self){
        if(self.value === 'night'){
          Body.SetBackgroundColor('black');
          Body.SetColor('white');
          self.value = 'day';

          Links.SetColor('powderblue');
        }
        else{
          Body.SetBackgroundColor('white');
          Body.SetColor('black');
          self.value = 'night';

          Links.SetColor('blue');
          }
        }

    </script>
    <title>WEB</title>
  </head>
  <body>
    <h1><a href="index.php">WEB</a></h1>

    <input id="night_day" type="button" value="night" onclick="night(this)">

    <ol>
      <?=$list?>
    </ol>
    <form action="process_create.php" method="POST">
      <p>
        <input type="text" name="title" placeholder="title" value="">
      </p>
      <p>
        <textarea name="description" placeholder="description" rows="8" cols="80"></textarea>
      </p>
      <?=$select_form?>
      <p>
        <input type="submit">
      </p>
    </form>
  </body>
</html>
