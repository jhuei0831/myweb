<template>
    <v-sheet color="transparent">
        <v-skeleton-loader class="mx-auto" type="article, actions" v-if="loading"></v-skeleton-loader>
        <v-sheet v-if="!loading" color="transparent">
            <v-col>
                <v-btn to="/users" small color="primary"><v-icon left small>mdi-arrow-left</v-icon>返回</v-btn>
            </v-col>
            <v-col v-if="errors.length">
				<v-alert v-for="(error, key) in errors" :key="key" type="error" dismissible>{{ error }}<br></v-alert>
			</v-col>
            <v-card class="blue-grey lighten-5">
                <v-card-title class="cyan darken-3 white--text">
                    <v-icon color="white">mdi-account-plus-outline</v-icon>&nbsp;使用者新增
                </v-card-title>
                <v-card-text>
                    <validation-observer ref="observer" v-slot="{ invalid, reset }">
                    <v-form @submit.prevent="submit" @reset.prevent="reset" ref="form" lazy-validation id="usercreate" class="mt-4">
                        <validation-provider v-slot="{errors}" name="名稱" rules="required|max:10">
                            <v-text-field name="name" v-model="name" label="名稱" id="name" :error-messages="errors" rounded filled background-color="white"></v-text-field>
                        </validation-provider>
                        <validation-provider v-slot="{errors}" name="電子信箱" rules="required|email">
                            <v-text-field name="email" v-model="email" label="電子信箱" id="email" :error-messages="errors" rounded filled background-color="white"></v-text-field>
                        </validation-provider>
                        <validation-provider v-slot="{ errors }" name="密碼" rules="required|password:@password_confirmation">
                            <v-text-field type="password" name="password" v-model="password" label="密碼" id="password" :error-messages="errors" rounded filled background-color="white"></v-text-field>
                        </validation-provider>
                        <validation-provider v-slot="{ errors }" name="確認密碼" vid="password_confirmation" rules="required">
                            <v-text-field type="password" name="password_confirmation" v-model="password_confirmation" label="確認密碼" id="password_confirmation" :error-messages="errors" rounded filled background-color="white"></v-text-field>
                        </validation-provider>
                        <validation-provider v-slot="{errors}" name="電子信箱" rules="required">
                            <v-select name="role" v-model="role" :items="roles" item-text="name" label="角色" chips :error-messages="errors" rounded filled background-color="white">
                                <template #selection="{ item }">
                                    <v-chip color="blue lighten-4 blue--text">{{ item.name }}</v-chip>
                                </template>
                            </v-select>
                        </validation-provider>
                        <v-btn color="success" @click="submit" :disabled="invalid">送出</v-btn>
                        <v-btn color="error" type="reset">清除表單內容</v-btn>
                        <v-btn color="warning" @click="clear_errors">清除錯誤訊息</v-btn>
                    </v-form> 
                    </validation-observer>
                </v-card-text>
            </v-card>      
        </v-sheet>      
    </v-sheet>
</template>

<script>
    import { mapGetters, mapActions, mapMutations } from "vuex";
    import { mapFields } from 'vuex-map-fields';

    export default {
        data: () => ({
            email: '',
            name: '',
            password: '',
            password_confirmation: '',
            role: '',
        }),
        mounted() {
            this.getRoles()
        },
        computed: {
            ...mapFields("users", ["errors"]),
            ...mapGetters("users", ["loading", "roles"]),
        },
        methods: {
            ...mapActions("users", ["getRoles", "createUser"]),
            ...mapMutations("users", ["clean_errors"]),
            submit() {
                if (this.$refs.form.validate()) {
                    this.createUser({
                        name: this.name, 
                        email: this.email,
                        password: this.password,
                        password_confirmation: this.password_confirmation,
                        role: this.role,
                    })
                }
            },
            clear_errors() {
                this.clean_errors()
            }
        }
    }
</script>
