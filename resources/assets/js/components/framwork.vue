<template>
    <el-container style="height: 100%;"
                  v-loading.fullscreen.lock="initloading">
        <el-aside width="200px" style="background-color: rgb(84, 92, 100)">
            <el-menu
                    v-if="systemready"
                    :default-active="currentMenu"
                    class="el-menu-vertical-demo"
                    background-color="#545c64"
                    text-color="#fff"
                    active-text-color="#ffd04b">
                <el-submenu index="1">
                    <template slot="title">
                        <i class="el-icon-menu"></i>
                        <span>作品管理</span>
                    </template>
                    <el-menu-item index="productionlist" @click="listproduction">作品列表</el-menu-item>
                </el-submenu>
            </el-menu>
        </el-aside>

        <el-container>
            <el-header style="text-align: right; font-size: 12px">
                <el-dropdown @command="handleCommand">
                    <i class="el-icon-setting" style="margin-right: 15px"></i>
                    <el-dropdown-menu slot="dropdown">
                        <el-dropdown-item command="logout">退出</el-dropdown-item>
                    </el-dropdown-menu>
                </el-dropdown>
                <span>{{ userName }}</span>
            </el-header>

            <el-main v-if="systemready">
                <router-view></router-view>
            </el-main>
        </el-container>
    </el-container>
</template>

<script>

    export default {
        name: "framwork",
        components: {},
        data() {
            return {
                initloading: true,
                systemready: false,
            }
        },
        computed: {
            currentMenu: function () {
                return this.$store.state.sidebar.current;
            },
            userName: function () {
                return this.$store.state.user.info.name;
            },
        },
        methods: {
            listproduction:function(){
                this.$router.push('/listproduction');
            },


            handleCommand(command) {
                switch (command) {
                    case 'logout':
                        window.location = '/logout';
                        break;
                }
            }
        },
        mounted() {
            axios.get('/admin/initlogindata')
                .then((response) => {
                    this.$store.commit('user/setInfo', response.data);
                    this.systemready = true;
                })
                .catch((response) => {
                    this.$message.error('获取初始化信息失败');
                })
                .finally((response) => {
                    this.initloading = false;
                });
        }
    }
</script>

<style>
    .el-header {
        background-color: #ffffff;
        color: #333;
        line-height: 60px;
        box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.15);
    }

    .el-aside {
        color: #333;
    }

    .el-main {
        padding: 5px;
    }
</style>