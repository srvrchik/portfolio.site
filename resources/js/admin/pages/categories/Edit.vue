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
                            <v-text-field
                                v-model="category.title"
                                :rules="titleRules"
                                :label="$t('fields.title')"
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
        name: "Create",
        data: () => ({
            loading: false,
            valid: false,
            title: '',
            errors: {
                email: []
            },
            titleRules: [
                v => !!v || 'Title is required',
            ],
            lazy: false,
        }),
        mounted() {
            this.getOne(this.$route.params.id);
        },
        computed: {
            ...mapGetters({
                category: 'categories/category'
            })
        },
        methods: {
            ...mapActions({
                showSnackbar: 'snackbar/showSnackbar',
                getOne: 'categories/getOne'
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
                    axios
                        .post('/api/categories/' + this.category.id + '/update', {
                            title: this.category.title,
                        })
                        .then((res) => {
                            this.showSnackbar('Updated');
                            this.$router.push({ name: 'categories.index' })
                        })
                        .catch((res) => {
                            this.errors = res.response.data.errors;
                            console.log(res.response);
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
