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
    else if(input[i] == '^'){
      jsonop = printNum(prevop,number,jsonop,numel);
      input[i] = ' <span style="color:chocolate;">^</span> ';
      jsonop = jsonop+'"el'+i+'":{"op":"pot"},';
      prevop = 1;
    }
    else if(input[i] == '?'){
      jsonop = printNum(prevop,number,jsonop,numel);
      input[i] = ' <span style="color:chocolate;">ROOT</span> ';
      jsonop = jsonop+'"el'+i+'":{"op":"sqr"},';
      prevop = 1;
    }
    else if(input[i] == ' '){
      input[i] = '';
    }else{
      if(prevop == 1){
        var number = input[i];
        var numel = i;
        var constantJson = jsonop;
        jsonop = constantJson+'"el'+numel+'":{"num":'+number+'},';
      }else{
        number = number+input[i];
        if(constantJson == ''){
          var constantJson = jsonop;
        }
        jsonop = constantJson+'"el'+numel+'":{"num":'+number+'},';
      }
      prevop = 0;
    }
  }

  jsonop = jsonop.substring(0, jsonop.length - 1);
  jsonop = jsonop+'}';
  app.op = jsonop;
  input = input.join('');
  return input;
}

function printNum(prevop,number,jsonop,numel){
  if(prevop == 0){

  }
  return jsonop;
}
