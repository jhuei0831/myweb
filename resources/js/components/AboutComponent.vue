<template>
    <v-simple-table>
        <thead>
            <tr>
                <th class="text-center">Name</th>
                <th class="text-center">Email</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ userdata.name }}</td>
                <td>{{ userdata.email }}</td>
            </tr>
        </tbody>
    </v-simple-table>
</template>

<script>
    export default {
        data () {
            return {
                userdata: null
            }  
        },
        mounted() {
            axios.get('/api/user')
            .then((response) => {
                this.userdata = response.data.data;
                console.log(response.data.data);
            })
            .catch(() => {
                this.$router.push({ name: 'Login' })
            })
        }
    }
</script>
