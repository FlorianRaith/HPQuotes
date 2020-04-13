<template>
  <div>
    <div v-if="loading" class="loader">
      <!-- <svg xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.0" width="50px" height="50px" viewBox="0 0 128 128" xml:space="preserve"><g><path d="M40.73 13.1l-4.04-7A63.67 63.67 0 0 1 61.5.06v8a55.83 55.83 0 0 0-20.77 5.05z" fill="#000000" fill-opacity="1"/><path d="M40.73 13.1l-4.04-7A63.67 63.67 0 0 1 61.5.06v8a55.83 55.83 0 0 0-20.77 5.05z" fill="#f8f8f8" fill-opacity="0.03" transform="rotate(30 64 64)"/><path d="M40.73 13.1l-4.04-7A63.67 63.67 0 0 1 61.5.06v8a55.83 55.83 0 0 0-20.77 5.05z" fill="#e8e8e8" fill-opacity="0.09" transform="rotate(60 64 64)"/><path d="M40.73 13.1l-4.04-7A63.67 63.67 0 0 1 61.5.06v8a55.83 55.83 0 0 0-20.77 5.05z" fill="#d4d4d4" fill-opacity="0.17" transform="rotate(90 64 64)"/><path d="M40.73 13.1l-4.04-7A63.67 63.67 0 0 1 61.5.06v8a55.83 55.83 0 0 0-20.77 5.05z" fill="#bebebe" fill-opacity="0.25" transform="rotate(120 64 64)"/><path d="M40.73 13.1l-4.04-7A63.67 63.67 0 0 1 61.5.06v8a55.83 55.83 0 0 0-20.77 5.05z" fill="#a6a6a6" fill-opacity="0.35" transform="rotate(150 64 64)"/><path d="M40.73 13.1l-4.04-7A63.67 63.67 0 0 1 61.5.06v8a55.83 55.83 0 0 0-20.77 5.05z" fill="#8e8e8e" fill-opacity="0.44" transform="rotate(180 64 64)"/><path d="M40.73 13.1l-4.04-7A63.67 63.67 0 0 1 61.5.06v8a55.83 55.83 0 0 0-20.77 5.05z" fill="#737373" fill-opacity="0.55" transform="rotate(210 64 64)"/><path d="M40.73 13.1l-4.04-7A63.67 63.67 0 0 1 61.5.06v8a55.83 55.83 0 0 0-20.77 5.05z" fill="#5a5a5a" fill-opacity="0.65" transform="rotate(240 64 64)"/><path d="M40.73 13.1l-4.04-7A63.67 63.67 0 0 1 61.5.06v8a55.83 55.83 0 0 0-20.77 5.05z" fill="#414141" fill-opacity="0.75" transform="rotate(270 64 64)"/><path d="M40.73 13.1l-4.04-7A63.67 63.67 0 0 1 61.5.06v8a55.83 55.83 0 0 0-20.77 5.05z" fill="#2a2a2a" fill-opacity="0.84" transform="rotate(300 64 64)"/><path d="M40.73 13.1l-4.04-7A63.67 63.67 0 0 1 61.5.06v8a55.83 55.83 0 0 0-20.77 5.05z" fill="#151515" fill-opacity="0.92" transform="rotate(330 64 64)"/><animateTransform attributeName="transform" type="rotate" values="0 64 64;30 64 64;60 64 64;90 64 64;120 64 64;150 64 64;180 64 64;210 64 64;240 64 64;270 64 64;300 64 64;330 64 64" calcMode="discrete" dur="700ms" repeatCount="indefinite"></animateTransform></g></svg> -->
    </div>

    <div v-if="error">
      <h3>Error</h3>
      <p>{{ error }}</p>
    </div>

    <div v-if="!loading && !finished" class="centered-container">
      <blockquote class="animation-in">
        <p> {{ quote.quote }} </p>
      </blockquote>
      <h3 class="animation-in">Who is the author?</h3>
      <div class="btns">
        <div class="author animation-in" v-for="(author, index) in possibleAuthors" :key="index">
          <img 
            :src="'/images/character' + author + '.jpg'" 
            :alt="name(author)" 
            :title="name(author)" 
            @click="selectAuthor(author)"
            :class="{ active: played && quote.author === author, 'not-active': played && quote.author !== author }"
          >
          <p>{{ name(author)}}</p>
        </div>
      </div>
    </div>

    <div v-if="finished" class="centered-container">
      <h1>Good job</h1>
      <p class="guesses ">You got {{ points }} out of {{ settings.rounds }} quotes correct!</p>
      <div class="btns">
        <router-link to="/" class="btn-main">Back to Home</router-link>
        <a @click.prevent="$emit('settings')" class="btn-main">Play Again</a>
      </div>
    </div>
  </div>
