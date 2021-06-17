<template>
    <v-container grid-list-lg>
        </br>
        </br>
        </br>
        <v-layout row wrap class="mx-auto card" max-width="400">
            <v-flex v-for="(item, key) in articles" :value="key" xs12 sm4 md4 :key="key" class='card-card'>
                <v-card-media :src="keys.URI+item.img" height="250px" width='250px'></v-card-media>
                <v-card-title>{{item.title}}</v-card-title>
                </v-img>
                <v-card-text class="text--primary">
                    <div>{{item.text}}</div>
                </v-card-text>
                <v-card-actions>
                    <v-btn color="orange" :to="'/update/' + item.id"> Обновить </v-btn>
                    <v-btn color="orange" text @click="remove(item.id)"> Удалить </v-btn>
                </v-card-actions>
            </v-flex>
        </v-layout>
    </v-container>
</template>
<script>
    import axios from 'axios';
    import keys from '../../keys/keys.js';
    export default {
        name: 'Articles',
        data() {
            return {
                articles: null,
                keys: keys
            }
        },
        created() {
            this.getArticles();
        },
        computed: {
            getArticles() {
                axios({
                    method: 'get',
                    url: keys.URI + '/api/home',
                }).then(response => {
                    console.log(response.data)
                    this.articles = response.data;
                }).catch(e => {
                    console.log(e);
                })
            },
        },
        methods: {
            remove(id) {
                axios({
                    method: 'post',
                    url: keys.URI + '/api/destroy/' + id,
                }).then(response => {
                    console.log(response.data)
                    this.articles = this.articles.filter(c => c.id !== id);
                }).catch(e => {
                    console.log(e);
                })
            }
        },
    }
</script>
<style>
    .card {
        margin-right: 40px;
    }
    
    .card-card {
        background: #ccc;
        margin-right: 40px;
        margin-bottom: 40px;
    }
    
    .text--primary {
        text-align: left;
    }
</style>