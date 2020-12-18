<template>
  <div class="about">
    <h1>This is an about page{{userdata}}</h1>
  </div>
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
                this.userdata = response.data.user;
                // console.log(response.data);
            })
        }
    }
</script>
