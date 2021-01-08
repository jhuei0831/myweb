<template>
    <v-sheet color="transparent">
        <v-skeleton-loader class="mx-auto" type="article, actions" v-if="loading"></v-skeleton-loader>
        <v-sheet v-if="!loading" color="transparent">
            <v-col>
                <v-btn to="/roles" small color="primary"><v-icon left small>mdi-arrow-left</v-icon>返回</v-btn>
            </v-col>
            <v-col v-if="errors.length">
				<v-alert v-for="(error, key) in errors" :key="key" type="error" dismissible>{{ error }}<br></v-alert>
			</v-col>
            <v-card class="blue-grey lighten-5">
                <v-card-title class="cyan darken-3 white--text">
                    <v-icon color="white">mdi-account-edit-outline</v-icon>&nbsp;角色修改
                </v-card-title>
                <v-card-text>
                    <validation-observer ref="observer" v-slot="{ invalid, reset }">
                        <v-form @submit.prevent="submit" @reset.prevent="reset" ref="form" lazy-validation id="roleedit" class="mt-4">
                            <validation-provider v-slot="{errors}" name="名稱" rules="required|max:10">
                                <v-text-field name="name" v-model="role.name" label="名稱" id="name" :error-messages="errors" rounded filled background-color="white"></v-text-field>
                            </validation-provider>
                            <validation-provider v-slot="{errors}" name="權限" rules="required">
                                <v-select name="permission" v-model="rolePermissions" :items="permissions" item-text="name" label="權限" multiple chips :error-messages="errors" rounded filled background-color="white">
                                    <template #selection="{ item }">
                                        <v-chip color="blue lighten-4 blue--text">{{item.name}}</v-chip>
                                    </template>
                                </v-select>
                            </validation-provider>
                            <v-btn color="success" @click="submit" :disabled="invalid">送出</v-btn>
                            <v-btn color="error" @click="clear">清除表單內容</v-btn>
                            <v-btn color="warning" @click="clear_errors">清除錯誤訊息</v-btn>
                        </v-form> 
                    </validation-observer>
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
            name: "",
            permission: []
        }),
        mounted() {
            // 取得網址的role id
            let pathname = window.location.pathname.split("/")
            let filename = pathname[pathname.length-1]
            this.getRole(filename)
            this.getPermissions()
        },
        computed: {
            ...mapFields("roles", ["rolePermissions", "errors"]),
            ...mapGetters("roles", ["loading", "permissions", "role"]),
        },
        methods: {
            ...mapActions("roles", ["getPermissions", "getRole", "editRoles"]),
            ...mapMutations("roles", ["clean_errors"]),
            submit() {
                if (this.$refs.form.validate()) {
                    let formContents = {name: this.role.name, permission: this.rolePermissions}
                    let id = this.role.id
                    this.clean_errors()
				    this.editRoles({formContents, id})
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
