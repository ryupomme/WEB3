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

$article = array(
    'title'=>'Welcome',
    'description'=>'Hello, web'
);

$update_link = '';
$delete_link = '';
$author = '';
if(isset($_GET['id'])){
  $filtered_id = mysqli_real_escape_string($conn, $_GET['id']);
  $sql = "SELECT * FROM topic LEFT JOIN author ON topic.author_id = author.id WHERE topic.id={$filtered_id}";
  $result = mysqli_query($conn, $sql);
  //echo mysqli_error($conn);

  $row = mysqli_fetch_array($result);

  $article['title']=htmlspecialchars($row['title']);
  $article['description']=htmlspecialchars($row['description']);
  $article['name']=htmlspecialchars($row['name']);

  $update_link = '<a href="update.php?id='.$_GET['id'].'">update</a>';
  //GET/POST방식으로 정보 전달시 링크만으로도 데이터 삭제가 가능하
  //$delete_link = '<a href="delete_process.php?id='.$_GET['id'].'">delete</a>';

  //Form 으로 처리
  $delete_link = '
  <form action = "process_delete.php" method="post">
    <input type="hidden" name="id" value="'.$_GET['id'].'">
    <input type="submit" value="delete">
  </form>';
  $author = "<p>by {$article['name']}</P>";
}


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
        // var target = document.querySelector('body');
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
    
    <input id="night_day" type="button" value="night" onclick="
      nightDatHandler(this);
    ">
    <p><a href="author.php">author</a></p>
    <ol>
      <?=$list?>
    </ol>
    <a href="create.php">create</a>
    <?=$update_link?>
    <?=$delete_link?>
    <h2><?=$article['title']?></h2>
    <p><?=$article['description']?></p>
    <?=$author?>

    <form action="insert.php" method="post">
      <input type="text" name="" value="">
      <input type="submit">
    </form>
  </body>
</html>
