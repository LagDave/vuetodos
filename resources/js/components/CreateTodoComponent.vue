<template>
  <div>
    <form @submit.prevent="saveTodo" method="POST" class="form">
      <div class="row">
        <div class="col-9 px-0">
          <div class="form-group">
            <input
              v-model="title"
              placeholder="What should you do?"
              type="text"
              class="form-control"
            />
          </div>
        </div>
        <div class="col-3 pl-2 pr-0">
          <button class="btn btn-primary w-100">Save</button>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      title: ""
    };
  },
  methods: {
    saveTodo() {
      const todo = {
        title: this.title
      };
      this.$emit("create-todo", todo);
      this.title = "";
    }
  }
};
</script>