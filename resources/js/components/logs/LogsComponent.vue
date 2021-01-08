<template>
    <v-sheet rounded color="transparent">
        <!-- <v-skeleton-loader class="mx-auto" type="table" v-if="loading"></v-skeleton-loader> -->
        <v-card>
            <v-card-title class="cyan darken-3 white--text">
                <v-icon color="white">mdi-file-document-multiple-outline</v-icon>&nbsp;Log列表
                <v-spacer></v-spacer>
                <v-btn color="white" text @click="filter = !filter"><v-icon>mdi-filter-variant</v-icon></v-btn>
            </v-card-title>
            <v-data-table :headers="headers" :items="filteredLogs" :loading="loading" class="blue-grey lighten-5"> 
                <template v-slot:item="log">
                    <tr>
                        <td>{{log.item.id}}</td>
                        <td>{{log.item.user}}</td>
                        <td>{{log.item.ip}}</td>
                        <td>{{log.item.action}}</td>
                        <td>{{log.item.table}}</td>
                        <td>{{log.item.created_at|formatDate}}</td>
                        <td>                           
                            <v-btn icon @click="getDetail(log.item.id)"><v-icon color="primary">mdi-information-outline</v-icon></v-btn>                               
                        </td>
                    </tr>
                </template>  
                <template v-slot:[`body.prepend`] v-if="filter">
                    <tr>
                        <td>
                            <!-- <v-text-field v-model="id" type="text" label="No" rounded dense filled class="mt-2"></v-text-field> -->
                        </td>
                        <td>
                            <v-text-field v-model="user" type="text" label="使用者" rounded dense filled class="mt-2"></v-text-field>
                        </td>
                        <td>
                            <v-text-field v-model="ip" type="text" label="IP" rounded dense filled class="mt-2"></v-text-field>
                        </td>
                        <td>
                            <v-select v-model="filters['action']" :items="columnValueList('action')" label="動作" multiple clearable rounded filled dense class="mt-2">
                                <template #selection="{ item }">{{ item }}</template>
                            </v-select>
                        </td>
                        <td>
                            <v-select label="資料表" rounded filled multiple clearable dense :items="columnValueList('table')" v-model="filters['table']" class="mt-2">
                                <template #selection="{ item }">{{ item }}</template>
                            </v-select>
                        </td>
                        <td>
                            <v-menu ref="menu_start" v-model="menu_start" :close-on-content-click="false" :return-value.sync="date_start" transition="scale-transition" offset-y>
                                <template v-slot:activator="{ on, attrs }">
                                    <v-text-field v-model="date_start" label="開始時間" readonly v-bind="attrs" v-on="on" rounded dense filled class="mt-2"></v-text-field>
                                </template>
                                <v-date-picker v-model="date_start" no-title scrollable>
                                    <v-spacer></v-spacer>
                                    <v-btn text color="primary" @click="menu_start = false">Cancel</v-btn>
                                    <v-btn text color="primary" @click="$refs.menu_start.save(date_start)">OK</v-btn>
                                </v-date-picker>
                            </v-menu>
                        </td>
                        <td>
                            <v-menu ref="menu_end" v-model="menu_end" :close-on-content-click="false" :return-value.sync="date_end" transition="scale-transition" offset-y>
                                <template v-slot:activator="{ on, attrs }">
                                    <v-text-field v-model="date_end" label="結束時間" readonly v-bind="attrs" v-on="on" rounded dense filled class="mt-2"></v-text-field>
                                </template>
                                <v-date-picker v-model="date_end" no-title scrollable>
                                    <v-spacer></v-spacer>
                                    <v-btn text color="primary" @click="menu_end = false">Cancel</v-btn>
                                    <v-btn text color="primary" @click="$refs.menu_end.save(date_end)">OK</v-btn>
                                </v-date-picker>
                            </v-menu>
                        </td>
                    </tr>
                </template>  
            </v-data-table>
        </v-card>
        <v-dialog v-model="dialog" max-width="1000">
            <v-card tile>
                <v-toolbar color="primary">
                    <v-toolbar-title class="white--text">詳細資料</v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-btn icon dark @click="leaveDetail()"><v-icon>mdi-close</v-icon></v-btn>
                </v-toolbar>              
                <v-skeleton-loader class="mx-auto" type="table" v-if="loading"></v-skeleton-loader>
                <v-card-text>
                    <v-simple-table v-if="!loading" class="mt-4">
                        <template v-slot:default>
                        <thead class="cyan">
                            <tr>
                                <th class="white--text">項目</th>
                                <th class="white--text">資料</th>
                            </tr>
                        </thead>
                        <tbody class="blue-grey lighten-5">
                            <tr>
                                <td>使用者</td>
                                <td>{{ log.user }}</td>
                            </tr>
                            <tr>
                                <td>IP</td>
                                <td>{{ log.ip }}</td>
                            </tr>
                            <tr>
                                <td>作業系統</td>
                                <td>{{ log.os }}</td>
                            </tr>
                            <tr>
                                <td>瀏覽器</td>
                                <td>{{ log.browser }}</td>
                            </tr>
                            <tr>
                                <td>瀏覽器詳細資料</td>
                                <td>{{ log.browser_detail }}</td>
                            </tr>
                            <tr>
                                <td>動作</td>
                                <td>{{ log.action }}</td>
                            </tr>
                            <tr>
                                <td>資料表</td>
                                <td>{{ log.table }}</td>
                            </tr>
                            <tr>
                                <td>資料</td>
                                <td>{{ log.data }}</td>
                            </tr>
                            <tr>
                                <td>建立時間</td>
                                <td>{{ log.created_at | formatDate }}</td>
                            </tr>
                        </tbody>
                        </template>
                    </v-simple-table>
                </v-card-text>
            </v-card>
        </v-dialog>
    </v-sheet>
