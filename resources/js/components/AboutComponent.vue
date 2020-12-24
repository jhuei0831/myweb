<template>
    <!-- <v-layout justify-center>
        <v-card :width="500">
            <v-avatar size="100">
                    <img alt="user" src="https://cdn.vuetifyjs.com/images/john.png">
            </v-avatar>
        </v-card>
    </v-layout> -->
    <!-- <v-card class="mx-auto" max-width="500" tile>
        <v-card-title primary-title>
            title
        </v-card-title>
        <v-img height="200" src="https://cdn.vuetifyjs.com/images/cards/server-room.jpg"></v-img>
        <v-row no-gutters>
            <v-list-item>
                <v-list-item-avatar size="100">
                    <img src="https://www.w3schools.com/howto/img_avatar.png" alt="John">
                </v-list-item-avatar>
                <v-list-item-content>
                    <v-list-item-title class="title" style="margin-top:20px;">Injamamul Haque Sonet</v-list-item-title>
                    <v-list-item-subtitle>Software Engineer | dokanee</v-list-item-subtitle>
                </v-list-item-content>
            </v-list-item>
        </v-row>
    </v-card> -->
    <v-layout>
        <v-flex>
            <v-card dark tile img="https://cdn.vuetifyjs.com/images/cards/server-room.jpg" class="mx-auto" width="500">
                <v-layout column align-center max-width="500">
                    <v-avatar size='100' class="my-3">
                        <v-img src="https://cdn.vuetifyjs.com/images/john.jpg"></v-img>  
                    </v-avatar>
                </v-layout>
            </v-card>
            <v-card dark tile color="blue-grey darken-4" class="mx-auto" width="500">
                <v-layout column align-center>
                    <v-card-text class="headline text-center py-1">{{ userdata.name }}</v-card-text>
                    <v-card-text class="text-center pt-1 pb-4"><v-icon>mdi-email</v-icon> {{ userdata.email }}</v-card-text>
                </v-layout>
            </v-card>
        </v-flex>
    </v-layout>
</template>

<script>
    import { mapGetters, mapActions } from "vuex";

    export default {
        computed: {
            ...mapGetters("auth", ["userdata"])
        }
    }
</script>
