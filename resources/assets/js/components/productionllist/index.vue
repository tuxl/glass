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
                <el-button @click="addProduction()" size="small" type="primary" hidden>新增</el-button>
            </el-row>
            <div id="parent" style="overflow: hidden; margin-top: 5px">
            <el-table
                    v-loading="loading"
                    :data="upgradelist"
                    highlight-current-row
                    :border="true">
                <el-table-column fixed="left" :min-width="180" prop="title" label="名称"></el-table-column>
                <el-table-column fixed="left" :min-width="180" prop="auther" label="作者"></el-table-column>
                <el-table-column fixed="left" :min-width="180" prop="auther" label="缩略图">
                    <template slot-scope="scope">
                        <template v-if="scope.row.thumb_path">
                            <a :href="scope.row.thumb_path" target="_blank" >查看</a>
                        </template>
                    </template>
                </el-table-column>
                <el-table-column fixed="left" :min-width="180" prop="auther" label="主图">
                    <template slot-scope="scope">
                        <template v-if="scope.row.mainpic">
                            <a :href="scope.row.mainpic" target="_blank" >查看</a>
                        </template>
                    </template>
                </el-table-column>
                <el-table-column :width="100" fixed="right" label="操作" align="center">
                    <template slot-scope="scope">
                        <div class="rh_operationiconlist">
                            <span>
                                <i class="el-icon-edit" title="编辑" @click="editdata(scope.row)"></i>
                            </span>
                            <span>
                                <i class="el-icon-tickets"  title="相册" @click="editPic(scope.row)"></i>
                            </span>
                            <span>
                                <i class="el-icon-delete"  title="删除" @click="deleteProduction(scope.row)"></i>
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
                        :page-sizes="[20]"
                        :page-size="pagination.pageSize"
                        layout="total, sizes, prev, pager, next, jumper"
                        :total="pagination.total">
                </el-pagination>
            </div>
        </div>
        <editform v-if="edit.show"
                  :row="edit.row"
                  :formtype="edit.formtype"
                  @close="edit.show = false"
                  @update="fetchData">
        </editform>
        <picform v-if="picform.show"
                 :row="picform.data"
                 @close="picform.show = false"
                 @update="fetchData"></picform>
    </div>
</template>

<script>

    import editform from './form';
    import picform from './albummanage';

    export default {
        name: "producitionlist",
        components: {
            editform,
            picform,
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
                    formtype:'add',
                },
                query:{
                    name:'',
                    partner:null,
                },
                picform:{
                    show:false,
                    data:null,
                }
            }
        },
        watch:{
        },
        computed: {

        },
        methods: {
            editPic:function(row){
                this.picform.show = true;
                this.picform.data = row;
            },
            research:function(){
                this.pagination.currentPage = 0;
                this.fetchData();
            },
            editdata:function(row){
                this.edit.show = true;
                this.edit.row = row;
                this.edit.formtype = 'edit';
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
                axios.get('/admin/productionlist',
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
            addProduction:function () {
                this.edit.show = true;
                this.edit.formtype = 'add';
            },
            deleteProduction:function (row) {
                this.$confirm('此操作将永久删除该文件, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    axios.post(
                        '/admin/productionlist/delete/'+row.id,
                        {},
                        {headers: {'X-Requested-With': 'XMLHttpRequest'},}
                    ).then((response) => {
                        this.$message.success('删除成功');
                        this.showDialog = false;
                        this.fetchData();
                    }).catch((error) => {
                        let message = '';
                        this.$message.error('删除失败');
                    }).finally(() => {
                    });
                }).catch(() => {

                });
            }
        },
        mounted(){
            this.$store.commit('sidebar/setMenu', 'productionlist');
            this.fetchData();
        }
    }
</script>

<style>

</style>