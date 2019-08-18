<template>
  <div>
    <div v-for="todo in todos" v-bind:key="todo.id">
      <TodoItem
        @del-todo="$emit('del-todo', todo.id)"
        @toggle-todo="$emit('toggle-todo', todo.id)"
        v-bind:todo="todo"
      />
    </div>
  </div>
</template>

<script>
import TodoItem from "./TodoItem";

export default {
  name: "TodoList",
  props: ["todos"],
  components: {
    TodoItem
  }
};
</script>

<style lang="scss" scoped>
</style>