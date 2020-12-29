<template>
    <v-sheet rounded color="transparent">
        <!-- <v-skeleton-loader class="mx-auto" type="table" v-if="loading"></v-skeleton-loader> -->
        <v-card>
            <v-card-title class="cyan darken-3 white--text">
                <v-icon color="white">mdi-file-document-multiple-outline</v-icon>&nbsp;Log列表
                <v-spacer></v-spacer>
                <v-text-field color="cyan darken-3" class="cyan lighten-3" rounded v-model="search" append-icon="mdi-magnify" label="Search" hide-details></v-text-field>
            </v-card-title>
            <v-data-table :headers="headers" :items="logs" :search="search" :loading="loading" class="blue-grey lighten-5"> 
                <template v-slot:item="log">
                    <tr>
                        <td>{{log.item.id}}</td>
                        <td>{{log.item.user}}</td>
                        <td>{{log.item.ip}}</td>
                        <td>{{log.item.action}}</td>
                        <td>{{log.item.table}}</td>
                        <td>{{log.item.created_at}}</td>
                        <td>
                            <v-btn x-small color="info" @click="enterDetail(log.item.id)">詳細資料</v-btn>
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
    import router from "../router/index.js"
    
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
                    { text: '使用者', value: 'user'},
                    { text: 'IP', value: 'ip'},
                    { text: '動作', value: 'action'},
                    { text: '資料表', value: 'table'},
                    { text: '建立日期', value: 'created_at'},
                    { text: '' },
                ],
            }
        },
        mounted() {
            this.getLogs()
        },
        computed: {
            ...mapGetters("logs", ["logs", "loading"]),
        },
        methods: {
            ...mapActions("logs", ["getLogs"]),
            enterDetail(id) {
                router.push({ path: `/logs/detail/${id}`})
            },
        }
    }
</script>
