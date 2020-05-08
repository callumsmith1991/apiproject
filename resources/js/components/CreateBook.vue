<template>
  <div class="row">
    <div class="col-md-6">
      <form @submit.prevent="createBook">
        <div class="form-group">
          <label>ISBN</label>
          <input type="text" class="form-control" v-model="book.ISBN" />
        </div>
        <div class="form-group">
          <label>Title</label>
          <input type="text" class="form-control" v-model="book.title" />
        </div>
        <div class="form-group">
          <label>Author</label>
          <input type="text" class="form-control" v-model="book.author" />
        </div>
        <div class="form-group">
          <label>Category (if adding multiple categories, please seperate each by comma)</label>
          <input type="text" class="form-control" v-model="book.category" />
        </div>
        <div class="form-group">
          <label>Price (GDP)</label>
          <input type="text" class="form-control" v-model="book.price" />
        </div>
        <button type="submit" class="btn btn-primary">Add Book</button>
        <router-link to="/" class="btn btn-secondary">Back to All Books</router-link>
      </form>
    </div>
    <div class="col-md-6">
      <div class="alert alert-danger" role="alert" v-if="hasValidationErrors">
        {{ message }}
        <ul>
          <li v-for="error in errors" :key="error">{{ error }}</li>
        </ul>
      </div>
      <div class="alert alert-success" role="alert" v-if="success">{{ message }}</div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      book: {},
      errors: [],
      hasValidationErrors: false,
      success: "",
      message: ""
    };
  },
  methods: {
    createBook() {
      this.axios
        .post("http://127.0.0.1:8000/api/create/", this.book)
        .then(response => {
          console.log(response.data);

          if (this.hasValidationErrors == true) {
            this.hasValidationErrors = false;
          }

          this.success = true;
          this.message = response.data.message;
        })
        .catch(error => {
          console.log(error.response.data);

          this.success = false;

          this.hasValidationErrors = true;

          if (error.response.data.errors) {
            var errorsArr = [];

            var errors = Object.entries(error.response.data.errors);

            for (var i = 0; i < errors.length; i++) {
              errorsArr.push(errors[i][1][0]);
            }

            this.errors = errorsArr;
            
          }

          this.message = error.response.data.message;
        });
    }
  }
};
</script>