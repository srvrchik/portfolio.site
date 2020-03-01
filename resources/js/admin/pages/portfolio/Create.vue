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
                            {{ $t('crud.create') }}
                        </v-card-title>
                        <v-card-text>
                            <v-file-input
                                accept="image/*"
                                label="File Input"
                                v-model="file"
                                :rules="fileRules"
                            ></v-file-input>
                            <v-select
                                item-text="title"
                                item-value="id"
                                v-model="category_id"
                                :items="categories"
                                label="Categories"
                                :rules="categoryRules"
                            ></v-select>
                            <v-text-field
                                v-model="title"
                                label="Title"
                                :rules="titleRules"
                                required
                            ></v-text-field>
                            <v-text-field
                                v-model="url"
                                label="Url"
                                :rules="urlRules"
                                required
                            ></v-text-field>
                            <v-btn color="primary" @click="submit" :loading="loading">{{ $t('crud.create') }}</v-btn>
                        </v-card-text>
                    </v-card>
                </v-col>
            </v-row>
        </v-container>
    </v-form>
</template>

<script>
    import { mapActions, mapGetters, mapState } from 'vuex'

    export default {
        name: "Create",
        data: () => ({
            file: [],
            fileRules: [
                v => !!v || 'File is required',
                v => (v !== null) || 'File is required',
            ],
            category_id: 0,
            title: '',
            titleRules: [
                v => !!v || 'Name is required',
            ],
            url: '',
            urlRules: [
                v => !!v || 'Name is required',
            ],
            categoryRules: [
                v => !!v || 'Name is required',
            ],
            loading: false,
            valid: false,
            name: '',
            lazy: false,
        }),
        mounted() {
            this.getCategories();
        },
        computed: {
            ...mapGetters({
                categories: 'categories/all'
            }),
        },
        methods: {
            ...mapActions({
                showSnackbar: 'snackbar/showSnackbar',
                getCategories: 'categories/getAll'
            }),

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
                    formData.append('title', this.title);
                    formData.append('category_id', this.category_id);
                    formData.append('url', this.url);
                    axios
                        .post('/api/portfolio/store', formData, {
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            }
                        })
                        .then((res) => {
                            this.showSnackbar('Created');
                            console.log(res.data);
                            this.$router.push({ name: 'portfolio.index' })
                        })
                        .catch((res) => {
                            this.errors = res.response.data.errors;
                            this.validate();
                            console.log(res.response)
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
