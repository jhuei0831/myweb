<template>
    <v-sheet>
        <v-skeleton-loader class="mx-auto" type="article, actions" v-if="!allow"></v-skeleton-loader>
        <v-sheet v-if="allow">
            <v-btn to="/roles" small color="primary"><v-icon left small>mdi-arrow-left</v-icon>返回</v-btn>
            <p v-if="errors.length">
				<v-alert v-for="(error, key) in errors" :key="key" type="error">{{ error }}<br></v-alert>
			</p>
            <v-form v-model="valid" @submit.prevent="submit" ref="form" lazy-validation id="roleedit">
                <v-text-field name="name" v-model="role.name" label="名稱" id="name" :rules="nameRules"></v-text-field>
                <v-select name="permission" v-model="permission" :items="permissions" item-text="name" label="權限" multiple chips></v-select>
                <v-btn @click="submit" :disabled="!valid">送出</v-btn>
                <v-btn @click="clear">清除</v-btn>
            </v-form> 
        </v-sheet>      
    </v-sheet>
</template>

<script>
    import { mapGetters, mapActions } from "vuex";

    export default {
        data: () => ({
            valid: true,
            name: "",
            nameRules: [v => !!v || "Name is required", v => (v && v.length <= 10) || "Name must be less than 10 characters"],
            permission: []
        }),
        mounted() {
            // 取得網址的role id
            let pathname = window.location.pathname.split("/");
            let filename = pathname[pathname.length-1];
            this.getRole(filename)
            this.getPermissions()
            this.getPermission({permission: 'role-edit'})
        },      
        computed: {
            ...mapGetters("roles", ["loading", "permissions", "rolePermissions", "errors", "role"]),
            ...mapGetters("auth", ["allow"])
        },
        methods: {
            ...mapActions("roles", ["getPermissions", "getRole", "editRoles"]),
            ...mapActions("auth", ["getPermission"]),
            submit() {
                if (this.$refs.form.validate()) {
                    let formContents = {name: this.role.name, permission: this.permission}
                    let id = this.role.id
				    this.editRoles({formContents, id})
                }
            },
            clear() {
                this.$refs.form.reset();
            }
        }
    }
</script>
