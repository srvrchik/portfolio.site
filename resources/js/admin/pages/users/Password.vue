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
                            Change Password
                        </v-card-title>
                        <v-card-text>
                            <v-text-field
                                v-model="password"
                                :rules="passwordRules.concat(passwordConfirmationRule)"
                                type="password"
                                label="Password"
                                required
                            ></v-text-field>
                            <v-text-field
                                v-model="password_confirmation"
                                :rules="passwordRules"
                                type="password"
                                label="Password Confirmation"
                                required
                            ></v-text-field>
                            <v-btn color="primary" @click="submit" :loading="loading">Save</v-btn>
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
        props: ['id'],
        data: () => ({
            lazy: true,
            loading: false,
            valid: false,
            name: '',
            errors: {
                email: []
            },
            password: '',
            passwordRules: [
                v => !!v || 'Password is required',
                v => v.length >= 8 || 'Password must not be less than 8 characters',
            ],
            password_confirmation: '',
        }),
        computed: {
            passwordConfirmationRule() {
                return () =>
                    this.password === this.password_confirmation || "Password must match";
            },
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
                        .post('/api/users/' + this.id + '/update/password', {
                            password: this.password,
                            password_confirmation: this.password_confirmation,
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
