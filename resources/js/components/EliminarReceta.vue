<template>
  <input 
    type="submit" 
    class="btn btn-danger mb-2 d-block w-100" 
    value="Eliminar ×"
    @click="eliminarReceta"
  >
</template>


<script>
  export default {
    props: ['receta'],
    methods: {
      eliminarReceta() {
          this.$swal({
          title: 'Deseas eliminar esta receta?',
          text: "Una vez eliminada, no se puede recuperar",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si',
          cancelButtonText: 'No'
        }).then((result) => {
          if (result.isConfirmed) {
            const params = {
              id: this.receta
            }

            axios.post(`/recetas/${this.receta}`, {params, _method: 'delete'})
              .then(res => {
                this.$swal({
                  title: 'Receta eliminada',
                  text: 'Se eliminó la receta',
                  icon: 'success'
                });
                //remove element DOM
                this.$el.parentNode.parentNode.parentNode.removeChild(this.$el.parentNode.parentNode);
              })
              .catch(err => {
                console.log(err);
              })

          }
        })
      }
    }
  }

</script>