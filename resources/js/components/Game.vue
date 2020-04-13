<template>
  <div>
    <div v-if="loading">
      <h3>Loading...</h3>
    </div>

    <div v-if="invalidID">
      <h3>Invalid Game</h3>
    </div>

    <div v-if="error">
      <h3>Error</h3>
      <p>{{ error }}</p>
    </div>

    <div v-if="quotes && !finished" class="centered-container">
      <blockquote>
        <p> {{ quote.quote }} </p>
      </blockquote>
      <h3>Who is the author?</h3>
      <div class="btns">
        <div class="author" v-for="(author, index) in possibleAuthors" :key="index">
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
      <p class="guesses">You got {{ points }} out of {{ rounds }} quotes correct!</p>
      <div class="btns">
        <router-link to="/" class="btn-main">Back to Home</router-link>
        <router-link :to="{ name: 'newgame', params: { difficulty, rounds, books } }" class="btn-main">New Game</router-link>
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

<script>
import { bookTitles, authors } from '../staticData';
import { setTimeout } from 'timers';

const rotOutput = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';
const rotInput = 'NOPQRSTUVWXYZ0123456789ABCDEFGHIJKLMnopqrstuvwxyzabcdefghijklm';

export default {
  data() {
    return {
      loading: false,
      finished: false,
      quotes: null,
      error: null,
      invalidID: false,
      settings: null,
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
      if(author === this.quote.author) {
        this.points++;
      }

      this.played = true;
      setTimeout(() => {
        this.played = false;
        this.currentQuote++;

        if(this.currentQuote >= this.rounds) {
          this.finished = true;
        }
      }, 1500);
    },
    reverseRot(str) {
      const index = x => rotInput.indexOf(x);
      const translate = x => index(x) > -1 ? rotOutput[index(x)] : x;
      return str.split('').map(translate).join('');
    },
    parseGameID() {
      const regex = /^(en|de)(e|m|h)(0{1}|[1-7]{1,6})([a-zA-Z]{4})(\d+)$/
      const decoded = this.reverseRot(this.$route.params.gameid);

      const value = decoded.match(regex);

      if(value === null) {
        this.invalidID = true;
        return;
      }

      this.settings = {};
      this.settings.difficulty = value[2];
      this.settings.books = value[3];
      this.settings.seed = value[4];
      this.settings.rounds = value[5];
    },
    fetchQuotes() {
      axios.get(`/api/v1/quotes/random/en/${this.settings.difficulty}/${this.settings.books}/${this.settings.rounds}/${this.settings.seed}`)
        .then(response => {
            this.quotes = response.data;
        }).catch(error => {
            this.error = error;
        }).finally(() => {
            this.loading = false;
        });
    }
  },
  computed: {
    quote() {
      return this.quotes[this.currentQuote];
    },
    possibleAuthors() {
      // Generating an array with random authors but the real one
      const allAuthors = [...Array(authors.length + 1).keys()].splice(1);
      allAuthors.splice(allAuthors.indexOf(this.quote.author), 1);

      const arr = [];
      let amount;
      if(this.settings.difficulty === 'e') amount = 4;
      if(this.settings.difficulty === 'm') amount = 6;
      if(this.settings.difficulty === 'h') amount = 8;

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
    this.parseGameID();
    if(this.invalidID) return;
    this.fetchQuotes();    
    
    // attach static data
    this.$options.bookTitles = bookTitles;
    this.$options.authors = authors;
  }
}
</script>