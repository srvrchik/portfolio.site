<template>
    <v-form
        v-model="valid"
        ref="form"
        :lazy-validation="lazy"
    >
        <v-container>
            <v-row>
                <v-col cols="12">
                    <v-card>
                        <v-card-title>
                            {{ $t('crud.edit') }}
                        </v-card-title>
                        <v-card-text>
                            <img v-if="portfolio.image !== null" :src="'/uploads/projects/' + portfolio.image" width="200">
                            <v-spacer></v-spacer>
                            <v-btn
                                v-if="portfolio.image !== null"
                                @click="deleteImage"
                            >
                                <v-icon
                                color="error"
                                >
                                    delete
                                </v-icon>
                            </v-btn>
                            <v-file-input
                                accept="image/*"
                                label="File Input"
                                v-model="file"
                                :rules="fileRules"
                            ></v-file-input>
                            <v-select
                                item-text="title"
                                item-value="id"
                                v-model="portfolio.category_id"
                                :items="categories"
                                label="Categories"
                            ></v-select>
                            <v-text-field
                                v-model="portfolio.title"
                                label="Title"
                                :rules="titleRules"
                                required
                            ></v-text-field>
                            <v-text-field
                                v-model="portfolio.url"
                                label="Url"
                                :rules="urlRules"
                                required
                            ></v-text-field>
                            <v-btn color="primary" @click="submit" :loading="loading">{{ $t('crud.edit') }}</v-btn>
                        </v-card-text>
                    </v-card>
                </v-col>
            </v-row>
        </v-container>
    </v-form>
</template>

<script>
    import { mapActions, mapGetters } from 'vuex'

    export default {
        name: "Edit",
        data: () => ({
            file: [],
            fileRules: [
                v => !!v || 'File is required',
            ],
            title: '',
            titleRules: [
                v => !!v || 'Name is required',
            ],
            url: '',
            urlRules: [
                v => !!v || 'Name is required',
            ],
            loading: false,
            valid: false,
            name: '',
            lazy: false,
        }),
        mounted() {
            this.getOne(this.$route.params.id);
            this.getCategories();
        },
        computed: {
            ...mapGetters({
                portfolio: 'portfolio/one',
                categories: 'categories/all'
            })
        },
        methods: {
            ...mapActions({
                showSnackbar: 'snackbar/showSnackbar',
                getOne: 'portfolio/getOne',
                getCategories: 'categories/getAll'
            }),

            deleteImage(){
                axios
                    .post('/api/portfolio/' + this.portfolio.id + '/remove/image')
                    .then((res) => {
                        this.showSnackbar('Image Removed');
                        console.log(res.data);
                        this.portfolio.image = null;
                    })
                    .catch((res) => {
                        this.errors = res.response.data.errors;
                        console.log(res.response);
                        this.showSnackbar('Something went wrong.');
                    });
            },

            validate () {
                return this.$refs.form.validate();
            },
            reset () {
                this.$refs.form.reset()
            },
            resetValidation () {
                this.$refs.form.resetValidation()
            },
            submit () {
                this.loading = true;
                if(this.validate())
                {
                    var formData = new FormData;
                    formData.append('file', this.file);
                    formData.append('title', this.portfolio.title);
                    formData.append('url', this.portfolio.url);
                    formData.append('category_id', this.portfolio.category_id);
                    axios
                        .post('/api/portfolio/' + this.portfolio.id + '/update', formData, {
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            }
                        })
                        .then((res) => {
                            this.showSnackbar('Edited');
                            console.log(res.data);
                            this.$router.push({ name: 'portfolio.index' })
                        })
                        .catch((res) => {
                            this.errors = res.response.data.errors;
                            console.log(res.response.data);
                            this.validate();
                            this.showSnackbar('Something went wrong.');
                        });
                }else{
                    this.showSnackbar('Please Enter All Inputs');
                }
                this.loading = false;
            },
        }
    }
</script>

<style scoped>

</style>
