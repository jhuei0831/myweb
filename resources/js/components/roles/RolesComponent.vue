<template>
    <v-sheet rounded color="transparent">
        <!-- <v-skeleton-loader class="mx-auto" type="table" v-if="loading"></v-skeleton-loader> -->
        <v-col>
            <v-btn to="/roles/create" small color="primary"><v-icon left small>mdi-account-plus</v-icon>新增</v-btn>
        </v-col>
        <v-card>
            <v-card-title class="cyan darken-3 white--text">
                <v-icon color="white">mdi-account-outline</v-icon>&nbsp;角色列表
                <v-spacer></v-spacer>
                <v-text-field color="cyan darken-3" class="cyan lighten-3" rounded v-model="search" append-icon="mdi-magnify" label="Search" hide-details></v-text-field>
            </v-card-title>
            <v-data-table :headers="headers" :items="roles" :search="search" :loading="loading" class="blue-grey lighten-5"> 
                <template v-slot:item="role">
                    <tr>
                        <td>{{role.item.id}}</td>
                        <td>{{role.item.name}}</td>
                        <td>
                            <v-btn icon @click="enterEdit(role.item.id)"><v-icon color="success">mdi-circle-edit-outline</v-icon></v-btn>
                            <v-btn icon @click="enterDelete(role.item.id)"><v-icon color="error">mdi-delete-circle-outline</v-icon></v-btn>
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
                    { text: 'Action' },
                ],
            }
        },
        mounted() {
            this.getRoles()
        },
        computed: {
            ...mapGetters("roles", ["roles", "loading"]),
        },
        methods: {
            ...mapActions("roles", ["getRoles", "deleteConfirm"]),
            enterEdit(id) {
                router.push({ path: `/roles/edit/${id}`})
            },
            enterDelete(id) {
                this.deleteConfirm(id)
            },
        }
    }
</script>
