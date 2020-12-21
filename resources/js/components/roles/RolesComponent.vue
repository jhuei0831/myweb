<template>
    <v-sheet>
        <v-skeleton-loader class="mx-auto" type="table" v-if="loading"></v-skeleton-loader>
        <v-btn to="/roles/create" small color="primary"><v-icon small>mdi-account-plus</v-icon> 新增</v-btn>
        <v-simple-table v-if="!loading">    
            <thead>
                <tr>
                    <th>No</th>
                    <th>名稱</th>
                    <th>動作</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(role, key) in roles" :key="key">
                    <td>{{ key+1 }}</td>
                    <td>{{ role.name }}</td>
                    <td>
                        <v-btn x-small color="success">修改</v-btn>
                        <v-btn x-small color="red white--text">刪除</v-btn>
                    </td>
                </tr>
            </tbody>
        </v-simple-table>
    </v-sheet>
</template>

<script>
    import { mapGetters, mapActions } from "vuex";

    export default {
        mounted() {
            this.getRoles()
        },
        computed: {
            ...mapGetters("roles", ["roles", "loading"])
        },
        methods: {
            ...mapActions("roles", ["getRoles"])
        }
    }
</script>
