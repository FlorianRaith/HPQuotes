<template>
  <div>
    <h1>Harry Potter Quotes</h1>
    <p class="intro">
      Would you say you're a real Harry Potter fan? Test yourself by getting a quote from the Harry Potter books where you need to identify the author.
    </p>
    <div class="btns">
      <router-link to="/create" class="btn-main new-game" :class="{'fade-in': bookImagesLoaded}">New Game</router-link>
    </div>
  </div>
</template>

<style scoped>
.intro {
  text-align: center;
  font-size: 1rem;
  max-width: 600px;
  margin: 1.5rem 0.5rem 2.5rem 0.5rem;
}

.new-game {
  opacity: 0;
  transition: opacity .2s;
}

.fade-in {
  opacity: 1;
}

@media (max-height: 800px) {
  h1 {
    margin-top: 2rem;
  }
}

@media (max-height: 700px) {
  html, body {
    font-size: 100%;
  }
}
</style>

<script>
import { mapState, mapActions } from 'vuex';

export default {
  created() {
    if(!this.bookImagesLoaded) this.loadBookImages();
  },
  computed: {
    ...mapState(['bookImagesLoaded'])
  },
  methods: {
    ...mapActions(['loadBookImages']),
  },
  beforeRouteLeave (to, from, next) {
    if(!this.bookImagesLoaded) next(false);
    else next();
  }
}
</script>