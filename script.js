$(function()
{
  $("#submit1").on("click",function(){
   $.ajax({
    type: "POST",
    url: "./sql.php",
    datatype: "json",
    data: {
      "submit-type":1,
      "exercise" : $('#exercise').val(),
      "count":$("#count").val()
    },
    success: function(data) {
      console.log("登録");
      $("#count").val("");
      get_exercise_data();

    },
    error: function(data) {
      console.log("error");
    }
  });
 });
});

$(function()
{
  $("#submit2").on("click",function(){
   $.ajax({
    type: "POST",
    url: "./sql.php",
    datatype: "json",
    data: {
      "submit-type":2,
      "exercise" : $('#exercise-name').val(),
      "count_type":$('#count_type').val()
    },
    success: function(data) {
      console.log("新しくトレーニングの項目を登録しました");
      $("#exercise-name").val("");
      set_menu();
    },
    error: function(data) {
      console.log("error");
    }
  });
 });
});

$(function(){
  set_menu();
  get_exercise_data();
});

function set_menu(){
  $("#exercise").empty();
  $("#exercise").append('<option disabled selected>選択してください</option>');
  //#exercise初期化
  $("#delete_exercise").empty();
  $.ajax({
    type:"POST",
    url: './sql.php',
    datatype:"json",
    data:{
      "submit-type":3
    },
    success:function(data){

      $.each(data,function(key, value) {
        var list_code = "<option value=\""
        +value.id
        +"\">"
        +value.exercise_name+"/"+value.count_type
        +"</option>"
        $("#exercise").append(list_code);
        var del_exe = "<button class=\"delete_menu\" value="+value.id+">"+value.exercise_name+"/"+value.count_type+"</button>";
        $("#delete_exercise").append(del_exe);
      });
    }
  })
}

function get_exercise_data()
{
  var id_list = [];
  $.ajax
  (
  {
    type:"POST",
    url:"./sql.php",
    datatype:"json",
    data:
    {
      "submit-type":4
    },
    success:function(data)
    {
      $("#exercise_log").empty();
      $(".button-area").empty();
      $(".button-area").append('<button class=\"tab-button\" id=\"all\">ALL</button>');
      $.each(data,function(key, value) 
      {
        var list_code ="<div class=\"log-box active-tab exe"+value.exercise_id+"\">"
        +"<p class=\"exercise_name\">"+value.exercise_name+"</p>"
        +"<p class=\"count\">"+value.count+"</p>"
        +"<p class=\"count_type\">"+value.count_type+"</p>"
        +"<p class=\"date_data\">"+value.date_data+"</p>"
        +"<button  class=\"id_button\" value=\""+value.id+"\" class=\"delete-log\">削除</button>"
        +"</div>";
        $("#exercise_log").append(list_code);
        if(id_list.find(item => item === value.exercise_id) == undefined){
          console.log("a",value.exercise_id);
          id_list.push(value.exercise_id);
          var  add_button = "<button class=\"tab-button\" id=\"exe"+value.exercise_id+"\">"+value.exercise_name+"</button>"
          $(".button-area").append(add_button);
        }
      });

      $(document).ready(function()
      {
        console.log("動的検知");
        $(function(){
          $(".tab-button").on("click",function(){
            $(".tab-button").removeClass('active-button');
            $(this).addClass('active-button');
            $(".log-box").removeClass('active-tab');
            var tab_id = $(this).attr("id");
            console.log("a",tab_id);
            if (tab_id =="all"){
              $(".log-box").addClass('active-tab');
            }
            else{
              $("."+tab_id).addClass('active-tab');
              console.log("aa",$("."+tab_id));
            }
          });
        });

        $(function(){
          $(".id_button").on("click",function(){
           $.ajax({
            type: "POST",
            url: "./sql.php",
            datatype: "json",
            data: {
              "submit-type":5,
              "id" : $(this).val(),
            },
            success: function(data) {
              console.log("登録したトレーニングを削除しました");
              get_exercise_data();
            },
            error: function(data) {
              console.log("error");
            }
          });
         });
        });
      });
      $(function(){
        $(".delete_menu").on("click",function(){
          if(confirm("トレーニングを削除すると対応する記録のデータも削除されます。よろしいですか？")){
            $.ajax({
              type:"POST",
              url:"./sql.php",
              datatype:"json",
              data:{
                "submit-type":6,
                "id":$(this).val()
              },
              success:function(data){
                console.log("登録したメニューを削除しました");
                set_menu();
                get_exercise_data();
              }
            });
          }
        });
      });
    }
  });
}