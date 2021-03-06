<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
<form action="process.php" method="post">
    <div id="app">
      <p>Text:</p>
      <p v-html="message"></p>
      <p v-html="op"></p>
      <input type="hidden" name="json" :value="op">
      <label for="">Operation:</label>
      <input v-model="input" v-on:keyup="letters"><br>
      <label for="">Value of "x":</label>
      <input name="var1" value="0">
    </div>
    <button type="submit" name="button">calculate</button>
</form>
  </body>
  <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
  <script src="dMath.js"></script>
  <script type="text/javascript">
  var app = new Vue({
        el: '#app',
        data: {
          message: '',
          input:"",
          op:[]
        },
        methods:{
          letters: function(){
            var input = this.input;
             this.message = calcText(input);
          }
        }
        })
  </script>
</html>
