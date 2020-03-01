<template>
    <div class="text-center ma-2">
        <v-snackbar
            v-model="snackbar"
            :timeout="0"
        >
            {{ snackbarText }}
            <v-btn
                color="pink"
                text
                @click="closeSnackbar"
            >
                Close
            </v-btn>
        </v-snackbar>
    </div>
</template>

<script>
    import { mapGetters, mapActions } from 'vuex'

    export default {
        computed: mapGetters({
            snackbar: 'snackbar/snackbar',
            snackbarText: 'snackbar/snackbarText',
            snackbarColor: 'snackbar/snackbarColor'
        }),
        methods: mapActions({
            closeSnackbar: 'snackbar/closeSnackbar'
        })
    }
</script>

<style scoped>

</style>
