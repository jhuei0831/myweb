<template>
    <v-sheet v-if="allow">
        <v-skeleton-loader class="mx-auto" type="card" v-if="allow"></v-skeleton-loader>
        <v-btn to="/roles" small color="primary"><v-icon left small>mdi-arrow-left</v-icon>返回</v-btn>

        <v-form v-model="valid" @submit.prevent="submit" ref="form" lazy-validation>
            <v-text-field name="name" label="名稱" id="name" :rules="nameRules"></v-text-field>
            <v-select v-model="permission" :items="permissions" item-text="name" label="Select" multiple chips></v-select>
            <v-btn @click="submit" :disabled="!valid">送出</v-btn>
            <v-btn @click="clear">清除</v-btn>
        </v-form>    
    </v-sheet>
</template>

<script>
    import { mapGetters, mapActions } from "vuex";

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
            this.getPermission({permission: 'role-create!'})
        },
        computed: {
            ...mapGetters("roles", ["loading", "permissions"]),
            ...mapGetters("auth", ["allow"]),
        },
        methods: {
            ...mapActions("roles", ["getPermissions"]),
            ...mapActions("auth", ["getPermission"]),
            submit() {
                if (this.$refs.form.validate()) {
                    // Native form submission is not yet supported
                }
            },
            clear() {
                this.$refs.form.reset();
            }
        }
    }
</script>
