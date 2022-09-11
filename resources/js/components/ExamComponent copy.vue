<template>
    <div>
        <div v-if="exam == null" class="my-4">
            <div class="alert alert-danger">Invalid Exam</div>
            <a @click="returnHome" class="btn btn-link text-danger">return</a>
        </div>
        <div v-else-if="exam.status == 'close'">
            <div class="alert alert-danger">Invalid Exam</div>
            <a @click="returnHome" class="btn btn-link text-danger">return</a>
        </div>
        <div v-else>
            <div class="my-4">
                <small>
                    <span class="fa fa-user text-danger"></span> User: &nbsp;
                    <span class="">{{student.name}}</span> &nbsp; |
                </small>

                <small>
                    <span class="fa fa-clock text-success"></span> Start Time: &nbsp;
                    <span class="">{{exam.exam_created}}</span> &nbsp; |
                </small>
            </div>
            <div class="stop-watch-desktop" :class="sec_left < 100 ? 'bg-danger text-white' : 'bg-success text-white'">
                <strong>
                    {{time_left}}
                </strong>
            </div>

            <div class="question_bank">
                <div class="" style="position: sticky !important; top: 0; z-index: 100">
                    <div class="card p-3 mb-3 bg-none">
                        <div class="text-center" :class="sec_left < 100 ? 'alert alert-danger' : 'alert alert-success'">
                            <h1> 
                                <strong>
                                    TIME LEFT: {{time_left}}
                                </strong>
                            </h1>
                        </div>
                    </div>
                </div>
                <form class="w-100" @submit.prevent="submitMock">
                    
                    <div v-for="(question, index) in questions" class="card p-3 rounded mb-5 shadow-sm" >
                        <div class="d-flex">
                            <div class="px-3">
                                <h6 class="mt-3">{{question.question_number}}</h6>
                            </div>

                            <div class="w-100">
                                <div class="question mb-3">
                                    <h3 v-html='question.question.question'></h3>
                                </div>
                                <div>
                                    <div class="answers">
                                        <span v-if="question.answer == question.question.option_a">
                                            <input checked @click="answerClick(question.id, question.question.option_a)" type="radio" :name="question.question_number+'answer'" value="1" :id="question.id+'1id'" required="true" /> <label :for="question.id+'1id'" class="radio-ans" :class="question.answer == question.question.option_a ? 'fw-bold text-info' : '' ">A - {{question.question.option_a}}</label>  <hr />
                                        </span>
                                        <span v-else>
                                            <input @click="answerClick(question.id, question.question.option_a)" type="radio" :name="question.question_number+'answer'" value="1" :id="question.id+'1id'" required="true" /> <label :for="question.id+'1id'" class="radio-ans" :class="question.answer == question.question.option_a ? 'fw-bold text-info' : '' ">A - {{question.question.option_a}}</label>  <hr />
                                        </span>
                                        <span v-if="question.answer == question.question.option_b">
                                            <input checked @click="answerClick(question.id, question.question.option_b)" type="radio" :name="question.question_number+'answer'" value="2" :id="question.id+'2id'" required="true" /> <label :for="question.id+'2id'" class="radio-ans" :class="question.answer == question.question.option_b ? 'fw-bold text-info' : '' ">B - {{question.question.option_b}}</label> <hr />
                                        </span>

                                        <span v-else>
                                            <input @click="answerClick(question.id, question.question.option_b)" type="radio" :name="question.question_number+'answer'" value="2" :id="question.id+'2id'" required="true" /> <label :for="question.id+'2id'" class="radio-ans" :class="question.answer == question.question.option_b ? 'fw-bold text-info' : '' ">B - {{question.question.option_b}}</label> <hr />
                                        </span>

                                        <span v-if="question.answer == question.question.option_c">
                                            <input checked @click="answerClick(question.id, question.question.option_c)" type="radio" :name="question.question_number+'answer'" value="3" :id="question.id+'3id'" required="true" /> <label :for="question.id+'3id'" class="radio-ans" :class="question.answer == question.question.option_c ? 'fw-bold text-info' : '' ">C - {{question.question.option_c}}</label>  <hr />
                                        </span>

                                        <span v-else>
                                            <input @click="answerClick(question.id, question.question.option_c)" type="radio" :name="question.question_number+'answer'" value="3" :id="question.id+'3id'" required="true" /> <label :for="question.id+'3id'" class="radio-ans" :class="question.answer == question.question.option_c ? 'fw-bold text-info' : '' ">C - {{question.question.option_c}}</label>  <hr />
                                        </span>

                                        <span v-if="question.answer == question.question.option_d">
                                            <input checked @click="answerClick(question.id, question.question.option_d)" type="radio" :name="question.question_number+'answer'" value="4" :id="question.id+'4id'" required="true" /> <label :for="question.id+'4id'" class="radio-ans" :class="question.answer == question.question.option_d ? 'fw-bold text-info' : '' ">D - {{question.question.option_d}}</label>  <hr />
                                        </span>
                                        <span v-else>
                                            <input @click="answerClick(question.id, question.question.option_d)" type="radio" :name="question.question_number+'answer'" value="4" :id="question.id+'4id'" required="true" /> <label :for="question.id+'4id'" class="radio-ans" :class="question.answer == question.question.option_d ? 'fw-bold text-info' : '' ">D - {{question.question.option_d}}</label>  <hr />
                                        </span>

                                        <span v-if="question.answer == question.question.option_e">
                                            <input checked @click="answerClick(question.id, question.question.option_e)" type="radio" :name="question.question_number+'answer'" value="5" :id="question.id+'5id'" required="true" /> <label :for="question.id+'5id'" class="radio-ans" :class="question.answer == question.question.option_e ? 'fw-bold text-info' : '' ">E - {{question.question.option_e}}</label>  <hr />
                                        </span>
                    
                                        <span v-else>
                                            <input @click="answerClick(question.id, question.question.option_e)" type="radio" :name="question.question_number+'answer'" value="5" :id="question.id+'5id'" required="true" /> <label :for="question.id+'5id'" class="radio-ans" :class="question.answer == question.question.option_e ? 'fw-bold text-info' : '' ">E - {{question.question.option_e}}</label>  <hr />
                                        </span>
                                        <div class="d-flex justify-content-end">
                                            <input hidden @click="answerClick(question.id, '0')" type="radio" :name="question.question_number+'answer'" value="" :id="question.id+'6id'" required="true" /> <label :for="question.id+'6id'" class="radio-ans text-danger" >Clear answer</label> 
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="my-3 text-center">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <a href="#!" @click="exitPage" class="btn bg-none text-danger">Exit</a>
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
            time_left : '00',
            sec_left : 0,
            questionGroups : [],
        }
    },
    props : ["user", "title"],

    methods: {
        async fetchQuestions(){
                let url;
                if (localStorage.getItem("examid") == null || localStorage.getItem("examid") == null){
                    url = `/get-questions-fresh/${this.user}/${this.title}`
                }else{
                    var examId = localStorage.getItem("examid")
                    url = `/get-questions/${this.user}/${examId}`
                }
                let response = await axios.get(url)
                console.log(response)
                this.exam = response.data.exam
                
                this.student = response.data.student
                const exam_details = response.data.exam
                if (response.data.exam != null){
                    this.time_left = response.data.exam.time_left
                    this.sec_left = response.data.exam.total_sec
                    this.questionGroups = response.data.groups.slice().reverse()
                    // localStorage.setItem("examid", exam_details.id)
                    this.questions = response.data.exam_questions
                }

        },
        async countDown(){
            if (this.sec_left > 0){
                let url = `/update-time/${this.time_left}/${this.exam.id}`
                let response = await axios.get(url)
                this.time_left = response.data.time_left
                this.sec_left = response.data.total_sec
                if (response.data.total_sec == 15){
                    alert("Your time is running out")
                }

                if (response.data.total_sec == 1) {
                    localStorage.removeItem("examid")
                    
                    window.location.assign(`/submit/${this.exam.exam_id}`)
                }
            }
        },
        async answerClick(question, option){
            let url = `/answer/${question}/${option}/${this.exam.id}`
            let response = await axios.get(url)
            this.questions = response.data.exam_questions
        },

        async exitPage(){
            if (confirm("Are you sure to exit the page? \r\n you will loose all your points in the exam \r\n Click OK to exit the page")) {
                let url = `/destroyExam/${this.exam.id}`
                localStorage.removeItem("examid")
                let response = await axios.get(url)
                window.location.assign("/welcome")
            }
        },
        submitMock(){
            const questions = this.questions
            let questions_yet_to_answered = 0
            questions.map((item)=>{
                if(item.answer == "" || item.answer == null){
                    questions_yet_to_answered += 1
                }
            })

            if (questions_yet_to_answered > 0){
                if (confirm(`You are yet to answer ${questions_yet_to_answered} question(s). All questions are compulstory. Click okay to submit`)) {
                    localStorage.removeItem("examid")
                    window.location.assign(`/submit/${this.exam.exam_id}`)
                }
            }else{
                localStorage.removeItem("examid")
                window.location.assign(`/submit/${this.exam.exam_id}`)
            }
        },

        returnHome(){
            localStorage.removeItem("examid")
            window.location.assign("/welcome")
        }


    },

    mounted() {
        this.fetchQuestions();
        setInterval(()=>{
            this.countDown()
        }, 1000)
    },
}
</script>