<template>
  <div class="books btns">
    <div class="book" v-for="(title, index) in $options.bookTitles" :key="index" :class="{selected: books.includes(index + 1)}">
        <div class="check  ">&#10003;</div>
        <div class="img-holder" :style="'background-color: ' + $options.bookCoverColors[index]">
          <img 
            :alt="title" 
            :title="'Harry Potter And The ' + title" 
            @click="toggleBook(index + 1)"
          >
        </div>
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

.book .img-holder {
  height: 160px;
  border: solid 2px rgb(11, 3, 27);
}

.book img:hover {
  box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);  
}

.book img {
  width: 100%;
  height: 100%;
  cursor: pointer;
  transition: filter .1s, opacity .2s;
}

.hide {
  opacity: 0;
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
  z-index: 10;
}

.book:not(.selected) .check {
  display: none;
}

.book:not(.selected) img {
  filter: grayscale() contrast(.6); /* msie */
  background-color: #000;
}

.book:not(.selected) img:hover {
  filter: none; /* msie */
}
</style>

<script>
import { mapState, mapActions } from 'vuex';
import { bookTitles, bookCoverColors } from '../../staticData';
 
export default {
  props: ['default'],
  data() {
    return {
      shouldLoad: true,
      books: null,
    }
  },
  beforeMount() {
    this.books = this.default;
    this.$emit('input', this.books);
  },
  computed: mapState(['bookImagesLoaded']),
  methods: {
    ...mapActions(['loadBookImages']),
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
  watch: {
    bookImagesLoaded() {
      this.shouldLoad = true;

      const books = document.getElementsByClassName('book');
      let i = 0;
      const interval = setInterval(() => {
        books[i].childNodes[2].childNodes[0].classList.remove('hide');
        books[i].childNodes[2].childNodes[0].src = '/images/book' + (i + 1) + '.jpg';  
        if(++i === books.length) clearInterval(interval);
      }, 50);
    
    }
  },
  created() {
    if(!this.bookImagesLoaded) {
      this.shouldLoad = false;
      this.loadBookImages();
    }
    this.$options.bookTitles = bookTitles;
    this.$options.bookCoverColors = bookCoverColors;
  },
  mounted() {
    const books = document.getElementsByClassName('book');
    for(let i = 0; i < books.length; i++) {
      if(!this.shouldLoad) {
        books[i].childNodes[2].childNodes[0].classList.add('hide');
      } else {
        books[i].childNodes[2].childNodes[0].src = '/images/book' + (i + 1) + '.jpg';
      }
    }
  }
}
</script>