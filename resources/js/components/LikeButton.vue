<template>
  
  <div class="d-flex align-items-center">
    <span class="like-btn" @click="likeReceta" :class="{ 'like-active' : isActive }" ></span>
    <p v-if="quantityLikes" class="mt-3"><strong>{{ quantityLikes }}</strong></p>
  </div>

</template>


<script>
  export default {
    props: ['recetaId', 'likes', 'likesNumber'],
    data: function() {
      return {
        totalLikes: this.likesNumber,
        isActive: this.likes
      }
    },
    mounted () {
      console.log(this.likes)
    },
    methods: {
      likeReceta: function () {
        axios.post(`/recetas/${this.recetaId}`)
        .then(response => {
          if (response.data.attached.length > 0) {
            this.$data.totalLikes++;
          } else {
            this.$data.totalLikes--;
          }

          this.isActive = !this.isActive
        })
        .catch(error => {
          if (error.response.status === 401) {
              this.$swal({
              icon: 'error',
              title: 'Oops...',
              text: 'Necesitas estar registrado!',
            }).then((result) => {
              if (result.isConfirmed) {
                window.location = "/register"
              }
            })
          }
        })
      }
    },
    computed: {
      quantityLikes: function() {
        return this.totalLikes
      }
    }
  }

</script>