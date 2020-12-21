<script>
    export default {
        methods: {
                can(permissionName) {
                return Permissions.toString().indexOf(permissionName) !== -1;
            },
        },
    };
</script>