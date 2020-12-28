<template>
    <v-sheet rounded color="transparent">
        <!-- <v-skeleton-loader class="mx-auto" type="table" v-if="loading"></v-skeleton-loader> -->
        <v-col>
            <v-btn to="/users/create" small color="primary"><v-icon left small>mdi-account-plus</v-icon>新增</v-btn>
        </v-col>
        <v-card>
            <v-card-title class="cyan darken-3 white--text">
                <v-icon color="white">mdi-account-multiple-outline</v-icon>&nbsp;使用者列表
                <v-spacer></v-spacer>
                <v-text-field color="cyan darken-3" class="cyan lighten-3" rounded v-model="search" append-icon="mdi-magnify" label="Search" hide-details></v-text-field>
            </v-card-title>
            <v-data-table :headers="headers" :items="users" :search="search" :loading="loading" class="blue-grey lighten-5"> 
                <template v-slot:item="user">
                    <tr>
                        <td>{{user.item.id}}</td>
                        <td>{{user.item.name}}</td>
                        <td>{{user.item.email}}</td>
                        <td v-for="(role, key) in user.item.roles" :key="key">{{ role.name }}</td>
                        <td>
                            <v-btn x-small color="success" @click="enterEdit(user.item.id)">修改</v-btn>
                            <v-btn x-small color="red white--text" @click="enterDelete(user.item.id)">刪除</v-btn>
                        </td>
                    </tr>
                </template>    
            </v-data-table>
        </v-card>
    </v-sheet>
</template>

<script>
    import { mapGetters, mapActions } from "vuex";
    import Swal from 'sweetalert2'
    import router from "../../router/index.js"
    
    export default {
        data() {
            return {
                search: '',
                headers: [
                    {
                        text: 'No',
                        align: 'start',
                        sortable: true,
                        value: 'id',
                    },
                    { text: 'Name', value: 'name'},
                    { text: 'E-mail', value: 'email'},
                    { text: 'Role', value: 'role'},
                    { text: 'Action' },
                ],
            }
        },
        mounted() {
            this.getUsers()
        },
        computed: {
            ...mapGetters("users", ["users", "loading"]),
        },
        methods: {
            ...mapActions("users", ["getUsers", "deleteConfirm"]),
            enterEdit(id) {
                router.push({ path: `/users/edit/${id}`})
            },
            enterDelete(id) {
                this.deleteConfirm(id)
            },
        }
    }
</script>
