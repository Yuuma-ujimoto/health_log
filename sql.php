<?php 
if(isset($_POST["submit-type"])){
  $mysql_database_setting = 'mysql:dbname=health;host=localhost';
  $mysql_user = "root";
  $mysql_pass = "";
  $mysql_connecter = new PDO($mysql_database_setting,$mysql_user,$mysql_pass);
  if ($_POST["submit-type"]==1){
    if (isset($_POST["exercise"]) && isset($_POST["count"])){
      $exercise = $_POST["exercise"];
      $count = $_POST["count"];
      $datetime = date("Y-m-d H:i:s");
      echo $exercise.$count.$datetime;

      $sql = "insert into health_data(exercise,count,date_data) Values(:exercise,:count,:date)";
      $statement = $mysql_connecter->prepare($sql);
      $statement->bindParam(":exercise",$exercise,PDO::PARAM_INT);
      $statement->bindParam(":count",$count,PDO::PARAM_INT);
      $statement->bindParam(":date",$datetime,PDO::PARAM_STR);
      $statement->execute();
    }
  }
  else if($_POST["submit-type"]==2){
    if (isset($_POST["exercise"])){
      if ($_POST["exercise"] != ""){

        $exercise = $_POST["exercise"];
        $count = $_POST["count_type"];
        $sql = "insert into exercise_data(exercise_name,count_type) Values(:exercise,:count)";
        $statement = $mysql_connecter->prepare($sql);
        $statement->bindParam(":exercise",$exercise,PDO::PARAM_STR);
        $statement->bindParam(":count",$count,PDO::PARAM_STR);
        $statement->execute();
      }
    }
  }
  else if ($_POST["submit-type"]==3) {
    $sql = "select * from exercise_data where is_show = 1";
    $stmt = $mysql_connecter->prepare($sql);
    $stmt->execute();
    $record_list = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $record_list[] = array(
        "id" => $row["exercise_id"],
        "exercise_name" => $row["exercise_name"],
        "count_type" => $row["count_type"]
      );
    }

    header('Content-type: application/json');
    echo json_encode($record_list);
  }
  else if($_POST["submit-type"]==4){
    $sql = "select E.exercise_name,H.count,E.count_type,H.date_data,H.health_id ,E.exercise_id from health_data H inner join exercise_data E on H.exercise=E.exercise_id where E.is_show = 1 and H.is_show = 1;";
    $stmt = $mysql_connecter->prepare($sql);
    $stmt->execute();
    $record_list = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $record_list[] = array(
        "exercise_name" => $row["exercise_name"],
        "count"=>$row["count"],
        "count_type" => $row["count_type"],
        "date_data"=>$row["date_data"],
        "id"=>$row["health_id"],
        "exercise_id"=>$row["exercise_id"]
      );
    }

    header('Content-type: application/json');
    echo json_encode($record_list);
  }
  else if($_POST["submit-type"]==5){
    $delete_id = $_POST["id"];
    $sql = "update health_data set is_show =0 where health_id = :id";
    $statement = $mysql_connecter->prepare($sql);
    $statement->bindParam(":id",$delete_id,PDO::PARAM_INT);
    $statement->execute();

  }
  else if($_POST["submit-type"]==6){
    $delete_id = $_POST["id"];
    $sql = "update exercise_data set is_show = 0 where exercise_id = :id";
    $statement = $mysql_connecter->prepare($sql);
    $statement->bindParam(":id",$delete_id,PDO::PARAM_INT);
    $statement->execute();
  }
  exit();
}
?>