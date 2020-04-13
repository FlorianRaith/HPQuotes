<template>
  <div class="books btns">
    <div class="book animate-out" v-for="(title, index) in $options.bookTitles" :key="index" :class="{selected: books.includes(index + 1)}">
        <div class="check">&#10003;</div>
        <img :src="'/images/book' + (index + 1) + '.jpg'" :alt="title" :title="'Harry Potter And The ' + title" @click="toggleBook(index + 1)">
        <p>{{ title }}</p>
    </div>
  </div>
</template>

<style scoped>
.book {
   margin: .2rem .6rem;
   width: 110px;
   position: relative;
}

.book img:hover {
  box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);  
}

.book img {
  width: 100%;
  height: 160px;
  border: solid 2px rgb(11, 3, 27);
  cursor: pointer;
  transition: all .1s;
}

.book.selected .check {
  display: block;
  position: absolute;
  right: 0;
  top: -10px;
  color: white;
  text-shadow: 0px 0px 4px #000;
  font-family: sans-serif;
  font-size: 1.5rem;
  text-align: center;
}

.book:not(.selected) .check {
  display: none;
}

.book:not(.selected) img {
  opacity: 0.4;
  filter: alpha(opacity=40); /* msie */
  background-color: #000;
}

.book:not(.selected) img:hover {
  opacity: 1.0;
  filter: alpha(opacity=100); /* msie */
}
</style>

<script>
import { bookTitles } from '../../../staticData';
 
export default {
  props: ['default'],
  data() {
    return {
      books: null,
    }
  },
  beforeMount() {
    this.books = this.default;
    this.$emit('input', this.books);
  },
  methods: {
    toggleBook(book) {
      if(this.books.includes(book)) {
        this.books.splice(this.books.indexOf(book), 1);
      } else {
        this.books.push(book);
      }
      this.$emit('input', this.books);
      this.$emit('update-books', this.books);
    }
  },
  created() {
    this.$options.bookTitles = bookTitles;
  }
}
</script>