<template>
  <div class="centered-container">
    <h1 class="animate-out">Game Settings</h1>
    <h3 class="animate-out">Select Difficulty</h3>
    <SelectDifficulty v-model="difficulty" :default="defaultDifficulty" />
    <h3 class="animate-out">Select Rounds:</h3>
    <SelectRounds class="animate-out" v-model="rounds" :default="defaultRounds" />
    <h3 class="books-title animate-out">Select Books:</h3>
    <SelectBooks v-model="books" :default="defaultBooks" @update-books="updateStartButton" />
    <a href="#" @click.prevent="submitSettings" class="animate-out btn-main start-game" :class="{error: !canStart}">
      {{ startButtonText }}
    </a>
  </div>
</template>

<style scoped>
.start-game, .books-title {
  margin-top: 1rem;
}

.start-game {
  margin-bottom: 3.5rem;
}

.start-game.error {
  background: red;
}
</style>

<style>
  .animate-out {
    transition: opacity .1s;
  }
  
  .fade-out {
    opacity: 0 !important;
  }
</style>

<script>
import SelectDifficulty from './SelectDifficulty';
import SelectRounds from './SelectRounds';
import SelectBooks from './SelectBooks';
import { setInterval, clearInterval } from 'timers';

export default {
  props: ['settings'],
  data() {
    return {
      difficulty: null,
      rounds: null,
      books: null,
      canStart: true,
      startButtonText: 'Start Game',
      interval: null
    }
  },
  computed: {
    defaultDifficulty() {
      return this.settings === null ? 'easy' : this.settings.difficulty;
    },
    defaultRounds() {
      return this.settings === null ? 10 : this.settings.rounds;
    },
    defaultBooks() {
      return this.settings === null ? [1, 2, 3, 4, 5, 6, 7] : this.settings.books;
    }
  },
  methods: {
    updateStartButton(books) {
      this.canStart = this.books.length !== 0;
      this.startButtonText = this.canStart ? 'Start Game' :
                                             'You have to select at least one book!'
    },
    submitSettings() {
      if(!this.canStart) return;

      // play fade out animation
      const elements = document.getElementsByClassName('animate-out');
      let i = 0;
      this.interval = setInterval(() => {
        if(i >= elements.length) {
          clearInterval(this.interval);
          this.$emit('input', { difficulty: this.difficulty, rounds: this.rounds, books: this.books });
          this.$emit('play');
          return;
        }
        elements[i++].className += ' fade-out';
      }, 50);

    }
  },
  destroyed() {
    clearInterval(this.interval);
  },
  components: {
    SelectDifficulty,
    SelectRounds,
    SelectBooks
  }
}
</script>