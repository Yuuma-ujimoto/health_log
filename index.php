<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
  <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
  <script src="./script.js"></script>
  <link rel="stylesheet" type="text/css" href="./style.css">
</head>
<body>
  <main>
    <section class="section">
      <h2>トレーニングの結果を記録</h2>
      <div class="input-wrap">
        <select id="exercise">
          <!--うまいこと行けばここにデータが入る-->
        </select>
        <input type="number"  id="count" min="0">
        <button id="submit1">送信</button>
      </div>
   </section>

   <section class="section">
    <h2>新しくトレーニングの項目を登録</h2>
    <div class="input-wrap">
      
    <input type="text" id="exercise-name">
    <select id="count_type">
      <option>回</option>
      <option>秒</option>
      <option>分</option>
      <option>時間</option>
      <option>メートル</option>
      <option>キロメートル</option>
    </select>
    <button id="submit2">送信</button>
    </div>
  </section>

  <section class="section">
    <div class="button-area input-wrap">
    <button class="tab-button" id="all">ALL</button>
    </div>
  </section>
  <section class="section">
    <h2>トレーニングの記録</h2>
    <div id="exercise_log">

    </div>
  </section>
  <section id="delete_exercise">
    
  </section>
  
</main>
</body>
</html>