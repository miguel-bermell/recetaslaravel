<template>
    <span v-text="formatFecha"></span>
</template>

<script>
  import { format, formatDistance, formatRelative, subDays } from 'date-fns';
  import es from 'date-fns/locale/es'

    export default {
      props: ['fecha'],
      computed: {
        formatFecha() {
          return formatDistance(subDays(new Date(this.fecha), 0), new Date(), { locale: es });
        }
      }
    }
</script>