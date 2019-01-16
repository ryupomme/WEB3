<?php
$conn = mysqli_connect("localhost", "root", "111111", "opentutorials");
$sql = "
    INSER INTO topic (
      title,
      description,
      created
    ) VALUE (
      'MySQL',
      'MySQL is ..',
      NOW()
    )";
  //중간 중간 확인 가능
  //echo $sql;
$result = mysqli_query($conn, $sql);
if($result === false){
  // sql 에러 확인
  echo mysqli_error($conn);
}
?>
