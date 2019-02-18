<template>
    <el-dialog top="7vh" title="相册管理" :visible.sync="showDialog" @close="closedialog">
        <div>
            <el-form label-width="80px" >
                <el-form-item label="缩略图">
                    <input type="file" id="thumb"/> <el-button type="primary" @click="uploadPic('thumb')" size="mini">提交</el-button>
                </el-form-item>
                <el-form-item label="主图">
                    <input type="file" id="mainpic"/> <el-button type="primary" @click="uploadPic('mainpic')" size="mini">提交</el-button>
                </el-form-item>
            </el-form>
        </div>
        <div slot="footer" class="dialog-footer">
            <el-button @click="showDialog = false">关闭</el-button>
        </div>
    </el-dialog>
</template>

<script>
    export default {
        name: "albummanage",
        props: ['row'],
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
            uploadPic:function (type) {
                let formData = new FormData();
                formData.append('type', type);
                if (type == 'thumb'){
                    let thumb = document.querySelector('#thumb');
                    if (thumb.files.length == 0){
                        this.$message.error('请上传缩略图');
                        return;
                    }
                    formData.append("pic", thumb.files[0]);
                } else {
                    let mainpic = document.querySelector('#mainpic');
                    if (mainpic.files.length == 0){
                        this.$message.error('请上传主图');
                        return;
                    }
                    formData.append("pic", mainpic.files[0]);
                }
                this.uploading = true;
                axios.post('/productionlist/picupload/'+this.row.id, formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    })
                    .then((response)=>{
                        this.$message.success('添加成功');
                        this.$emit('update');
                    })
                    .catch((response)=>{

                    })
                    .finally(()=>{
                        this.uploading = false;
                    });
            },
        },
        created() {
            this.showDialog = true;
        }

    }
</script>

<style scoped>

</style>