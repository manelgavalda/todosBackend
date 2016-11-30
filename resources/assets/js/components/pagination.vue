<template>
    <ul class="pagination pagination-sm no-margin pull-right">
        <li><a href="#">&laquo;</a></li>

        <li v-for="n in paginationRange" :class="activePage(n)">

        <li><a href="#">{{n}}}</a></li>

        <li><a href="#">&raquo;</a></li>
    </ul>
</template>
<style>
</style>
<script>
    export default {
    methods: {
      lowerBound (num, limit) {
        return num >= limit ? num : limit
       }
    },
    computed: {
        paginationRange () {
          let start = this.currentPage - this.visiblePages / 2 <= 0
                        ? 1 : this.currentPage + this.visiblePages / 2 > this.lastPage
                        ? Util.lowerBound(this.lastPage - this.visiblePages + 1, 1)
                        : Math.ceil(this.currentPage - this.visiblePages / 2)
          let range = []
          for (let i = 0; i < this.visiblePages && i < this.lastPage; i++) {
            range.push(start + i)
          }
          return range
        }
      }
    }
</script>
