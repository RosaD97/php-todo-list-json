
const { createApp } = Vue;

createApp({
    data() {
        return {
            newTodo: '',
            apiUrl: 'server.php',
            todos: []
        }
    },
    methods: {
        getTodos() {
            axios.get(this.apiUrl)
                .then((response) => {
                    this.todos = response.data;
                })
        },
        // Metodo per l'aggiunta dei todo
        addTodo() {
            const data = {
                add: true,
                todo: this.newTodo
            };
            const headers = {
                'Content-Type': 'multipart/form-data',
                'Accept': 'application/json',
            }
            axios.post(this.apiUrl, data, { headers })
                .then((response) => {
                    this.todos = response.data;
                })
            this.newTodo = '';
        },
        removeTodo(i){
            const data = {
                delete: i
            };
            const headers = {
                'Content-Type': 'multipart/form-data',
                'Accept': 'application/json',
            }

            axios.post(this.apiUrl, data, { headers })
            .then((response) => {
                this.todos = response.data;
                // console.log('elimina');
            })
        }
    },
    created() {
        // Lettura dei todos
        this.getTodos();
    }
}).mount('#app');