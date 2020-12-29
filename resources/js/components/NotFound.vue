<template>
    <div class="text-center mt-16">
        <h1 class="font-weight-black red--text">Page Not Found</h1>
        <br>
        <v-btn color="cyan white--text" @click="goback()">GO BACK</v-btn>
    </div>
</template>

<script>
import router from "../router/index.js"

export default {
    methods: {
        goback() {
            router.go(-1)
        }
    }
}
</script>