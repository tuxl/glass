<template>
    <el-dialog top="7vh" title="作品" :visible.sync="showDialog" @close="closedialog">
        <el-form v-loading="loading"
                 element-loading-text="loading..."
                 element-loading-spinner="el-icon-loading"
                 element-loading-background="rgba(255, 255, 255, 0.8)"
                 :model="form" ref="ruleForm" status-icon label-width="120px" size="small">
            <el-form-item label="名称" >
                <el-input v-model="form.name" clearable></el-input>
            </el-form-item>
            <el-form-item label="分类">
                <el-select v-model="form.cat" placeholder="请选择分类">
                    <el-option v-for="item in catlist" :key="item.id" :value="item.id" :label="item.name">{{ item.name }}</el-option>
                </el-select>
            </el-form-item>
            <el-form-item label="作者">
                <el-input v-model="form.auther" clearable></el-input>
            </el-form-item>
            <el-form-item label="宽(像素)">
                <el-input v-model="form.w" clearable></el-input>
            </el-form-item>
            <el-form-item label="高(像素)">
                <el-input v-model="form.h" clearable></el-input>
            </el-form-item>
        </el-form>
        <div slot="footer" class="dialog-footer">
            <el-button @click="showDialog = false">取消</el-button>
            <el-button type="primary" :loading="uploading" @click="submitForm()">确定</el-button>
        </div>
    </el-dialog>
</template>

<script>
    export default {
        name: "form",
        props: ['row', 'formtype'],
        components: {
        },
        data() {
            return {
                showDialog: false,
                uploading: false,
                form: {
                    name: '',
                    auther: '',
                    w:0,
                    h:0,
                    cat:null,
                },
                loading:false,
                catlist:[],
            }
        },

        methods: {
            closedialog: function () {
                this.$emit('close');
            },
            submitForm() {
                let url = '';
                if (this.formtype == 'edit') {
                    url = '/admin/productionlist/edit/'+this.row.id;
                } else  {
                    url = '/admin/productionlist/add';
                }

                this.uploading = true;

                let formdata = {
                    name:this.form.name,
                    auther:this.form.auther,
                    w:this.form.w,
                    h:this.form.h,
                    cat:this.form.cat,
                };
                axios.post(
                    url,
                    formdata,
                    {headers: {'X-Requested-With': 'XMLHttpRequest'},}
                ).then((response) => {
                    this.$message.success('添加成功');
                    this.showDialog = false;
                    this.$emit('update');
                }).catch((error) => {
                    let message = '';
                    this.$message.error('添加失败');
                }).finally(() => {
                    this.uploading = false;
                });
            },
            fetchAllCat:function () {
                let url = '/admin/categorylist/listall';
                axios.get( url,
                    {
                        headers: {'X-Requested-With': 'XMLHttpRequest'},
                    })
                    .then((response) => {
                        this.catlist = response.data;
                    })
                    .catch((response)=>{
                    })
                    .finally((response)=>{
                        this.loading = false;
                    })
            }
        },
        created() {
            this.showDialog = true;
            this.fetchAllCat();
            if (this.formtype == 'edit') {
                this.loading = true;
                let url = '/admin/productionlist/detail/'+this.row.id;
                axios.get( url,
                    {
                        headers: {'X-Requested-With': 'XMLHttpRequest'},
                    })
                    .then((response) => {
                        let data = response.data;
                        this.form.name = data.title;
                        this.form.auther = data.auther;
                        this.form.w = data.w;
                        this.form.h= data.h;
                        this.form.cat= data.catid;
                    })
                    .catch((response)=>{
                    })
                    .finally((response)=>{
                        this.loading = false;
                    })
            }
        }

    }
</script>

<style scoped>

</style>