<template>
    <v-container>
        </br>
        </br>
        </br>
        </br>
	<template v-if="error">
      <v-snackbar
        :timeout="5000"
        :multi-line="true"
        color="red"
        @input="closeError"
        :value="true"
      >
        {{error}}
        <v-btn flat red @click.native="closeError">Close</v-btn>
      </v-snackbar>
    </template>
        <v-layout row>
            <v-flex xs12 sm6 offset-sm3>
                <h1 class="text--secondary mb-3">Обновить запись</h1>
                <v-form v-model="valid" ref="form" validation class="mb-3">
                    <v-text-field name="title" label="Добавить заголовок" type="text" v-model="title" required :rules="[v => !!v || 'Обязательно к заполнению']"></v-text-field>
                    <v-text-field name="description" label="Добавить описание" type="text" v-model="description" multi-line :rules="[v => !!v || 'Обязательно к заполнению']"></v-text-field>
					
                    <v-card-media v-if="img!=null" :src="keys.URI+img" height="250px" width='250px'></v-card-media>
                </v-form>
                <v-layout row class="mb-3">
                    <v-flex xs12>
                        <v-btn color="#ccc" @click="triggerUpload"> Загрузить картинку </v-btn>
                        <input ref="fileInput" type="file" style="display: none;" accept="image/*" @change="onFileChange"> </v-flex>
                </v-layout>
                <v-layout row>
                    <v-flex xs12> <img :src="imageSrc" height="100" v-if="imageSrc"> </v-flex>
                </v-layout>
                <v-layout row>
                    <v-flex xs12>
                        <v-spacer></v-spacer>
                        <v-btn color="blue" class="success" @click="createAd"> Обновить </v-btn>
                    </v-flex>
                </v-layout>
            </v-flex>
        </v-layout>
    </v-container>
</template>
<script>
    import axios from 'axios';
    import keys from '../../keys/keys.js';
    export default {
        data() {
                return {
                    title: '',
                    description: '',
                    valid: false,
                    image: null,
                    imageSrc: '',
                    id: this.$route.params.id,
                    article: null,
                    img: null,
                    keys: keys,
					error:false
                }
            },
            computed: {
                loading() {}
            },
            methods: {
                createAd() {
					
                    var fd = new FormData();
                    fd.append('title', this.title);
                    fd.append('description', this.description);
                    var pk = '';
                    if (this.img) {
                        pk = this.img
                    }
                    if (this.image) {
                        pk = this.image;
                    }
                    fd.append('image', pk);
                    axios({
                        method: 'post',
                        url: keys.URI + '/api/update/' + this.id,
                        data: fd,
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }).then(response => {
                        console.log(response.data)
						if(response.data != 'ok'){
							this.error = 'Необходимо заполнить все поля';
							return false;
						}
                        this.$router.push('/articles')
                    }).catch(e => {
                        console.log(e);
                    })
                },
				closeError () {
				   this.error = false;
                   //this.$store.dispatch('clearError')
                 },
                triggerUpload() {
                    this.$refs.fileInput.click()
                },
                onFileChange(event) {
                    const file = event.target.files[0]
                        /*
                                const reader = new FileReader()
                                reader.onload = e => {
                                  this.imageSrc = reader.result
                                }
                                reader.readAsDataURL(file)
                        		*/
                    this.image = file
                }
            },
            mounted() {
                axios({
                    method: 'post',
                    url: keys.URI + '/api/one/' + this.id,
                    data: {
                        id: this.id
                    },
                }).then(response => {
                    //console.log(response.data)
                    this.title = response.data.title;
                    this.description = response.data.text;
                    this.img = response.data.img;
                }).catch(e => {
                    console.log(e);
                })
            }
    }
</script>