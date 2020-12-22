<template>
    <v-sheet>
        <v-skeleton-loader class="mx-auto" type="table" v-if="loading"></v-skeleton-loader>
        <v-sheet wrap v-if="allow">
            <v-btn to="/roles/create" small color="primary"><v-icon left small>mdi-account-plus</v-icon>新增</v-btn>
            <v-simple-table>    
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
    </v-sheet>
</template>

<script>
    import { mapGetters, mapActions } from "vuex";

    export default {
        mounted() {
            this.getRoles()
            this.getPermission({permission: 'role-list'})
        },
        computed: {
            ...mapGetters("roles", ["roles", "loading"]),
            ...mapGetters("auth", ["allow"]),
        },
        methods: {
            ...mapActions("roles", ["getRoles"]),
            ...mapActions("auth", ["getPermission"]),
        }
    }
</script>
