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
                            Create
                        </v-card-title>
                        <v-card-text>
                            <v-text-field
                                v-model="name"
                                :rules="nameRules"
                                label="Name"
                                required
                            ></v-text-field>
                            <v-text-field
                                v-model="email"
                                :rules="emailRules.concat(emailExistsRule)"
                                :type="'email'"
                                label="Email"
                                required
                            ></v-text-field>
                            <v-text-field
                                v-model="password"
                                :rules="passwordRules.concat(passwordConfirmationRule)"
                                :type="'password'"
                                label="Password"
                                required
                            ></v-text-field>
                            <v-text-field
                                v-model="password_confirmation"
                                :rules="[]"
                                :type="'password'"
                                label="Password Confirmation"
                                required
                            ></v-text-field>
                            <v-btn color="primary" @click="submit" :loading="loading">Create</v-btn>
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
            password: '',
            passwordRules: [
                v => !!v || 'Password is required',
                v => v.length >= 8 || 'Password must not be less than 8 characters',
            ],
            password_confirmation: '',
            lazy: false,
        }),
        mounted() {
        },
        computed: {
            passwordConfirmationRule() {
                return () =>
                    this.password === this.password_confirmation || "Password must match";
            },
            emailExistsRule() {
                return () =>
                    (this.errors.email.length === 0) || "Email already exists";
            }
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
                this.errors.email = [];
                if(this.validate())
                {
                    axios
                        .post('/api/users/store', {
                            name: this.name,
                            email: this.email,
                            password: this.password,
                            password_confirmation: this.password_confirmation
                        })
                        .then((res) => {
                            this.showSnackbar('Created');
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
