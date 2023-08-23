<template>
    <h1>NEW PROJECT</h1>
    <form @submit.prevent="submit">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" v-model="project.name">
        </div>
        <br>
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" name="description" id="description" class="form-control" v-model="project.description">
        </div>
        <br>
        <div class="form-group">
            <label for="start_date">Start date</label>
            <input type="date" name="start_date" id="start_date" class="form-control" v-model="project.start_date">
        </div>
        <br>
        <div class="form-group">
            <label for="end_date">End date</label>
            <input type="date" name="end_date" id="end_date" class="form-control" v-model="project.end_date">
        </div>
        <br>
        <div class="form-group">
            <label for="difficulty">Difficulty</label>
            <input type="text" name="difficulty" id="difficulty" class="form-control" v-model="project.difficulty">
        </div>
        <br>
        <div class="form-group">
            <label for="type_id">Type</label>
            <br>
            <select
                name="type_id"
                id="type_id"
                v-model="project.type_id"
            >
                <option
                    v-for="type in types"
                    :key="type.id"
                    :value="type.id"
                >
                    {{ type.name }}
                </option>
            </select>
        </div>
        <br>
        <div
            v-for="technology in technologies"
            :key="technology.id"
            class="form-check"
        >
            <input
                id="technologies"
                class="form-check-input"
                type="checkbox"
                :value="technology.id"
                v-model="project.technologies"
            >
            <label class="form-check-label" for="technologies">
                {{ technology.name }}
            </label>
        </div>
        <br>
        <input type="submit" value="CREATE">
    </form>
</template>

<script>
import axios from 'axios';

const API_URL = 'http://localhost:8000/api/v1';

export default {
    name: 'ProjectCreate',
    emits: ['submitted'],
    data() {
        return {
            types: [],
            technologies: [],

            // DEBUG
            // project: {
            //     name: '',
            //     description: '',
            //     start_date: '',
            //     end_date: '',
            //     difficulty: '',
            //     type_id: '',
            //     technologies: []
            // }
            project: {
                name: 'ABC',
                description: 'desc',
                start_date: '2222-01-01',
                end_date: '2222-01-01',
                difficulty: 'top',
                type_id: '10',
                technologies: []
            }
        }
    },
    methods: {

        submit() {

            console.log(
                "submit of project",
                JSON.stringify(this.project, null, 2)
            );

            axios.post(API_URL + '/projects', this.project)
                .then(res => {

                    const data = res.data;
                    console.log("data", data);

                    if (data.project_id > 0) {

                        // TUTTO BENE
                        console.log("emit");
                        this.$emit('submitted', data.project_id);
                    } else {

                        // GESTIONE ERRORE
                    }
                })
                .catch(err => console.error(err));
        }
    },
    mounted() {
        axios.get(API_URL + '/types')
             .then(res => {

                const data = res.data;

                this.types = data.types;
             })
             .catch(err => console.error(err));

        axios.get(API_URL + '/technologies')
             .then(res => {

                const data = res.data;

                this.technologies = data.technologies;
             })
             .catch(err => console.error(err));
    }
}
</script>
