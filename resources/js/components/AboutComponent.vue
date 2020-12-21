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
    import { mapGetters, mapActions } from "vuex";

    export default {
        computed: {
            ...mapGetters("auth", ["userdata"])
        }
    }
</script>
