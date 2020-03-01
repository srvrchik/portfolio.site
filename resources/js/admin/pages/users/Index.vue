<template>
    <v-container>
        <v-row>
            <v-col cols="12">
                <v-card>
                    <v-data-table
                        :headers="headers"
                        :items="users"
                        :search="search"
                        sort-by="calories"
                        class="elevation-1"
                        :items-per-page="5"
                    >
                        <template v-slot:top>
                            <v-toolbar flat>
                                <v-text-field
                                    v-model="search"
                                    :label="$t('fields.search')"
                                    single-line
                                    hide-details
                                ></v-text-field>
                                <v-spacer></v-spacer>
                                <router-link :to="{ name: 'users.create' }">
                                    <v-btn color="primary" dark class="mb-2">{{ $t('fields.newItem') }}</v-btn>
                                </router-link>
                            </v-toolbar>
                        </template>
                        <template v-slot:item.action="{ item }">
                            <v-tooltip top>
                                <template v-slot:activator="{ on }">
                                    <router-link
                                        :to="{ name: 'users.edit', params: {id: item.id} }"
                                        style="text-decoration:none;"
                                    >
                                        <v-icon
                                            v-on="on"
                                            small
                                            class="mr-2"
                                        >
                                            mdi-pencil
                                        </v-icon>
                                    </router-link>
                                </template>
                                <span>{{ $t('crud.edit') }}</span>
                            </v-tooltip>
                            <v-tooltip top>
                                <template v-slot:activator="{ on }">
                                    <router-link
                                        :to="{ name: 'users.edit.password', params: {id: item.id} }"
                                        style="text-decoration:none;"
                                    >
                                        <v-icon
                                            v-on="on"
                                            small
                                            class="mr-2"
                                        >
                                            mdi-shield-edit
                                        </v-icon>
                                    </router-link>
                                </template>
                                <span>{{ $t('crud.changePassword') }}</span>
                            </v-tooltip>
                            <v-tooltip top>
                                <template v-slot:activator="{ on }">
                                    <v-icon
                                        v-on="on"
                                        small
                                        @click="deleteUser(item.id)"
                                    >
                                        delete
                                    </v-icon>
                                </template>
                                <span>{{ $t('crud.delete') }}</span>
                            </v-tooltip>
                        </template>
                        <template v-slot:no-data>
                            <v-btn color="primary" @click="getUsers">Reset</v-btn>
                        </template>
                    </v-data-table>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
    import { mapGetters, mapActions } from 'vuex'

    export default {
        name: "Index",
        data () {
            return {
                search: '',
                headers: [
                    {
                        text: 'ID',
                        align: 'left',
                        sortable: false,
                        value: 'id',
                    },
                    { text: this.$t('fields.name'), value: 'name' },
                    { text: this.$t('fields.email'), value: 'email' },
                    { text: this.$t('fields.created_at'), value: 'created_at' },
                    { text: this.$t('fields.actions'), value: 'action', sortable: false },
                ],
                desserts: [],
                editedIndex: -1,
                editedItem: {
                    name: '',
                    email: '',
                },
                defaultItem: {
                    name: '',
                    email: '',
                },
            }
        },
        mounted() {
            this.getUsers();
        },
        computed: {
            ...mapGetters({
                users: 'users/users'
            }),
        },
        methods: {
            ...mapActions({
                getUsers: 'users/getUsers',
                deleteUser: 'users/deleteUser'
            }),

            save () {
                if (this.editedIndex > -1) {
                    Object.assign(this.users[this.editedIndex], this.editedItem)
                } else {
                }
                this.close()
            },
        },
    }
</script>

<style scoped>

</style>
