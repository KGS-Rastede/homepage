<!doctype html>
<html lang="en">

<head>
  <title><?= $site->title() ?></title>

  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <?= css('assets/css/tailwind-build.css') ?>

  <?= js('https://cdn.jsdelivr.net/npm/vue/dist/vue.js') ?>
  <?= js('assets/js/main.js') ?>

</head>

<script>
import Vue from 'vue'
import App from '../../assets/js/App.vue'

Vue.config.productionTip = false

new Vue({
  render: h => h(App),
}).$mount('#app')
</script>

<body class="bg-gray-300">
