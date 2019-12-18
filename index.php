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
          op:''
        },
        methods:{
          letters: function(){
            var input = this.input;
             this.message = calcText(input);
          }
        }
        })
function calcText(input){
  var length = input.length;
  input = input.split("");
  var jsonop = '{';
  var prevop = 1;
  for(i=0;i<length;i++){

    if(input[i] == '*'){
      jsonop = printNum(prevop,number,jsonop,numel);
      input[i] = ' <span style="color:red;">x</span> ';
      jsonop = jsonop+'"el'+i+'":{"op":"mult"},';
      prevop = 1;
    }
    else if(input[i] == '/'){
      jsonop = printNum(prevop,number,jsonop,numel);
      input[i] = ' <span style="color:red;">/</span> ';
      jsonop = jsonop+'"el'+i+'":{"op":"div"},';
      prevop = 1;
    }
    else if(input[i] == '-'){
      jsonop = printNum(prevop,number,jsonop,numel);
      input[i] = ' <span style="color:blue;">-</span> ';
      jsonop = jsonop+'"el'+i+'":{"op":"rest"},';
      prevop = 1;
    }
    else if(input[i] == '+'){
      jsonop = printNum(prevop,number,jsonop,numel);
      input[i] = ' <span style="color:blue;">+</span> ';
      jsonop = jsonop+'"el'+i+'":{"op":"add"},';
      prevop = 1;
    }
    else if(input[i] == '('){
      jsonop = printNum(prevop,number,jsonop,numel);
      input[i] = ' <span style="color:chocolate;">(</span> ';
      jsonop = jsonop+'"el'+i+'":{"group":{';
      prevop = 1;
    }
    else if(input[i] == ')'){
      jsonop = printNum(prevop,number,jsonop,numel);
      input[i] = ' <span style="color:chocolate;">)</span> ';
      jsonop = jsonop.substring(0, jsonop.length - 1);
      jsonop = jsonop+'}},';
      prevop = 1;
    }
    else if(input[i] == ' '){
      input[i] = '';
    }
    else if(input[i] == '='){
      input[i] = ' <span style="color:gold;">=</span> ';
      jsonop = jsonop+'"el'+i+'":{"num":'+number+'},';
      prevop = 1;
    }else{
      if(prevop == 1){
        var number = input[i];
        var numel = i;
      }else{
        number = number+input[i];
      }
      prevop = 0;
    }
  }

  jsonop = jsonop.substring(0, jsonop.length - 1);
  jsonop = jsonop+'}';
  console.log(JSON.parse(jsonop));
  app.op = jsonop;
  input = input.join('');
  return input;
}

function printNum(prevop,number,jsonop,numel){
  if(prevop == 0){
    jsonop = jsonop+'"el'+numel+'":{"num":'+number+'},';
  }
  return jsonop;
}
  </script>
</html>
