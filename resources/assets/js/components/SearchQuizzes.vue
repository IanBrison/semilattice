<template>
    <div class="col-12">
        <h4>検索</h4>
        <div class="input-group">
            <input type="text" v-model="keyword" class="form-control" placeholder="name">
            <span class="input-group-btn">
                <button v-on:click="search" class="btn btn-secondary" type="button">Search</button>
            </span>
        </div>
        <table v-if="search_contents.length > 0" class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NAME</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="content in search_contents">
                    <td>{{ content.id }}</td>
                    <td>{{ content.name }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        props: ['search_url'],
        data() {
            return {
                "keyword": '',
                "search_contents": []
            }
        },
        methods: {
            search: function() {
                if (this.keyword != '') {
                    axios.get(this.search_url + '/' + this.keyword)
                        .then((res) => {
                            this.search_contents = res.data;
                        });
                    this.keyword = '';
                } else {
                    this.search_contents = [];
                }
            }
        }
    }
</script>