<template>
  <div class="container">
    <header class="navbar">
      <section class="navbar-section">
        <router-link to="/" class="navbar-brand mr-2">HPQuotes.com</router-link>
      </section>
      <section class="navbar-section">
        <a href="#" class="btn btn-link">About</a>
        <a href="#" class="btn btn-link">GitHub</a>
      </section>
    </header>
  </div>
</template>

<style scoped>
.container {
  margin: 0;
  padding: 0;
}

.navbar {
  background: rgb(11, 3, 27);
  padding: .5rem;
  box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);
}
.navbar-brand {
  color: rgb(255, 240, 18);
  font-weight: 600;
  padding-left: 0.4rem;
}
</style>



<script>
export default {
  
}
</script>