</template>

<style scoped>
blockquote {
  max-width: 800px;
  margin: .5rem .3rem;
  margin-top: 3.5rem;
  border-color: rgb(11, 3, 27);
}

p {
  margin: 0;
}

h3 {
  margin-top: 1rem;
  margin-bottom: 1.5rem;
}

.loader {
  margin-top: 3.5rem;
}

.author {
  width: 120px;
  margin: .3rem .9rem;
  position: relative;
}

.author img {
  width: 100%;
  height: 160px;
  border: solid 2px rgb(11, 3, 27);
  cursor: pointer;
  filter: grayscale() contrast(60%);
  transition: filter .1s;
}

.author img:hover {
  filter: none;
}

.author img.active {
  filter: none;
  border-color: green;
}

.author img.not-active {
  filter: grayscale() contrast(60%);
  border-color: red;
}

.guesses {
  margin: 2rem 0;
}

@media (max-height: 700px) {
  h3 {
    margin-top: .2rem;
    margin-bottom: 1rem;
  }
  blockquote {
    margin-top: .5rem;
  }
}
</style>

<style>
.animation-in {
  opacity: 0;
  transition: opacity .1s;
}

.fade-in {
  opacity: 1;
}
</style>

<script>
import { bookTitles, authors } from '../../staticData';

export default {
  props: ['settings'],
  data() {
    return {
      loaded: 0,
      finished: false,
      quotes: null,
      error: null,
      currentQuote: 0,
      points: 0,
      played: false,
    }
  },
  methods: {
    name(author) {
      return this.$options.authors[author - 1];
    },
    selectAuthor(author) {
      if(this.played) return;

      if(author === this.quote.author) {
        this.points++;
      }

      this.played = true;
      setTimeout(() => {
        
        if(this.currentQuote + 1 >= this.settings.rounds) {
          this.finished = true;
        } else {
          const elements = document.getElementsByClassName('animation-in');
          let i = 0;

          let interval = setInterval(() => {
            if(i >= elements.length * 2) {
              clearInterval(elements);
              return;
            }

            if(i == elements.length) {
              this.currentQuote++;
              this.played = false;
            }

            if(i < elements.length) {
              elements[i++].classList.remove('fade-in');
            } else {
              elements[i++ - elements.length].className += ' fade-in';
            }

          }, 50);
        }
      }, 1500);
    },
    loadImages() {
      const amount = 8;
      let loadedImages = 0;

      for(let i = 1; i <= amount; i++) {
        const image = new Image();
        image.onload = () => {
          loadedImages++;
          if(loadedImages === amount) {
            this.loaded++;
          }
        }
        image.src = '/images/character' + i + '.jpg';
      }
    }
  },
  watch: {
    loaded(value) {
      if(value < 2) return;

      const elements = document.getElementsByClassName('animation-in');
      let i = 0;
      let interval = setInterval(() => {
        if(i >= elements.length) {
          clearInterval(interval);
          return;
        }

        elements[i++].className += ' fade-in';
      }, 50);
    },
  },
  computed: {
    quote() {
      return this.quotes[this.currentQuote];
    },
    loading() {
      return this.loaded < 2;
    },
    possibleAuthors() {
      // Generating an array with random authors but the real one
      const allAuthors = [...Array(authors.length + 1).keys()].splice(1);
      allAuthors.splice(allAuthors.indexOf(this.quote.author), 1);

      const arr = [];
      let amount;
      if(this.settings.difficulty === 'easy') amount = 4;
      if(this.settings.difficulty === 'medium') amount = 6;
      if(this.settings.difficulty === 'hard') amount = 8;

      for(let i = 0; i < amount - 1; i++) {
        const randomAuthor = allAuthors[~~(Math.random() * allAuthors.length)];
        allAuthors.splice(allAuthors.indexOf(randomAuthor), 1);
        arr.push(randomAuthor);
      }

      // add the real author at a random index into the array
      arr.splice(~~(Math.random() * (arr.length + 1)), 0, this.quote.author);

      return arr;
    }
  },
  created() {
    this.loadImages();

    // fetching data
    const difficulty = this.settings.difficulty[0];
    const rounds = this.settings.rounds;
    const books = this.settings.books.length === 7 ? '0' : this.settings.books.join('');

    axios.get(`/api/v1/quotes/random/en/${difficulty}/${books}/${rounds}`)
      .then(response => {
        this.quotes = response.data;
      }).catch(error => {
        this.error = error;
      }).finally(() => {
        this.loaded++;
      });

    // attach static data
    this.$options.bookTitles = bookTitles;
    this.$options.authors = authors;
  }
}
</script>