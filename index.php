<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
<form action="process.php" method="post">
    <div id="app">
      <p>Texto:</p>
      <p v-html="message"></p>
      <p v-html="op"></p>
      <input type="hidden" name="json" :value="op">
      <input v-model="input" v-on:keyup="letters">
    </div>
    <button type="submit" name="button">calcular</button>
</form>
  </body>
  <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
  <script src="dMath.js"></script>
</html>
