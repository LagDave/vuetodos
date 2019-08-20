<template>
  <div>
    <div class="overlay">
      <div class="overlay__inner">
        <div class="overlay__content">
          <span class="spinner"></span>
        </div>
      </div>
    </div>
    <NavBar />
    <div class="container">
      <br />
      <div class="row justify-content-center">
        <div class="px-0 col-lg-6">
          <div class="shadow card" style="border:none; padding:10px 30px">
            <CreateTodo @create-todo="createTodo" />
            <!-- Completed/Total -->
            <p>
              Completed:
              <span>{{completed_todos}} / {{total_todos}}</span>
            </p>
          </div>
        </div>
      </div>
      <br />
      <div class="row justify-content-center">
        <div class="shadow main-wrapper col-lg-6">
          <TodoList
            @update-todo="updateTodo"
            @del-todo="delTodo"
            @toggle-todo="toggleTodo"
            v-bind:todos="todos"
          />
        </div>
      </div>
    </div>
    <br />
  </div>
</template>


<script>
import TodoList from "./TodoListComponent";
import NavBar from "./NavBarComponent";
import CreateTodo from "./CreateTodoComponent";

export default {
  created() {
    this.fetchTodos();
  },
  components: {
    TodoList,
    NavBar,
    CreateTodo
  },
  data() {
    return {
      todos: {}
    };
  },
  computed: {
    completed_todos: function() {
      if (this.todos.length > 0) {
        return this.todos.filter(todo => {
          return todo.is_completed == 1;
        }).length;
      }
    },
    total_todos: function() {
      return this.todos.length;
    }
  },
  methods: {
    fetchTodos() {
      fetch("/api/todos")
        .then(res => res.json())
        .then(res => {
          this.todos = res.data;
          $(".overlay").css("display", "none");
        });
    },
    toggleTodo(id) {
      $(".overlay").css("display", "block");
      fetch(`/api/todos/toggle/${id}`, { method: "put" })
        .then(res => res.json())
        .then(res => {
          this.fetchTodos();
        })
        .catch(err => {
          console.log(err);
          alert("An Error has Occured! Please try again");
        });
    },
    delTodo(id) {
      $(".overlay").css("display", "block");
      fetch(`/api/todos/${id}`, { method: "delete" })
        .then(res => res.json())
        .then(res => {
          this.fetchTodos();
        })
        .catch(err => {
          console.log(err);
          alert("An Error has Occured! Please try again");
        });
    },
    createTodo(todo) {
      $(".overlay").css("display", "block");
      fetch("api/todos", {
        method: "POST",
        body: JSON.stringify(todo),
        headers: {
          "content-type": "application/json"
        }
      })
        .then(res => res.json())
        .then(res => {
          this.fetchTodos();
        })
        .catch(err => console.log(err));
    },
    updateTodo(todo) {
      $(".");
    }
  }
};
</script>


<style>
.main-wrapper {
  background: white;
  padding: 20px;
  border-radius: 10px;
}
.overlay {
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  position: fixed;
  background: #222;
  z-index: 999;
  display: none;
}

.overlay__inner {
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  position: absolute;
}

.overlay__content {
  left: 50%;
  position: absolute;
  top: 50%;
  transform: translate(-50%, -50%);
}

.spinner {
  width: 75px;
  height: 75px;
  display: inline-block;
  border-width: 2px;
  border-color: rgba(255, 255, 255, 0.05);
  border-top-color: #fff;
  animation: spin 1s infinite linear;
  border-radius: 100%;
  border-style: solid;
}

@keyframes spin {
  100% {
    transform: rotate(360deg);
  }
}
</style>