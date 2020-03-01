<template>
    <v-form
        :lazy-validation="lazy"
        v-model="valid"
        ref="form"
    >
        <v-container>
            <v-row>
                <v-col cols="12">
                    <v-card>
                        <v-card-title>
                            Edit
                        </v-card-title>
                        <v-card-text>
                            <v-text-field
                                v-model="user.name"
                                :rules="nameRules"
                                label="Name"
                                required
                            ></v-text-field>
                            <v-text-field
                                v-model="user.email"
                                :rules="emailRules.concat(emailExistsRule)"
                                :type="'email'"
                                label="Email"
                                required
                            ></v-text-field>
                            <v-btn color="primary" @click="submit" :loading="loading">Edit</v-btn>
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
        name: "Password",
        data: () => ({
            lazy: true,
            loading: false,
            valid: false,
            name: '',
            errors: {
                email: []
            },
            nameRules: [
                v => !!v || 'Name is required',
                v => v.length >= 4 || 'Name must not be less than 4 characters',
            ],
            email: '',
            emailRules: [
                v => !!v || 'E-mail is required',
                v => /.+@.+/.test(v) || 'E-mail must be valid',
            ],
        }),
        mounted() {
            this.getUser(this.$route.params.id);
        },
        computed: {
            passwordConfirmationRule() {
                return () =>
                    this.password === this.password_confirmation || "Password must match";
            },
            emailExistsRule() {
                return () =>
                    (this.errors.email.length === 0) || "Email already exists";
            },
            ...mapGetters({user: 'users/user'})
        },
        methods: {
            ...mapActions({
                showSnackbar: 'snackbar/showSnackbar',
                getUser: 'users/getUser'
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
                this.errors.email = [];
                if(this.validate())
                {
                    axios
                        .post('/api/users/' + this.id + '/update', {
                            name: this.user.name,
                            email: this.user.email,
                            user_id: this.user.id,
                        })
                        .then((res) => {
                            this.showSnackbar('Updated');
                            this.$router.push({ name: 'users.index' })
                        })
                        .catch((res) => {
                            this.errors = res.response.data.errors;
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
