<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

    <div id="app">
      <p>Texto:</p>
      <p v-html="message"></p>
      <p>JSON:</p>
      <p v-html="op"></p>
      <input v-model="input" v-on:keyup="letters">
    </div>

  </body>
  <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
  <script type="text/javascript">

  var app = new Vue({
        el: '#app',
        data: {
          message: '',
          input:"",
          op:{"num0":{"num":5},"num1":{"op":"add"},"num2":{"num":3}}
        },
        methods:{
          letters: function(){
            var input = this.input;
            var length = input.length;
            input = input.split("");
            for(i=0;i<length;i++){
              if(input[i] == '*'){
                input[i] = '<span style="color:red;">x</span>';
              }
              if(input[i] == '/'){
                input[i] = '<span style="color:red;">/</span>';
              }
              if(input[i] == '-'){
                input[i] = '<span style="color:blue;">-</span>';
              }
              if(input[i] == '+'){
                input[i] = '<span style="color:blue;">+</span>';
              }
            }
            input = input.join('');
            this.op = this.op.num0;
             this.message = input;
          }
        }
        })

  </script>
</html>
