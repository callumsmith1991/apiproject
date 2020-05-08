<template>
  <div v-if="booksToShow">
    <form @submit.prevent="filterBooks">
      <div class="row">
        <div class="col-md-2">
          <div class="form-group">
            <label>Category</label>
            <input type="text" class="form-control" v-model="categoryFilter" />
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <label>Author</label>
            <input type="text" class="form-control" v-model="authorFilter" />
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <button type="submit" class="btn btn-secondary">Filter</button>
          </div>
        </div>
      </div>
    </form>
    <p>{{message}}</p>
    <table class="table table-dark">
      <thead>
        <tr>
          <th>
            <strong>ISBN</strong>
          </th>
          <th>
            <strong>Title</strong>
          </th>
          <th>
            <strong>Author</strong>
          </th>
          <th>
            <strong>Category</strong>
          </th>
          <th>
            <strong>Price</strong>
          </th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="book in books" :key="book.id">
          <td>{{ book.ISBN }}</td>
          <td>{{ book.title }}</td>
          <td>{{ book.author }}</td>
          <td>{{ book.category }}</td>
          <td>{{ book.price }} GDP</td>
        </tr>
      </tbody>
    </table>
    <router-link to="/create/" class="btn btn-primary">Create Book</router-link>
  </div>
  <div v-else>
    <p>{{message}}</p>
    <router-link to="/create/" class="btn btn-primary">Create Book</router-link>
  </div>
</template>

<script>
export default {
  data() {
    return {
      message: "",
      books: [],
      booksToShow: "",
      authorFilter: "",
      categoryFilter: "",
      defaultBooksList: []
    };
  },
  created() {
    this.axios.get("http://127.0.0.1:8000/api/").then(response => {
      this.message = response.data.message;
      this.books = response.data.books;
      this.defaultBooksList = response.data.books;
      this.booksToShow = true;
    });
  },
  methods: {
    filterBooks() {
      if (this.categoryFilter && this.authorFilter) {
        this.axios
          .get(
            "http://127.0.0.1:8000/api/categories/" +
              this.categoryFilter +
              "/author/" +
              this.authorFilter +
              ""
          )
          .then(response => {
            this.message = response.data.message;
            this.books = response.data.books;
          })
          .catch(error => {
            this.message = error.response.data.message;
            this.books = this.defaultBooksList;
          });
      } else if (this.categoryFilter) {
        this.axios
          .get(
            "http://127.0.0.1:8000/api/categories/" + this.categoryFilter + ""
          )
          .then(response => {
            this.message = response.data.message;
            this.books = response.data.books;
          })
          .catch(error => {
            this.message = error.response.data.message;
            this.books = this.defaultBooksList;
          });
      } else if (this.authorFilter) {
        this.axios
          .get("http://127.0.0.1:8000/api/author/" + this.authorFilter + "")
          .then(response => {
            this.message = response.data.message;
            this.books = response.data.books;
          })
          .catch(error => {
            this.message = error.response.data.message;
            this.books = this.defaultBooksList;
          });
      } else {
        this.message = "No filter Option chosen";
        this.books = this.defaultBooksList;
      }
    }
  }
};
</script>