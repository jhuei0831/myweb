<template>
    <v-layout>
        <v-flex>
            <v-card dark tile img="https://cdn.vuetifyjs.com/images/cards/server-room.jpg" class="mx-auto" width="800">
                <v-layout column align-center max-width="500">
                    <v-avatar size='100' class="my-3">
                        <v-img src="https://cdn.vuetifyjs.com/images/john.jpg"></v-img>  
                    </v-avatar>
                </v-layout>
            </v-card>
            <v-card dark tile color="purple darken-4" class="mx-auto" width="800" :height="isEditing ? '280' : '200'">
                <v-toolbar flat color="purple">
                    <v-toolbar-title class="font-weight-light">
                        <v-icon>mdi-card-account-details</v-icon> User Profile
                    </v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-btn color="purple darken-3" fab small @click="isEditing = !isEditing">
                        <v-icon v-if="isEditing">mdi-close</v-icon>
                        <v-icon v-else>mdi-pencil</v-icon>
                    </v-btn>
                </v-toolbar>
                <v-layout column align-center class="mt-4 text-center">
                    <v-card-text class="headline py-1" v-show="!isEditing">{{ userdata.name }}</v-card-text>
                    <v-card-text class="pt-1 pb-4" v-show="!isEditing"><v-icon>mdi-email</v-icon> {{ userdata.email }}</v-card-text>  
                    <validation-observer ref="observer" v-slot="{ invalid }">
                        <v-form @submit.prevent="detail_submit" v-show="isEditing" ref="form_detail" lazy-validation>
                            <validation-provider v-slot="{errors}" name="名稱" rules="required|max:10">
                                <v-text-field name="name" label="名稱" v-model="userdata.name" :error-messages="errors"></v-text-field>         
                            </validation-provider>
                            <validation-provider v-slot="{errors}" name="電子信箱" rules="required|email">
                                <v-text-field name="email" label="信箱" v-model="userdata.email" :error-messages="errors"></v-text-field>  
                            </validation-provider>
                            <v-btn :disabled="invalid" color="purple lighten-2" @click="detail_submit">Save</v-btn>
                        </v-form>                         
                    </validation-observer> 
                </v-layout>
            </v-card>
        </v-flex>
    </v-layout>
</template>

<script>
    import { mapGetters, mapActions } from "vuex";

    export default {
        data() {
            return{
                isEditing: null,
            }
        },
        computed: {
            ...mapGetters("auth", ["userdata"])
        },
        methods: {
            ...mapActions("users", ["editSelf"]),
            detail_submit() {
                if (this.$refs.form_detail.validate()) {
                    let formContents = {name: this.userdata.name, email: this.userdata.email}
                    let id = this.userdata.id
                    this.editSelf({formContents, id})
                    this.isEditing = false
                }
            },
        }
    }
</script>
