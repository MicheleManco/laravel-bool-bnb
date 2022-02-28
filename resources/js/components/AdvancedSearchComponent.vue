<template>
  <div>
      ricerca avanzata
  </div>
</template>

<script>
export default {
    data: function() {
            return {
                apartments: []
            }
        },
        mounted() {
            axios.get('/api/apartments/list')
                .then(r=>this.apartments=r.data)
                .catch(e=>console.error(e))
        }
}
</script>

<style>

</style>