</template>

<script>
    import { mapGetters, mapActions, mapMutations } from "vuex";
    import Swal from 'sweetalert2'
    import router from "../../router/index.js"
    
    export default {
        data() {
            return {
                dialog: false,
                filter: false,
                id: '',
                user: '',
                ip: '',
                filters: {
                    action: [],
                    table: [],
                },
                date_start: '',
                date_end: '',
                menu_start: false,
                menu_end: false,
            }
        },
        mounted() {
            this.getLogs()
        },
        computed: {
            ...mapGetters("logs", ["logs", "log", "loading"]),
            headers () {
                return [
                    {
                        text: 'No',
                        align: 'start',
                        sortable: true,
                        value: 'id',
                        filter: f => { 
                            return ( f + '' ).toLowerCase().includes(this['id'].toLowerCase()) 
                        }
                    },
                    { 
                        text: '使用者', 
                        value: 'user',
                        filter: f => { 
                            return ( f + '' ).toLowerCase().includes(this['user'].toLowerCase()) 
                        }
                    },
                    { 
                        text: 'IP', 
                        value: 'ip',
                        filter: f => { 
                            return ( f + '' ).toLowerCase().includes(this['ip'].toLowerCase()) 
                        }
                    },
                    { 
                        text: '動作', 
                        value: 'action',
                    },
                    { 
                        text: '資料表', 
                        value: 'table'
                    },
                    { 
                        text: '建立日期', 
                        value: 'created_at',
                        filter: value => {
                            if (this.date_start != '' && this.date_end == '') {
                                return value >= this.date_start
                            } 
                            else if (this.date_start == '' && this.date_end != '') {
                                return value <= this.date_end
                            }
                            else if (this.date_start != '' && this.date_end != '') {
                                return value >= (this.date_start) && value <= (this.date_end)
                            }
                            else{
                                return true
                            }
                        },
                    },
                    { text: '' },
                ]
            },
            filteredLogs() {
				return this.logs.filter((d) => {
					return Object.keys(this.filters).every((f) => {
						return this.filters[f].length < 1 || this.filters[f].includes(d[f]);
					});
				});
			},
        },
        methods: {
            ...mapActions("logs", ["getLogs", "getLog"]),
            ...mapMutations("logs", ["log_data"]),
            getDetail(id) {
                this.dialog = true
                this.getLog(id)
            },
            leaveDetail() {
                this.dialog = false
                this.log_data([])
            },
            columnValueList(val) {
				return this.logs.map((d) => d[val]);
			},
        }
    }
</script>
