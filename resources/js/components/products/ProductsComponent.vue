<template>
    <v-sheet rounded color="transparent">
        <!-- <v-skeleton-loader class="mx-auto" type="table" v-if="loading"></v-skeleton-loader> -->
        <v-col>
            <v-btn to="/users/create" small color="primary"><v-icon left small>mdi-account-plus</v-icon>新增</v-btn>
        </v-col>
        <v-card>
            <v-card-title class="cyan darken-3 white--text">
                <v-icon color="white">mdi-account-multiple-outline</v-icon>&nbsp;商品列表
                <v-spacer></v-spacer>
                <v-text-field color="cyan darken-3" class="cyan lighten-3" rounded v-model="search" append-icon="mdi-magnify" label="Search" hide-details></v-text-field>
            </v-card-title>
            <v-data-table :headers="headers" :items="products" :search="search" :loading="loading" class="blue-grey lighten-5"> 
                <template v-slot:item="product">
                    <tr>
                        <td>{{product.item.id}}</td>
                        <td>{{product.item.name}}</td>
                        <td>{{product.item.price}}</td>
                        <td>{{product.item.unit}}</td>
                        <td>
                            <v-btn icon @click="enterEdit(user.item.id)"><v-icon color="success">mdi-circle-edit-outline</v-icon></v-btn>
                            <v-btn icon @click="enterDelete(user.item.id)"><v-icon color="error">mdi-delete-circle-outline</v-icon></v-btn>
                        </td>
                    </tr>
                </template>    
            </v-data-table>
        </v-card>
    </v-sheet>
</template>

<script>
    import { mapGetters, mapActions } from "vuex";
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
                    { text: '名稱', value: 'name'},
                    { text: '價錢', value: 'price'},
                    { text: '單位', value: 'unit'},
                    { text: 'Action' },
                ],
            }
        },
        mounted() {
            this.getProducts()
        },
        computed: {
            ...mapGetters("products", ["products", "loading"]),
        },
        methods: {
            ...mapActions("products", ["getProducts", "deleteConfirm"]),
        }
    }
</script>
