<template>
    <v-sheet class="transparent">
        <v-col>
            <v-btn to="/logs" small color="primary"><v-icon left small>mdi-arrow-left</v-icon>返回</v-btn>
        </v-col>
        <v-simple-table>
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
    </v-sheet>  
</template>

<script>
import { mapActions, mapGetters } from "vuex";

export default {
    mounted() {
        let pathname = window.location.pathname.split("/")
        let filename = pathname[pathname.length-1]
        this.getLog(filename)
    },
    computed: {
        ...mapGetters('logs', ['log'])
    },
    methods: {
        ...mapActions("logs", ["getLog"])
    }
}
</script>