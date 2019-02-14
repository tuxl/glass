<template>
    <el-dialog top="7vh" :title="form_title" :visible.sync="showDialog" @close="closedialog">
        <el-form :rules="rules" :model="form" ref="ruleForm" status-icon label-width="120px" size="small">
            <el-form-item label="名称" prop="rename" required>
                <el-input v-model="form.rename" clearable></el-input>
            </el-form-item>
            <el-form-item label="共享状态" prop="sharestate" required>
                <el-select v-model="form.sharestate">
                    <el-option label="开启" :value="1"></el-option>
                    <el-option label="关闭" :value="2"></el-option>
                </el-select>
            </el-form-item>
        </el-form>
        <div slot="footer" class="dialog-footer">
            <el-button @click="showDialog = false">取消</el-button>
            <el-button type="primary" :loading="uploading" @click="submitForm('ruleForm')">确定</el-button>
        </div>
    </el-dialog>
</template>

<script>

    export default {
        name: "editform",
        props: ['category'],
        components: {
        },
        data() {
            return {
                form_title: '编辑',
                showDialog: false,
                uploading: false,
                form: {
                    rename: '',
                    sharestate: '',
                },
                rules: {

                },

            }
        },

        methods: {
            closedialog: function () {
                this.$emit('close');
            },
            submitForm(formName) {
                this.$refs[formName].validate((valid) => {
                    if (!valid) {
                        return;
                    }

                    let formdata = {
                        sharestate: this.form.sharestate,
                        rename: this.form.rename,
                    };
                    let url = '/simcatshare/update/'+this.category.id;
                    this.uploading = true;
                    axios.post(
                        url,
                        formdata,
                        {headers: {'X-Requested-With': 'XMLHttpRequest'},}
                    ).then((response) => {
                        this.$message.success('更新成功');
                        this.$emit('update');
                        this.showDialog = false;
                    }).catch((error) => {
                        if (error.status == 500) {
                            this.$message.error('表单数据错误');
                        } else if (error.status == 530) {
                            this.$message.error('共享卡使用中，无法关闭共享');
                        } else if (error.status == 531) {
                            this.$message.error('更新失败');
                        } else if (error.status == 532) {
                            this.$message.error('卡类型不存在');
                        } else if (error.status == 533) {
                            this.$message.error('合作伙伴没有开启共享');
                        } else {
                            this.$message.error('失败');
                        }
                    }).finally(() => {
                        this.uploading = false;
                    });
                });
            },
        },
        created() {
            this.showDialog = true;
            let dataformparent = this.category;
            this.form.sharestate = dataformparent.sharestate;
            this.form.rename = dataformparent.rename;
        }

    }
</script>

<style scoped>

</style>