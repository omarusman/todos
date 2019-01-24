/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// require('./bootstrap');

window.Vue = require('vue');
window.Http = require('axios').default;
window._ = require('lodash');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data: {
        todo: "",
        todoList: []
    },
    methods: {

        /**
         * Get all todo items.
         */
        all() {

            Http.get("/todos").then(response => {

                this.todoList = response.data.data;

            }).catch(error => console.log(error));
        },

        /**
         * Add todo item.
         */
        add() {

            Http.post("/todos", {todo: this.todo}).then(response => {

                this.todoList.unshift(response.data.data);
                this.todo = "";

            }).catch(error => console.log(error));
        },

        /**
         * Delete todo item.
         *
         * @param id
         */
        destroy(id) {

            Http.delete("/todos/" + id).then(() => {

                this.todoList = _.difference(this.todoList, _.remove(this.todoList, {id: id}));

            }).catch(error => console.log(error));
        }
    },

    mounted() {

        this.all();
    }
});
