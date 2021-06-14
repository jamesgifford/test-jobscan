<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Search Results</div>

                    <div class="card-body">
                        <table class="table table-hover table-striped">
                            <thead>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Company</th>
                                <th>Skills</th>
                                <th>Score</th>
                            </thead>
                            <tbody>
                                <tr v-for="posting in postings" :key="posting.id">
                                    <td>{{ posting.external_id }}</td>
                                    <td>{{ posting.title }}</td>
                                    <td>{{ posting.company }}</td>
                                    <td>{{ posting.skills }}</td>
                                    <td>{{ posting.score }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div>
                        <a href="/">Search again</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['searchId'],
        data() {
            return {
                postings: [],
            }
        },
        mounted() {
            console.log('Results component mounted.');
            this.getPostings();
        },
        methods: {
            getPostings() {
                axios.get('/api/search/'+this.searchId).then(response => this.postings = response.data);
            }
        }
    }
</script>
