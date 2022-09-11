<template>
    <div>
        <div v-if="exam == null" class="mt-5">
            <div class="alert alert-danger">Invalid Exam</div>
            <a href="/welcome" class="btn btn-link text-danger">return</a>
        </div>
        <div v-else>
            <div  class="my-4 d-flex align-items-center">
                <h3 class="">{{student.name}}'s Result &nbsp; - &nbsp; <span class="text-danger">{{exam.score}}/{{exam.total_question}}</span></h3>
            </div>

            <div class="question_bank">
                <form class="w-100" >
                    <div v-for="(question, index) in questions" :key="index" class="card p-3 rounded mb-5 shadow-sm" >
                        <div class="d-flex">
                            <div class="px-3 mt-3">
                                <h6 class="badge bg-primary text-white">{{question.question_number}}</h6>
                            </div>

                            <div class="w-100">
                                <div class="question mb-3">
                                    <h3 v-html="question.question.question"></h3>
                                </div>
                                <div>
                                    <div class="answers">
                                        <p :class="question.answer == question.question.answer ? 'text-success' : 'text-danger'" >Your Answer: {{question.answer}}</p>
                                        <p class="text-success" >Correct Answer: {{question.question.answer}}</p>
                                    </div>
                                </div>

                                <div v-if="question.question.reason !== null ">
                                    <div class="answers">
                                        <h6 class="reason" >Reason</h6>
                                        <p class="text-success" >{{question.question.reason}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="my-3 text-center">
                        <a href="#!"  class="btn bg-none text-danger">Exit</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</template>


<script>
export default {
    data() {
        return {
            questions : [],
            exam : {},
            student : {},
        }
    },
    props : ["user"],

    methods: {
        async fetchQuestions(){
            let pathname = window.location.pathname;
            let url = "/get-details";
            var data = {'pathname' : pathname}

            let response = await axios.post(url, data)
            console.log(response)
            this.exam = response.data.exam
            this.student = response.data.exam.student
            this.questions = response.data.exam_questions
        },
    },

    mounted() {
        this.fetchQuestions();
    },
}
</script>