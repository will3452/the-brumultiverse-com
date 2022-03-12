<template>
<div>
    <div class="flex flex-col md:flex-row md:items-center my-2">
        <label for="" class="text-white font-bold block w-4/12 p-0 text-left md:text-right md:px-4 md:pr-6">
            College
            <span class="text-red-600">*</span>
        </label>
        <select v-model="collegeId" @change="onCollegeChange" name="college" id="course" class="p-2 border border-gray-400 text-gray-900 w-full md:w-8/12">
        <option value="" disabled selected></option>
            <option v-for="college in colleges" :key="college.id" :value="college.id"> {{college.name}} </option>
        </select>
    </div>
    <div class="flex flex-col md:flex-row md:items-center my-2">
        <label for="" class="text-white font-bold block w-4/12 p-0 text-left md:text-right md:px-4 md:pr-6">
            Course
            <span class="text-red-600">*</span>
        </label>
        <select v-model="courseId"  name="course" id="course" class="p-2 border border-gray-400 text-gray-900 w-full md:w-8/12">
        <option value="" disabled selected></option>
            <option v-for="course in courses" :key="course.id" :value="course.id"> {{course.name}} </option>
        </select>
    </div>
    <div class="flex flex-col md:flex-row md:items-center my-2">
        <label for="" class="text-white font-bold block w-4/12 p-0 text-left md:text-right md:px-4 md:pr-6">
            Club
            <span class="text-red-600">*</span>
        </label>
        <select v-model="clubId"  name="club" id="course" class="p-2 border border-gray-400 text-gray-900 w-full md:w-8/12">
        <option value="" disabled selected></option>
            <option v-for="club in clubs" :key="club.id" :value="club.id"> {{club.name}} </option>
        </select>
    </div>
</div>
</template>

<script>
    export default {
        data () {
            return {
                colleges: [],
                courses:[],
                clubs:[],
                collegeId:null,
                courseId:null,
                clubId:null,
            }
        },
        methods : {
            async getAllColleges() {
                let colleges = await axios.get('/colleges')
                this.colleges = await colleges.data;
            },
            getCourse() {
                axios.get('/courses',{
                    params: {college_id:this.collegeId},
                })
                    .then(res=>{
                        this.courses = res.data;
                    })
            },
            getClub() {
                axios.get('/clubs',{
                    params: {college_id:this.collegeId},
                })
                    .then(res=>{
                        this.clubs = res.data;
                    })
            },
            onCollegeChange() {
                this.getClub();
                this.getCourse();
            }
        },
        mounted () {
            this.getAllColleges();
        }
    }
</script>
