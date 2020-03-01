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
                            <v-text-field
                                v-model="title"
                                :rules="titleRules"
                                :label="$t('fields.title')"
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
    import { mapActions } from 'vuex'

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
        },
        methods: {
            ...mapActions({
                showSnackbar: 'snackbar/showSnackbar'
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
                        .post('/api/categories/store', {
                            title: this.title,
                        })
                        .then((res) => {
                            this.showSnackbar('Created');
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
