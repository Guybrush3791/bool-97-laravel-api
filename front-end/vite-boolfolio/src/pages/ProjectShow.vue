<template>
    <div v-if="project">
        <h1>Project: {{ project.name }}</h1>
        <p>{{ project.description }}</p>
        <div class="row mb-4 mt-2">
            <span class="col">{{ project.difficulty }}</span>
            <span class="col">{{ project.start_date }}</span>
            <span class="col">{{ project.end_date }}</span>
        </div>
        <!-- <h4><b>Type:</b> {{ project.type.name }}</h4> -->
        <h4>Technologies:</h4>
        <ul>
            <li
                v-for="technology in project.technologies"
                :key="technology.id"
            >
                {{ technology.name }}
            </li>
        </ul>
    </div>
</template>

<script>
import axios from 'axios';


const API_URL = "http://localhost:8000/api/v1";

export default {
    name: 'ProjectShow',
    data() {
        return {
            project: null
        }
    },
    mounted() {

        const projectId = this.$route.params.id;

        axios.get(API_URL + '/projects/' + projectId)
             .then(res => {

                const data = res.data;
                this.project = data.project;

                console.log("data", JSON.stringify(this.project.type.name, null, 2));

                console.log("axios");
             })
             .catch(err => console.error(err));

        console.log("the end");
    }
}

</script>
