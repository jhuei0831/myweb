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
                    <v-form v-model="valid" @submit.prevent="submit" ref="form" lazy-validation id="rolecreate" class="mt-4">
                        <v-text-field name="name" v-model="name" label="名稱" id="name" :rules="nameRules"></v-text-field>
                        <v-text-field name="email" v-model="email" label="電子信箱" id="email" :rules="emailRules"></v-text-field>
                        <v-text-field name="password" v-model="password" label="電子信箱" id="password" :rules="passwordRules"></v-text-field>
                        <v-text-field name="email" v-model="email" label="電子信箱" id="email" :rules="nameRules"></v-text-field>
                        <v-select name="role" :rules="roleRules" v-model="role" :items="roles" item-text="name" label="角色" chips>
                            <template #selection="{ item }">
                                <v-chip color="blue lighten-4 blue--text">{{item.name}}</v-chip>
                            </template>
                        </v-select>
                        <v-btn color="success" @click="submit" :disabled="!valid">送出</v-btn>
                        <v-btn color="error" @click="clear">清除表單內容</v-btn>
                        <v-btn color="warning" @click="clear_errors">清除錯誤訊息</v-btn>
                    </v-form> 
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
            valid: true,
            name: "",
            nameRules: [v => !!v || "名稱必填", v => (v && v.length <= 10) || "名稱必須小於10個字"],
            email: '',
            emailRules: [
                v => !!v || 'E-mail is required',
                v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
            ],
            select: null,
            role: '',
            roleRules: [v => !!v || "權限必填"],
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
				    this.createRoles({name: this.name, permission: this.permission})
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
