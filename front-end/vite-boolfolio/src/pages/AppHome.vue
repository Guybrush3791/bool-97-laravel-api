<template>
    <h1>
        Project
        <button
            v-if="!create"
            class="rounded btn btn-primary"
            @click="create = !create"
        >
            <h3>+</h3>
        </button>
    </h1>
    <project-create
        v-if="create"
        @submitted="submitted"
    />
    <div class="row justify-content-center" v-else>
        <project-card
          v-for="project in projects"
          :key="project.id"
          :project="project"

          class="my-3 mx-3"

          @click="toProjectShow(project.id)"
        />
        <div class="pages row justify-content-center">
          <div
            v-for="(page, index) in pages"
            :key="index"

            v-html="page.label"

            class="col mx-2 py-3 text-white rounded fs-4"
            :class="{
              'bg-primary': !page.active,
              'bg-secondary': page.active,

              'd-none': page.url === null
            }"

            @click="toPage(page.url)"
          />
        </div>
    </div>
</template>

<script>
import ProjectCard from '../components/ProjectCard.vue';
import ProjectCreate from '../components/ProjectCreate.vue';

import axios from 'axios';

const API = "http://localhost:8000/api/v1"

export default {
  name: 'AppHome',
  components: {

      ProjectCard,
      ProjectCreate
  },
  data() {
    return {
      projects: [],
      pages: [],

      create: false
    }
  },
  methods: {

    toPage(url) {
      axios.get(url)
           .then(res => {

            const data = res.data.projects;

            this.projects = data.data;
            this.pages = data.links;
           })
           .catch(err => console.error(err));
    },
    toProjectShow(id) {

      this.$router.push('/projects/' + id);
    },
    submitted(id) {

        this.$router.push('/projects/' + id);
    }
  },
  mounted() {
    axios.get(API + '/projects-page')
         .then(res => {

            // this.projects = res.data.projects;
            const data = res.data.projects;

            this.projects = data.data;
            this.pages = data.links;
         })
         .catch(err => console.error(err));
  }
}
</script>
