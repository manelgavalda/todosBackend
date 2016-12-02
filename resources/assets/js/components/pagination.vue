<template>
    <ul class="pagination pagination-sm no-margin pull-right">
        <li><a href="#" @click.prevent="pageChanged(1)" aria-label="First"><span aria-hidden="true">&laquo;</span></a></li>
        <li><a href="#" @click.prevent="pageChanged(page-1)" aria-label="Previous"><span aria-hidden="true">&lt</span></a></li>
        <li><a href="#" @click.prevent="pageChanged(n)" :class=activePage(n)>{{n}}</a></li>
        <li><a href="#" @click.prevent="pageChanged(page+1)" aria-label="Next"><span aria-hidden="true">&gt</span></a></li>
        <li><a href="#" @click.prevent="pageChanged(lastPage)" aria-label="Last"><span aria-hidden="true">&raquo;</span></li>
    </ul>
</template>
<style>
</style>
<script>
    export default {
      props: {
    // Current Page
    currentPage: {
      type: Number,
      required: true
    },
    visiblePages: {
      type: Number,
      default: 5,
      coerce: (val) => parseInt(val)
    },
    totalPages: Number,
    // Items per page
    itemsPerPage: Number,
    // Total items
    totalItems: Number,
  },
    methods: {
      lowerBound (num, limit) {
        return num >= limit ? num : limit
       },
       pageChanged (pageNum){
        this.$emit('page-changed', pageNum)
       },
       activePage (pageNum) {
        return this.currentPage
       }
    },
    computed: {
     lastPage () {
      if (this.totalPages) {
        return this.totalPages
      } else {
        return this.totalItems % this.itemsPerPage === 0
          ? this.totalItems / this.itemsPerPage
          : Math.floor(this.totalItems / this.itemsPerPage) + 1
      }
    },
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
      },
      created() {
            this.page = this.currentPage;
        }
    }
</script>
