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
            <el-form-item label="作者">
                <el-input v-model="form.auther" clearable></el-input>
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
                },
                loading:false,
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
        },
        created() {
            this.showDialog = true;
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