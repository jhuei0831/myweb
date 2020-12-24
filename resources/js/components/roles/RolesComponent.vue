<template>
    <v-sheet>
        <!-- <v-skeleton-loader class="mx-auto" type="table" v-if="loading"></v-skeleton-loader> -->
        <v-col>
            <v-btn to="/roles/create" small color="primary"><v-icon left small>mdi-account-plus</v-icon>新增</v-btn>
        </v-col>
        <v-card>
            <v-card-title>
                Role
            <v-spacer></v-spacer>
            <v-text-field
                v-model="search"
                append-icon="mdi-magnify"
                label="Search"
                single-line
                hide-details
            ></v-text-field>
            </v-card-title>
            <v-data-table
                :headers="headers"
                :items="roles"
                :search="search"
                :loading="loading"
            >     
            </v-data-table>
        </v-card>
        <!-- <v-sheet wrap v-if="!loading">
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
                            <v-btn x-small color="success" @click="enterEdit(role.id)">修改</v-btn>
                            <v-btn x-small color="red white--text" @click="enterDelete(role.id)">刪除</v-btn>
                        </td>
                    </tr>
                </tbody>
            </v-simple-table>
        </v-sheet>    -->
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
                    { text: 'Name', value: 'name' },
                    // { text: 'Action', value: 'fat' },
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
            }
        }
    }
</script>
