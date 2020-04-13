<template>
  <div class="centered-container">
    <h1>Game Settings</h1>
    <h3>Select Difficulty</h3>
    <SelectDifficulty v-model="difficulty" :default="difficulty" />
    <h3>Select Rounds:</h3>
    <SelectRounds v-model="rounds" :default="rounds" />
    <h3 class="books-title">Select Books:</h3>
    <SelectBooks v-model="books" :default="books" @update-books="updateStartButton" />
    <!-- <a href="#" @click.prevent="submitSettings" class="animate-out btn-main start-game" :class="{error: !canStart}">
      {{ startButtonText }}
    </a> -->
    <router-link :to="'/game/' + gameID" class="btn-main start-game" :class="{error: !canStart}">
      {{ startButtonText }}
    </router-link>
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

<script>
import SelectDifficulty from './SelectDifficulty';
import SelectRounds from './SelectRounds';
import SelectBooks from './SelectBooks';

const rotInput = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';
const rotOutput = 'NOPQRSTUVWXYZ0123456789ABCDEFGHIJKLMnopqrstuvwxyzabcdefghijklm';
const seedChars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'
const seed = generateSeed();

function generateSeed() {
  let seed = '';
  for(let i = 0; i < 4; i++) {
    seed += seedChars[~~(Math.random() * seedChars.length)];
  }
  return seed;
}

export default {
  data() {
    return {
      difficulty: 'easy',
      rounds: 10,
      books: [1, 2, 3, 4, 5, 6, 7],
      canStart: true,
      startButtonText: 'Start Game',
      interval: null
    }
  },
  computed: {
    gameID() {
      return this.rot('en' + this.difficulty[0] + (this.books.length === 7 ? 0 : this.books.join('')) + seed + this.rounds); 
    }
  },
  methods: {
    updateStartButton(books) {
      this.canStart = this.books.length !== 0;
      this.startButtonText = this.canStart ? 'Start Game' :
                                             'You have to select at least one book!'
    },
    rot(str) {
      const index = x => rotInput.indexOf(x);
      const translate = x => index(x) > -1 ? rotOutput[index(x)] : x;
      return str.split('').map(translate).join('');
    }
  },
  components: {
    SelectDifficulty,
    SelectRounds,
    SelectBooks
  }
}
</script>