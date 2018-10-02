<template>
    <div class="demo">
        <nav class="pagination pagination_type1 pagination_type3">
            <ol class="pagination__list">
                <li class="pagination__group">
                    <a href="javascript:void(0);"
                       @click.prevent="changePage(1)"
                       :disabled="pagination.current_page <= 1"
                       class="pagination__item pagination__control pagination__control_prev">Anterior</a>
                </li>
                <li class="pagination__group" v-for="page in pages">
                    <a href="javascript:void(0);" class="pagination__item"
                       :class="isCurrentPage(page) ? 'pagination__item_active' : ''"
                       @click.prevent="changePage(page)">{{ page }}</a>
                </li>
                <li class="pagination__group"><a href="javascript:void(0);"
                     @click.prevent="changePage(pagination.current_page + 1)"
                     :disabled="pagination.current_page >= pagination.last_page"
                     class="pagination__item pagination__control pagination__control_next">Próxima</a></li>
            </ol>
        </nav>
    </div>
</template>

<style>
    .pagination {
        margin-top: 40px;
    }
</style>

<script>
    export default {
        name: 'PaginationComponent',
        props: {
            pagination: Object,
            offset: String
        },
        methods: {
            isCurrentPage(page) {
                return this.pagination.current_page === page;
            },
            changePage(page) {
                if (page > this.pagination.last_page) {
                    page = this.pagination.last_page;
                }
                this.pagination.current_page = page;
                this.$emit('paginate');
            }
        },
        computed: {
            pages() {
                let pages = [];
                let from = this.pagination.current_page - Math.floor(this.offset / 2);
                if (from < 1) {
                    from = 1;
                }
                let to = from + this.offset - 1;
                if (to > this.pagination.last_page) {
                    to = this.pagination.last_page;
                }
                while (from <= to) {
                    pages.push(from);
                    from++;
                }
                return pages;
            }
        }
    }
</script>
