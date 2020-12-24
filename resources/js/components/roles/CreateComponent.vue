<template>
    <v-sheet>
        <v-skeleton-loader class="mx-auto" type="article, actions" v-if="loading"></v-skeleton-loader>
        <v-sheet v-if="!loading">
            <v-btn to="/roles" small color="primary"><v-icon left small>mdi-arrow-left</v-icon>返回</v-btn>
            <v-col v-if="errors.length">
				<v-alert v-for="(error, key) in errors" :key="key" type="error" dismissible>{{ error }}<br></v-alert>
			</v-col>
            <v-form v-model="valid" @submit.prevent="submit" ref="form" lazy-validation id="rolecreate">
                <v-text-field name="name" v-model="name" label="名稱" id="name" :rules="nameRules"></v-text-field>
                <v-select name="permission" v-model="permission" :items="permissions" item-text="name" label="權限" multiple chips></v-select>
                <v-btn @click="submit" :disabled="!valid">送出</v-btn>
                <v-btn @click="clear">清除</v-btn>
            </v-form> 
        </v-sheet>      
    </v-sheet>
</template>

<script>
    import { mapGetters, mapActions } from "vuex";
    import { mapFields } from 'vuex-map-fields';

    export default {
        data: () => ({
            valid: true,
            name: "",
            nameRules: [v => !!v || "Name is required", v => (v && v.length <= 10) || "Name must be less than 10 characters"],
            select: null,
            permission: []
        }),
        mounted() {
            this.getPermissions()
        },
        computed: {
            ...mapFields("roles", ["errors"]),
            ...mapGetters("roles", ["loading", "permissions"]),
        },
        methods: {
            ...mapActions("roles", ["getPermissions", "createRoles"]),
            submit() {
                if (this.$refs.form.validate()) {
				    this.createRoles({name: this.name, permission: this.permission})
                }
            },
            clear() {
                this.$refs.form.reset();
                this.errors = []
            }
        }
    }
</script>
