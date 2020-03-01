<template>
    <v-container fluid>
        <v-row
            align="center"
            justify="center"
        >
            <v-col cols="10">
                <v-card>
                    <v-card-text>
                        <v-row>
                            <v-col
                                cols="12"
                                md="6"
                            >
                                <span>Scheme</span>
                                <v-switch
                                    v-model="user.admin_theme ? true : false"
                                    @change="changeTheme"
                                    primary
                                    :disabled="loading"
                                    label="Dark"
                                />
                            </v-col>
                        </v-row>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
    import { mapGetters } from 'vuex'

    export default {
        name: "Layout",
        mounted() {
        },
        data: () => ({
            drawers: ['Default (no property)', 'Permanent', 'Temporary'],
            primaryDrawer: {
                model: null,
                type: 'default (no property)',
                clipped: false,
                floating: false,
                mini: false,
            },
            footer: {
                inset: false,
            },
            loading: false
        }),
        computed: {
            ...mapGetters({
                user: 'user/authUser'
            })
        },
        methods: {
            changeTheme(){
                this.loading = true;
                axios
                    .post('/user/change/theme')
                    .then((res) => {
                        this.loading = false;
                        this.$vuetify.theme.dark = res.data.theme;
                    })
                    .catch((res) => {
                        console.log(res.response.data);
                    });
            }
        }

    }
</script>

<style scoped>

</style>
