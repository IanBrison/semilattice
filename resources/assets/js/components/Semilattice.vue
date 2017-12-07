<template>
    <div class="row" style="margin: 0;">
            <div class="col-md-2" v-for="category_layer in category_layers">
                <div v-for="category in category_layer">
                    <div><span v-bind:id="'category' +  category.id">{{ category.name }}</span></div>
                </div>
            </div>
            <div class="col-md-2">
                <div v-for="content in contents">
                    <div><span v-bind:id="'content' +  content.id">{{ content.name }}</span></div>
                </div>
            </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                all_category: [],
                category_layers: [[],[],[],[],[],[],[],[],[],[],[],[],[],[],[],[],[],[],[]],
                connections: [],
                contents: []
            };
        },
        methods: {
            getData: function(id, layer_num) {
                axios.get('/admin/category/' + id)
                    .then((res) => {
                        for(var n = 0; n < res.data.length; n++){
                            this.connections.push([id, res.data[n].id]);
                            if (this.all_category.indexOf(res.data[n].id) < 0) {
                                this.all_category.push(res.data[n].id);
                                this.category_layers[layer_num].push({ id: res.data[n].id, name: res.data[n].name});
                                this.getData(res.data[n].id, layer_num + 1);
                            }
                        }
                    });
            }
        },
        mounted: function() {
            this.all_category.push(1);
            this.category_layers[0].push({ id: 1, name: 'サッカー大会'});
            this.getData(1, 1);
        }
    }
</script>

<style scoped>
    .col-md-2 {
        padding: 0 2px;
        max-width: 195px;
        font-size: 10px;
    }
</style>
