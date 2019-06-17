<template>
    <div id="container">
        <div class="exercise-container">
            <div id="tabs" class="d-flex justify-content-between">
                <div>
                    <button class="btn btn-dark" @click="currentTab = 1">Завдання</button>
                    <button class="btn btn-dark" @click="currentTab = 2">Редактор</button>
                    <button class="btn btn-dark" @click="currentTab = 3">Вивід</button>
                </div>
                <div>
                    <button class="btn btn-primary" @click="run">Перевірити</button>
                </div>
                <div>
                    <div class="btn-group">
                        <a :href="prevUrl" class="btn btn-secondary">&larr; Попереднє</a>
                        <a :href="nextUrl" class="btn btn-info">Далі &rarr;</a>
                    </div>
                </div>
            </div>
            <monaco-editor
                    id="editor"
                    class="editor"
                    v-model="code"
                    theme="vs-dark"
                    :options="options"
                    language="php"
                    v-show="currentTab === 2"
            >
            </monaco-editor>
            <div v-show="currentTab === 1" class="text-white" v-html="marked(exercise.body)"></div>
            <div v-show="currentTab === 3" class="text-white" v-bind:class="{ 'text-danger': output.response.error }">
                <span v-if="output.response.error">Помилка: <br></span>
                {{ output.response.stdout }}
            </div>
        </div>
    </div>
</template>

<script>
    import MonacoEditor from 'vue-monaco-cdn'

    export default {
        props: ['exercise', 'next-url', 'prev-url'],
        data() {
            return {
                currentTab: 1,
                code: "<\?php\n//код\n",//"<\?php echo \"Привіт світ!\";",
                output: {
                    is_passed: false,
                    response: {
                        error: "",
                        stderror: "",
                        stdout: ""
                    }
                },
                options: {
                    language: 'php',
                    fixedOverflowWidgets: true,
                    minimap: {enabled: false},
                    automaticLayout: true,
                    scrollBeyondLastLine: false
                }
            }
        },
        methods: {
            run: function () {
                let self = this;
                axios.post('/api/exercise/check', {
                    id: this.$props.exercise.id,
                    code: this.$data.code
                }).then(function (response) {
                    self.$data.output = response.data;
                    self.$data.currentTab = 3;

                    let is_passed = response.data.is_passed;

                    self.$swal({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 4000,
                        type: is_passed ? 'success' : 'error',
                        title: is_passed ? 'Правильно!' : 'Невдача',
                        text: is_passed ?
                            'Програма повернула правильний результат.' :
                            'Спробуйте перевірити ваш код і запустити ще раз'
                    });

                }).catch(function (error) {
                    console.log(error);
                });
            }
        },
        components: {
            MonacoEditor
        }
    }
</script>

<style>
    .exercise-container {
        height: 100%;
        display: flex;
        flex-direction: column;
        background: #1D2021;
    }

    #container {
        height: 100vh;
        width: 100%;
    }

    #editor {
        flex: 1;
        overflow: hidden;
    }

    #tabs {
        width: 100%;
        margin: 0;
    }

    #tabs button, #tabs a {
        padding: 2px 0.75rem;
    }
</style>