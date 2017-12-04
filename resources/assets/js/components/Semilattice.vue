<template>
    <div class="row">
            <div class="col-md-1" v-for="category_layer in category_layers">
                <div v-for="category in category_layer">
                    <div><span v-bind:id="'category' +  category.id">{{ category.id + ': ' + category.name }}</span></div>
                </div>
            </div>
            <div class="col-md-1">
                <div v-for="content in contents">
                    <div><span v-bind:id="'content' +  content.id">{{ content.id + ': ' + content.name }}</span></div>
                </div>
            </div>
    </div>
</template>

<script>
    import axios from 'axios';
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
            canvas_category: function (id1, id2, color) {
                            $("canvas").drawLine({
                                strokeStyle: color,
                                strokeWidth: 1,
                                x1: $(id1).offset().left + $(id1).outerWidth() + 3,
                                y1: $(id1).offset().top + $(id1).outerHeight() / 2 ,
                                x2: $(id2).offset().left - 3,
                                y2: $(id2).offset().top + $(id2).outerHeight() / 2
                            });
            },
            getData: function(id, layer_num) {
                axios.get('/admin/category/' + id)
                    .then((res) => {
                        for(var n = 0; n < res.data.length; n++){
                            this.connections.push([res.data[n].id, id]);
                            if (this.all_category.indexOf(res.data[n].id) < 0) {
                                this.all_category.push(res.data[n].id);
                                this.category_layer[layer_num].push(res.data[n].id);
                                this.getData(res.data[n].id, layer_num + 1);
                            }
                        }
                        // res.data.forEach(function(value){
                        //     connections.push([value.id, id]);
                        //     if (all_category.indexOf(value.id) < 0) {
                        //         all_category.push(value.id);
                        //         category_layer[layer_num].push(value.id);
                        //         getData(value.id, layer_num + 1);
                        //     }
                        // });
                    });
            }
        },
        mounted: function() {
            this.getData(1, 0);
        }
    }
</script>

<style scoped>
    .col-md-1 {
        padding: 0px;
    }
</style>
