<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <ul class="text-danger" v-if="isError">
                    <li v-for="(error, index) in errors" :key="index">
                        <span v-for="(errr, index) in error" :key="index">{{errr}} </span>
                    </li>
                </ul>

                <div class="alert alert-success" v-if="status">
                    <div class="alert-header" @click="toggleStatus">&times;</div>
                    Question Updated
                </div>
                <div class="my-3 p-3 card  bg-light" >
                    <label for="option_a">Question </label>
                    <vue-html5-editor :content="question" :height="200" :show-module-name="showModuleName"
                      @change="updateData" ref="editor"></vue-html5-editor>
                </div>

                <div class="my-5 p-3 card">
                    <label for="option_a">Group <span class="text-danger">[Optional]</span></label>
                    <select v-model="question_group" class="form-control form-select" >
                        <option value="">Select</option>
                        <option v-for="group in groups" :value="group.id" :key="group.id" v-if="group.title !== 'Select'">{{group.id}} - {{group.title}}</option>
                    </select>
                    <div class="d-flex justify-content-end">
                        <button @click="showAddGroupTitle = true" class="btn">Add New</button>
                    </div>

                    <div class="my-3 add_group_title" v-if="showAddGroupTitle">
                        <div class="form-group">
                            <div class="bg-light w-100 p-3">
                                <div v-if="addGroupTitleError" class="text-danger">Something went wrong, please refresh the page</div>
                                <input v-model="group_title" class="w-100 form-control" placeholder="Enter group info/title">
                                <div class="my-2">
                                    <label for="option_a">Subject </label>
                                    <select v-model="group_category" class="form-control form-select" >
                                        <option value="">Select</option>
                                        <option v-for="category in categories" :value="category.id" :key="category.id">{{category.title}}</option>
                                    </select>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <button @click="addQuestionGroup" class="btn">Add</button>
                                    <button @click="showAddGroupTitle = false" class="btn">close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="my-3 p-3 card bg-light">
                    <label for="option_a">Subject </label>
                    <select disabled v-model="subject" class="form-control form-select" >
                        <option value="">Select</option>
                        <option v-for="category in categories" :value="category.title" :key="category.id">{{category.title}}</option>
                    </select>
                </div>
                <div class="question_answer">
                    <div class="my-2 p-3 card">
                        <label for="option_a">Option A</label>
                        <input  require type="text" id="option_a" v-model="option_a" class="form-control">
                    </div>

                    <div class="my-2 p-3 card">
                        <label for="option_a">Option B</label>
                        <input  require type="text" id="option_b" v-model="option_b" class="form-control">
                    </div>

                    <div class="my-2 p-3 card">
                        <label for="option_a">Option C</label>
                        <input  require type="text" id="option_c" v-model="option_c" class="form-control">
                    </div>

                    <div class="my-2 p-3 card">
                        <label for="option_a">Option D</label>
                        <input  require type="text" id="option_D" v-model="option_d" class="form-control">
                    </div>

                </div>
                <div class="my-2 card p-3 alert alert-secondary">
                    <label for="answer">Answer</label>
                    <input  require type="text" id="answer" v-model="answer" class="form-control">
                </div>

                <div class="my-3 p-3 card  bg-light" >
                    <label for="Reason">Reason</label>
                    <vue-html5-editor :content="Reason" :height="100" :show-module-name="showModuleName"
                    @change="updateReason" ref="editor"></vue-html5-editor>
                </div>
 
                <div class="my-2">
                    <button @click="updateQuestion" class="btn btn-success btn-lg">UPDATE QUESTION</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        props: ["thisquestion"],
        data() {
            return {
                question : '<p></p>',
                categories : [],
                option_a : "",
                option_b : "",
                option_c : "",
                option_d : "",
                option_e : "",
                answer : "",
                Reason : "",
                subject : "Select",
                isError : false,
                errors : [],
                status : false,
                groups : [],
                question_group : "",
                group_title : "",
                group_category : "",
                showAddGroupTitle : false,
                addGroupTitleError : false
            }
        },

        methods: {
            toggleStatus(){
                this.status = false;
            },
            async getCategories(){
                let response = await axios.get("/get-categories")
                this.categories = response.data
            },
            async getCategoriesByTitle(title){
                let response = await axios.get(`/get-categories-bytitle/${title}`)
                return response.data
            },
            async questionGroup(){
                let response = await axios.get("/get-question-group")
                this.groups = response.data
            },
            async addQuestionGroup(){
                if (this.group_title == "" || this.group_category == "") return false
                var data = {
                    "group_title" : this.group_title,
                    "category_id" : this.group_category
                }
                let response = await axios.post("/add-question-group", data)
                if (response.data == true){
                    this.questionGroup()
                    this.addGroupTitleError = false
                    this.showAddGroupTitle = false
                }else{
                    this.addGroupTitleError = true
                }
            },
            async updateQuestion(){
                var data = {
                    "question" : this.question,
                    "subject" : this.subject,
                    "option_a" : this.option_a,
                    "option_b" : this.option_b,
                    "option_c" : this.option_c,
                    "option_d" : this.option_d,
                    "option_e" : this.option_e,
                    "answer" : this.answer,
                    "reason" : this.Reason,
                    "group_id" : this.question_group
                }
                await axios.post(`/admin/questions/update/${this.thisquestion.id}`, data)
                .then((response)=>{
                    this.isError = false
                    window.scrollTo(top)
                    this.status = response.data
                })
                .catch((error)=>{
                    this.isError = true
                    this.errors = error.response.data.errors
                    window.scrollTo(top)
                    console.log(window)
                })
            },

            async getQuestion(){
                let response = await axios.get(`/get-question-byid/${this.thisquestion.id}`)
                this.thisquestion = response.data
            },
            updateData: function (data) {
                // sync content to component
                this.question = data
            },
            updateReason: function (data) {
                // sync content to component
                this.Reason = data
            },
        },
        mounted() {
            this.getCategories()
            setTimeout(()=>{
                this.questionGroup(this.thisquestion.category)
                this.question = this.thisquestion.question
                this.subject = this.thisquestion.category
                console.log(this.subject)
                this.option_a = this.thisquestion.option_a
                this.option_b = this.thisquestion.option_b
                this.option_c = this.thisquestion.option_c
                this.option_d = this.thisquestion.option_d
                this.option_e = this.thisquestion.option_e
                this.answer = this.thisquestion.answer
                this.Reason = this.thisquestion.reason
                this.question_group = this.thisquestion.group_id
            }, 1000)
        },
    }
</script>
