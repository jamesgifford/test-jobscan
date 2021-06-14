<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Search Jobs</div>

                    <div class="card-body">
                        <button @click="submitSearch">Submit</button>
                        <table class="table table-hover table-striped">
                            <thead>
                                <th></th>
                                <th>Skill</th>
                                <th>Rating</th>
                            </thead>
                            <tbody>
                                <tr v-for="skill in skills" :key="skill.id">
                                    <td>
                                        <input type="checkbox" v-model="selectedSkills" :value="skill" :disabled="selectedSkills.length >= skillLimit && selectedSkills.indexOf(skill) === -1" />
                                    </td>
                                    <td>{{ skill.name }}</td>
                                    <td>
                                        <select v-model="skill.rating" :disabled="selectedSkills.length >= skillLimit && selectedSkills.indexOf(skill) === -1">
                                            <option value="1" selected="selected">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                skills: [],
                selectedSkills: [],
                skillLimit: 10
            }
        },
        mounted() {
            console.log('Search component mounted.');
            this.getSkills();
        },
        methods: {
            getSkills() {
                axios.get('/api/skills').then(response => this.skills = response.data).then(() => {
                    this.skills.forEach((value, index) => {
                        this.skills[index].rating = 1;
                    });
                });
            },
            submitSearch() {
                axios.post('/api/search', {
                        skills: this.selectedSkills
                    })
                    .then(function (response) {
                        window.location = response.data.url;
                    })
                    .catch(function (error) {
                        //console.log(error);
                    });
            }
        }
    }
</script>
