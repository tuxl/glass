<template>
    <div>
        <div class="block_div" style="margin-bottom: 10px">
            <el-form :inline="true" size="mini">
                <el-form-item label="名称">
                    <el-input clearable v-model="query.name"></el-input>
                </el-form-item>
                <el-form-item>
                    <el-button  type="primary" plain @click="research">查询</el-button>
                </el-form-item>
            </el-form>
        </div>
        <div class="block_div" style="margin-bottom: 15px">
            <el-row style="margin-bottom: 5px">
                <el-button @click="fetchData()" size="small" type="primary" hidden>刷新</el-button>
            </el-row>
            <div id="parent" style="overflow: hidden; margin-top: 5px">
            <el-table
                    v-loading="loading"
                    :data="upgradelist"
                    highlight-current-row
                    :border="true">
                <el-table-column fixed="left" :min-width="180" prop="title" label="名称"></el-table-column>
                <el-table-column fixed="left" :min-width="180" prop="rename" label="作者"></el-table-column>
                <el-table-column :width="100" fixed="right" label="操作" align="center">
                    <template slot-scope="scope">
                        <div class="rh_operationiconlist">
                            <span>
                                <i class="el-icon-edit" title="相册" @click="editCat(scope.row)"></i>
                            </span>
                            <span>
                                <i class="el-icon-tickets"  title="删除" @click="subscriber(scope.row)"></i>
                            </span>
                        </div>
                    </template>
                </el-table-column>
            </el-table>
            </div>
            <div style="text-align: right; margin-top:20px;">
                <el-pagination
                        v-if="pagination.showpagination"
                        @size-change="handleSizeChange"
                        @current-change="handleCurrentChange"
                        :current-page.sync="pagination.currentPage"
                        :page-sizes="[20, 100, 200, 300, 400, 1000]"
                        :page-size="pagination.pageSize"
                        layout="total, sizes, prev, pager, next, jumper"
                        :total="pagination.total">
                </el-pagination>
            </div>
        </div>

        <editform v-if="edit.show"
                  :category="edit.row"
                  @update="fetchData"
                  @close="edit.show = false"></editform>
    </div>
</template>

<script>

    import editform from './editform'
    export default {
        name: "producitionlist",
        components: {
            editform,
        },
        data () {
            return {
                upgradelist:[],
                partnerlist:[],
                loading:false,
                pagination:{
                    showpagination: true,
                    total: 0,
                    pageSize: 20,
                    currentPage: 1,
                },

                edit:{
                    show:false,
                    row:null,
                },
                query:{
                    name:'',
                    partner:null,
                }
            }
        },
        watch:{
        },
        computed: {

        },
        methods: {
            research:function(){
                this.pagination.currentPage = 0;
                this.fetchData();
            },
            editCat:function(row){
                this.edit.show = true;
                this.edit.row = row;
            },
            rerendPaginationn: function () {
                this.pagination.showpagination = !this.pagination.showpagination;
                this.$nextTick(() => {
                    this.pagination.showpagination = true;
                });
            },
            handleSizeChange: function (val) {
                this.pagination.pageSize = val;
                this.fetchData();
            },
            handleCurrentChange: function (val) {
                this.pagination.currentPage = val;
                this.fetchData();
            },
            fetchData:function () {
                let params = {
                    'page': this.pagination.currentPage,
                    'pagesize': this.pagination.pageSize,
                    'name':this.query.name,
                };
                axios.get('/productionlist',
                    {
                        params: params
                    })
                    .then((response) => {
                        this.pagination.total = response.data.count;
                        this.upgradelist = response.data.data;
                    })
                    .catch((response)=>{
                    })
                    .finally((response)=>{
                        this.loading = false;
                        this.scrolltriger = !this.scrolltriger;
                    })
            },
        },
        mounted(){
            this.$store.commit('sidebar/setMenu', 'productionlist');
            this.fetchData();
        }
    }
</script>

<style>

</style>