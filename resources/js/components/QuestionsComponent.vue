<template>
    <div>
        <!-- index is used to check with current question index -->
        <div v-for="(question, index) in questions">
            <!-- Hide all questions, show only the one with index === to current question index -->
            <div v-show="index === questionIndex">
                <div v-html="marked(question.body)"></div>
                <ul>
                    <li v-for="answer in question.answers">
                        <label>
                            <!-- The radio button has three new directives -->
                            <!-- v-bind:value sets "value" to "true" if the response is correct -->
                            <!-- v-bind:name sets "name" to question index to group answers by question -->
                            <!-- v-model creates binding with userResponses -->
                            <input type="radio"
                                   v-bind:value="question.answer_id === answer.id"
                                   v-bind:name="index"
                                   v-model="userResponses[index]">
                            {{ answer.title }}
                        </label>
                    </li>
                </ul>
            </div>
        </div>

        <!-- The two navigation buttons -->
        <div v-show="questionIndex !== questions.length" class="btn-group btn-group-lg">
            <!-- Note: prev is hidden on first question -->
            <button v-if="questionIndex > 0" v-on:click="prev" class="btn btn-warning">
                &larr; Назад
            </button>
            <button v-on:click="next" class="btn btn-info">
                Вперед &rarr;
            </button>
        </div>
        <div v-show="questionIndex === questions.length">
            <h2>
                Тести пройдено.
            </h2>
            <a :href="nextUrl" class="btn btn-lg btn-success">Продовжити &rarr;</a>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['questions', 'next-url'],
        data() {
            return {
                // Store current question index
                questionIndex: 0,
                // An array initialized with "false" values for each question
                // It means: "did the user answered correctly to the question n?" "no".
                userResponses: Array(this.questions.length).fill(false)
            }
        },
        methods: {
            // Go to next question
            next: function () {
                let currentQuestion = this.userResponses[this.questionIndex];
                //If selected bad answer
                if (!currentQuestion) {
                    this.$swal({
                        type: 'error',
                        title: 'Відповідь хибна',
                        text: 'Спробуйте ще раз'
                    });
                } else {
                    this.$swal({
                        type: 'success',
                        title: 'Правильно!',
                        text: 'Продовжуйте далі :)'
                    });
                    this.questionIndex++;
                }
            },
            // Go to previous question
            prev: function () {
                this.questionIndex--;
            },
        }
    }
</script>

<style scoped>

</style>