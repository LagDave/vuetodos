<template>
  <div>
    <div class="overlay">
      <div class="overlay__inner">
        <div class="overlay__content">
          <span class="spinner"></span>
        </div>
      </div>
    </div>

    <div style="border:none; padding:0 30px" class="mb-2">
      <div class="row align-items-center">
        <div class="col-9">
          <div class="custom-control custom-checkbox">
            <input
              @change="$emit('toggle-todo', todo.id);"
              type="checkbox"
              class="custom-control-input"
              v-bind:id="todo.id"
              v-bind:checked="todo.is_completed == 1"
            />
            <label
              style="text-decoration:"
              v-bind:for="todo.id"
              :class="{'custom-control-label': true, 'is-completed': todo.is_completed == 1}"
            >{{todo.title}}</label>
          </div>
          <small class="text-muted">{{todo.created_at}}</small>
        </div>
        <div class="col-3">
          <p class="icons">
            <i @click="$emit('del-todo', todo.id)" class="fas fa-trash delete-icon"></i>
            <i @click="$emit('update-todo', todo)" class="fas fa-pen update-icon"></i>
          </p>
        </div>
      </div>
    </div>
    <hr />
  </div>
</template>

<script>
export default {
  props: ["todo"],
  methods: {
    toggleTodo(id) {}
  }
};
</script>

<style scoped>
.is-completed {
  text-decoration: line-through !important;
}
.icons {
  text-align: center;
}
.delete-icon {
  color: rgb(255, 96, 79);
  font-size: 1.3em;
  margin-right: 10px;
}
.update-icon {
  color: rgba(255, 196, 0, 0.767);
  font-size: 1.3em;
}

.fa-trash,
.fa-pen {
  transition: 0.2s;
  cursor: pointer;
}
.fa-trash:hover,
.fa-pen:hover {
  transform: scale(1.2, 1.2);
}
</style>