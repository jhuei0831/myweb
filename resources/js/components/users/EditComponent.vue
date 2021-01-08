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
                    <v-icon color="white">mdi-account-edit-outline</v-icon>&nbsp;角色修改
                </v-card-title>
                <v-card-text>
                    <v-tabs v-model="tab" background-color="transparent" color="cyan darken-3" grow>
                        <v-tab href="#details"><v-icon>mdi-card-account-details-outline</v-icon>&nbsp;資料修改</v-tab>
                        <v-tab href="#password"><v-icon>mdi-lock-outline</v-icon>&nbsp;密碼修改</v-tab>
                    </v-tabs>
                    <v-tabs-items v-model="tab" class="transparent">
                        <v-tab-item id="details">
                            <validation-observer ref="observer" v-slot="{ invalid, reset }">
                            <v-form @submit.prevent="detail_submit" @reset.prevent="reset" ref="form_detail" lazy-validation id="user_detail" class="mt-4">
                                <validation-provider v-slot="{errors}" name="名稱" rules="required|max:10">
                                    <v-text-field name="name" v-model="user.name" label="名稱" id="name" :error-messages="errors" rounded filled background-color="white"></v-text-field>
                                </validation-provider>
                                <validation-provider v-slot="{errors}" name="電子信箱" rules="required|email">
                                    <v-text-field name="email" v-model="user.email" label="電子信箱" id="email" :error-messages="errors" rounded filled background-color="white"></v-text-field>
                                </validation-provider>
                                <validation-provider v-slot="{errors}" name="角色" rules="required">
                                    <v-select name="role" v-model="user_role" :items="roles" item-text="name" label="角色" chips :error-messages="errors" rounded filled background-color="white">
                                        <template #selection="{ item }">
                                            <v-chip color="blue lighten-4 blue--text">{{ item.name }}</v-chip>
                                        </template>
                                    </v-select>
                                </validation-provider>
                                <v-btn color="success" @click="detail_submit" :disabled="invalid" rounded>送出</v-btn>
                                <v-btn color="error" type="reset" rounded>清除表單內容</v-btn>
                                <v-btn color="warning" @click="clear_errors" rounded>清除錯誤訊息</v-btn>
                            </v-form> 
                            </validation-observer>
                        </v-tab-item>
                        <v-tab-item id="password">
                            <validation-observer ref="observer" v-slot="{ invalid, reset }">
                            <v-form @submit.prevent="password_submit" @reset.prevent="reset" ref="form_password" lazy-validation id="user_password" class="mt-4">
                                <validation-provider v-slot="{ errors }" name="密碼" rules="required|min:8|password:@password_confirmation">
                                    <v-text-field type="password" name="password" v-model="password" label="密碼" id="password" :error-messages="errors" rounded filled autocomplete="off" background-color="white"></v-text-field>
                                </validation-provider>
                                <validation-provider v-slot="{ errors }" name="確認密碼" vid="password_confirmation" rules="required">
                                    <v-text-field type="password" name="password_confirmation" v-model="password_confirmation" label="確認密碼" id="password_confirmation" :error-messages="errors" rounded filled autocomplete="off" background-color="white"></v-text-field>
                                </validation-provider>
                                <v-btn color="success" @click="password_submit" :disabled="invalid" rounded>送出</v-btn>
                                <v-btn color="error" type="reset" rounded>清除表單內容</v-btn>
                                <v-btn color="warning" @click="clear_errors" rounded>清除錯誤訊息</v-btn>
                            </v-form> 
                            </validation-observer>
                        </v-tab-item>
                    </v-tabs-items>
                    
                </v-card-text>
            </v-card>
            
        </v-sheet>      
    </v-sheet>
</template>

<script>
    import { mapState, mapGetters, mapActions, mapMutations } from "vuex";
    import { mapFields } from 'vuex-map-fields';

    export default {
        data: () => ({
            tab: null,
            password: '',
            password_confirmation: '',
        }),
        mounted() {
            // 取得網址的role id
            let pathname = window.location.pathname.split("/")
            let filename = pathname[pathname.length-1]
            this.getUser(filename)
            this.getRoles()
        },
        computed: {
            ...mapFields("users", ["user_role", "errors"]),
            ...mapGetters("users", ["loading", "roles", "user"]),
        },
        methods: {
            ...mapActions("users", ["getRoles", "getUser", "editUser"]),
            ...mapMutations("users", ["clean_errors"]),
            detail_submit() {
                if (this.$refs.form_detail.validate()) {
                    let formContents = {name: this.user.name, email: this.user.email, roles: this.user_role}
                    let id = this.user.id
                    this.clean_errors()
				    this.editUser({formContents, id})
                }
            },
            password_submit() {
                if (this.$refs.form_password.validate()) {
                    let formContents = {password: this.password, password_confirmation: this.password_confirmation}
                    let id = this.user.id
                    this.clean_errors()
				    this.editUser({formContents, id})
                }
            },
            clear() {
                this.$refs.form.reset()
            },
            clear_errors() {
                this.clean_errors()
            }
        }
    }
</script>
