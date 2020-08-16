<template>
  <div id="app" class="antialiased text-gray-900">
    <div class="bg-gray-200 min-h-screen">
      <Navbar/>
    </div>
  </div>
</template>


<script>
import Navbar from 'http://kirby/assets/js/components/Navbar.vue'
export default {
  name: 'app',
  components: {
    Navbar
  },
}
</script>